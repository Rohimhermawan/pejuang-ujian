<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use \Cviebrock\EloquentSluggable\Services\SlugService;

class CategoryController extends Controller
{

    public function index()
    {

        $categories = category::with('post', 'exam')->paginate(20);
        $post; $exam;
        foreach ($categories as $category) {
            $post[$category->name] = $category->post->count();
            $exam[$category->name] = $category->exam->count();
        }
       return view('admin.setting.category.index', [
        'categories' => $categories,
        'post' => $post,
        'exam' => $exam 
       ]);
    }

    public function create()
    {
        return view('admin.setting.category.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'slug' => 'required|max:255|unique:categories'
        ]);

        category::create($validated);

        return redirect('admin/categories')->with('success', 'Category has been created successfully');
    }

    public function show(Category $category)
    {
        $datas = category::where('id', $category->id)->with('post', 'exam')->paginate(20);
        return view('admin.setting.category.show', compact('datas'));
    }

    public function edit(Category $category)
    {
        return view('admin.setting.category.edit', [
            'category' => $category
        ]);
    }

    public function update(Request $request, Category $category)
    {
        $rules = [
            'name' => 'required'
        ];
        if ($request->slug != $category->slug) {
            $rules['slug'] = 'required|max:255|unique:categories';
        }
        $validated = $request->validate($rules);
        category::where('id', $category->id)
                    ->update($validated);

        return redirect('admin/categories')->with('success', 'Category has been updated successfully');
    }

    public function destroy($id)
    {
        category::destroy($id);
        return redirect('admin/categories')->with('success', 'Category has been deleted successfully');
    }

    public function createSlug(Request $request)
    {
        $slug = SlugService::createSlug(Category::class, 'slug', $request->tittle);
        return response()->json(['slug' => $slug]);
    }
}
