@extends('layouts.app')

@section('title', 'Report Details')

@section('content')
<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h3>Report Details</h3>
        </div>
        <div class="card-body">
            <h4>Patient Information</h4>
            <ul>
                <li><strong>Name:</strong> {{ $report->patient->name }}</li>
                <li><strong>Age:</strong> {{ $report->patient->age }}</li>
                <li><strong>Gender:</strong> {{ $report->patient->gender }}</li>
                <li><strong>Contact:</strong> {{ $report->patient->contact }}</li>
            </ul>

            <h4>Report Details</h4>
            <ul>
                <li><strong>Report ID:</strong> {{ $report->id }}</li>
                <li><strong>Date:</strong> {{ $report->created_at->format('d M, Y') }}</li>
                <li><strong>Diagnosis:</strong> {{ $report->diagnosis }}</li>
                <li><strong>Prescriptions:</strong> {{ $report->prescriptions }}</li>
                <li><strong>Notes:</strong> {{ $report->notes }}</li>
            </ul>

            <h4>Doctor Information</h4>
            <ul>
                <li><strong>Doctor Name:</strong> {{ $report->doctor->name }}</li>
                <li><strong>Specialization:</strong> {{ $report->doctor->specialization }}</li>
                <li><strong>Contact:</strong> {{ $report->doctor->contact }}</li>
            </ul>
        </div>
        <div class="card-footer text-right">
            <a href="{{ route('reports.index') }}" class="btn btn-secondary">Back to Reports</a>
            <a href="{{ route('reports.edit', $report->id) }}" class="btn btn-primary">Edit</a>
            <form action="{{ route('reports.destroy', $report->id) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this report?')">Delete</button>
            </form>
        </div>
    </div>
</div>
@endsection
