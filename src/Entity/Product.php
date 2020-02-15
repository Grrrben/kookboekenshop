<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProductRepository")
 */
class Product
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * This is the previous id. Needed for 301 routing etc.
     * @ORM\Column(type="integer", unique=true)
     */
    private $kbsId;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $slug;

    public function getAppearance()
    {
        return $this->appearance;
    }

    public function setAppearance($appearance): self
    {
        $this->appearance = $appearance;
        return $this;
    }

    public function getBinding()
    {
        return $this->binding;
    }

    public function setBinding($binding): self
    {
        $this->binding = $binding;
        return $this;
    }

    public function getLanguage()
    {
        return $this->language;
    }

    public function setLanguage($language): self
    {
        $this->language = $language;
        return $this;
    }

    public function getAvailability()
    {
        return $this->availability;
    }

    public function setAvailability($availability): self
    {
        $this->availability = $availability;
        return $this;
    }

    public function getImgCover()
    {
        return $this->imgCover;
    }

    public function setImgCover($imgCover): self
    {
        $this->imgCover = $imgCover;
        return $this;
    }

    public function getImgBook()
    {
        return $this->imgBook;
    }

    public function setImgBook($imgBook): self
    {
        $this->imgBook = $imgBook;
        return $this;
    }

    public function getImgAuthor()
    {
        return $this->imgAuthor;
    }

    public function setImgAuthor($imgAuthor): self
    {
        $this->imgAuthor = $imgAuthor;
        return $this;
    }

    public function getImgThumbnail()
    {
        return $this->imgThumbnail;
    }

    public function setImgThumbnail($imgThumbnail): self
    {
        $this->imgThumbnail = $imgThumbnail;
        return $this;
    }

    public function getCoAuthor()
    {
        return $this->coAuthor;
    }

    public function setCoAuthor($coAuthor): self
    {
        $this->coAuthor = $coAuthor;
        return $this;
    }

    public function getTranslator()
    {
        return $this->translator;
    }

    public function setTranslator($translator): self
    {
        $this->translator = $translator;
        return $this;
    }

    public function getIllustrator()
    {
        return $this->illustrator;
    }

    public function setIllustrator($illustrator): self
    {
        $this->illustrator = $illustrator;
        return $this;
    }

    public function getEditor()
    {
        return $this->editor;
    }

    public function setEditor($editor): self
    {
        $this->editor = $editor;
        return $this;
    }

    public function getPhotographer()
    {
        return $this->photographer;
    }

    public function setPhotographer($photographer): self
    {
        $this->photographer = $photographer;
        return $this;
    }

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $subTitle;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $quote;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $appearance;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $binding;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $year;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $pages;

    /**
     * @ORM\Column(type="integer")
     */
    private $price;

    /**
     * @ORM\Column(type="integer")
     */
    private $listPrice;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $isbn13;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $descShort;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $descLong;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $language;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    private $availability;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $imgCover;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $imgBook;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $imgAuthor;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $imgThumbnail;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Author")
     */
    private $author;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Author")
     */
    private $coAuthor;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Author")
     */
    private $translator;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Author")
     */
    private $illustrator;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Author")
     */
    private $editor;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Author")
     */
    private $photographer;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Tag", inversedBy="products")
     */
    private $tags;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Recipe", mappedBy="product")
     */
    private $recipes;

    public function __construct()
    {
        $this->tags = new ArrayCollection();
        $this->recipes = new ArrayCollection();
    }


    public function getId(): ?int
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

    public function getSubTitle()
    {
        return $this->subTitle;
    }

    public function setSubTitle($subTitle): self
    {
        $this->subTitle = $subTitle;

        return $this;
    }

    public function getSlug()
    {
        return $this->slug;
    }

    public function setSlug($slug): self
    {
        $this->slug = $slug;
        return $this;
    }

    public function getQuote()
    {
        return $this->quote;
    }

    public function setQuote($quote): self
    {
        $this->quote = $quote;
        return $this;
    }

    public function getKbsId()
    {
        return $this->kbsId;
    }

    public function setKbsId($kbsId): self
    {
        $this->kbsId = $kbsId;
        return $this;
    }

    public function getYear()
    {
        return $this->year;
    }

    public function setYear($year): self
    {
        $this->year = $year;
        return $this;
    }

    public function getPages()
    {
        return $this->pages;
    }

    public function setPages($pages): self
    {
        $this->pages = $pages;
        return $this;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function setPrice($price): self
    {
        $this->price = $price;
        return $this;
    }

    public function getListPrice()
    {
        return $this->listPrice;
    }

    public function setListPrice($listPrice): self
    {
        $this->listPrice = $listPrice;
        return $this;
    }

    public function getIsbn13()
    {
        return $this->isbn13;
    }

    public function setIsbn13($isbn13): self
    {
        $this->isbn13 = $isbn13;
        return $this;
    }

    public function getDescShort()
    {
        return $this->descShort;
    }

    public function setDescShort($descShort): self
    {
        $this->descShort = $descShort;
        return $this;
    }

    public function getDescLong()
    {
        return $this->descLong;
    }

    public function setDescLong($descLong): self
    {
        $this->descLong = $descLong;
        return $this;
    }

    public function getAuthor(): ?Author
    {
        return $this->author;
    }

    public function setAuthor(?Author $author): self
    {
        $this->author = $author;

        return $this;
    }

    /**
     * @return Collection|Tag[]
     */
    public function getTags(): Collection
    {
        return $this->tags;
    }

    public function addTag(Tag $tag): self
    {
        if (!$this->tags->contains($tag)) {
            $this->tags[] = $tag;
        }

        return $this;
    }

    public function removeTag(Tag $tag): self
    {
        if ($this->tags->contains($tag)) {
            $this->tags->removeElement($tag);
        }

        return $this;
    }

    /**
     * @return Collection|Recipe[]
     */
    public function getRecipes(): Collection
    {
        return $this->recipes;
    }

    public function addRecipe(Recipe $recipe): self
    {
        if (!$this->recipes->contains($recipe)) {
            $this->recipes[] = $recipe;
            $recipe->setBookId($this);
        }

        return $this;
    }

    public function removeRecipe(Recipe $recipe): self
    {
        if ($this->recipes->contains($recipe)) {
            $this->recipes->removeElement($recipe);
            // set the owning side to null (unless already changed)
            if ($recipe->getBookId() === $this) {
                $recipe->setBookId(null);
            }
        }

        return $this;
    }
}
