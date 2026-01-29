@extends('layouts.app')

@section('title', 'Edit Blog')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-lg shadow-lg p-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-6">Edit Blog</h1>
        
        <form action="{{ route('blogs.update', $blog->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="mb-6">
                <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Blog Title</label>
                <input 
                    type="text" 
                    name="title" 
                    id="title" 
                    value="{{ old('title', $blog->title) }}"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('title') border-red-500 @enderror"
                    required
                >
                @error('title')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="content" class="block text-sm font-medium text-gray-700 mb-2">Blog Content</label>
                <textarea 
                    name="content" 
                    id="content" 
                    rows="15"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('content') border-red-500 @enderror"
                    required
                >{{ old('content', $blog->content) }}</textarea>
                @error('content')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex gap-4">
                <button 
                    type="submit" 
                    class="bg-indigo-600 hover:bg-indigo-700 text-white px-8 py-3 rounded-lg font-semibold transition duration-200"
                >
                    Update Blog
                </button>
                <a 
                    href="{{ route('blogs.show', $blog->id) }}" 
                    class="bg-gray-500 hover:bg-gray-600 text-white px-8 py-3 rounded-lg font-semibold transition duration-200"
                >
                    Cancel
                </a>
            </div>
        </form>
    </div>

    <!-- Info Section -->
    <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-6 mt-6">
        <h3 class="text-lg font-semibold text-yellow-900 mb-2">Blog Information</h3>
        <div class="text-sm text-yellow-800 space-y-1">
            <p><strong>Author:</strong> {{ $blog->user->name }}</p>
            <p><strong>Created:</strong> {{ $blog->created_at->format('F j, Y g:i A') }}</p>
            <p><strong>Last Updated:</strong> {{ $blog->updated_at->format('F j, Y g:i A') }}</p>
        </div>
    </div>
</div>
@endsection
