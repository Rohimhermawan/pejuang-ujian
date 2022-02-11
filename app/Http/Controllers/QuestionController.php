<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Exam;
use App\Models\Question;
use App\Models\Category;
use App\Models\Material;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class QuestionController extends Controller
{
    public function index()
    {
        
    }

    public function create()
    {
        return view('admin.soal.create', [
            'categories' => category::all(),
            'materials' => material::all()
        ]);
    }

    public function store(Request $request)
    {
        $exam = exam::find($request->exam_id);
        $rules =[
            'question' => 'required',
            'opt_a' => 'required',
            'opt_b' => 'required',
            'opt_c' => 'required',
            'opt_d' => 'required',
            'opt_e' => 'required',
            'key' => 'required'
        ];
        if ($request->file('image')) {
            $rules['image'] = 'image|file|max:1024';
        }

        $validated = $request->validate($rules);
        if ($request->file('image')) {
            $filenameWithExt = $request->file('image')->getClientOriginalName();
            // Get just ext
            $extension = $request->file('image')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore = time().'.'.$extension;
            // // Upload Image
            $folderFile = 'public/questionsImage/' . $exam->category_id . '/' . $exam->material_id . '/' .$exam->slug;
            $request->file('image')->storeAs($folderFile, $fileNameToStore, 'local');
        }
        
        $validated['image'] = $fileNameToStore??''; 
        $validated['exam_id'] = $request->exam_id; 
        $validated['explanation'] = $request->explaination; 
        question::create($validated);
        
        return redirect('/admin/exams/'.$exam->slug)->with('success', 'data has been created successfully');
    }
    public function show(Question $question)
    {
        return view('admin.soal.show', [
            'question' => $question
        ]);
    }

    public function edit(Question $question)
    {
        return view('admin.soal.edit', [
            'question' => $question
        ]);
    }

    public function update(Request $request, Question $question)
    {
        $exam = exam::find($request->exam_id);
        $rules =[
            'question' => 'required',
            'opt_a' => 'required',
            'opt_b' => 'required',
            'opt_c' => 'required',
            'opt_d' => 'required',
            'opt_e' => 'required',
            'key' => 'required'
        ];
        if ($request->file('image')) {
            $rules['image'] = 'image|file|max:1024';
        }

        $validated = $request->validate($rules);
        if ($request->file('image')) {
            if ($request->oldImage) {
                storage::disk('public')->delete('questionsImage/' . $exam->category_id . '/' . $exam->material_id . '/' .$exam->slug.'/'.$request->oldImage);
            }
            $filenameWithExt = $request->file('image')->getClientOriginalName();
            // Get just ext
            $extension = $request->file('image')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore = time().'.'.$extension;
            // // Upload Image
            $folderFile = 'public/questionsImage/' . $exam->category_id . '/' . $exam->material_id . '/' .$exam->slug;
            $request->file('image')->storeAs($folderFile, $fileNameToStore, 'local');
        }
        
        $validated['image'] = $fileNameToStore??$request->oldImage; 
        $validated['exam_id'] = $request->exam_id; 
        $validated['explanation'] = $request->explaination; 
        question::where('id', $question->id)
                    ->update($validated);
        
        return redirect('/admin/exams/'.$exam->slug)->with('success', 'data has been updated successfully');;
    }

    public function destroy(Question $question)
    {
        $exam = exam::find($question->exam_id);
        if ($question->image) {
            storage::disk('public')->delete('questionsImage/' . $exam->category_id . '/' . $exam->material_id . '/' .$exam->slug.'/'.$question->oldImage);
        }
        question::destroy($question->id);
        return redirect('/admin/exams/'.$exam->slug)->with('success', 'data has been deleted successfully');
    }
}
