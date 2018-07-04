<?php
/**
 * Created by PhpStorm.
 * User: Etudiant0
 * Date: 29/06/2018
 * Time: 16:25
 */

namespace App\Twig;

use App\Entity\Category;
use Doctrine\ORM\EntityManagerInterface;
use PhpParser\Node\Scalar\String_;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class AppExtension extends AbstractExtension
{
    private $entityManager;
    private $session;


    /**
     * AppExtension constructor.
     * @param EntityManagerInterface $entityManager
     * @param SessionInterface $session
     */
    public function __construct(EntityManagerInterface $entityManager, SessionInterface $session)
    {
        $this->session       = $session;
        $this->entityManager = $entityManager;
    }

    public function getFunctions()
    {
        return [
            new TwigFunction('get_categories', array($this, 'getCategories')),
            new TwigFunction('isUserInvited', array($this, 'isUserInvited')),
            new TwigFunction('get_categories_having_articles', array($this, 'getCategoriesHavingArticles')),
        ];
    }

    public function getFilters()
    {
        return [new TwigFilter('wrap', array($this, 'wrap'), array('is_safe' => array('html')))];
    }

    public function wrap($string, $maxLineLength = 170)
    {
        if (strlen($string) <= $maxLineLength) {
            return $string;
        }
        $spacePosition = mb_strrpos(mb_substr($string, 0, $maxLineLength), ' ');

        if ($spacePosition !== FALSE) {
            return mb_substr($string, 0, $spacePosition) . '...';
        }

        return mb_substr($string, 0, $maxLineLength) . '...';
    }

    public function getCategories()
    {
        return $this->entityManager->getRepository(Category::class)->findAll();
    }

    public function isUserInvited()
    {
        return $this->session->get( 'showModal' );
    }

    public function getCategoriesHavingArticles()
    {
        return $this->entityManager->getRepository(Category::class)->findCategoriesHavingArticles();
    }
}