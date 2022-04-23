<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Exam;
use App\Models\Category;
use App\Models\Material;
use App\Models\Question;

class FeatureController extends Controller
{
    public function index()
    {
        if (request('feature') == 'blog') {
            $data = post::whereNotNull('published_at')->filter(request(['search', 'category', 'material']))->with('category', 'material')->paginate(9)->withQueryString();
        } else {
            $data = exam::whereNotNull('published_at')->filter(request(['search', 'category', 'material']))->with('category', 'material')->paginate(9)->withQueryString();
        }
        $categories = category::all();
        $materials = material::all();
        return view('features', compact('data', 'categories', 'materials'));
    }

    public function viewBLog(post $slug)
    {
        return view('blog', [
            'post' => $slug
        ]);
    }

    public function viewExam(exam $slug)
    {
        return view('exam', compact('slug'));
    }

    public function fetchQuestion($id)
    {
        return question::where('exam_id', $id)->get();
    }
}
