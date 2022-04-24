<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Exam;
use Carbon\Carbon;
use App\Models\Category;
use App\Models\Material;
use App\Models\Question;

class FeatureController extends Controller
{
    public function index()
    {
        if (request('feature') == 'blog') {
            $data = post::orderBy('published_at', 'desc')->whereNotNull('published_at')->filter(request(['search', 'category', 'material']))->with('category', 'material')->paginate(9)->withQueryString();
        } else {
            $data = exam::orderBy('published_at', 'desc')->whereNotNull('published_at')->filter(request(['search', 'category', 'material']))->with('category', 'material')->paginate(9)->withQueryString();
        }
        $categories = category::all();
        $materials = material::all();
        return view('features', compact('data', 'categories', 'materials'));
    }

    public function viewBLog(post $slug)
    {
        $slug->published_at = Carbon::parse($slug->published_at);
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
