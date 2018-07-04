<?php
/**
 * Created by PhpStorm.
 * User: Moulaye CISSE
 * Date: 26/06/2018
 * Time: 10:19
 */

namespace App\Service\Menu;

use Symfony\Component\Yaml\Exception\ParseException;
use Symfony\Component\Yaml\Yaml;

class MenuYamlProvider
{
    function getMenus() : iterable
    {
        try {
            return Yaml::parseFile(__DIR__ . '/menus.yaml');
        } catch (ParseException $parseException)
        {
            printf( 'Unable to pasrse thez YAML string: %s', $parseException->getMessage() );
        }

        return [];
    }
}