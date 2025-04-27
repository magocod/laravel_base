<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Note;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $post_id = request()->input('post_id');

//        if (is_null($post_id)) {
//            abort(404, 'Post not found');
//        }
        $query = Comment::with("post");

        if (!is_null($post_id)) {
            $query->where("post_id", $post_id);
        }

        $comments = $query->latest()->paginate(5);

        return view('comments.index', compact('comments'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $notes = Note::all();

        $post_id = request()->input('post_id');

        if (is_null($post_id)) {
            abort(404, 'Comment not found');
        }

        return view('comments.create', compact('notes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'post_id' => 'required',
        ]);
        Comment::create($request->only(['title', 'content', 'post_id']));
        return redirect()->route('comments.index', ['post_id' => $request->input('post_id')])
            ->with('success', 'Comment created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $comment = Comment::with('post')->findOrFail($id);
        return view('comments.show', compact('comment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $notes = Note::all();

        $comment = Comment::findOrFail($id);

        return view('comments.edit', compact('notes', 'comment'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
        ]);

        $comment = Comment::findOrFail($id);
        $comment->update($request->only(['title', 'content']));

        return redirect()->route('comments.index', ['post_id' => $comment->post_id])
            ->with('success', 'Comment updated successfully.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $comment = Comment::findOrFail($id);
        $comment->delete();

        return redirect()->route('comments.index', ['post_id' => $comment->post_id])
            ->with('success', 'Comment deleted successfully');
    }
}
