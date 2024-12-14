@extends('layouts.app')

@section('content')
<div class="container mx-auto">
    <h1 class="text-2xl font-bold mb-4">Add Appointment</h1>
    <form action="{{ route('appointments.store') }}" method="POST">
    @csrf
    <div class="mb-4">
        <label for="patient_id" class="block text-gray-700">Patient</label>
        <select name="patient_id" id="patient_id" class="mt-1 block w-full" required>
            @foreach($patients as $patient)
                <option value="{{ $patient->id }}">{{ $patient->first_name }} {{ $patient->last_name }}</option>
            @endforeach
        </select>
    </div>
    <div class="mb-4">
        <label for="doctor_id" class="block text-gray-700">Doctor</label>
        <select name="doctor_id" id="doctor_id" class="mt-1 block w-full" required>
            @foreach($doctors as $doctor)
                <option value="{{ $doctor->id }}">{{ $doctor->first_name }} {{ $doctor->last_name }}</option>
            @endforeach
        </select>
    </div>
    <div class="mb-4">
        <label for="appointment_date" class="block text-gray-700">Appointment Date</label>
        <input type="datetime-local" name="appointment_date" id="appointment_date" class="mt-1 block w-full" required>
    </div>
    <div class="mb-4">
        <label for="status" class="block text-gray-700">Status</label>
        <select name="status" id="status" class="mt-1 block w-full" required>
            @foreach(\App\Models\Appointment::getStatuses() as $status)
                <option value="{{ $status }}">{{ ucfirst($status) }}</option>
            @endforeach
        </select>
    </div>
    <div class="mb-4">
        <label for="reason" class="block text-gray-700">Reason</label>
        <textarea name="reason" id="reason" class="mt-1 block w-full" required></textarea>
    </div>
    <div class="mb-4">
        <label for="notes" class="block text-gray-700">Notes</label>
        <textarea name="notes" id="notes" class="mt-1 block w-full"></textarea>
    </div>
    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Submit</button>
</form>
</div>
@endsection
