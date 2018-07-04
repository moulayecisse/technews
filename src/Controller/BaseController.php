<?php
/**
 * Created by PhpStorm.
 * User: Etudiant0
 * Date: 29/06/2018
 * Time: 15:22
 */

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class BaseController extends Controller
{
    protected $view;
    protected $parameters;
    protected $menus;
}