@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="flex items-center justify-center">Class Management</h1>
        <form action="{{ route('classes.store') }}" method="POST"
            class="max-w-md mx-auto p-6 bg-white border border-gray-300 rounded-lg shadow-md">
            @csrf
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">Class Name:</label>
                <input type="text" name="name" id="name"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50"
                    required>
            </div>
            <div class="mb-4">
                <label for="max_participants" class="block text-sm font-medium text-gray-700">Maximum Participants:</label>
                <input type="number" name="max_participants" id="max_participants" max="21"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50"
                    required>
            </div>
            <button type="submit"
                class="w-full bg-blue-600 text-white font-semibold py-2 rounded-md hover:bg-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-50">Create
                Class</button>
        </form>
        <h2 class="mt-5">Existing Classes</h2>

        <table class="min-w-full bg-white border border-gray-200 shadow-md rounded-lg overflow-hidden">
            <thead>
                <tr class="bg-[#42248E] text-white">
                    <th class="py-3 px-4 text-left text-sm font-semibold">Class Name</th>
                    <th class="py-3 px-4 text-left text-sm font-semibold">Max Participants</th>
                    <th class="py-3 px-4 text-left text-sm font-semibold">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($classes as $class)
                    <tr class="border-b hover:bg-gray-100">
                        <td class="py-3 px-4 text-sm">{{ $class->name }}</td>
                        <td class="py-3 px-4 text-sm">{{ $class->max_participants }}</td>
                        <td class="py-3 px-4 text-sm flex gap-2">
                            <!-- Delete Button -->
                            <form action="{{ route('classes.destroy', $class->id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="bg-red-600 text-white hover:bg-red-500 focus:outline-none focus:ring-2 focus:ring-red-400 focus:ring-opacity-50 rounded-md px-2 py-1 text-xs">Delete</button>
                            </form>

                            <!-- View Courses Button -->
                            <a href="{{ route('class.courses', $class->id) }}"
                                class="bg-blue-600 text-white hover:bg-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-50 rounded-md px-2 py-1 text-xs">View
                                Courses</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
