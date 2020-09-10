<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\ChallengeRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass=ChallengeRepository::class)
 * @ApiResource
 */
class Challenge
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $challenge_name;

    /**
     * @ORM\Column(type="string")
     */
    private $challenge_position;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created_at;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $created_by;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updated_at;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $updated_by;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="challenges")
     */
    private $user;

    /**
     * @ORM\OneToMany(targetEntity=Item::class, mappedBy="challenge")
     */
    private $challenge_items;

    public function __construct()
    {
        $this->challenge_items = new ArrayCollection();
    }

    /**
    * toString
    * @return string
    */
    public function __toString()
    {
        return get_class($this);
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getChallengeName(): ?string
    {
        return $this->challenge_name;
    }

    public function setChallengeName(string $challenge_name): self
    {
        $this->challenge_name = $challenge_name;

        return $this;
    }

    public function getChallengePosition(): ?string
    {
        return $this->challenge_position;
    }

    public function setChallengePosition(string $challenge_position): self
    {
        $this->challenge_position = $challenge_position;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getCreatedBy(): ?string
    {
        return $this->created_by;
    }

    public function setCreatedBy(string $created_by): self
    {
        $this->created_by = $created_by;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(\DateTimeInterface $updated_at): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }

    public function getUpdatedBy(): ?string
    {
        return $this->updated_by;
    }

    public function setUpdatedBy(string $updated_by): self
    {
        $this->updated_by = $updated_by;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection|Item[]
     */
    public function getChallengeItems(): Collection
    {
        return $this->challenge_items;
    }

    public function addChallengeItem(Item $challengeItem): self
    {
        if (!$this->challenge_items->contains($challengeItem)) {
            $this->challenge_items[] = $challengeItem;
            $challengeItem->setChallenge($this);
        }

        return $this;
    }

    public function removeChallengeItem(Item $challengeItem): self
    {
        if ($this->challenge_items->contains($challengeItem)) {
            $this->challenge_items->removeElement($challengeItem);
            // set the owning side to null (unless already changed)
            if ($challengeItem->getChallenge() === $this) {
                $challengeItem->setChallenge(null);
            }
        }

        return $this;
    }
}
