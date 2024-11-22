@extends('layouts.app')

@section('content')
@php
    $categories = ['Programming', 'Design', 'Marketing', 'Business'];
@endphp
<head>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>

<div class="container mx-auto p-6">
    <h1 class="text-3xl font-bold text-[#22B8BF] mb-6">Course Management</h1>

    <!-- Form to Create a New Course -->
    <h2 class="text-2xl font-semibold mb-4">Create a New Course</h2>

    <div class="min-h-screen flex items-center justify-center">
        <div class="bg-[#1E3E62] p-8 w-full sm:w-[500px] flex items-center justify-center rounded-xl shadow-lg">
            <form action="{{ route('coach.store') }}" method="POST" class="w-full">
                @csrf
                <h2 class="text-2xl font-bold text-white mb-6 text-center">Create a New Course</h2>

                <!-- Course Title -->
                <div class="mb-6">
                    <label for="title" class="block text-sm font-medium text-white">Course Title:</label>
                    <input type="text" name="title" id="title" class="w-full p-3 border border-blue-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400 text-gray-800" required>
                </div>

                <!-- Description -->
                <div class="mb-6">
                    <label for="description" class="block text-sm font-medium text-white">Description:</label>
                    <textarea name="description" id="description" class="w-full p-3 border border-blue-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400 text-gray-800" required></textarea>
                </div>

                <!-- Category -->
                <div class="mb-6">
                    <label class="block text-sm font-medium text-white mb-3">Category:</label>
                    <button type="button" id="chooseCategoryBtn" class="w-full p-3 bg-blue-500 text-white rounded-md hover:bg-blue-600 focus:outline-none">Choose Category</button>
                    <input type="hidden" name="category" id="categoryInput" required>
                </div>

                <!-- Class Selection -->
                <div class="mb-6">
                    <label for="class_id" class="block text-sm font-medium text-white">Class:</label>
                    <select name="class_id" id="class_id" class="w-full p-3 border border-blue-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400" required>
                        <option value="" disabled selected>Select a class</option>
                        @foreach($classes as $class)
                            <option value="{{ $class->id }}">{{ $class->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="w-full bg-blue-500 text-white px-6 py-3 rounded-md hover:bg-blue-600 transition duration-200">Create Course</button>
            </form>
        </div>
    </div>

    <!-- Display Courses -->
    <h2 class="text-2xl font-semibold text-blue-500 mt-8">Existing Courses</h2>
    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-bold text-[#22B8BF] mb-6">Course Management</h1>
    
        <!-- Display Courses -->
        <h2 class="text-2xl font-semibold text-blue-500 mt-8">Existing Courses</h2>
        <div class="grid grid-cols-1 gap-6 mt-4">
            @foreach($courses->reverse() as $course)
                <div class="bg-white shadow-md rounded-lg overflow-hidden">
                    <div class="bg-blue-500 text-white px-4 py-2">
                        <h5 class="text-lg font-semibold">{{ $course->title }}</h5>
                    </div>
                    <div class="p-4">
                        <p class="text-sm text-gray-500"><strong>Category:</strong> {{ $course->category ?? 'Uncategorized' }}</p>
                        <p class="text-sm text-gray-500"><strong>Class:</strong> {{ $course->classes->name }}</p>
                        <p class="text-gray-700 mt-2 mb-2"><strong>Description:</strong>{{ \Str::limit($course->description, 100) }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    
</div>

<!-- Modal for Category Selection -->
<div id="categoryModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
    <div class="bg-white p-6 w-[300px] rounded-lg shadow-lg">
        <h3 class="text-xl font-bold text-center mb-4">Choose a Category</h3>
        <div class="flex flex-wrap justify-center space-x-4">
            @foreach($categories as $category)
                <button type="button" class="categoryBtn p-4 border border-blue-300 rounded-lg shadow-md hover:bg-blue-100 focus:outline-none" data-category="{{ $category }}">
                    <!-- Category-specific icons and names -->
                    @if($category == 'Programming')
                        <i class="fas fa-code text-blue-500 text-2xl"></i>
                    @elseif($category == 'Design')
                        <i class="fas fa-paint-brush text-green-500 text-2xl"></i>
                    @elseif($category == 'Marketing')
                        <i class="fas fa-chart-line text-red-500 text-2xl"></i>
                    @elseif($category == 'Business')
                        <i class="fas fa-briefcase text-yellow-500 text-2xl"></i>
                    @endif
                    <span class="mt-2 text-sm text-gray-800">{{ $category }}</span>
                </button>
            @endforeach
        </div>
        <div class="mt-4 text-center">
            <button id="closeModalBtn" class="px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600">Close</button>
        </div>
    </div>
</div>

<script>
    // Get elements
    const categoryModal = document.getElementById('categoryModal');
    const chooseCategoryBtn = document.getElementById('chooseCategoryBtn');
    const closeModalBtn = document.getElementById('closeModalBtn');
    const categoryInput = document.getElementById('categoryInput');
    
    // Open the modal when the category button is clicked
    chooseCategoryBtn.addEventListener('click', () => {
        categoryModal.classList.remove('hidden');
    });

    // Close the modal when the close button is clicked
    closeModalBtn.addEventListener('click', () => {
        categoryModal.classList.add('hidden');
    });

    // Set category input value when a category is selected
    document.querySelectorAll('.categoryBtn').forEach(button => {
        button.addEventListener('click', (event) => {
            const selectedCategory = event.target.getAttribute('data-category');
            categoryInput.value = selectedCategory;
            categoryModal.classList.add('hidden');
        });
    });
</script>

@endsection
