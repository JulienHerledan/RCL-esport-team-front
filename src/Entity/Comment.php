<?php

namespace App\Entity;

use App\Repository\CommentRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=CommentRepository::class)
 */
class Comment
{
  /**
   * @ORM\Id
   * @ORM\GeneratedValue
   * @ORM\Column(type="integer")
   */
  private $id;

  /**
   * @ORM\Column(type="text")
   * @Groups({"article", "comments"})
   */
  private $message;

  /**
   * @ORM\ManyToOne(targetEntity=User::class, inversedBy="comments")
   * @ORM\JoinColumn(nullable=false)
   * @Groups({"article", "comments"})
   */
  private $author;

  /**
   * @ORM\Column(type="datetime_immutable", nullable=true)
   * @Groups({"article"})
   */
  private $updatedAt;
 

  /**
   * @ORM\ManyToOne(targetEntity=Article::class, inversedBy="comments")
   * @ORM\JoinColumn(nullable=false)
   */
  private $article;

    /**
     * @ORM\Column(type="datetime_immutable", options={"default": "CURRENT_TIMESTAMP"})
     * @Groups({"article", "comments"})
     */
    private $createdAt;

  public function getId(): ?int
  {
    return $this->id;
  }

  public function getMessage(): ?string
  {
    return $this->message;
  }

  public function setMessage(string $message): self
  {
    $this->message = $message;

    return $this;
  }

  public function getAuthor(): ?user
  {
    return $this->author;
  }

  public function setAuthor(?user $author): self
  {
    $this->author = $author;

    return $this;
  }

  public function getUpdatedAt(): ?\DateTimeImmutable
  {
    return $this->updatedAt;
  }

  public function setUpdatedAt(?\DateTimeImmutable $updatedAt): self
  {
    $this->updatedAt = $updatedAt;

    return $this;
  }

  public function getArticle(): ?Article
  {
    return $this->article;
  }

  public function setArticle(?Article $article): self
  {
    $this->article = $article;

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
}
