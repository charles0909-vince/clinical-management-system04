@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3>Medical Record Details</h3>
                </div>
                <div class="card-body">
                    <table class="table">
                        <tr>
                            <th width="200">Patient Name:</th>
                            <td>{{ $medicalRecord->patient ? $medicalRecord->patient->name : 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Visit Date:</th>
                            <td>{{ $medicalRecord->visit_date ? $medicalRecord->visit_date->format('Y-m-d') : 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Symptoms:</th>
                            <td>{{ $medicalRecord->symptoms }}</td>
                        </tr>
                        <tr>
                            <th>Diagnosis:</th>
                            <td>{{ $medicalRecord->diagnosis }}</td>
                        </tr>
                        <tr>
                            <th>Treatment:</th>
                            <td>{{ $medicalRecord->treatment }}</td>
                        </tr>
                        <tr>
                            <th>Prescription:</th>
                            <td>{{ $medicalRecord->prescription }}</td>
                        </tr>
                        <tr>
                            <th>Doctor:</th>
                            <td>{{ $medicalRecord->doctor ? $medicalRecord->doctor->name : 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Additional Notes:</th>
                            <td>{{ $medicalRecord->notes }}</td>
                        </tr>
                        <tr>
                            <th>Created At:</th>
                            <td>{{ $medicalRecord->created_at ? $medicalRecord->created_at->format('Y-m-d H:i:s') : 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Last Updated:</th>
                            <td>{{ $medicalRecord->updated_at ? $medicalRecord->updated_at->format('Y-m-d H:i:s') : 'N/A' }}</td>
                        </tr>
                    </table>

                    <div class="mt-3">
                        <a href="{{ route('medical-records.edit', $medicalRecord->id) }}" class="btn btn-warning">Edit</a>
                        <a href="{{ route('medical-records.index') }}" class="btn btn-secondary">Back to List</a>
                        <form action="{{ route('medical-records.destroy', $medicalRecord->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
