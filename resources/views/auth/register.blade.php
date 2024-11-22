@extends('layouts.app')

@section('content')
    <div class="flex justify-center items-center min-h-screen w-full h-full bg-cover bg-center  bg-no-repeat relative">
        <video autoplay muted loop class="absolute w-full inset-0 h-full object-cover">
            <source src="{{ asset('images/fps.mp4') }}" type="video/mp4">
            Your browser does not support the video tag.
        </video>
        <div class="relative w-full max-w-lg bg-white p-10 rounded-lg shadow-lg z-10 border border-gray-200">
            <h2 class="text-3xl font-bold text-gray-800 mb-8 text-center">Create an Account</h2>

            <!-- Display Validation Errors -->
            @if ($errors->any())
                <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
                    <ul class="list-disc pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Registration Form -->
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Name -->
                <div class="mb-6">
                    <label for="name" class="block text-sm font-medium text-gray-700">Full Name</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}"
                        class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="Enter your full name" required autofocus>
                    @error('name')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Email -->
                <div class="mb-6">
                    <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}"
                        class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="Enter your email" required>
                    @error('email')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Password -->
                <div class="mb-6">
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input type="password" name="password" id="password"
                        class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="Create a password" required>
                    @error('password')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div class="mb-6">
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation"
                        class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="Confirm your password" required>
                </div>

                <!-- Register Button -->
                <div>
                    <button type="submit"
                        class="w-full py-3 px-4 bg-blue-600 text-white font-semibold rounded-md shadow-md hover:bg-blue-700 transition duration-200 ease-in-out focus:outline-none focus:ring focus:ring-blue-300">
                        Register
                    </button>
                </div>

                <!-- Login Link -->
                <div class="mt-4 text-center">
                    <p class="text-sm text-gray-600">Already have an account?
                        <a href="{{ route('login') }}" class="text-blue-600 hover:underline">Login here</a>
                    </p>
                </div>
            </form>
        </div>
    </div>
    <div class="absolute inset-0 bg-black bg-opacity-50"></div>
@endsection