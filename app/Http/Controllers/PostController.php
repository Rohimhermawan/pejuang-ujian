<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Material;
use App\Models\Category;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.blog.index', [
            'posts' => post::paginate(15)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.blog.create', [
            'categories' => category::all(),
            'materials' => material::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'tittle' => 'required|max:255',
            'slug' => 'required|max:255|unique:posts',
            'category_id' => 'required',
            'image' => 'image|file|max:1024',
            'body' => 'required'
        ]);
        $validated['user_id'] = 1;
        $validated['excerpt'] = str::limit(strip_tags($validated['body']), 200);
        
        if ($request->file('image')) {
            $filenameWithExt = $request->file('image')->getClientOriginalName();
            //Get just filename
            $filename = $request->slug;
            // Get just ext
            $extension = $request->file('image')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            // // Upload Image
            $request->file('image')->storeAs('public/postsImage/'.$request->category_id, $fileNameToStore, 'local');
        }
        
        $validated['image'] = $fileNameToStore;
        post::create($validated);
        
        return redirect('/admin/posts')->with('success', 'Post has been created successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('admin.blog.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('admin.blog.edit', [
            'post' => $post,
            'categories' => category::all(),
            'materials' => material::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $rules = ([
            'tittle' => 'required|max:255',
            'category_id' => 'required',
            'image' => 'image|file|max:1024',
            'body' => 'required',
        ]);
        if ($request->slug != $post->slug) {
            $rules['slug'] = 'required|max:255|unique:posts';
        }
        
        if ($request->file('image')) {
            if ($request->oldImage) {
                storage::disk('public')->delete('postsImage/'.$request->oldCategory.'/'.$request->oldImage);
            }
            $filenameWithExt = $request->file('image')->getClientOriginalName();
            //Get just filename
            $filename = $request->slug;
            // Get just ext
            $extension = $request->file('image')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            // // Upload Image
            $request->file('image')->storeAs('public/postsImage/'.$request->category_id, $fileNameToStore, 'local');
            $validated['image'] = $fileNameToStore;
        }

        $validated = $request->validate($rules);
        
        $rules['user_id'] = 1;
        $rules['excerpt'] = str::limit(strip_tags($rules['body']), 200);
        post::where('id', $post->id)
            ->update($validated);

        return redirect('/admin/posts')->with('success', 'Post has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        if ($post->image) {
            storage::disk('public')->delete('postsImage/'.$post->category_id.'/'.$post->image);
        }
        post::destroy($post->id);
        return redirect('/admin/posts')->with('success', 'Post has been deleted successfully');
    }

    public function createSlug(Request $request)
    {
        $slug = SlugService::createSlug(Post::class, 'slug', $request->tittle);
        return response()->json(['slug' => $slug]);
    }
}
