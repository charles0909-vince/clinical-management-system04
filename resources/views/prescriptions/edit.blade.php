@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3>Edit Prescription</h3>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('prescriptions.update', $prescription->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group mb-3">
                            <label for="patient_id">Patient</label>
                            <select class="form-control" id="patient_id" name="patient_id" required>
                                @foreach($patients as $patient)
                                    <option value="{{ $patient->id }}" {{ $prescription->patient_id == $patient->id ? 'selected' : '' }}>
                                        {{ $patient->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <label for="medication">Medication</label>
                            <input type="text" class="form-control" id="medication" name="medication" 
                                   value="{{ $prescription->medication }}" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="dosage">Dosage</label>
                            <input type="text" class="form-control" id="dosage" name="dosage" 
                                   value="{{ $prescription->dosage }}" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="frequency">Frequency</label>
                            <input type="text" class="form-control" id="frequency" name="frequency" 
                                   value="{{ $prescription->frequency }}" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="duration">Duration</label>
                            <input type="text" class="form-control" id="duration" name="duration" 
                                   value="{{ $prescription->duration }}" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="instructions">Instructions</label>
                            <textarea class="form-control" id="instructions" name="instructions" rows="3">{{ $prescription->instructions }}</textarea>
                        </div>

                        <div class="form-group mb-3">
                            <label for="prescribing_doctor">Prescribing Doctor</label>
                            <input type="text" class="form-control" id="prescribing_doctor" name="prescribing_doctor" 
                                   value="{{ $prescription->prescribing_doctor }}" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="prescription_date">Prescription Date</label>
                            <input type="date" class="form-control" id="prescription_date" name="prescription_date" 
                                   value="{{ $prescription->prescription_date }}" required>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Update Prescription</button>
                            <a href="{{ route('prescriptions.index') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection