<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\VictimaRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass=VictimaRepository::class)
 */
class Victima
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
    private $nombre;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $apellido;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $tipo_documento;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $nro_documento;

     /**
     * Undocumented variable
     *
     * @ORM\OneToMany(targetEntity="DetalleHecho", mappedBy="victima", cascade={"persist"})
     */
    private $detalleHecho;

    public function __construct()
    {
        $this->victima = new ArrayCollection();
    }

  
    public function __toString()
          {
              return  $this->getNombre() ." ". $this->getApellido();

          }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getApellido(): ?string
    {
        return $this->apellido;
    }

    public function setApellido(string $apellido): self
    {
        $this->apellido = $apellido;

        return $this;
    }

    public function getTipoDocumento(): ?string
    {
        return $this->tipo_documento;
    }

    public function setTipoDocumento(?string $tipo_documento): self
    {
        $this->tipo_documento = $tipo_documento;

        return $this;
    }

    public function getNroDocumento(): ?string
    {
        return $this->nro_documento;
    }

    public function setNroDocumento(?string $nro_documento): self
    {
        $this->nro_documento = $nro_documento;

        return $this;
    }



     /**
     * @return Collection|DetalleHecho[]
     */
    public function getDetalleHecho(): Collection
    {
        return $this->exp;
    }

    public function addDetalleHecho(DetalleHecho $detalleHecho): self
    {
        if (!$this->exp->contains($detalleHecho)) {
            $this->exp[] = $detalleHecho;
            $detalleHecho->setVictima($this);
        }

        return $this;
    }

    public function removeDetalleHecho(DetalleHecho $DetalleHecho): self
    {
        if ($this->detalleHecho->removeElement($DetalleHecho)) {
            // set the owning side to null (unless already changed)
            if ($DetalleHecho->getVictima() === $this) {
                $DetalleHecho->setVictima(null);
            }
        }

        return $this;
    }
}
