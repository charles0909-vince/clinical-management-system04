@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3>Patient Details</h3>
                        <a href="{{ route('patients.index') }}" class="btn btn-secondary">Back to List</a>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            @if($patient->photo)
                                <img src="{{ asset('storage/' . $patient->photo) }}" 
                                     alt="Patient's photo" class="img-fluid rounded mb-3">
                            @else
                                <img src="{{ asset('images/default-patient.png') }}" 
                                     alt="Default photo" class="img-fluid rounded mb-3">
                            @endif
                        </div>
                        <div class="col-md-8">
                            <h4>{{ $patient->name }}</h4>
                            <p class="text-muted">Patient ID: {{ $patient->id }}</p>
                            
                            <div class="mb-3">
                                <strong>Email:</strong> {{ $patient->email }}
                            </div>
                            
                            <div class="mb-3">
                                <strong>Phone:</strong> {{ $patient->phone }}
                            </div>
                            
                            <div class="mb-3">
                                <strong>Age:</strong> {{ $patient->age }} years
                            </div>
                            
                            <div class="mb-3">
                                <strong>Blood Group:</strong> {{ $patient->blood_group }}
                            </div>

                            <div class="mb-3">
                                <strong>Address:</strong><br>
                                {{ $patient->address }}
                            </div>
                        </div>
                    </div>

                    <div class="mt-4">
                        <h5>Medical History</h5>
                        <p>{{ $patient->medical_history ?? 'No medical history recorded.' }}</p>
                    </div>

                    <div class="mt-4">
                        <h5>Recent Appointments</h5>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Doctor</th>
                                        <th>Reason</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($patient->appointments()->latest()->take(5)->get() as $appointment)
                                    <tr>
                                        <td>{{ $appointment->appointment_date }}</td>
                                        <td>{{ $appointment->doctor->name }}</td>
                                        <td>{{ $appointment->reason }}</td>
                                        <td>
                                            <span class="badge bg-{{ $appointment->status == 'completed' ? 'success' : 'primary' }}">
                                                {{ ucfirst($appointment->status) }}
                                            </span>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="4" class="text-center">No appointments found</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="mt-4">
                        <h5>Recent Medical Records</h5>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Diagnosis</th>
                                        <th>Treatment</th>
                                        <th>Doctor</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($patient->medicalRecords()->latest()->take(5)->get() as $record)
                                    <tr>
                                        <td>{{ $record->date }}</td>
                                        <td>{{ $record->diagnosis }}</td>
                                        <td>{{ $record->treatment }}</td>
                                        <td>{{ $record->doctor->name }}</td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="4" class="text-center">No medical records found</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="mt-4">
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('patients.edit', $patient->id) }}" class="btn btn-primary">Edit Patient</a>
                            <form action="{{ route('patients.destroy', $patient->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this patient?')">
                                    Delete Patient
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection