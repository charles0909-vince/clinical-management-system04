@extends('layouts.app')

@section('content')
<div class="container py-5">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <h1 class="text-primary fw-bold">Doctors Directory</h1>
            <a href="{{ route('doctors.create') }}" class="btn btn-primary btn-sm">
                <i class="fas fa-user-plus me-2"></i> Add New Doctor
            </a>
        </div>
    </div>

    <!-- Doctors Table -->
    <div class="card shadow-sm border-0 rounded">
        <div class="card-body p-4">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-hover table-bordered align-middle">
                    <thead class="table-primary">
                        <tr>
                            <th class="text-center py-3">ID</th>
                            <th class="py-3">Name</th>
                            <th class="py-3">Specialization</th>
                            <th class="py-3">Email</th>
                            <th class="py-3">Phone</th>
                            <th class="text-center py-3">Status</th>
                            <th class="text-center py-3">Photo</th>
                            <th class="text-center py-3">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($doctors as $doctor)
                            <tr>
                                <td class="text-center py-3">{{ $doctor->id }}</td>
                                <td class="py-3">{{ $doctor->first_name }} {{ $doctor->last_name }}</td>
                                <td class="py-3">{{ $doctor->specialization }}</td>
                                <td class="py-3">{{ $doctor->email }}</td>
                                <td class="py-3">{{ $doctor->phone }}</td>
                                <td class="text-center py-3">
                                    <span class="badge bg-{{ $doctor->status == 'active' ? 'success' : 'danger' }}">
                                        {{ ucfirst($doctor->status) }}
                                    </span>
                                </td>
                                <td class="text-center py-3">
                                    <img src="{{ $doctor->photo ? asset('storage/' . $doctor->photo) : asset('images/default.png') }}" 
                                         alt="Doctor Photo" class="rounded-circle" width="50" height="50">
                                </td>
                                <td class="text-center py-3">
                                    <a href="{{ route('doctors.show', $doctor->id) }}" class="btn btn-sm btn-info me-2">
                                        <i class="fas fa-eye"></i> View
                                    </a>
                                    <a href="{{ route('doctors.edit', $doctor->id) }}" class="btn btn-sm btn-primary me-2">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <form action="{{ route('doctors.destroy', $doctor->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                                            <i class="fas fa-trash-alt"></i> Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center text-muted py-4">No doctors found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="mt-4">
                {{ $doctors->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</div>
@endsection
