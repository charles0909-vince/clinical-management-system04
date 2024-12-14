@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3>Create New Prescription</h3>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('prescriptions.store') }}">
                        @csrf

                        <div class="form-group mb-3">
                            <label for="patient_id">Patient</label>
                            <select name="patient_id" id="patient_id" class="form-control @error('patient_id') is-invalid @enderror" required>
                                <option value="">Select Patient</option>
                                @foreach($patients as $patient)
                                    <option value="{{ $patient->id }}">{{ $patient->name }} (ID: {{ $patient->id }})</option>
                                @endforeach
                            </select>
                            @error('patient_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="doctor_id">Doctor</label>
                            <select name="doctor_id" id="doctor_id" class="form-control @error('doctor_id') is-invalid @enderror" required>
                                <option value="">Select Doctor</option>
                                @foreach($doctors as $doctor)
                                    <option value="{{ $doctor->id }}">Dr. {{ $doctor->name }} ({{ $doctor->specialization }})</option>
                                @endforeach
                            </select>
                            @error('doctor_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="date">Prescription Date</label>
                            <input type="date" name="date" id="date" class="form-control @error('date') is-invalid @enderror" 
                                   value="{{ old('date', date('Y-m-d')) }}" required>
                            @error('date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="diagnosis">Diagnosis</label>
                            <textarea name="diagnosis" id="diagnosis" class="form-control @error('diagnosis') is-invalid @enderror" 
                                      rows="3" required>{{ old('diagnosis') }}</textarea>
                            @error('diagnosis')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="card mb-3">
                            <div class="card-header">
                                Medications
                                <button type="button" class="btn btn-sm btn-success float-end" id="addMedication">Add Medication</button>
                            </div>
                            <div class="card-body">
                                <div id="medications">
                                    <div class="medication-item mb-3">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <input type="text" name="medications[0][name]" class="form-control" 
                                                       placeholder="Medication Name" required>
                                            </div>
                                            <div class="col-md-2">
                                                <input type="text" name="medications[0][dosage]" class="form-control" 
                                                       placeholder="Dosage" required>
                                            </div>
                                            <div class="col-md-3">
                                                <input type="text" name="medications[0][frequency]" class="form-control" 
                                                       placeholder="Frequency" required>
                                            </div>
                                            <div class="col-md-2">
                                                <input type="number" name="medications[0][duration]" class="form-control" 
                                                       placeholder="Duration (days)" required>
                                            </div>
                                            <div class="col-md-1">
                                                <button type="button" class="btn btn-danger btn-sm remove-medication">×</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <label for="notes">Additional Notes</label>
                            <textarea name="notes" id="notes" class="form-control @error('notes') is-invalid @enderror" 
                                      rows="3">{{ old('notes') }}</textarea>
                            @error('notes')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Create Prescription</button>
                            <a href="{{ route('prescriptions.index') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    $(document).ready(function() {
        let medicationCount = 1;

        $('#addMedication').click(function() {
            const newMedication = `
                <div class="medication-item mb-3">
                    <div class="row">
                        <div class="col-md-4">
                            <input type="text" name="medications[${medicationCount}][name]" class="form-control" 
                                   placeholder="Medication Name" required>
                        </div>
                        <div class="col-md-2">
                            <input type="text" name="medications[${medicationCount}][dosage]" class="form-control" 
                                   placeholder="Dosage" required>
                        </div>
                        <div class="col-md-3">
                            <input type="text" name="medications[${medicationCount}][frequency]" class="form-control" 
                                   placeholder="Frequency" required>
                        </div>
                        <div class="col-md-2">
                            <input type="number" name="medications[${medicationCount}][duration]" class="form-control" 
                                   placeholder="Duration (days)" required>
                        </div>
                        <div class="col-md-1">
                            <button type="button" class="btn btn-danger btn-sm remove-medication">×</button>
                        </div>
                    </div>
                </div>
            `;
            $('#medications').append(newMedication);
            medicationCount++;
        });

        $(document).on('click', '.remove-medication', function() {
            $(this).closest('.medication-item').remove();
        });
    });
</script>
@endpush
@endsection