<?php

namespace App\Entity;

use App\Repository\SocialNetworkLinkRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

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
     * @Assert\Url
     * @Assert\NotNull(message="Vous devez rentrer une URL")
     * @Assert\Length(min=10, max=255)
     */
    private $link;

    /**
     * @ORM\ManyToOne(targetEntity=Member::class, inversedBy="socialNetworkLinks")
     * @ORM\JoinColumn(nullable=false)
     * @Assert\NotNull(message="Vous devez associé le lien à un membre de l'equipe")
     */
    private $member;

    /**
     * @ORM\ManyToOne(targetEntity=SocialNetwork::class, inversedBy="socialNetworkLinks")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"members"})
     * @Assert\NotNull(message="Vous devez asscocié le lien à un réseau social")
     */
    private $socialNetwork;

    public function __toString()
    {
        return $this->link;
    }

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
