@extends('layouts.app')

@section('content')
<div class="bg-gradient-to-b from-blue-50 to-white py-12">
    <div class="container mx-auto px-6 lg:px-12">
        <h1 class="text-5xl font-extrabold text-center text-blue-800 mb-8">Welcome to Clinica</h1>
        <p class="text-center text-lg text-gray-600 mb-12">Providing comprehensive care with excellence and compassion</p>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
            @foreach ([
                ['Total Patients', $stats['total_patients'], 'user-group'],
                ['Total Appointments', $stats['total_appointments'], 'calendar'],
                ['Total Doctors', $stats['total_doctors'], 'user-md'],
                ["Today's Appointments", $stats['today_appointments'], 'calendar-check'],
            ] as [$label, $value, $icon])
                <div class="flex items-center p-6 bg-white border border-gray-200 rounded-lg shadow-md hover:shadow-lg {{ is_string($value) ? 'cursor-pointer' : '' }}" 
                     @if (is_string($value)) onclick="window.location.href='{{ $value }}'" @endif>
                    <div class="p-4 rounded-full bg-blue-100 text-blue-600">
                        <i class="fas fa-{{ $icon }} fa-2x"></i>
                    </div>
                    <div class="ml-4">
                        @if (is_string($value))
                            <h5 class="text-3xl font-bold text-gray-800">Manage</h5>
                        @else
                            <h5 class="text-3xl font-bold text-gray-800">{{ $value }}</h5>
                        @endif
                        <p class="text-gray-600">{{ $label }}</p>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Appointments and Quick Actions -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

            <!--  Appointments -->
            <div class="p-6 bg-white border border-gray-200 rounded-lg shadow-md">
                <h3 class="text-2xl font-semibold text-blue-800 mb-6">Recent Appointments</h3>
                <div class="flex mb-4">
                    <input 
                        type="text" 
                        placeholder="Search appointments..." 
                        class="w-full p-3 border border-gray-300 rounded-lg focus:ring focus:ring-blue-200">
                </div>
                <div class="relative overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-600">
                        <thead class="text-xs text-gray-700 uppercase bg-blue-50">
                            <tr>
                                <th scope="col" class="px-6 py-3">Patient</th>
                                <th scope="col" class="px-6 py-3">Doctor</th>
                                <th scope="col" class="px-6 py-3">Date</th>
                                <th scope="col" class="px-6 py-3">Status</th>
                                <th scope="col" class="px-6 py-3 text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
    @forelse($recent_appointments as $appointment)
    <tr class="bg-white border-b hover:bg-gray-50">
        <td class="px-6 py-4">
            {{ $appointment->patient ? $appointment->patient->full_name : 'N/A' }}
        </td>
        <td class="px-6 py-4">
            {{ $appointment->doctor ? $appointment->doctor->full_name : 'N/A' }}
        </td>
        <td class="px-6 py-4">
            {{ $appointment->appointment_date ? $appointment->appointment_date->format('M d, Y') : 'N/A' }}
        </td>
        <td class="px-6 py-4">
            <span class="px-2 py-1 text-xs font-medium rounded-full 
                {{ $appointment->status === 'completed' ? 'bg-green-100 text-green-800' : '' }}
                {{ $appointment->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                {{ $appointment->status === 'cancelled' ? 'bg-red-100 text-red-800' : '' }}">
                {{ ucfirst($appointment->status) }}
            </span>
        </td>
        <td class="px-6 py-4 text-right">
            <a href="{{ route('appointments.show', $appointment->id) }}" class="text-blue-600 hover:underline">View</a>
        </td>
    </tr>
    @empty
    <tr>
        <td colspan="5" class="px-6 py-4 text-center text-gray-500">No recent appointments found.</td>
    </tr>
    @endforelse
</tbody>

                    </table>
                </div>
            </div>


            <!-- Medical Records -->
<div class="p-6 bg-white border border-gray-200 rounded-lg shadow-md">
    <h3 class="text-2xl font-semibold text-blue-800 mb-6">Recent Medical Records</h3>
    <div class="relative overflow-x-auto">
        <table class="w-full text-sm text-left text-gray-600">
            <thead class="text-xs text-gray-700 uppercase bg-blue-50">
                <tr>
                    <th scope="col" class="px-6 py-3">Patient</th>
                    <th scope="col" class="px-6 py-3">Doctor</th>
                    <th scope="col" class="px-6 py-3">Visit Date</th>
                    <th scope="col" class="px-6 py-3 text-right">Actions</th>
                </tr>
            </thead>
            <tbody>
    @forelse($recent_medical_records as $record)
    <tr class="bg-white border-b hover:bg-gray-50">
        <td class="px-6 py-4">
            {{ $record->patient ? $record->patient->name : 'N/A' }}
        </td>
        <td class="px-6 py-4">
            {{ $record->doctor ? $record->doctor->name : 'N/A' }}
        </td>
        <td class="px-6 py-4">
            {{ $record->visit_date ? $record->visit_date->format('M d, Y') : 'N/A' }}
        </td>
        <td class="px-6 py-4 text-right">
            <a href="{{ route('medicalrecords.show', $record->id) }}" class="text-blue-600 hover:underline">View</a>
        </td>
    </tr>
    @empty
    <tr>
        <td colspan="4" class="px-6 py-4 text-center text-gray-500">No recent medical records found.</td>
    </tr>
    @endforelse
</tbody>

        </table>
    </div>
</div>


            <!-- Quick Actions -->
            <div class="p-6 bg-white border border-gray-200 rounded-lg shadow-md">
                <h3 class="text-2xl font-semibold text-blue-800 mb-6">Quick Actions</h3>
                <div class="grid grid-cols-2 gap-6">
            @foreach ([
        ['New Patient', 'patients.create', 'user-plus', 'blue'],
        ['New Appointment', 'appointments.create', 'calendar-plus', 'green'],
        ['New Prescription', 'prescriptions.create', 'file-medical', 'purple'],
        ['New Bill', 'billing.create', 'file-invoice-dollar', 'orange'],
        ['New Medical Record', 'medicalrecords.create', 'file-alt', 'red'],
        ['New Inventory Item', 'inventory.create', 'box', 'indigo'],
    ] as [$label, $route, $icon, $color])
        <a 
            href="{{ route($route) }}" 
            class="flex items-center px-4 py-3 text-sm font-semibold text-black bg-{{ $color }}-500 rounded-lg shadow-md hover:bg-{{ $color }}-600 focus:ring focus:ring-{{ $color }}-300">
            <i class="fas fa-{{ $icon }} fa-lg mr-2"></i>{{ $label }}
        </a>
    @endforeach
</div>

            </div>

        </div>

        <!-- Manage Doctors Section -->
        <div class="p-6 mt-8 bg-white border border-gray-200 rounded-lg shadow-md">
            <h3 class="text-2xl font-semibold text-blue-800 mb-6">Manage Doctors</h3>
            <div class="flex justify-between items-center mb-4">
                <a href="{{ route('doctors.create') }}" class="px-4 py-2 bg-blue-500 text-white rounded-md shadow-md hover:bg-blue-600">Add New Doctor</a>
                <a href="{{ route('doctors.index') }}" class="text-blue-600 hover:underline">View All Doctors</a>
            </div>
            <div class="relative overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-600">
                    <thead class="text-xs text-gray-700 uppercase bg-blue-50">
                        <tr>
                            <th scope="col" class="px-6 py-3">Name</th>
                            <th scope="col" class="px-6 py-3">Specialization</th>
                            <th scope="col" class="px-6 py-3">Status</th>
                            <th scope="col" class="px-6 py-3 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recent_doctors as $doctor)
                        <tr class="bg-white border-b hover:bg-gray-50">
                            <td class="px-6 py-4">{{ $doctor->first_name }} {{ $doctor->last_name }}</td>
                            <td class="px-6 py-4">{{ $doctor->specialization }}</td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-1 text-xs font-medium rounded-full 
                                    {{ $doctor->status === 'active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ ucfirst($doctor->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <a href="{{ route('doctors.edit', $doctor->id) }}" class="text-blue-600 hover:underline">Edit</a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-6 py-4 text-center text-gray-500">No doctors found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
