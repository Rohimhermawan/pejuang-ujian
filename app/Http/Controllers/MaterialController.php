<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Material;
use \Cviebrock\EloquentSluggable\Services\SlugService;

class MaterialController extends Controller
{

    public function index()
    {

        $materials = material::with('post', 'exam')->paginate(20);
        $post; $exam;
        foreach ($materials as $material) {
            $post[$material->name] = $material->post->count();
            $exam[$material->name] = $material->exam->count();
        }
       return view('admin.setting.material.index', [
        'materials' => $materials,
        'post' => $post,
        'exam' => $exam 
       ]);
    }

    public function create()
    {
        return view('admin.setting.material.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'slug' => 'required|max:255|unique:categories'
        ]);

        material::create($validated);

        return redirect('admin/categories')->with('success', 'material has been created successfully');
    }

    public function show(Material $material)
    {
        $datas = material::where('id', $material->id)->with('post', 'exam')->paginate(20);
        return view('admin.setting.material.show', compact('datas'));
    }

    public function edit(Material $material)
    {
        return view('admin.setting.material.edit', [
            'material' => $material
        ]);
    }

    public function update(Request $request, Material $material)
    {
        $rules = [
            'name' => 'required'
        ];
        if ($request->slug != $material->slug) {
            $rules['slug'] = 'required|max:255|unique:categories';
        }
        $validated = $request->validate($rules);
        material::where('id', $material->id)
                    ->update($validated);

        return redirect('admin/categories')->with('success', 'material has been updated successfully');
    }

    public function destroy($id)
    {
        material::destroy($id);
        return redirect('admin/categories')->with('success', 'material has been deleted successfully');
    }

    public function createSlug(Request $request)
    {
        $slug = SlugService::createSlug(material::class, 'slug', $request->tittle);
        return response()->json(['slug' => $slug]);
    }
}
