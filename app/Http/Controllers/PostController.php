<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\FormDraftRequest;
use App\Models\Post;
use App\Models\Staff;
use App\Models\Category;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::take(30)->get();
        return view('admin_default.pages.post_index', compact('posts'));
    }

    public function create()
    {
        $categories = Category::categorySelect();
        return view('admin_default.pages.post_create', compact('categories'));
    }

    public function store(FormDraftRequest $request)
    {
        $request->validated();

        try {
            $request['slug'] = uniqid();
            $post = new Post($request->all());
            $post->save();
            Staff::find(1)->post()->save($post, ['event' => POST::E_CREATE]);
        } catch(\Exception $e) {
            \Log::error("Error at ".__METHOD__.". Content: ".$e->getMessage());
            return redirect()->back()->withErrors($e->getMessage());
        }
        return redirect()->route('admin.drafts.index')
            ->withMessage('Congrats! You have created a post successfully!');
    }

    public function show($id)
    {
        $post = POST::find($id);
        $route = 'admin.posts.unpublish';
        return view('admin_default.pages.post_show', compact('post', 'route'));
    }

    public function unpublish(Request $request, $id)
    {
        try {
            $post = Post::find($id);
            $post->status = POST::STT_DRAFT;
            $post->save();
            $post->delete();
            Staff::find(1)->post()->save($post, ['event' => POST::E_UNPUBLISH]);
        } catch(\Exception $e) {
            \Log::error("Error at ".__METHOD__.". Content: ".$e->getMessage());
            return redirect()->back()->withErrors($e->getMessage());
        }
        if ($request->action == 'unpublish_edit') {
            return redirect()->route('admin.drafts.edit', $id);
        }
        return redirect()->route('admin.drafts.show', $id)
            ->withMessage('You have unpublish a post!');
    }
}
