<?php
/**
 * Created by PhpStorm.
 * User: Moulaye CISSE
 * Date: 26/06/2018
 * Time: 10:19
 */

namespace App\Article;

use Symfony\Component\Yaml\Exception\ParseException;
use Symfony\Component\Yaml\Yaml;

class ArticleYAMLProvider
{
    function getArticles() : iterable
    {
        try {
            return Yaml::parseFile(__DIR__ . '/articles.yaml');
        } catch (ParseException $parseException)
        {
            printf( 'Unable to parse the YAML string: %s', $parseException->getMessage() );
        }

        return [];
    }
}