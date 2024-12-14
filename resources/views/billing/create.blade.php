@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white text-center">
                    <h3 class="mb-0">Create a New Bill</h3>
                </div>

                <div class="card-body">
                    <form action="{{ route('billing.store') }}" method="POST">
                        @csrf

                        <div class="mb-4">
                            <label for="amount" class="form-label fw-bold">Amount</label>
                            <input 
                                type="number" 
                                name="amount" 
                                id="amount" 
                                class="form-control @error('amount') is-invalid @enderror" 
                                placeholder="Enter amount" 
                                value="{{ old('amount') }}" 
                                required>
                            @error('amount')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-save me-2"></i> Submit
                            </button>
                        </div>
                    </form>
                </div>

                <div class="card-footer text-center">
                    <a href="{{ route('billing.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-2"></i> Back to Billing List
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
