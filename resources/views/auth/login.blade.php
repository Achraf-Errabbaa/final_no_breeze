@extends('layouts.app')

@section('content')
    <div class="relative flex justify-center items-center min-h-screen bg-cover bg-center bg-no-repeat">
        <!-- Background Video -->
        <video autoplay muted loop class="absolute inset-0 w-full h-full object-cover">
            <source src="{{ asset('images/fps.mp4') }}" type="video/mp4">
            Your browser does not support the video tag.
        </video>

        <!-- Login Form -->
        <div class="relative w-full max-w-md bg-white p-8 rounded-lg shadow-md z-10">
            <h2 class="text-3xl font-extrabold text-center mb-6 text-gray-800">Login</h2>

            <!-- Error Message -->
            @if(session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 p-4 rounded mb-4" role="alert">
                    {{ session('error') }}
                </div>
            @endif

            <!-- Login Form -->
            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}"
                        class="mt-1 block w-full px-4 py-2 rounded-md border border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        placeholder="example@email.com" required autofocus>
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input type="password" name="password" id="password"
                        class="mt-1 block w-full px-4 py-2 rounded-md border border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        placeholder="••••••••" required>
                </div>

                <!-- Login Button -->
                <div>
                    <button type="submit"
                        class="w-full py-2 px-4 text-white font-semibold bg-indigo-600 hover:bg-indigo-700 rounded-md shadow focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                        Login
                    </button>
                </div>
            </form>
        </div>

        <!-- Overlay -->
        <div class="absolute inset-0 bg-black bg-opacity-50"></div>
    </div>
@endsection
