<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Exam;
use App\Models\Question;
use App\Models\Category;
use App\Models\Material;
use Carbon\Carbon;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ExamController extends Controller
{
    public function index()
    {
        return view('admin.ujian.index',[
            'exams' => exam::with('question')->paginate(20),
        ]);
    }

    public function create()
    {
        return view('admin.ujian.create', [
            'categories' => category::all(),
            'materials' => material::all()
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tittle' => 'required|max:255',
            'slug' => 'required|max:255|unique:exams',
            'category_id' => 'required',
            'material_id' => 'required',
            'image' => 'image|file|max:1024',
            'excerpt' => 'required',
            'quantity' => 'required|numeric'
        ]);
        
        if ($request->file('image')) {
            $filenameWithExt = $request->file('image')->getClientOriginalName();
            //Get just filename
            $filename = $request->slug;
            // Get just ext
            $extension = $request->file('image')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            // // Upload Image
            $folderFile = 'public/examsImage/' . $request->category_id . '/' . $request->material_id;
            $request->file('image')->storeAs($folderFile, $fileNameToStore, 'local');
        }
        
        $validated['image'] = $fileNameToStore;
        exam::create($validated);

        return redirect('/admin/exams')->with('success', 'Exam has been created successfully');
    }

    public function show(Exam $exam)
    {
        return view('admin.soal.index', [
            'questions' => question::where('exam_id', $exam->id)->paginate(20),
            'examid' => $exam->id
        ]);
    }

    public function edit(Exam $exam)
    {
        return view('admin.ujian.edit', [
            'categories' => category::all(),
            'materials' => material::all(),
            'exam' => $exam
        ]);
    }

    public function update(Request $request, Exam $exam)
    {
        $rules = ([
            'tittle' => 'required|max:255',
            'category_id' => 'required',
            'material_id' => 'required',
            'image' => 'image|file|max:1024',
            'excerpt' => 'required',
            'quantity' => 'required|numeric'
        ]);

        if ($request->slug != $exam->slug) {
            $rules['slug'] = 'required|max:255|unique:exams';
        }
        
        if ($request->file('image')) {
            if ($request->oldImage) {
                storage::disk('public')->delete('examsImage/'.$request->oldCategory.'/'.$request->oldMaterial.'/'.$exam->oldImage);
            }
            $filenameWithExt = $request->file('image')->getClientOriginalName();
            //Get just filename
            $filename = $request->slug;
            // Get just ext
            $extension = $request->file('image')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            // // Upload Image
            $folderFile = 'public/examsImage/' . $request->category_id . '/' . $request->material_id;
            $request->file('image')->storeAs($folderFile, $fileNameToStore, 'local');
        }
        
        $validated = $request->validate($rules);
        $validated['image'] = $fileNameToStore??$request->oldImage;
        
        exam::where('id', $exam->id)
            ->update($validated);
        return redirect('/admin/exams')->with('success', 'Exam has been updated successfully');
    }

    public function destroy(Exam $exam)
    {
        if ($exam->image) {
            storage::disk('public')->delete('examsImage/'.$exam->category_id .'/'. $exam->material_id .'/'.$exam->image);
        }
        exam::destroy($exam->id);
        return redirect('/admin/exams')->with('success', 'Exam has been deleted successfully');
    }

    public function createSlug(Request $request)
    {
        $slug = SlugService::createSlug(Exam::class, 'slug', $request->tittle);
        return response()->json(['slug' => $slug]);
    }

    public function publish(Exam $exam)
    {
        // dd($exam->published_at);
        if ($exam->published_at == null) {
            exam::where('id', $exam->id)
                ->update([
                    'published_at' => Carbon::now()->format("Y-m-d H:i:m")
                ]);
        } else {
            exam::where('id', $exam->id)
                ->update([
                    'published_at' => null
                ]);
        }
        return back();
    }
}
