<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Grupo
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
    private $descripcion;

    /**
     * @ORM\Column(type="integer")
     * @var int
     */
    private $aula;

    /**
     * @ORM\Column(type="integer")
     * @var int
     */
    private $planta;

    /**
     * @ORM\OneToMany(targetEntity="Alumno", mappedBy="grupo")
     */
    private $alumnado;

    /**
     * @ORM\OneToOne(targetEntity="Profesor", inversedBy="tutoria")
     */
    private $tutor;

    /**
     * @ORM\ManyToMany(targetEntity="Profesor", mappedBy="grupos")
     */
    private $profesorado;

    /**
     * Convierte el grupo en una cadena
     */
    public function __toString()
    {
        return $this->getDescripcion();
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->alumnado = new \Doctrine\Common\Collections\ArrayCollection();
        $this->profesorado = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set descripcion
     *
     * @param string $descripcion
     *
     * @return Grupo
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set aula
     *
     * @param integer $aula
     *
     * @return Grupo
     */
    public function setAula($aula)
    {
        $this->aula = $aula;

        return $this;
    }

    /**
     * Get aula
     *
     * @return integer
     */
    public function getAula()
    {
        return $this->aula;
    }

    /**
     * Set planta
     *
     * @param integer $planta
     *
     * @return Grupo
     */
    public function setPlanta($planta)
    {
        $this->planta = $planta;

        return $this;
    }

    /**
     * Get planta
     *
     * @return integer
     */
    public function getPlanta()
    {
        return $this->planta;
    }

    /**
     * Add alumnado
     *
     * @param Alumno $alumnado
     *
     * @return Grupo
     */
    public function addAlumnado(Alumno $alumnado)
    {
        $this->alumnado[] = $alumnado;

        return $this;
    }

    /**
     * Remove alumnado
     *
     * @param Alumno $alumnado
     */
    public function removeAlumnado(Alumno $alumnado)
    {
        $this->alumnado->removeElement($alumnado);
    }

    /**
     * Get alumnado
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAlumnado()
    {
        return $this->alumnado;
    }

    /**
     * Set tutor
     *
     * @param Profesor $tutor
     *
     * @return Grupo
     */
    public function setTutor(Profesor $tutor = null)
    {
        $this->tutor = $tutor;

        return $this;
    }

    /**
     * Get tutor
     *
     * @return Profesor
     */
    public function getTutor()
    {
        return $this->tutor;
    }

    /**
     * Add profesorado
     *
     * @param Profesor $profesorado
     *
     * @return Grupo
     */
    public function addProfesorado(Profesor $profesorado)
    {
        $this->profesorado[] = $profesorado;

        return $this;
    }

    /**
     * Remove profesorado
     *
     * @param Profesor $profesorado
     */
    public function removeProfesorado(Profesor $profesorado)
    {
        $this->profesorado->removeElement($profesorado);
    }

    /**
     * Get profesorado
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getProfesorado()
    {
        return $this->profesorado;
    }
}
