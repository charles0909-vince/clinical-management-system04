@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3>Edit Inventory Item</h3>
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

                    <form action="{{ route('inventory.update', $inventory->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="item_name">Item Name</label>
                            <input type="text" class="form-control" id="item_name" name="item_name" 
                                   value="{{ $inventory->item_name }}" required>
                        </div>

                        <div class="form-group">
                            <label for="category">Category</label>
                            <select class="form-control" id="category" name="category" required>
                                <option value="Medicine" {{ $inventory->category == 'Medicine' ? 'selected' : '' }}>Medicine</option>
                                <option value="Equipment" {{ $inventory->category == 'Equipment' ? 'selected' : '' }}>Equipment</option>
                                <option value="Supplies" {{ $inventory->category == 'Supplies' ? 'selected' : '' }}>Supplies</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="quantity">Quantity</label>
                            <input type="number" class="form-control" id="quantity" name="quantity" 
                                   value="{{ $inventory->quantity }}" required>
                        </div>

                        <div class="form-group">
                            <label for="unit_price">Unit Price</label>
                            <input type="number" step="0.01" class="form-control" id="unit_price" name="unit_price" 
                                   value="{{ $inventory->unit_price }}" required>
                        </div>

                        <div class="form-group">
                            <label for="expiry_date">Expiry Date</label>
                            <input type="date" class="form-control" id="expiry_date" name="expiry_date" 
                                   value="{{ $inventory->expiry_date }}">
                        </div>

                        <div class="form-group mt-3">
                            <button type="submit" class="btn btn-primary">Update Item</button>
                            <a href="{{ route('inventory.index') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection