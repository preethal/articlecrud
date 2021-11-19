<?php

namespace App\Http\Controllers;
use App\Repository\ArticleRepositoryInterface;
use App\Repository\EloquentRepositoryInterface;
use App\Repository\Eloquent\BaseRepository;
use App\Repository\Eloquent\ArticleRepository;
use Illuminate\Http\Request;
use App\Http\Traits\articleTrait;

use Illuminate\Support\Facades\Http;
use App\Models\Article;
use App\Models\Category;
use App\Models\Tag;
use DB;


class ArticleController extends Controller
{   
     use articleTrait;
    
}
