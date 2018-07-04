<?php
/**
 * Created by PhpStorm.
 * User: Moulaye CISSE
 * Date: 29/06/2018
 * Time: 15:35
 */

namespace App\Article;


use App\Entity\User;
use DateTime;
use Symfony\Component\HttpFoundation\File\File;

class ArticleRequest
{
    private $id;
    private $title;
    private $slug;
    private $content;
    private $featuredImage;
    private $featuredImageUrl;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getFeaturedImageUrl()
    {
        return $this->featuredImageUrl;
    }

    /**
     * @param mixed $featuredImageUrl
     */
    public function setFeaturedImageUrl($featuredImageUrl): void
    {
        $this->featuredImageUrl = $featuredImageUrl;
    }
    private $special;
    private $spotlight;
    private $createdDate;
    private $category;
    private $user;

    /**
     * ArticleRequest constructor.
     * @param $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
        $this->createdDate = new DateTime();
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     * @return ArticleRequest
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @param mixed $slug
     * @return ArticleRequest
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param mixed $content
     * @return ArticleRequest
     */
    public function setContent($content)
    {
        $this->content = $content;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getFeaturedImage()
    {
        return $this->featuredImage;
    }

    /**
     * @param File $featuredImage
     * @return ArticleRequest
     */
    public function setFeaturedImage($featuredImage)
    {
        $this->featuredImage = $featuredImage;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSpecial()
    {
        return $this->special;
    }

    /**
     * @param mixed $special
     * @return ArticleRequest
     */
    public function setSpecial($special)
    {
        $this->special = $special;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSpotlight()
    {
        return $this->spotlight;
    }

    /**
     * @param mixed $spotlight
     * @return ArticleRequest
     */
    public function setSpotlight($spotlight)
    {
        $this->spotlight = $spotlight;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCreatedDate()
    {
        return $this->createdDate;
    }

    /**
     * @param mixed $createdDate
     * @return ArticleRequest
     */
    public function setCreatedDate($createdDate)
    {
        $this->createdDate = $createdDate;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param mixed $category
     * @return ArticleRequest
     */
    public function setCategory($category)
    {
        $this->category = $category;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     * @return ArticleRequest
     */
    public function setUser($user)
    {
        $this->user = $user;
        return $this;
    }
}