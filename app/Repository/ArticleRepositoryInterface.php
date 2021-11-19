<?php
namespace App\Repository;


use App\Model\Article;


use Illuminate\Support\Collection;

interface ArticleRepositoryInterface
{
   public function all(): Collection;
}