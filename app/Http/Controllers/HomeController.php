<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Article;
use DB;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
   /* public function __construct()
    {
        $this->middleware('auth');
    }*/

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    
     public function index()
        {

        $articles =  Article::latest()->paginate(5);
        return view('home',['articles'=>$articles]);

        }

     public function create()
       {

    // Show create post form
       return view('create');

       }

    public function store(Request $request)
        {

            // Validate posted form data
            $validated = $request->validate([
                'title' => 'required',
                'content' => 'required',
                
            ]);

            $input = $request->all();
            $tags = explode(", ", $input['tag']);
            // Create and save post with validated data
            $articles = Article::create($input);
            $articles->tag($tags);

            return view('home',['articles'=>$articles]);


         
        } 


   
}
