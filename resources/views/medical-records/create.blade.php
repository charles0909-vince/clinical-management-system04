@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3>Create New Medical Record</h3>
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

                    <form action="{{ route('medical-records.store') }}" method="POST">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="patient_id">Patient</label>
                            <select class="form-control" id="patient_id" name="patient_id" required>
                                <option value="">Select Patient</option>
                                @foreach($patients as $patient)
                                <option value="{{ $patient->id }}" {{ old('patient_id') == $patient->id ? 'selected' : '' }}>
                                {{ $patient->full_name }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <label for="visit_date">Visit Date</label>
                            <input type="date" class="form-control" id="visit_date" name="visit_date" 
                                   value="{{ old('visit_date', date('Y-m-d')) }}" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="symptoms">Symptoms</label>
                            <textarea class="form-control" id="symptoms" name="symptoms" rows="3">{{ old('symptoms') }}</textarea>
                        </div>

                        <div class="form-group mb-3">
                            <label for="diagnosis">Diagnosis</label>
                            <textarea class="form-control" id="diagnosis" name="diagnosis" rows="3" required>{{ old('diagnosis') }}</textarea>
                        </div>

                        <div class="form-group mb-3">
                            <label for="treatment">Treatment</label>
                            <textarea class="form-control" id="treatment" name="treatment" rows="3" required>{{ old('treatment') }}</textarea>
                        </div>

                        <div class="form-group mb-3">
                            <label for="prescription">Prescription</label>
                            <textarea class="form-control" id="prescription" name="prescription" rows="3">{{ old('prescription') }}</textarea>
                        </div>

                        <div class="form-group mb-3">
                            <label for="doctor_id">Doctor</label>
                            <select class="form-control" id="doctor_id" name="doctor_id" required>
                            <option value="">Select Doctor</option>
                        @foreach($doctors as $doctor)
                            <option value="{{ $doctor->id }}" {{ old('doctor_id') == $doctor->id ? 'selected' : '' }}>
                            Dr. {{ $doctor->first_name }} {{ $doctor->last_name }} ({{ $doctor->specialization }})
                            </option>
                        @endforeach
                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <label for="notes">Additional Notes</label>
                            <textarea class="form-control" id="notes" name="notes" rows="3">{{ old('notes') }}</textarea>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Save Record</button>
                            <a href="{{ route('medical-records.index') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection