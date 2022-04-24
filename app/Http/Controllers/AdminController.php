<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Exam;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class AdminController extends Controller
{
    public function index()
    {
        $data = exam::all()->count();
        $data2 = exam::whereNotNull('published_at', null)->count();
        $exam = [
            "publish"=>$data2,
            "pending"=>$data-$data2,
            "total"=> $data
        ];
        $data = post::all()->count();
        $data2 = post::whereNotNull('published_at', null)->count();
        $post = [
            "publish"=>$data2,
            "pending"=>$data-$data2,
            "total"=> $data
        ];
        return view('admin.dashboard', compact('exam', 'post'));
    }
    
    public function authenticate(Request $request)
    {
        // dd($request);
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'min:8'],
        ]);
 
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
 
            return redirect('/admin/dashboard');
        }
 
        return redirect('/login')->with('gagal', 'The provided credentials do not match our records.');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
