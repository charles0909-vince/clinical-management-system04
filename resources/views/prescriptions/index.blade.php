@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <div class="bg-blue-800 text-white px-6 py-4">
            <div class="flex justify-between items-center">
                <h3 class="text-lg font-bold">Prescriptions</h3>
                <a href="{{ route('prescriptions.create') }}" class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white font-medium text-sm rounded-lg">Create New Prescription</a>
            </div>
        </div>

        <div class="px-6 py-4">
            @if (session('success'))
                <div class="mb-4 px-4 py-3 bg-green-100 border border-green-300 text-green-700 rounded-lg" role="alert">
                    {{ session('success') }}
                </div>
            @endif

            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-200 rounded-lg">
                    <thead class="bg-gray-50">
                        <tr class="text-left text-xs font-semibold uppercase tracking-wider text-gray-600">
                            <th class="px-6 py-3 border-b">ID</th>
                            <th class="px-6 py-3 border-b">Patient</th>
                            <th class="px-6 py-3 border-b">Doctor</th>
                            <th class="px-6 py-3 border-b">Date</th>
                            <th class="px-6 py-3 border-b">Diagnosis</th>
                            <th class="px-6 py-3 border-b">Status</th>
                            <th class="px-6 py-3 border-b text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($prescriptions as $prescription)
                        <tr class="text-sm text-gray-700">
                            <td class="px-6 py-4">{{ $prescription->id }}</td>
                            <td class="px-6 py-4">{{ $prescription->patient->name }}</td>
                            <td class="px-6 py-4">{{ $prescription->doctor->name }}</td>
                            <td class="px-6 py-4">{{ $prescription->prescription_date ? $prescription->prescription_date->format('Y-m-d') : 'No Date' }}</td>
                            <td class="px-6 py-4">{{ Str::limit($prescription->diagnosis, 30) }}</td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-1 text-xs font-medium rounded-full {{ $prescription->status == 'active' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-600' }}">
                                    {{ ucfirst($prescription->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <a href="{{ route('prescriptions.show', $prescription->id) }}" class="px-3 py-1 text-sm text-blue-600 hover:underline">View</a>
                                <a href="{{ route('prescriptions.edit', $prescription->id) }}" class="px-3 py-1 text-sm text-yellow-600 hover:underline">Edit</a>
                                <form action="{{ route('prescriptions.destroy', $prescription->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-3 py-1 text-sm text-red-600 hover:underline" onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-4">
                {{ $prescriptions->links('pagination::tailwind') }}
            </div>
        </div>
    </div>
</div>
@endsection
