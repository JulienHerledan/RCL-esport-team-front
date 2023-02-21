<?php

namespace App\Entity;

use App\Repository\SocialNetworkRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=SocialNetworkRepository::class)
 */
class SocialNetwork
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
     * @Groups({"members"})
     */
    private $image;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     */
    private $updatedAt;

    /**
     * @ORM\OneToMany(targetEntity=SocialNetworkLink::class, mappedBy="socialNetwork", orphanRemoval=true)
     */
    private $socialNetworkLinks;

    public function __construct()
    {
        $this->socialNetworkLinks = new ArrayCollection();
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

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

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
     * @return Collection<int, SocialNetworkLink>
     */
    public function getSocialNetworkLinks(): Collection
    {
        return $this->socialNetworkLinks;
    }

    public function addSocialNetworkLink(SocialNetworkLink $socialNetworkLink): self
    {
        if (!$this->socialNetworkLinks->contains($socialNetworkLink)) {
            $this->socialNetworkLinks[] = $socialNetworkLink;
            $socialNetworkLink->setSocialNetwork($this);
        }

        return $this;
    }

    public function removeSocialNetworkLink(SocialNetworkLink $socialNetworkLink): self
    {
        if ($this->socialNetworkLinks->removeElement($socialNetworkLink)) {
            // set the owning side to null (unless already changed)
            if ($socialNetworkLink->getSocialNetwork() === $this) {
                $socialNetworkLink->setSocialNetwork(null);
            }
        }

        return $this;
    }

}
