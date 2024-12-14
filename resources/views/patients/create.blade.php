@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <div class="bg-blue-800 text-white px-6 py-4">
            <h3 class="text-lg font-bold">Add New Patient</h3>
        </div>
        <div class="px-6 py-4">
            @if (session('success'))
                <div class="mb-4 px-4 py-3 bg-green-100 border border-green-300 text-green-700 rounded-lg" role="alert">
                    {{ session('success') }}
                </div>
            @endif

            <form id="create-patient-form" action="{{ route('patients.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="registration_number" class="block text-gray-700">Registration Number</label>
                    <input type="text" name="registration_number" id="registration_number" 
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" 
                         required>
                 </div>
                <div class="mb-4">
                    <label for="first_name" class="block text-sm font-medium text-gray-700">First Name</label>
                    <input type="text" name="first_name" id="first_name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                </div>

                <div class="mb-4">
                    <label for="last_name" class="block text-sm font-medium text-gray-700">Last Name</label>
                    <input type="text" name="last_name" id="last_name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                </div>

                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" name="email" id="email" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                </div>

                <div class="mb-4">
                    <label for="phone_number" class="block text-gray-700">Phone Number</label>
                    <input type="text" name="phone_number" id="phone_number" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                </div>

                <div class="mb-4">
                    <label for="date_of_birth" class="block text-sm font-medium text-gray-700">Date of Birth</label>
                    <input type="date" name="date_of_birth" id="date_of_birth" 
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" 
                        required>
                </div>

                <!-- Gender -->
                <div class="mb-4">
                    <label for="gender" class="block text-sm font-medium text-gray-700">Gender</label>
                    <select name="gender" id="gender" 
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" 
                        required>
                        <option value="">Select Gender</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                        <option value="other">Other</option>
                    </select>
                </div>

                <!-- Address -->
                <div class="mb-4">
                    <label for="address" class="block text-sm font-medium text-gray-700">Address</label>
                    <textarea name="address" id="address" rows="3" 
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                        required></textarea>
                </div>


                <button type="submit" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-md">Submit</button>
            </form>
        </div>
    </div>
</div>
@endsection
