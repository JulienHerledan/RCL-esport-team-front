<?php

namespace App\Entity;

use App\Repository\ArticleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use App\Validator as AcmeAssert;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=ArticleRepository::class)
 * @ORM\HasLifecycleCallbacks
 */
class Article
{
  /**
   * @ORM\Id
   * @ORM\GeneratedValue
   * @ORM\Column(type="integer")
   * @Groups({"articles","comments"})
   */
  private $id;

  /**
   * @ORM\Column(type="string", length=64)
   * @Groups({"articles","comments"})
   * @Assert\Length(min = 1, max = 64, minMessage = "Vous devez rentrer au moins  1 caractere", maxMessage = "Vous devez rentrer moins de 64 caracteres")
   * @Assert\NotBlank(message= "Vous devez renseigner un titre d'article")
   * @Assert\NotNull(message= "Vous devez renseigner un titre d'article")
   */
  private $title;

    /**
     * @ORM\Column(type="text")
     * @Groups({"articles"})
     * @Assert\Length(min = 10, minMessage = "Vous devez rentrer au moins 10 caractere")
     * @Assert\NotBlank(message= "Vous devez renseigner un resume d'article")
     * @Assert\NotNull(message= "Vous devez renseigner un resume d'article")
     */
    private $resume;

    /**
     * @ORM\Column(type="text")
     * @Groups({"articles"})
     * @Assert\Length(min = 50, minMessage = "Vous devez rentrer au moins 50 caracteres")
     * @Assert\NotBlank(message= "Vous devez renseigner un resume d'article")
     * @Assert\NotNull(message= "Vous devez renseigner un resume d'article")
     */
    private $content;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="articles")
     * @ORM\JoinColumn(nullable=true, onDelete="SET NULL")
     * @Groups({"articles"})
     * @AcmeAssert\NotNullAtCreation
     */
    private $author;

    /**
     * @ORM\Column(type="datetime_immutable", options={"default": "CURRENT_TIMESTAMP"})
     * @Groups({"articles"})
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     * @Groups({"articles"})
     */
    private $updatedAt;

    /**
     * @ORM\OneToMany(targetEntity=Comment::class, mappedBy="article")
     * @Groups({"articles"})
     */
    private $comments;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"articles"})
     * @Assert\Url
     * @Assert\Length(min = 10, max = 255, minMessage = "Vous devez rentrer au moins 10 caracteres", maxMessage = "Vous devez rentrer moins de 255 caracteres")
     * @Assert\NotBlank (message = "Vous devez renseigner la photo de l'article")
     * @Assert\NotNull (message = "Vous devez renseigner la photo de l'article")
     */
    private $image;

    /**
     * @ORM\Column(type="string", length=64)
     * @Groups({"articles","comments"})
     */
    private $slug;

    public function __construct()
    {
        $this->comments = new ArrayCollection();
    }

    public function __toString()
    {
      return $this->title . ' / id: ' . $this->id;
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


    public function getResume(): ?string
    {
        return $this->resume;
    }

    public function setResume(string $resume): self
    {
        $this->resume = $resume;

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

    public function getAuthor(): ?User
    {
        return $this->author;
    }

    public function setAuthor(?User $author): self
    {
        $this->author = $author;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeImmutable $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * @return Collection<int, Comment>
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comment $comment): self
    {
        if (!$this->comments->contains($comment)) {
            $this->comments[] = $comment;
            $comment->setArticle($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): self
    {
        if ($this->comments->removeElement($comment)) {
            // set the owning side to null (unless already changed)
            if ($comment->getArticle() === $this) {
                $comment->setArticle(null);
            }
        }

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }
}
