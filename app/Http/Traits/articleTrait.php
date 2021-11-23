<?php

namespace App\Http\Traits;
use App\Repository\ArticleRepositoryInterface;
use App\Repository\EloquentRepositoryInterface;
use App\Repository\Eloquent\BaseRepository;
use App\Repository\Eloquent\ArticleRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use App\Models\Article;
use App\Models\Category;
use App\Models\Tag;
use DB;
use App\Http\Requests\StoreArticle;



trait articleTrait
{   
     private $articleRepository;

  

     /**
     * Create a new controller instance.
     *
     * @return void
     */
     public function __construct(Article $articleRepository)
    {
        $this->middleware('auth');
       $this->articleRepository = $articleRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $articles = $this->articleRepository->latest()->paginate(5);
       return view('home', [
           'articles' => $articles
       ]);  

        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add()
    {
    // To create articles
    $category = Category::all();
    $tag      =Tag::all();
    return view('create',['category'=> $category,'tag'=>$tag]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreArticle $request)
    {

            /*Validator::make($request->all(), [
                'title' => 'required',
                'content' => 'required',
            ])->validate();*/
           
            $input = $request->all();
               //save articles to database
            $articles = new Article;
            $articles->title = $request->title;
            $articles->content = $request->content;
            $articles->category_id = $request->category_id;
            $articles->tag=implode($request->tag, ',');
            $articles->save();
            $articles = $this->articleRepository->latest()->paginate(5);
            return view('home', compact('articles'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
                    

    }
            

       
             

           
        
           
            
            
    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $article = $this->articleRepository->findOrFail($id);
        $categories = Category::all();                       
        return view('editarticle',compact('article','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {


        $article = $this->articleRepository->findOrFail($id);
        $article->title   = request('title');
        $article->content  = request('content');
        $article->category_id = request('category_id');
        $article->tag = request('tag');
        $article->save();


        //$tags = \App\Tag::get()->pluck('name', 'id');
        $articles = $this->articleRepository->paginate(5);
        return view('home', compact('articles'))
                ->with('i', (request()->input('page', 1) - 1) * 5);
       
            
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   
        $this->articleRepository->find($id)->delete();
        $articles = $this->articleRepository->latest()->paginate(5);
        return view('home', compact('articles'))
            ->with('i', (request()->input('page', 1) - 1) * 5);

        //
    }
}
