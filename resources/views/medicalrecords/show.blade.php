
@extends('layouts.app')

@section('content')
    <h1>Medical Record Details</h1>
    <p>ID: {{ $medicalRecord->id }}</p>
    <p>Patient Name: {{ $medicalRecord->patient_name }}</p>
    <p>Diagnosis: {{ $medicalRecord->diagnosis }}</p>
    <!-- Add more fields as necessary -->
@endsection