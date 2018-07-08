<?php
/**
 * Created by PhpStorm.
 * User: Moulaye CISSE
 * Date: 26/06/2018
 * Time: 10:19
 */

namespace App\Service\Provider;

use App\Repository\ArticleRepositoryInterface;
use App\Entity\Article;
use App\Factory\ArticleFactory;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\Yaml\Exception\ParseException;
use Symfony\Component\Yaml\Yaml;

class ArticleYAMLProvider
{
    private $kernel;

    /**
     * ArticleYAMLProvider constructor.
     * @param $kernel
     */
    public function __construct(KernelInterface $kernel)
    {
        $this->kernel = $kernel;
    }

    public function getArticles() : iterable
    {
        return
            unserialize(
                file_get_contents(
                    $this->kernel->getCacheDir() . '/yaml-article.php'
                )
            );
    }
}