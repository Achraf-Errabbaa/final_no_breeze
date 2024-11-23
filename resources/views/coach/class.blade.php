@extends('layouts.app')

@section('content')
@php
    $categories = ['Programming', 'Design', 'Marketing', 'Business'];
@endphp

<head>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<div class="bg-gray-100 min-h-screen py-8">
    <div class="container mx-auto px-4">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-gray-800">Class Dashboard</h1>
            <button id="addNewClassBtn" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Add New Class
            </button>
        </div>
        
        <!-- Class Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($classes as $class)
                <div class="bg-white rounded-lg shadow-md p-6 flex flex-col justify-between">
                    <div>
                        <h2 class="text-xl font-semibold mb-2 text-gray-800">{{ $class->name }}</h2>
                        <p class="text-gray-600 mb-4">{{ $class->description ?? 'No description available' }}</p>
                        <div class="flex items-center space-x-2 text-sm text-gray-500 mb-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                            <span>{{ $class->max_participants }} students</span>
                        </div>
                        <div class="flex items-center space-x-2 text-sm text-gray-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <span>Schedule information (not provided in original data)</span>
                        </div>
                    </div>
                    <div class="flex justify-between items-center mt-4">
                        <span class="bg-gray-200 text-gray-700 text-sm font-semibold px-3 py-1 rounded-full">{{ $class->category }}</span>
                        <div class="flex space-x-2">
                            <a href="{{ route('class.courses', $class->id) }}" class="bg-blue-500 text-white hover:bg-blue-600 px-3 py-1 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-50">
                                View Details
                            </a>
                            <form action="{{ route('classes.destroy', $class->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 text-white hover:bg-red-600 px-3 py-1 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-red-400 focus:ring-opacity-50">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

<!-- Add New Class Modal -->
<div id="addClassModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
    <div class="bg-white p-8 rounded-lg shadow-lg max-w-md w-full">
        <h2 class="text-2xl font-bold mb-4">Add New Class</h2>
        <form action="{{ route('classes.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Class Name:</label>
                <input type="text" name="name" id="name" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>
            <div class="mb-4">
                <label for="max_participants" class="block text-sm font-medium text-gray-700 mb-1">Maximum Participants:</label>
                <input type="number" name="max_participants" id="max_participants" max="21" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Category:</label>
                <div class="grid grid-cols-2 gap-2">
                    @foreach ($categories as $category)
                        <label class="inline-flex items-center">
                            <input type="radio" name="category" value="{{ $category }}" class="form-radio text-blue-600" required>
                            <span class="ml-2">{{ $category }}</span>
                        </label>
                    @endforeach
                </div>
            </div>
            <div class="flex justify-end space-x-2">
                <button type="button" id="closeModalBtn" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-opacity-50">
                    Cancel
                </button>
                <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-50">
                    Create Class
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    const addClassModal = document.getElementById('addClassModal');
    const addNewClassBtn = document.getElementById('addNewClassBtn');
    const closeModalBtn = document.getElementById('closeModalBtn');

    addNewClassBtn.addEventListener('click', () => {
        addClassModal.classList.remove('hidden');
    });

    closeModalBtn.addEventListener('click', () => {
        addClassModal.classList.add('hidden');
    });

    // Close modal when clicking outside
    addClassModal.addEventListener('click', (e) => {
        if (e.target === addClassModal) {
            addClassModal.classList.add('hidden');
        }
    });

    function updateThumbnail(event) {
        const file = event.target.files[0];
        const thumbnail = document.getElementById('fileThumbnail');
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                thumbnail.style.backgroundImage = `url(${e.target.result})`;
                thumbnail.innerHTML = '';
            };
            reader.readAsDataURL(file);
        }
    }
</script>
@endsection