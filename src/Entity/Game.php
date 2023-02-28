<?php

namespace App\Entity;

use App\Repository\GameRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=GameRepository::class)
 */
class Game
{
  /**
   * @ORM\Id
   * @ORM\GeneratedValue
   * @ORM\Column(type="integer")
   */
  private $id;

  /**
   * @ORM\Column(type="string", length=64)
   * @Groups({"members"})
   */
  private $name;

  /**
   * @ORM\Column(type="string", length=255)
   */
  private $photo;

  /**
   * @ORM\Column(type="datetime_immutable", options={"default": "CURRENT_TIMESTAMP"})
   */
  private $createdAt;

  /**
   * @ORM\Column(type="datetime_immutable", nullable=true)
   */
  private $updatedAt;

  /**
   * @ORM\ManyToMany(targetEntity=Member::class, mappedBy="games")
   */
  private $members;

  public function __construct()
  {
    $this->members = new ArrayCollection();
  }

  public function getId(): ?int
  {
    return $this->id;
  }

  public function getName(): ?string
  {
    return $this->name;
  }

  public function setName(string $name): self
  {
    $this->name = $name;

    return $this;
  }

  public function getPhoto(): ?string
  {
    return $this->photo;
  }

  public function setPhoto(string $photo): self
  {
    $this->photo = $photo;

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

  public function setUpdatedAt(?\DateTimeImmutable $updatedAt): self
  {
    $this->updatedAt = $updatedAt;

    return $this;
  }

  /**
   * @return Collection<int, Member>
   */
  public function getMembers(): Collection
  {
    return $this->members;
  }

  public function addMember(Member $member): self
  {
    if (!$this->members->contains($member)) {
      $this->members[] = $member;
      $member->addGame($this);
    }

    return $this;
  }

  public function removeMember(Member $member): self
  {
    if ($this->members->removeElement($member)) {
      $member->removeGame($this);
    }

    return $this;
  }
}
