<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Bill;
use App\Models\Patient;
use App\Models\Doctor;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportController extends Controller
{
    public function index()
    {
        return view('reports.index');
    }

    public function generateReport(Request $request)
    {
        $validated = $request->validate([
            'report_type' => 'required|in:financial,appointments,patients,inventory',
            'date_from' => 'required|date',
            'date_to' => 'required|date|after:date_from'
        ]);

        $dateFrom = Carbon::parse($validated['date_from']);
        $dateTo = Carbon::parse($validated['date_to']);

        switch ($validated['report_type']) {
            case 'financial':
                $data = $this->generateFinancialReport($dateFrom, $dateTo);
                $view = 'reports.financial';
                break;
            case 'appointments':
                $data = $this->generateAppointmentsReport($dateFrom, $dateTo);
                $view = 'reports.appointments';
                break;
            case 'patients':
                $data = $this->generatePatientsReport($dateFrom, $dateTo);
                $view = 'reports.patients';
                break;
            case 'inventory':
                $data = $this->generateInventoryReport($dateFrom, $dateTo);
                $view = 'reports.inventory';
                break;
        }

        if ($request->format === 'pdf') {
            $pdf = PDF::loadView($view, $data);
            return $pdf->download($validated['report_type'].'-report.pdf');
        }

        return view($view, $data);
    }

    private function generateFinancialReport($dateFrom, $dateTo)
    {
        $bills = Bill::whereBetween('bill_date', [$dateFrom, $dateTo])->get();
        
        return [
            'total_revenue' => $bills->sum('total'),
            'total_paid' => $bills->sum(function($bill) {
                return $bill->payments->sum('amount');
            }),
            'total_pending' => $bills->where('status', 'pending')->sum('total'),
            'bills_by_status' => $bills->groupBy('status'),
            'monthly_revenue' => $bills->groupBy(function($bill) {
                return $bill->bill_date->format('Y-m');
            }),
            'date_range' => [
                'from' => $dateFrom->format('Y-m-d'),
                'to' => $dateTo->format('Y-m-d')
            ]
        ];
    }

    private function generateAppointmentsReport($dateFrom, $dateTo)
    {
        $appointments = Appointment::whereBetween('appointment_date', [$dateFrom, $dateTo])
            ->with(['patient', 'doctor'])
            ->get();

        return [
            'total_appointments' => $appointments->count(),
            'completed_appointments' => $appointments->where('status', 'completed')->count(),
            'cancelled_appointments' => $appointments->where('status', 'cancelled')->count(),
            'appointments_by_doctor' => $appointments->groupBy('doctor_id'),
            'appointments_by_date' => $appointments->groupBy(function($appointment) {
                return $appointment->appointment_date->format('Y-m-d');
            }),
            'date_range' => [
                'from' => $dateFrom->format('Y-m-d'),
                'to' => $dateTo->format('Y-m-d')
            ]
        ];
    }

    private function generatePatientsReport($dateFrom, $dateTo)
    {
        $patients = Patient::whereBetween('created_at', [$dateFrom, $dateTo])->get();
        
        return [
            'total_patients' => $patients->count(),
            'new_patients' => $patients->count(),
            'patients_by_gender' => $patients->groupBy('gender'),
            'patients_by_age' => $patients->groupBy(function($patient) {
                return Carbon::parse($patient->date_of_birth)->age;
            }),
            'date_range' => [
                'from' => $dateFrom->format('Y-m-d'),
                'to' => $dateTo->format('Y-m-d')
            ]
        ];
    }

    private function generateInventoryReport($dateFrom, $dateTo)
    {
        $inventory = \App\Models\Inventory::all();
        
        return [
            'total_items' => $inventory->count(),
            'low_stock_items' => $inventory->where('quantity', '<=', 'reorder_level')->count(),
            'items_by_type' => $inventory->groupBy('type'),
            'total_value' => $inventory->sum(function($item) {
                return $item->quantity * $item->price;
            }),
            'date_range' => [
                'from' => $dateFrom->format('Y-m-d'),
                'to' => $dateTo->format('Y-m-d')
            ]
        ];
    }
}