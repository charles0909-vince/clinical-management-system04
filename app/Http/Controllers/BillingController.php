<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\Payment;
use App\Models\Patient;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class BillingController extends Controller
{
    public function index()
    {
        $bills = Bill::with(['patient', 'appointment'])
            ->latest()
            ->paginate(10);
        return view('billing.index', compact('bills'));
    }

    public function create()
    {
        $patients = Patient::all();
        $appointments = Appointment::where('status', 'completed')->get();
        return view('billing.create', compact('patients', 'appointments'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'appointment_id' => 'nullable|exists:appointments,id',
            'bill_date' => 'required|date',
            'due_date' => 'required|date|after:bill_date',
            'items' => 'required|array',
            'items.*.description' => 'required|string',
            'items.*.amount' => 'required|numeric|min:0',
            'subtotal' => 'required|numeric|min:0',
            'tax' => 'required|numeric|min:0',
            'discount' => 'required|numeric|min:0',
            'total' => 'required|numeric|min:0',
            'status' => 'required|in:pending,paid,partial,overdue',
            'payment_method' => 'nullable|string',
            'notes' => 'nullable|string'
        ]);

        $bill = Bill::create($validated);

        if ($request->has('payment_amount') && $request->payment_amount > 0) {
            Payment::create([
                'bill_id' => $bill->id,
                'amount' => $request->payment_amount,
                'payment_date' => now(),
                'payment_method' => $request->payment_method,
                'status' => 'completed',
                'notes' => 'Initial payment'
            ]);
        }

        return redirect()->route('billing.index')
            ->with('success', 'Bill created successfully.');
    }

    public function show(Bill $bill)
    {
        return view('billing.show', compact('bill'));
    }

    public function edit(Bill $bill)
    {
        $patients = Patient::all();
        $appointments = Appointment::where('status', 'completed')->get();
        return view('billing.edit', compact('bill', 'patients', 'appointments'));
    }

    public function update(Request $request, Bill $bill)
    {
        $validated = $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'appointment_id' => 'nullable|exists:appointments,id',
            'bill_date' => 'required|date',
            'due_date' => 'required|date|after:bill_date',
            'items' => 'required|array',
            'items.*.description' => 'required|string',
            'items.*.amount' => 'required|numeric|min:0',
            'subtotal' => 'required|numeric|min:0',
            'tax' => 'required|numeric|min:0',
            'discount' => 'required|numeric|min:0',
            'total' => 'required|numeric|min:0',
            'status' => 'required|in:pending,paid,partial,overdue',
            'payment_method' => 'nullable|string',
            'notes' => 'nullable|string'
        ]);

        $bill->update($validated);

        return redirect()->route('billing.index')
            ->with('success', 'Bill updated successfully.');
    }

    public function destroy(Bill $bill)
    {
        $bill->payments()->delete();
        $bill->delete();
        return redirect()->route('billing.index')
            ->with('success', 'Bill deleted successfully.');
    }

    public function generatePDF(Bill $bill)
    {
        $pdf = PDF::loadView('billing.pdf', compact('bill'));
        return $pdf->download('bill-'.$bill->id.'.pdf');
    }

    public function recordPayment(Request $request, Bill $bill)
    {
        $validated = $request->validate([
            'amount' => 'required|numeric|min:0',
            'payment_method' => 'required|string',
            'payment_date' => 'required|date',
            'notes' => 'nullable|string'
        ]);

        $payment = Payment::create([
            'bill_id' => $bill->id,
            'amount' => $validated['amount'],
            'payment_date' => $validated['payment_date'],
            'payment_method' => $validated['payment_method'],
            'status' => 'completed',
            'notes' => $validated['notes']
        ]);

        $totalPaid = $bill->payments()->sum('amount');
        $bill->status = $totalPaid >= $bill->total ? 'paid' : 'partial';
        $bill->save();

        return redirect()->route('billing.show', $bill)
            ->with('success', 'Payment recorded successfully.');
    }
}