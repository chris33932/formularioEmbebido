<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
class User
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
    private $fullname;

    /**
     * Undocumented variable
     *
     * @ORM\OneToMany(targetEntity="Exp", mappedBy="user", cascade={"persist"})
     */
    private $exp;

    public function __construct()
    {
        $this->exp = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFullname(): ?string
    {
        return $this->fullname;
    }

    public function setFullname(string $fullname): self
    {
        $this->fullname = $fullname;

        return $this;
    }

    /**
     * @return Collection|Exp[]
     */
    public function getExp(): Collection
    {
        return $this->exp;
    }

    public function addExp(Exp $exp): self
    {
        if (!$this->exp->contains($exp)) {
            $this->exp[] = $exp;
            $exp->setUser($this);
        }

        return $this;
    }

    public function removeExp(Exp $exp): self
    {
        if ($this->exp->removeElement($exp)) {
            // set the owning side to null (unless already changed)
            if ($exp->getUser() === $this) {
                $exp->setUser(null);
            }
        }

        return $this;
    }
}
