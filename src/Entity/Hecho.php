<?php

namespace App\Entity;

use App\Repository\HechoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=HechoRepository::class)
 */
class Hecho
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $fecha;

    /**
     * @ORM\OneToMany(targetEntity=DetalleHecho::class, mappedBy="hechoNro", cascade={"persist"})
     */
    private $detalleHechos;

    public function __construct()
    {
        $this->detalleHechos = new ArrayCollection();
    }

  

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFecha(): ?\DateTimeInterface
    {
        return $this->fecha;
    }

    public function setFecha(\DateTimeInterface $fecha): self
    {
        $this->fecha = $fecha;

        return $this;
    }

    /**
     * @return Collection|DetalleHecho[]
     */
    public function getDetalleHechos(): Collection
    {
        return $this->detalleHechos;
    }

    public function addDetalleHecho(DetalleHecho $detalleHecho): self
    {
        if (!$this->detalleHechos->contains($detalleHecho)) {
            $this->detalleHechos[] = $detalleHecho;
            $detalleHecho->setHechoNro($this);
        }

        return $this;
    }

    public function removeDetalleHecho(DetalleHecho $detalleHecho): self
    {
        if ($this->detalleHechos->removeElement($detalleHecho)) {
            // set the owning side to null (unless already changed)
            if ($detalleHecho->getHechoNro() === $this) {
                $detalleHecho->setHechoNro(null);
            }
        }

        return $this;
    }
}
