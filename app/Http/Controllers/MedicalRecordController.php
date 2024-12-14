<?php

namespace App\Http\Controllers;

use App\Models\MedicalRecord;
use App\Models\Patient;
use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MedicalRecordController extends Controller
{
    public function index(Request $request)
    {
      
        $query = MedicalRecord::query();
    
        if ($request->has('search') && $request->search !== null) {
            $query->whereHas('patient', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%');
            })->orWhereHas('doctor', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%');
            });
        }
    
        
        $medicalRecords = $query->with(['patient', 'doctor'])
            ->latest()
            ->paginate(10);
    
      
        return view('medical-records.index', compact('medicalRecords'));
    }
    

    public function create()
    {
        $patients = Patient::all();
        $doctors = Doctor::all();
        return view('medical-records.create', compact('patients', 'doctors'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'doctor_id' => 'required|exists:doctors,id',
            'diagnosis' => 'required|string',
            'treatment' => 'required|string',
            'notes' => 'nullable|string',
            'visit_date' => 'required|date',
            'next_visit_date' => 'nullable|date',
            'attachments.*' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048'
        ]);

        if ($request->hasFile('attachments')) {
            $attachments = [];
            foreach ($request->file('attachments') as $file) {
                $path = $file->store('medical-records');
                $attachments[] = $path;
            }
            $validated['attachments'] = $attachments;
        }

        MedicalRecord::create($validated);

        return redirect()->route('medical-records.index')
            ->with('success', 'Medical record created successfully.');
    }

    public function show($id)
    {
        $medicalRecord = MedicalRecord::findOrFail($id); 
        return view('medical-records.show', compact('medicalRecord'));
    }
    

    public function edit(MedicalRecord $medicalRecord)
    {
        $patients = Patient::all();
        $doctors = Doctor::all();
        return view('medical-records.edit', compact('medicalRecord', 'patients', 'doctors'));
    }
    

    public function update(Request $request, MedicalRecord $medicalRecord)
    {
        $validated = $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'doctor_id' => 'required|exists:doctors,id',
            'diagnosis' => 'required|string',
            'treatment' => 'required|string',
            'notes' => 'nullable|string',
            'visit_date' => 'required|date',
            'next_visit_date' => 'nullable|date',
            'attachments.*' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048'
        ]);

        if ($request->hasFile('attachments')) {
            if ($medicalRecord->attachments) {
                foreach ($medicalRecord->attachments as $attachment) {
                    Storage::delete($attachment);
                }
            }

            $attachments = [];
            foreach ($request->file('attachments') as $file) {
                $path = $file->store('medical-records');
                $attachments[] = $path;
            }
            $validated['attachments'] = $attachments;
        }

        $medicalRecord->update($validated);

        return redirect()->route('medical-records.index')
            ->with('success', 'Medical record updated successfully.');
    }

    public function destroy(MedicalRecord $medicalRecord)
    {
        if ($medicalRecord->attachments) {
            foreach ($medicalRecord->attachments as $attachment) {
                Storage::delete($attachment);
            }
        }

        $medicalRecord->delete();

        return redirect()->route('medical-records.index')
            ->with('success', 'Medical record deleted successfully.');
    }
}