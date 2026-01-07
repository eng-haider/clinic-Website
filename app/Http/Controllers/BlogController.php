<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $query = Post::where('is_published', true);

        // Filter by category
        if ($request->has('category') && $request->category) {
            $query->where('category', $request->category);
        }

        // Search
        if ($request->has('search') && $request->search) {
            $query->where(function($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('content', 'like', '%' . $request->search . '%')
                  ->orWhere('excerpt', 'like', '%' . $request->search . '%');
            });
        }

        $posts = $query->latest('published_at')->paginate(9);

        // Get categories for filter
        $categories = Post::where('is_published', true)
            ->whereNotNull('category')
            ->distinct()
            ->pluck('category');

        return view('blog.index', compact('posts', 'categories'));
    }

    public function show(Post $post)
    {
        if (!$post->is_published) {
            abort(404);
        }

        $relatedPosts = Post::where('is_published', true)
            ->where('id', '!=', $post->id)
            ->where(function($query) use ($post) {
                if ($post->category) {
                    $query->where('category', $post->category);
                }
            })
            ->latest('published_at')
            ->take(3)
            ->get();

        return view('blog.show', compact('post', 'relatedPosts'));
    }
}
