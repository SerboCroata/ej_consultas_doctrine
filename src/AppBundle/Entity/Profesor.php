<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Profesor
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @var int
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=10)
     * @var string
     */
    private $dni;

    /**
     * @ORM\Column(type="string")
     * @var string
     */
    private $nombre;

    /**
     * @ORM\Column(type="string")
     * @var string
     */
    private $apellidos;

    /**
     * @ORM\OneToMany(targetEntity="Parte", mappedBy="profesor")
     */
    private $partes;

    /**
     * @ORM\OneToOne(targetEntity="Grupo", mappedBy="tutor")
     */
    private $tutoria;

    /**
     * @ORM\ManyToMany(targetEntity="Grupo", inversedBy="profesorado")
     */
    private $grupos;

    /**
     *
     */
    public function __toString()
    {
        return $this->getNombre() . ' ' . $this->getApellidos();
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->partes = new \Doctrine\Common\Collections\ArrayCollection();
        $this->grupos = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set dni
     *
     * @param string $dni
     *
     * @return Profesor
     */
    public function setDni($dni)
    {
        $this->dni = $dni;

        return $this;
    }

    /**
     * Get dni
     *
     * @return string
     */
    public function getDni()
    {
        return $this->dni;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Profesor
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set apellidos
     *
     * @param string $apellidos
     *
     * @return Profesor
     */
    public function setApellidos($apellidos)
    {
        $this->apellidos = $apellidos;

        return $this;
    }

    /**
     * Get apellidos
     *
     * @return string
     */
    public function getApellidos()
    {
        return $this->apellidos;
    }

    /**
     * Add parte
     *
     * @param \AppBundle\Entity\Parte $parte
     *
     * @return Profesor
     */
    public function addParte(\AppBundle\Entity\Parte $parte)
    {
        $this->partes[] = $parte;

        return $this;
    }

    /**
     * Remove parte
     *
     * @param \AppBundle\Entity\Parte $parte
     */
    public function removeParte(\AppBundle\Entity\Parte $parte)
    {
        $this->partes->removeElement($parte);
    }

    /**
     * Get partes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPartes()
    {
        return $this->partes;
    }

    /**
     * Set tutoria
     *
     * @param \AppBundle\Entity\Grupo $tutoria
     *
     * @return Profesor
     */
    public function setTutoria(\AppBundle\Entity\Grupo $tutoria = null)
    {
        $this->tutoria = $tutoria;

        return $this;
    }

    /**
     * Get tutoria
     *
     * @return \AppBundle\Entity\Grupo
     */
    public function getTutoria()
    {
        return $this->tutoria;
    }

    /**
     * Add grupo
     *
     * @param \AppBundle\Entity\Grupo $grupo
     *
     * @return Profesor
     */
    public function addGrupo(\AppBundle\Entity\Grupo $grupo)
    {
        $this->grupos[] = $grupo;

        return $this;
    }

    /**
     * Remove grupo
     *
     * @param \AppBundle\Entity\Grupo $grupo
     */
    public function removeGrupo(\AppBundle\Entity\Grupo $grupo)
    {
        $this->grupos->removeElement($grupo);
    }

    /**
     * Get grupos
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getGrupos()
    {
        return $this->grupos;
    }
}
