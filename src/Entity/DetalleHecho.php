<?php

namespace App\Entity;

use App\Repository\DetalleHechoRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DetalleHechoRepository::class)
 */
class DetalleHecho
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
    private $victima;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $autor;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $mecanismo;

    /**
     * @ORM\ManyToOne(targetEntity=Hecho::class, inversedBy="detalleHechos",cascade={"persist"})
     */
    private $hechoNro;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getVictima(): ?string
    {
        return $this->victima;
    }

    public function setVictima(string $victima): self
    {
        $this->victima = $victima;

        return $this;
    }

    public function getAutor(): ?string
    {
        return $this->autor;
    }

    public function setAutor(string $autor): self
    {
        $this->autor = $autor;

        return $this;
    }

    public function getMecanismo(): ?string
    {
        return $this->mecanismo;
    }

    public function setMecanismo(string $mecanismo): self
    {
        $this->mecanismo = $mecanismo;

        return $this;
    }

    public function getHechoNro(): ?Hecho
    {
        return $this->hechoNro;
    }

    public function setHechoNro(?Hecho $hechoNro): self
    {
        $this->hechoNro = $hechoNro;

        return $this;
    }
}
