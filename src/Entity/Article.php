<?php

namespace App\Entity;

use App\Controller\HelperTrait;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="article")
 * @ORM\Entity(repositoryClass="App\Repository\ArticleRepository")
// * Vich\Uploadable
**/
class Article
{
    use HelperTrait;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $slug;

    /**
     * @return mixed
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @param mixed $slug
     * @return Article
     */
    public function setSlug($slug) : Article
    {
        $this->slug = $slug;
        return $this;
    }


    /**
     * @ORM\Column(type="text")
     */
    private $content;

    /**
     * @ORM\Column(type="string", length=180)
     */
    private $featuredImage;

    /**
     * @ORM\Column(type="boolean")
     */
    private $special;

    /**
     * @ORM\Column(type="boolean")
     */
    private $spotlight;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdDate;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Category", inversedBy="articles")
     * @ORM\JoinColumn(nullable=false)
     */
    private $category;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="articles")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * Article constructor.
     */
    public function __construct()
    {
//        $this->createdDate = new DateTime();
    }


    public function setId( $id ): self
    {
        $this->id = $id;
        return $this;
    }


    public function getId()
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getFeaturedImage()
    {
        return $this->featuredImage;
    }

    public function setFeaturedImage($featuredImage): self
    {
        $this->featuredImage = $featuredImage;

        return $this;
    }

    public function getSpecial(): ?bool
    {
        return $this->special;
    }

    public function setSpecial(bool $special): self
    {
        $this->special = $special;

        return $this;
    }

    public function getSpotlight(): ?bool
    {
        return $this->spotlight;
    }

    public function setSpotlight(bool $spotlight): self
    {
        $this->spotlight = $spotlight;

        return $this;
    }

    public function getCreatedDate(): ?\DateTimeInterface
    {
        return $this->createdDate;
    }

    public function setCreatedDate(\DateTimeInterface $createdDate): self
    {
        $this->createdDate = $createdDate;

        return $this;
    }

    /**
     * @return Category
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param mixed $category
     */
    public function setCategory($category): void
    {
        $this->category = $category;
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
     */
    public function setUser($user): void
    {
        $this->user = $user;
    }
































//
//    /**
//     * @Vich\UploadableField(mapping="article", fileNameProperty="featuredImageName")
//     *
//     * @ORM\Column(type="string", length=180)
//     *
//     * @var File
//     */
//    private $featuredImage;
//
//    /**
//     * @ORM\Column(type="string", length=255)
//     *
//     * @var string
//     */
//    private $featuredImageName;
//
//    /**
//     * @ORM\Column(type="datetime")
//     *
//     * @var \DateTime
//     */
//    private $updatedAt;
//
//    /**
//     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $article
//     *
//     * @return Article
//     */
//    public function setFeaturedImageFile(File $featuredImage = null)
//    {
//        $this->featuredImageFile = $featuredImage;
//
//        if ($featuredImage)
//            $this->updatedAt = new \DateTimeImmutable();
//
//        return $this;
//    }
//
//    /**
//     * @return File|null
//     */
//    public function getFeaturedImageFile()
//    {
//        return $this->featuredImageFile;
//    }
//
//    /**
//     * @param string $featuredImageName
//     *
//     * @return Article
//     */
//    public function setFeaturedImageName($featuredImageName)
//    {
//        $this->featuredImageName = $featuredImageName;
//
//        return $this;
//    }
//
//    /**
//     * @return string|null
//     */
//    public function getFeaturedImageName()
//    {
//        return $this->featuredImageName;
//    }
}
