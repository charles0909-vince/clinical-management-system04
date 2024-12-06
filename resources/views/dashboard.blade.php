@extends('layouts.app')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-4">
    <div class="block p-6 bg-white border border-gray-200 rounded-lg shadow">
        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">{{ $stats['total_patients'] }}</h5>
        <p class="font-normal text-gray-700">Total Patients</p>
    </div>
    <div class="block p-6 bg-white border border-gray-200 rounded-lg shadow">
        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">{{ $stats['total_appointments'] }}</h5>
        <p class="font-normal text-gray-700">Total Appointments</p>
    </div>
    <div class="block p-6 bg-white border border-gray-200 rounded-lg shadow">
        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">{{ $stats['total_doctors'] }}</h5>
        <p class="font-normal text-gray-700">Total Doctors</p>
    </div>
    <div class="block p-6 bg-white border border-gray-200 rounded-lg shadow">
        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">{{ $stats['today_appointments'] }}</h5>
        <p class="font-normal text-gray-700">Today's Appointments</p>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
    <div class="p-4 bg-white border border-gray-200 rounded-lg shadow">
        <h3 class="text-xl font-semibold mb-4">Recent Appointments</h3>
        <div class="relative overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3">Patient</th>
                        <th scope="col" class="px-6 py-3">Doctor</th>
                        <th scope="col" class="px-6 py-3">Date</th>
                        <th scope="col" class="px-6 py-3">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($recent_appointments as $appointment)
                    <tr class="bg-white border-b">
                        <td class="px-6 py-4">{{ $appointment->patient->full_name }}</td>
                        <td class="px-6 py-4">{{ $appointment->doctor->full_name }}</td>
                        <td class="px-6 py-4">{{ $appointment->appointment_date->format('M d, Y') }}</td>
                        <td class="px-6 py-4">
                            <span class="px-2 py-1 text-xs rounded-full 
                                {{ $appointment->status === 'completed' ? 'bg-green-100 text-green-800' : '' }}
                                {{ $appointment->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                {{ $appointment->status === 'cancelled' ? 'bg-red-100 text-red-800' : '' }}
                            ">
                                {{ ucfirst($appointment->status) }}
                            </span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="p-4 bg-white border border-gray-200 rounded-lg shadow">
        <h3 class="text-xl font-semibold mb-4">Quick Actions</h3>
        <div class="grid grid-cols-2 gap-4">
            <a href="{{ route('patients.create') }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:ring-blue-300">
                New Patient
            </a>
            <a href="{{ route('appointments.create') }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-center text-white bg-green-700 rounded-lg hover:bg-green-800 focus:ring-4 focus:ring-green-300">
                New Appointment
            </a>
            <a href="{{ route('prescriptions.create') }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-center text-white bg-purple-700 rounded-lg hover:bg-purple-800 focus:ring-4 focus:ring-purple-300">
                New Prescription
            </a>
            <a href="{{ route('billing.create') }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-center text-white bg-orange-700 rounded-lg hover:bg-orange-800 focus:ring-4 focus:ring-orange-300">
                New Bill
            </a>
        </div>
    </div>
</div>
@endsection