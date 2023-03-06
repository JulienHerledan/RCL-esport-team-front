<?php

namespace App\Entity;

use App\Repository\CompetitionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=CompetitionRepository::class)
 */
class Competition
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=64)
     * @Groups({"matches", "members"})
     * @Assert\Length(min=5, max=64, minMessage = "Vous devez rentrer au moins 5 caracteres", maxMessage = "Vous devez rentrer moins de 64 caracteres")
     * @Assert\NotBlank (message= "Vous devez renseigner un nom de compétition")
     * @Assert\NotNull (message= "Vous devez renseigner un nom de compétition")
     */
    private $name;

    /**
     * @ORM\Column(type="date")
     * @Groups({"matches", "members"})
     * @Assert\Type("\DateTime")
     */
    private $date;

    /**
     * @ORM\Column(type="datetime_immutable", options={"default": "CURRENT_TIMESTAMP"})
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     */
    private $updatedAt;

    /**
     * @ORM\OneToMany(targetEntity=Matche::class, mappedBy="competition")
     */
    private $matches;

    public function __construct()
    {
        $this->matches = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->name;
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

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

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
     * @return Collection<int, Matche>
     */
    public function getMatches(): Collection
    {
        return $this->matches;
    }

    public function addMatch(Matche $match): self
    {
        if (!$this->matches->contains($match)) {
            $this->matches[] = $match;
            $match->setCompetition($this);
        }

        return $this;
    }

    public function removeMatch(Matche $match): self
    {
        if ($this->matches->removeElement($match)) {
            // set the owning side to null (unless already changed)
            if ($match->getCompetition() === $this) {
                $match->setCompetition(null);
            }
        }

        return $this;
    }
}
