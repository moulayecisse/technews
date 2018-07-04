<?php
/**
 * Created by PhpStorm.
 * User: Etudiant0
 * Date: 28/06/2018
 * Time: 15:42
 */

namespace App\Controller;


use Behat\Transliterator\Transliterator;

trait HelperTrait
{
    /**
     * Permet de générer un Slug à partir d'un String
     * @param $text
     * @return null|string|string[]
     */
    public function slugify( $text )
    {
        return Transliterator::transliterate($text);
    }
}