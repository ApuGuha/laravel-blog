@extends('layouts.app')

@section('title', $blog->title)

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-lg shadow-lg p-8">
        <!-- Header -->
        <div class="mb-6">
            <h1 class="text-4xl font-bold text-gray-900 mb-4">{{ $blog->title }}</h1>
            <div class="flex items-center justify-between text-sm text-gray-500">
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                    </svg>
                    <span class="font-medium">{{ $blog->user->name }}</span>
                    <span class="mx-2">•</span>
                    <span class="bg-gray-100 px-2 py-1 rounded text-xs">{{ ucfirst($blog->user->role) }}</span>
                </div>
                <span>{{ $blog->created_at->format('M d, Y') }}</span>
            </div>
        </div>

        <!-- Content -->
        <div class="prose prose-lg max-w-none mb-8">
            <div class="text-gray-700 leading-relaxed whitespace-pre-line">{{ $blog->content }}</div>
        </div>

        <!-- Actions -->
        <div class="pt-6 border-t border-gray-200">
            <div class="flex gap-3">
                <a href="{{ route('blogs.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-2 rounded font-semibold">
                    ← Back to All Blogs
                </a>
                
                @auth
                    @if(auth()->user()->canEdit($blog))
                        <a href="{{ route('blogs.edit', $blog->id) }}" class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded font-semibold">
                            Edit Blog
                        </a>
                    @endif
                    
                    @if(auth()->user()->canDelete($blog))
                        <form action="{{ route('blogs.destroy', $blog->id) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this blog?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-6 py-2 rounded font-semibold">
                                Delete Blog
                            </button>
                        </form>
                    @endif
                @endauth
            </div>
        </div>

        <!-- Metadata -->
        <div class="mt-6 pt-6 border-t border-gray-200">
            <div class="grid grid-cols-2 gap-4 text-sm text-gray-500">
                <div>
                    <span class="font-semibold">Created:</span> {{ $blog->created_at->format('F j, Y g:i A') }}
                </div>
                <div>
                    <span class="font-semibold">Updated:</span> {{ $blog->updated_at->format('F j, Y g:i A') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
