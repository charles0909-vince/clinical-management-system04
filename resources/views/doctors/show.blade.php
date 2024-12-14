@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3>Doctor Details</h3>
                        <a href="{{ route('doctors.index') }}" class="btn btn-secondary">Back to List</a>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            @if($doctor->photo)
                                <img src="{{ asset('storage/' . $doctor->photo) }}" 
                                     alt="Doctor's photo" class="img-fluid rounded mb-3">
                            @else
                                <img src="{{ asset('images/default-doctor.png') }}" 
                                     alt="Default photo" class="img-fluid rounded mb-3">
                            @endif
                        </div>
                        <div class="col-md-8">
                            <h4>{{ $doctor->name }}</h4>
                            <p class="text-muted">{{ $doctor->specialization }}</p>
                            
                            <div class="mb-3">
                                <strong>Email:</strong> {{ $doctor->email }}
                            </div>
                            
                            <div class="mb-3">
                                <strong>Phone:</strong> {{ $doctor->phone }}
                            </div>
                            
                            <div class="mb-3">
                                <strong>Experience:</strong> {{ $doctor->experience }} years
                            </div>
                            
                            <div class="mb-3">
                                <strong>Status:</strong>
                                <span class="badge bg-{{ $doctor->status == 'active' ? 'success' : 'danger' }}">
                                    {{ ucfirst($doctor->status) }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <div                    <div class="mt-4">
                        <h5>Qualifications</h5>
                        <p>{{ $doctor->qualification }}</p>
                    </div>

                    <div class="mt-4">
                        <h5>Recent Appointments</h5>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Patient</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($doctor->appointments()->latest()->take(5)->get() as $appointment)
                                    <tr>
                                        <td>{{ $appointment->appointment_date }}</td>
                                        <td>{{ $appointment->patient->name }}</td>
                                        <td>
                                            <span class="badge bg-{{ $appointment->status == 'completed' ? 'success' : 'primary' }}">
                                                {{ ucfirst($appointment->status) }}
                                            </span>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="mt-4">
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('doctors.edit', $doctor->id) }}" class="btn btn-primary">Edit Doctor</a>
                            <form action="{{ route('doctors.destroy', $doctor->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this doctor?')">
                                    Delete Doctor
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