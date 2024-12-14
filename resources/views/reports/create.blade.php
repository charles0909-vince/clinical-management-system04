@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3>Generate New Report</h3>
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

                    <form action="{{ route('reports.store') }}" method="POST">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="report_type">Report Type</label>
                            <select class="form-control" id="report_type" name="report_type" required>
                                <option value="">Select Report Type</option>
                                <option value="patient_statistics">Patient Statistics</option>
                                <option value="inventory">Inventory Report</option>
                                <option value="financial">Financial Report</option>
                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <label for="date_range">Date Range</label>
                            <select class="form-control" id="date_range" name="date_range" required>
                                <option value="today">Today</option>
                                <option value="week">This Week</option>
                                <option value="month">This Month</option>
                                <option value="year">This Year</option>
                                <option value="custom">Custom Range</option>
                            </select>
                        </div>

                        <div id="custom_dates" style="display: none;">
                            <div class="form-group mb-3">
                                <label for="start_date">Start Date</label>
                                <input type="date" class="form-control" id="start_date" name="start_date">
                            </div>

                            <div class="form-group mb-3">
                                <label for="end_date">End Date</label>
                                <input type="date" class="form-control" id="end_date" name="end_date">
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <label for="format">Report Format</label>
                            <select class="form-control" id="format" name="format" required>
                                <option value="pdf">PDF</option>
                                <option value="excel">Excel</option>
                                <option value="csv">CSV</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Generate Report</button>
                            <a href="{{ route('reports.index') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.getElementById('date_range').addEventListener('change', function() {
        const customDates = document.getElementById('custom_dates');
        if (this.value === 'custom') {
            customDates.style.display = 'block';
        } else {
            customDates.style.display = 'none';
        }
    });
</script>
@endpush
@endsection