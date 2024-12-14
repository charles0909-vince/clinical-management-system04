<?php

namespace App\Http\Controllers;

use App\Models\Prescription;
use App\Models\Patient;
use App\Models\Doctor;
use App\Models\Inventory;
use Illuminate\Http\Request;

class PrescriptionController extends Controller
{
    public function index()
    {
        $prescriptions = Prescription::with(['patient', 'doctor'])
            ->latest()
            ->paginate(10);
        return view('prescriptions.index', compact('prescriptions'));
    }

    public function create()
    {
        $patients = Patient::all();
        $doctors = Doctor::all();
        $medications = Inventory::where('type', 'medication')->get();
        return view('prescriptions.create', compact('patients', 'doctors', 'medications'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'doctor_id' => 'required|exists:doctors,id',
            'prescription_date' => 'required|date',
            'diagnosis' => 'required|string',
            'medications' => 'required|array',
            'instructions' => 'required|string',
            'notes' => 'nullable|string',
            'status' => 'required|in:active,completed,cancelled',
        ]);
    

        $validated['medications'] = json_encode($request->input('medications'));
    
        Prescription::create($validated);
    
        return redirect()->route('prescriptions.index')
            ->with('success', 'Prescription created successfully.');
    }
    

    public function show(Prescription $prescription)
    {
        return view('prescriptions.show', compact('prescription'));
    }

    public function edit(Prescription $prescription)
    {
        $patients = Patient::all();
        $doctors = Doctor::all();
        $medications = Inventory::where('type', 'medication')->get();
        return view('prescriptions.edit', compact('prescription', 'patients', 'doctors', 'medications'));
    }

    public function update(Request $request, Prescription $prescription)
    {
        $validated = $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'doctor_id' => 'required|exists:doctors,id',
            'prescription_date' => 'required|date',
            'diagnosis' => 'required|string',
            'medications' => 'required|array',
            'medications.*.id' => 'required|exists:inventory,id',
            'medications.*.dosage' => 'required|string',
            'medications.*.frequency' => 'required|string',
            'instructions' => 'required|string',
            'notes' => 'nullable|string',
            'status' => 'required|in:active,completed,cancelled'
        ]);

        $prescription->update($validated);

        return redirect()->route('prescriptions.index')
            ->with('success', 'Prescription updated successfully.');
    }

    public function destroy(Prescription $prescription)
    {
        $prescription->delete();
        return redirect()->route('prescriptions.index')
            ->with('success', 'Prescription deleted successfully.');
    }
}