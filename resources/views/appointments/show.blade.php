@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0 rounded">
                <!-- Card Header -->
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h3 class="mb-0">Appointment Details</h3>
                    <a href="{{ route('appointments.index') }}" class="btn btn-light btn-sm">
                        <i class="fas fa-arrow-left me-1"></i> Back to List
                    </a>
                </div>

                <!-- Card Body -->
                <div class="card-body">
                    <!-- Appointment ID -->
                    <div class="row mb-3">
                        <div class="col-md-4 fw-bold text-muted">Appointment ID:</div>
                        <div class="col-md-8">{{ $appointment->id }}</div>
                    </div>

                    <!-- Patient Name -->
                    <div class="row mb-3">
                        <div class="col-md-4 fw-bold text-muted">Patient Name:</div>
                        <div class="col-md-8">{{ $appointment->patient->first_name }} {{ $appointment->patient->last_name }}</div>
                    </div>

                    <!-- Doctor Name -->
                    <div class="row mb-3">
                        <div class="col-md-4 fw-bold text-muted">Doctor Name:</div>
                        <div class="col-md-8">{{ $appointment->doctor->first_name }} {{ $appointment->doctor->last_name }}</div>
                    </div>

                    <!-- Appointment Date -->
                    <div class="row mb-3">
                        <div class="col-md-4 fw-bold text-muted">Appointment Date:</div>
                        <div class="col-md-8">{{ $appointment->appointment_date->format('Y-m-d') }}</div>
                    </div>

                    <!-- Appointment Time -->
                    <div class="row mb-3">
                        <div class="col-md-4 fw-bold text-muted">Appointment Time:</div>
                        <div class="col-md-8">{{ $appointment->appointment_date->format('H:i:s') }}</div>
                    </div>

                    <!-- Reason for Visit -->
                    <div class="row mb-3">
                        <div class="col-md-4 fw-bold text-muted">Reason for Visit:</div>
                        <div class="col-md-8">{{ $appointment->reason }}</div>
                    </div>

                    <!-- Status -->
                    <div class="row mb-3">
                        <div class="col-md-4 fw-bold text-muted">Status:</div>
                        <div class="col-md-8">
                            <span class="badge bg-{{ $appointment->status == 'scheduled' ? 'primary' : ($appointment->status == 'completed' ? 'success' : 'danger') }}">
                                {{ ucfirst($appointment->status) }}
                            </span>
                        </div>
                    </div>

                    <!-- Created At -->
                    <div class="row mb-3">
                        <div class="col-md-4 fw-bold text-muted">Created At:</div>
                        <div class="col-md-8">{{ $appointment->created_at->format('Y-m-d H:i:s') }}</div>
                    </div>

                    <!-- Last Updated -->
                    <div class="row mb-3">
                        <div class="col-md-4 fw-bold text-muted">Last Updated:</div>
                        <div class="col-md-8">{{ $appointment->updated_at->format('Y-m-d H:i:s') }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
