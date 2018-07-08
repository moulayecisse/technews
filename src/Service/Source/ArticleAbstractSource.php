<?php
/**
 * Created by PhpStorm.
 * User: Moulaye CISSE
 * Date: 04/07/2018
 * Time: 14:33
 */

namespace App\Service\Source;


use App\Repository\ArticleRepositoryInterface;
use App\Entity\Article;

abstract class ArticleAbstractSource implements ArticleRepositoryInterface
{
    private $catalogue;

    public function setCatalogue($catalogue )
    {
        $this->catalogue = $catalogue;
    }

//    abstract protected function createFromArray( iterable $article ) : ?Article;
}