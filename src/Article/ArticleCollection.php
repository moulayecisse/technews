<?php
/**
 * Created by PhpStorm.
 * User: moula
 * Date: 04/07/2018
 * Time: 11:58
 */

namespace App\Article;


use Countable;

class ArticleCollection implements Countable
{
    /**
     * @var array $articles
     */
    private $articles;

    /**
     * Count elements of an object
     * @link http://php.net/manual/en/countable.count.php
     * @return int The custom count as an integer.
     * </p>
     * <p>
     * The return value is cast to an integer.
     * @since 5.1.0
     */
    public function count()
    {
        return count($this->articles);
    }
}