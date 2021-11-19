<?php

namespace App\Repository\Eloquent;

use App\Model\Article;

use App\Repository\ArticleRepositoryInterface;
use Illuminate\Support\Collection;

class UserRepository extends BaseRepository implements ArticleRepositoryInterface
{

   /**
    * UserRepository constructor.
    *
    * @param User $model
    */
   public function __construct(User $model)
   {
       parent::__construct($model);
   }

   /**
    * @return Collection
    */
   public function all(): Collection
   {
       return $this->model->all();    
   }
}