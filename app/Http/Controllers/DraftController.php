<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\FormDraftRequest;
use App\Models\Post;
use App\Models\Category;
use App\Models\Staff;

class DraftController extends Controller
{
    public function index()
    {
        $posts = Post::onlyTrashed()->where('status', POST::STT_DRAFT)->orderBy('id', 'desc')->paginate(30);
        $posts->load([
            'category:id,name',
            'staff' => function($query){
                $query->wherePivot('event', POST::E_CREATE);
        }
        ]);
        return view('admin_default.pages.post_index', compact('posts'));
    }

    public function show($id)
    {
        $post = Post::onlyTrashed()->find($id);
        $post->load('category:id,name');
        $route = $post->is_deleted() ? 'admin.drafts.trashed_update': 'admin.drafts.publish';
        return view('admin_default.pages.post_show', compact('post', 'route'));
    }

    public function edit($id)
    {
        $post = Post::onlyTrashed()->find($id);
        $categories = Category::categorySelect();
        return view('admin_default.pages.post_edit', compact('post', 'categories'));
    }

    public function update(FormDraftRequest $request, $id)
    {
        $request->validated();

        try {
            $post = Post::onlyTrashed()->find($id)->fill($request->all());
            $post->save();
            Staff::find(1)->post()->save($post, ['event' => POST::E_UPDATE]);
        } catch(\Exception $e) {
            \Log::error("Error at ".__METHOD__.". Content: ".$e->getMessage());
            return redirect()->back()->withErrors($e->getMessage());
        }
        return redirect()->route('admin.drafts.show', $id)
            ->withMessage('Congrats! You have updated a post successfully');
    }

    public function publishValidator(Array $array, $id)
    {
        return Validator::make($array, [
            'title' => "required|string|min:8|max:255|unique:posts,title,$id",
            'excerpt' => "required|string|min:8|max:255",
            'content' => "required|string|min:8",
            'category_id' => "required|integer",
        ]);
    }

    public function publish(Request $request, $id)
    {
        $validator = $this->publishValidator($request->all(), $id);
        if ($validator->fails()) {
            return redirect()->route('admin.drafts.edit', $id)->withErrors($validator)->withInput();
        } 

        try {
            $post = Post::onlyTrashed()->find($id);
            $post->status = POST::STT_PUBLISHED;
            $post->save();
            $post->restore();
            Staff::find(1)->post()->save($post, ['event' => POST::E_PUBLISH]);
        } catch(\Exception $e) {
            \Log::error("Error at ".__METHOD__.". Content: ".$e->getMessage());
            return redirect()->back()->withErrors($e->getMessage());
        }
        return redirect()->route('admin.drafts.index')
            ->withMessage('Congrats! You have published a post successfully');
    }

    public function trashedIndex()
    {
        $posts = POST::onlyTrashed()->where('status', POST::STT_DELETED)->paginate(50);
        return view('admin_default.pages.post_index', compact('posts'));        
    }

    public function trash($id)
    {
        try {
            $post = POST::onlyTrashed()->find($id);
            $post->status = POST::STT_DELETED;
            $post->save();
            Staff::find(1)->post()->save($post, ['event' => POST::E_TRASH]);
        } catch(\Exception $e) {
            \Log::error("Error at ".__METHOD__.". Content: ".$e->getMessage());
            return redirect()->back()->withErrors($e->getMessage());
        }
        return redirect()->route('admin.drafts.index')
            ->withMessage('You have sent a post to trash successfully');
    }

    public function trashedUpdate(Request $request, $id)
    {
        if ($request->action == 'restore') {
            $result = $this->restore($id);
            $message = 'Congrats! You have restored a post successfully';
        }
        if ($request->action == 'delete') {
            $result = $this->delete($id);
            $message = 'You have deleted a post completely';
        }
        if ($result) {
            return redirect()->route('admin.drafts.trashed')->withMessage($message);
        }
    }

    protected function restore($id)
    {
        try {
            $post = POST::onlyTrashed()->where('status', POST::STT_DELETED)->find($id);
            $post->status = POST::STT_DRAFT;
            $post->save();
        } catch(\Exception $e) {
            \Log::error("Error at ".__METHOD__.". Content: ".$e->getMessage());
            return redirect()->back()->withErrors($e->getMessage());
        }
        return true;
    }

    protected function delete($id)
    {
        try {
            $post = POST::onlyTrashed()->where('status', POST::STT_DELETED)->find($id);
            $post->forceDelete();
        } catch (\Exception $e) {
            \Log::error("Error at ".__METHOD__.". Content: ".$e->getMessage());
            return redirect()->back()->withErrors($e->getMessage());
        }
        return true;
    }
}
