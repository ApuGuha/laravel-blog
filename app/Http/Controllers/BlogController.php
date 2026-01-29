<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blogs = Blog::with('user')->latest()->paginate(10);
        return view('blogs.index', compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth::user();
        //check user can create blog( admin or editor)
        if(!Auth::check() || !$user->canCreateBlog())
        {
            abort(403, 'Unauthorized action.');
        }
        return view('blogs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        //check user can create blog( admin or editor)
        if(!Auth::check() || !$user->canCreateBlog())
        {
            abort(403, 'Unauthorized action.');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string'
        ]);

        $blog = Blog::create([
            'title' => $validated['title'],
            'content' => $validated['content'],
            'user_id' => Auth::id()
        ]);

        return redirect()->route('blogs.show', $blog->id)->with('success' , 'Blogs created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $blog = Blog::with('user')->findOrFail($id);
        return view('blogs.show', compact('blog'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $blog = Blog::findOrFail($id);

        if(!Auth::check() || !Auth::user()->canEdit($blog))
        {
            abort(403, 'Unauthorized action.');
        }

        return view('blogs.edit', $blog);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $blog = Blog::findOrFail($id);

        if(!Auth::check() || !Auth::user()->canEdit($blog))
        {
            abort(403, 'Unauthorized action.');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string'
        ]);

        $blog->update($validated);

        return redirect()->route('blogs.show', $blog->id)
            ->with('success', 'Blog updated successfully!');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $blog = Blog::findOrFail($id);

        if(!Auth::check() || !Auth::user()->canDelete($blog))
        {
            abort(403, 'Unauthorized action.');
        }

        $blog->delete();
        return redirect()->route('blogs.index')
            ->with('success', 'Blog deleted successfully!');
    }
}
