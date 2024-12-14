@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3>Add New Inventory Item</h3>
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

                    <form action="{{ route('inventory.store') }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="name">Item Name</label>
        <input type="text" class="form-control" id="name" name="name" required>
    </div>

    <div class="form-group">
        <label for="type">Category</label>
        <select class="form-control" id="type" name="type" required>
            <option value="medication">Medication</option>
            <option value="equipment">Equipment</option>
            <option value="supply">Supply</option>
        </select>
    </div>

    <div class="form-group">
        <label for="quantity">Quantity</label>
        <input type="number" class="form-control" id="quantity" name="quantity" required>
    </div>

    <div class="form-group">
        <label for="unit">Unit</label>
        <input type="text" class="form-control" id="unit" name="unit" required>
    </div>

    <div class="form-group">
        <label for="price">Unit Price</label>
        <input type="number" step="0.01" class="form-control" id="price" name="price" required>
    </div>

    <div class="form-group">
        <label for="reorder_level">Reorder Level</label>
        <input type="number" class="form-control" id="reorder_level" name="reorder_level" required>
    </div>

    <div class="form-group">
        <label for="expiry_date">Expiry Date</label>
        <input type="date" class="form-control" id="expiry_date" name="expiry_date">
    </div>

    <div class="form-group mt-3">
        <button type="submit" class="btn btn-primary">Save Item</button>
        <a href="{{ route('inventory.index') }}" class="btn btn-secondary">Cancel</a>
    </div>
</form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection