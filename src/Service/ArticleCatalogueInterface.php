<?php
/**
 * Created by PhpStorm.
 * User: Moulaye CISSE
 * Date: 04/07/2018
 * Time: 14:32
 */

namespace App\Service;


use App\Repository\ArticleRepositoryInterface;
use App\Service\Source\ArticleAbstractSource;

interface ArticleCatalogueInterface extends ArticleRepositoryInterface
{
    /**
     * @param ArticleAbstractSource $source
     */
    public function addSource( ArticleAbstractSource $source ) : void;

    /**
     * @param $sources
     */
    public function setSources( iterable $sources ) : void;

    /**
     * @return iterable
     */
    public function getSources() : iterable;
}