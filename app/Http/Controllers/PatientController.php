<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;
use App\Models\Doctor;

class PatientController extends Controller
{
    public function index()
    {
        $patients = Patient::latest()->paginate(10);
        return view('patients.index', compact('patients'));
    }

    public function create()
    {
        $patients = Patient::all(); 
        $doctors = Doctor::all();   
    
        return view('patients.create', compact('patients', 'doctors'));
    }

    public function store(Request $request)
        {
            $validated = $request->validate([
                'registration_number' => 'required|string|unique:patients',
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'date_of_birth' => 'required|date',
                'gender' => 'required|in:male,female,other',
                'phone_number' => 'required|string|max:20',
                'address' => 'required|string',
            ]);
        
            Patient::create($validated);
        
            return redirect()->route('patients.index')
                ->with('success', 'Patient created successfully.');
        }
        

    public function show(Patient $patient)
    {
        return view('patients.show', compact('patient'));
    }

    public function edit(Patient $patient)
    {
        return view('patients.edit', compact('patient'));
    }

    public function update(Request $request, Patient $patient)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'gender' => 'required|in:male,female,other',
            'phone_number' => 'required|string|max:20',
            'email' => 'required|email|unique:patients,email,' . $patient->id,
            'address' => 'required|string',
        ]);
    
        $patient->update($validated);
    
        return redirect()->route('patients.index')
            ->with('success', 'Patient updated successfully.');
    }
    

    public function destroy(Patient $patient)
    {
        $patient->delete();

        return redirect()->route('patients.index')
            ->with('success', 'Patient deleted successfully.');
    }
}