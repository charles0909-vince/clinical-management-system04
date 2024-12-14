@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3>Medical Records</h3>
                    <a href="{{ route('medicalrecords.create') }}" class="btn btn-primary">Add New Record</a>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="mb-3">
                        <form action="{{ route('medicalrecords.index') }}" method="GET" class="form-inline">
                            <input type="text" name="search" class="form-control mr-2" placeholder="Search records..." value="{{ request('search') }}">
                            <button type="submit" class="btn btn-outline-primary">Search</button>
                        </form>
                    </div>

                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Patient Name</th>
                                <th>Visit Date</th>
                                <th>Diagnosis</th>
                                <th>Treatment</th>
                                <th>Doctor</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($medicalRecords as $record)
                            <tr>
                                <td>{{ $record->id }}</td>
                                <td>{{ $record->patient->name }}</td>
                                <td>{{ $record->visit_date }}</td>
                                <td>{{ Str::limit($record->diagnosis, 30) }}</td>
                                <td>{{ Str::limit($record->treatment, 30) }}</td>
                                <td>{{ $record->doctor }}</td>
                                <td>
                                    <a href="{{ route('medicalrecords.show', $record->id) }}" class="btn btn-info btn-sm">View</a>
                                    <a href="{{ route('medicalrecords.edit', $record->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('medicalrecords.destroy', $record->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $medicalRecords->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection