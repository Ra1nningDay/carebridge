<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Comment;
use App\Models\Post;

class CommentController extends Controller
{

    public function store(Request $request, Post $post)
    {
        // Validate incoming request data
        $request->validate([
            'content' => 'required|string',
            'parent_id' => 'nullable|exists:comments,id', // Add validation for parent_id if needed
        ]);

        // Ensure the user is authenticated
        if (auth()->check()) {
            $comment = new Comment();
            $comment->content = $request->input('content');
            $comment->user_id = auth()->id(); // Get the authenticated user's ID
            $comment->post_id = $post->id; // Set the post ID
            $comment->parent_id = $request->input('parent_id'); // Set parent ID (nullable)
            $comment->save();

            return redirect()->route('posts.show', ['post' => $post->id])
                            ->with('success', 'Comment added successfully!');
        }

        // If user is not authenticated, redirect back with an error
        return redirect()->route('posts.show', ['post' => $post->id])
                        ->with('error', 'You must be logged in to comment.');
    }


    public function destroy(Comment $comment) 
    {
        $comment->delete();
        return redirect()->route('posts.show',['post' => $post->id])->with('success','Comment deleted successfully!');
    }
}
