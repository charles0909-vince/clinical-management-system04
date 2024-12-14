@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3>Inventory Item Details</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table">
                                <tr>
                                    <th>Item Name:</th>
                                    <td>{{ $inventory->item_name }}</td>
                                </tr>
                                <tr>
                                    <th>Category:</th>
                                    <td>{{ $inventory->category }}</td>
                                </tr>
                                <tr>
                                    <th>Quantity:</th>
                                    <td>{{ $inventory->quantity }}</td>
                                </tr>
                                <tr>
                                    <th>Unit Price:</th>
                                    <td>${{ number_format($inventory->unit_price, 2) }}</td>
                                </tr>
                                <tr>
                                    <th>Expiry Date:</th>
                                    <td>{{ $inventory->expiry_date }}</td>
                                </tr>
                                <tr>
                                    <th>Created At:</th>
                                    <td>{{ $inventory->created_at->format('Y-m-d H:i:s') }}</td>
                                </tr>
                                <tr>
                                    <th>Last Updated:</th>
                                    <td>{{ $inventory->updated_at->format('Y-m-d H:i:s') }}</td>
                                </tr>
                            </table>

                            <div class="mt-3">
                                <a href="{{ route('inventory.edit', $inventory->id) }}" class="btn btn-warning">Edit</a>
                                <a href="{{ route('inventory.index') }}" class="btn btn-secondary">Back to List</a>
                                <form action="{{ route('inventory.destroy', $inventory->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection