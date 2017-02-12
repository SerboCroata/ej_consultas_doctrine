<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Alumno
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @var int
     */
    private $id;

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
     * @ORM\Column(type="date")
     * @var \DateTime
     */
    private $fechaNacimiento;

    /**
     * @ORM\Column(type="text")
     * @var string
     */
    private $observaciones;

    /**
     * @ORM\ManyToOne(targetEntity="Grupo", inversedBy="alumnado")
     */
    private $grupo;

    /**
     * @ORM\OneToMany(targetEntity="Parte", mappedBy="alumno")
     */
    private $partes;

    /**
     * Convertir alumno en una cadena
     */
    public function __toString()
    {
        return $this->getApellidos() . ', ' . $this->getNombre() . ' (' . $this->getGrupo() . ')';
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->partes = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Alumno
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
     * @return Alumno
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
     * Set fechaNacimiento
     *
     * @param \DateTime $fechaNacimiento
     *
     * @return Alumno
     */
    public function setFechaNacimiento($fechaNacimiento)
    {
        $this->fechaNacimiento = $fechaNacimiento;

        return $this;
    }

    /**
     * Get fechaNacimiento
     *
     * @return \DateTime
     */
    public function getFechaNacimiento()
    {
        return $this->fechaNacimiento;
    }

    /**
     * Set observaciones
     *
     * @param string $observaciones
     *
     * @return Alumno
     */
    public function setObservaciones($observaciones)
    {
        $this->observaciones = $observaciones;

        return $this;
    }

    /**
     * Get observaciones
     *
     * @return string
     */
    public function getObservaciones()
    {
        return $this->observaciones;
    }

    /**
     * Set grupo
     *
     * @param Grupo $grupo
     *
     * @return Alumno
     */
    public function setGrupo(Grupo $grupo = null)
    {
        $this->grupo = $grupo;

        return $this;
    }

    /**
     * Get grupo
     *
     * @return Grupo
     */
    public function getGrupo()
    {
        return $this->grupo;
    }

    /**
     * Add parte
     *
     * @param Parte $parte
     *
     * @return Alumno
     */
    public function addParte(Parte $parte)
    {
        $this->partes[] = $parte;

        return $this;
    }

    /**
     * Remove parte
     *
     * @param Parte $parte
     */
    public function removeParte(Parte $parte)
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
}
