@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3>Edit Report</h3>
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

                    <form action="{{ route('reports.update', $report->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="form-group mb-3">
                            <label for="report_type">Report Type</label>
                            <select class="form-control" id="report_type" name="report_type" required>
                                <option value="Patient Statistics" {{ $report->type === 'Patient Statistics' ? 'selected' : '' }}>Patient Statistics</option>
                                <option value="Inventory Report" {{ $report->type === 'Inventory Report' ? 'selected' : '' }}>Inventory Report</option>
                                <option value="Financial Report" {{ $report->type === 'Financial Report' ? 'selected' : '' }}>Financial Report</option>
                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <label for="date_range">Date Range</label>
                            <select class="form-control" id="date_range" name="date_range" required>
                                <option value="today" {{ $report->date_range === 'today' ? 'selected' : '' }}>Today</option>
                                <option value="week" {{ $report->date_range === 'week' ? 'selected' : '' }}>This Week</option>
                                <option value="month" {{ $report->date_range === 'month' ? 'selected' : '' }}>This Month</option>
                                <option value="year" {{ $report->date_range === 'year' ? 'selected' : '' }}>This Year</option>
                                <option value="custom" {{ $report->date_range === 'custom' ? 'selected' : '' }}>Custom Range</option>
                            </select>
                        </div>

                        <div id="custom_dates" @if($report->date_range === 'custom') style="display: block;" @else style="display: none;" @endif>
                            <div class="form-group mb-3">
                                <label for="start_date">Start Date</label>
                                <input type="date" class="form-control" id="start_date" name="start_date" 
                                       value="{{ $report->start_date }}">
                            </div>

                            <div class="form-group mb-3">
                                <label for="end_date">End Date</label>
                                <input type="date" class="form-control" id="end_date" name="end_date" 
                                       value="{{ $report->end_date }}">
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <label for="description">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3">{{ $report->description }}</textarea>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Update Report</button>
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
document.addEventListener('DOMContentLoaded', function() {
    var dateRange = document.getElementById('date_range');
    var customDates = document.getElementById('custom_dates');

    dateRange.addEventListener('change', function() {
        if (this.value === 'custom') {
            customDates.style.display = 'block';
        } else {
            customDates.style.display = 'none';
        }
    });
});
</script>
@endpush
@endsection