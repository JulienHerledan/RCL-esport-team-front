<?php

namespace App\Entity;

use App\Repository\SocialNetworkLinkRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=SocialNetworkLinkRepository::class)
 */
class SocialNetworkLink
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"members"})
     */
    private $link;

    /**
     * @ORM\ManyToOne(targetEntity=member::class, inversedBy="socialNetworkLinks")
     * @ORM\JoinColumn(nullable=false)
     */
    private $member;

    /**
     * @ORM\ManyToOne(targetEntity=SocialNetwork::class, inversedBy="socialNetworkLinks")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"members"})
     */
    private $socialNetwork;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLink(): ?string
    {
        return $this->link;
    }

    public function setLink(string $link): self
    {
        $this->link = $link;

        return $this;
    }

    public function getMember(): ?member
    {
        return $this->member;
    }

    public function setMember(?member $member): self
    {
        $this->member = $member;

        return $this;
    }

    public function getSocialNetwork(): ?SocialNetwork
    {
        return $this->socialNetwork;
    }

    public function setSocialNetwork(?SocialNetwork $socialNetwork): self
    {
        $this->socialNetwork = $socialNetwork;

        return $this;
    }
}
