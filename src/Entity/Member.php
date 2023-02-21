<?php

namespace App\Entity;

use App\Repository\MemberRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
/**
 * @ORM\Entity(repositoryClass=MemberRepository::class)
 */
class Member
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
    private $username;

    /**
     * @ORM\Column(type="string", length=64)
     * @Groups({"members"})
     */
    private $firstname;

    /**
     * @ORM\Column(type="string", length=64)
     * @Groups({"members"})
     */
    private $lastname;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"members"})
     */
    private $photo;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"members"})
     */
    private $age;

    /**
     * @ORM\Column(type="text")
     * @Groups({"members"})
     */
    private $biography;
    
    /**
     * @ORM\ManyToMany(targetEntity=VideoClip::class, inversedBy="member")
     * @Groups({"members"})
     */
    private $videoClips;

    /**
     * @ORM\ManyToMany(targetEntity=Game::class, inversedBy="member")
     * @Groups({"members"})
     */
    private $games;

    /**
     * @ORM\Column(type="date")
     * @Groups({"members"})
     */
    private $birthday;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="member")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"members"})
     */
    private $createdBy;

    /**
     * @ORM\Column(type="datetime_immutable")
     * @Groups({"members"})
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     * @Groups({"members"})
     */
    private $updatedAt;

    /**
     * @ORM\ManyToMany(targetEntity=Award::class, mappedBy="members")
     * @Groups({"members"})
     */
    private $awards;

    /**
     * @ORM\OneToMany(targetEntity=SocialNetworkLink::class, mappedBy="member", orphanRemoval=true)
     * @Groups({"members"})
     */
    private $socialNetworkLinks;

    public function __construct()
    {
        
        $this->videoClips = new ArrayCollection();
        $this->games = new ArrayCollection();
        $this->awards = new ArrayCollection();
        $this->socialNetworkLinks = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

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

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setAge(int $age): self
    {
        $this->age = $age;

        return $this;
    }

    public function getBiography(): ?string
    {
        return $this->biography;
    }

    public function setBiography(string $biography): self
    {
        $this->biography = $biography;

        return $this;
    }
    
    /**
     * @return Collection<int, VideoClip>
     */
    public function getVideoClips(): Collection
    {
        return $this->videoClips;
    }

    public function addVideoClip(VideoClip $videoClip): self
    {
        if (!$this->videoClips->contains($videoClip)) {
            $this->videoClips[] = $videoClip;
        }

        return $this;
    }

    public function removeVideoClip(VideoClip $videoClip): self
    {
        $this->videoClips->removeElement($videoClip);

        return $this;
    }

    /**
     * @return Collection<int, Game>
     */
    public function getGames(): Collection
    {
        return $this->games;
    }

    public function addGame(Game $game): self
    {
        if (!$this->games->contains($game)) {
            $this->games[] = $game;
        }

        return $this;
    }

    public function removeGame(Game $game): self
    {
        $this->games->removeElement($game);

        return $this;
    }

    public function getBirthday(): ?\DateTimeInterface
    {
        return $this->birthday;
    }

    public function setBirthday(\DateTimeInterface $birthday): self
    {
        $this->birthday = $birthday;

        return $this;
    }

    public function getCreatedBy(): ?User
    {
        return $this->createdBy;
    }

    public function setCreatedBy(?User $createdBy): self
    {
        $this->createdBy = $createdBy;

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
     * @return Collection<int, Award>
     */
    public function getAwards(): Collection
    {
        return $this->awards;
    }

    public function addAward(Award $award): self
    {
        if (!$this->awards->contains($award)) {
            $this->awards[] = $award;
            $award->addMember($this);
        }

        return $this;
    }

    public function removeAward(Award $award): self
    {
        if ($this->awards->removeElement($award)) {
            $award->removeMember($this);
        }

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
            $socialNetworkLink->setMember($this);
        }

        return $this;
    }

    public function removeSocialNetworkLink(SocialNetworkLink $socialNetworkLink): self
    {
        if ($this->socialNetworkLinks->removeElement($socialNetworkLink)) {
            // set the owning side to null (unless already changed)
            if ($socialNetworkLink->getMember() === $this) {
                $socialNetworkLink->setMember(null);
            }
        }

        return $this;
    }
}
