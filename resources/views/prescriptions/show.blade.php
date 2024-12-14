@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h3 class="card-title mb-0">Prescription Details</h3>
                    <div>
                        <a href="{{ route('prescriptions.edit', $prescription->id) }}" class="btn btn-light btn-sm me-2">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <a href="{{ route('prescriptions.index') }}" class="btn btn-light btn-sm">
                            <i class="fas fa-arrow-left"></i> Back
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    <!-- Patient & Doctor Information -->
                    <div class="row mb-4">
                        <!-- Patient Information -->
                        <div class="col-md-6">
                            <h5 class="fw-bold">Patient Information</h5>
                            <p><strong>Name:</strong> {{ $prescription->patient->name ?? 'N/A' }}</p>
                            <p><strong>ID:</strong> {{ $prescription->patient->id ?? 'N/A' }}</p>
                            <p><strong>Age:</strong> {{ $prescription->patient->age ?? 'N/A' }} years</p>
                        </div>
                        <!-- Doctor Information -->
                        <div class="col-md-6">
                            <h5 class="fw-bold">Doctor Information</h5>
                            <p><strong>Name:</strong> Dr. {{ $prescription->doctor->name ?? 'N/A' }}</p>
                            <p><strong>Specialization:</strong> {{ $prescription->doctor->specialization ?? 'N/A' }}</p>
                            <p><strong>Date:</strong> 
                                {{ $prescription->prescription_date ? $prescription->prescription_date->format('Y-m-d') : 'No Date' }}
                            </p>
                        </div>
                    </div>

                    <!-- Diagnosis -->
                    <div class="mb-4">
                        <h5 class="fw-bold">Diagnosis</h5>
                        <p>{{ $prescription->diagnosis ?? 'No diagnosis provided.' }}</p>
                    </div>

                    <!-- Medications -->
                    <div class="mb-4">
                        <h5 class="fw-bold">Prescribed Medications</h5>
                        @if(!empty($prescription->medications) && is_array($prescription->medications))
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead class="table-light">
                                    <tr>
                                        <th>Medication</th>
                                        <th>Dosage</th>
                                        <th>Frequency</th>
                                        <th>Duration</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($prescription->medications as $medication)
                                    <tr>
                                        <td>{{ $medication['name'] ?? 'N/A' }}</td>
                                        <td>{{ $medication['dosage'] ?? 'N/A' }}</td>
                                        <td>{{ $medication['frequency'] ?? 'N/A' }}</td>
                                        <td>{{ $medication['duration'] ?? 'N/A' }} days</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @else
                        <p>No medications provided.</p>
                        @endif
                    </div>

                    <!-- Additional Notes -->
                    @if(!empty($prescription->notes))
                    <div class="mb-4">
                        <h5 class="fw-bold">Additional Notes</h5>
                        <p>{{ $prescription->notes }}</p>
                    </div>
                    @endif

                    <!-- Print Button -->
                    <div class="mt-4">
                        <a href="{{ route('prescriptions.print', $prescription->id) }}" 
                           class="btn btn-info btn-sm" target="_blank">
                            <i class="fas fa-print"></i> Print Prescription
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
