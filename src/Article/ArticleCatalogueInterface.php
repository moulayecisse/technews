<?php
/**
 * Created by PhpStorm.
 * User: Moulaye CISSE
 * Date: 04/07/2018
 * Time: 14:32
 */

namespace App\Article;


interface ArticleCatalogueInterface
{
    public function addSource( ArticleAbstractSource $source );
    public function setSources( $source );
    public function getSources();
}