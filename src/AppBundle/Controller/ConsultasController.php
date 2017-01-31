<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Grupo;
use Doctrine\ORM\EntityManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ConsultasController extends Controller
{
    /**
     * @Route("/ej1", name="ejercicio1")
     */
    public function ej1Action()
    {
        $em = $this->getDoctrine()->getManager();
        $alumnado = $em->getRepository('AppBundle:Alumno')
            ->findBy(['nombre' => 'María']);

        return $this->render('consultas/alumnado.html.twig', [
            'alumnado' => $alumnado
        ]);
    }

    /**
     * @Route("/ej2", name="ejercicio2")
     */
    public function ej2Action()
    {
        /** @var EntityManager $em */
        $em = $this->getDoctrine()->getManager();
        $alumnado = $em->createQuery(
            'SELECT a FROM AppBundle:Alumno a WHERE a.nombre != :nombre')
            ->setParameter('nombre', 'María')
            ->getResult();

        return $this->render('consultas/alumnado.html.twig', [
            'alumnado' => $alumnado
        ]);
    }

    /**
     * @Route("/ej3/{parametro}", name="ejercicio3")
     */
    public function ej3Action($parametro)
    {
        /** @var EntityManager $em */
        $em = $this->getDoctrine()->getManager();
        $alumnado = $em->createQueryBuilder()
            ->select('a')
            ->from('AppBundle:Alumno', 'a')
            ->where('a.nombre = :nombre')
            ->setParameter('nombre', $parametro)
            ->getQuery()
            ->getResult();

        return $this->render('consultas/alumnado.html.twig', [
            'alumnado' => $alumnado
        ]);
    }

    /**
     * @Route("/ej4", name="ejercicio4")
     */
    public function ej4Action()
    {
        /** @var EntityManager $em */
        $em = $this->getDoctrine()->getManager();
        $alumnado = $em->createQueryBuilder()
            ->select('a')
            ->from('AppBundle:Alumno', 'a')
            ->where('a.apellidos LIKE :apellido')
            ->setParameter('apellido', 'Ojeda %')
            ->orderBy('a.nombre')
            ->getQuery()
            ->getResult();

        return $this->render('consultas/alumnado.html.twig', [
            'alumnado' => $alumnado
        ]);
    }

    /**
     * @Route("/ej5", name="ejercicio5")
     */
    public function ej5Action()
    {
        /** @var EntityManager $em */
        $em = $this->getDoctrine()->getManager();
        $alumnado = $em->createQueryBuilder()
            ->select('a')
            ->from('AppBundle:Alumno', 'a')
            ->where('a.fechaNacimiento >= :fechaInicio')
            ->andWhere('a.fechaNacimiento < :fechaFin')
            ->setParameter('fechaInicio', new \DateTime('1997-01-01'))
            ->setParameter('fechaFin', new \DateTime('1998-01-01'))
            ->getQuery()
            ->getResult();

        return $this->render('consultas/alumnado.html.twig', [
            'alumnado' => $alumnado
        ]);
    }

    /**
     * @Route("/ej6", name="ejercicio6")
     */
    public function ej6Action()
    {
        /** @var EntityManager $em */
        $em = $this->getDoctrine()->getManager();
        $alumnadoCuenta = $em->createQueryBuilder()
            ->select('COUNT(a)')
            ->from('AppBundle:Alumno', 'a')
            ->where('a.fechaNacimiento >= :fechaInicio')
            ->andWhere('a.fechaNacimiento < :fechaFin')
            ->setParameter('fechaInicio', new \DateTime('1997-01-01'))
            ->setParameter('fechaFin', new \DateTime('1998-01-01'))
            ->getQuery()
            ->getSingleScalarResult();

        return $this->render('consultas/cuenta.html.twig', [
            'numero' => $alumnadoCuenta
        ]);
    }

    /**
     * @Route("/ej7/{anio}", name="ejercicio7", requirements={"anio"="\d{4}"})
     */
    public function ej7Action($anio)
    {
        /** @var EntityManager $em */
        $em = $this->getDoctrine()->getManager();
        $alumnado = $em->createQueryBuilder()
            ->select('a')
            ->from('AppBundle:Alumno', 'a')
            ->where('a.fechaNacimiento >= :fechaInicio')
            ->andWhere('a.fechaNacimiento < :fechaFin')
            ->setParameter('fechaInicio', new \DateTime("$anio-01-01"))
            ->setParameter('fechaFin', new \DateTime(($anio + 1) . '-01-01'))
            ->orderBy('a.fechaNacimiento', 'DESC')
            ->getQuery()
            ->getResult();

        return $this->render('consultas/alumnado.html.twig', [
            'alumnado' => $alumnado
        ]);
    }

    /**
     * @Route("/ej10", name="ejercicio10")
     * @Route("/ej11", name="ejercicio11")
     */
    public function ej10Action()
    {
        /** @var EntityManager $em */
        $em = $this->getDoctrine()->getManager();
        $grupos = $em->createQueryBuilder()
            ->select('g')
            ->addSelect('SIZE(g.alumnado)')
            ->addSelect('t')
            ->from('AppBundle:Grupo', 'g')
            ->join('g.tutor', 't')
            ->orderBy('g.descripcion', 'DESC')
            ->getQuery()
            ->getResult();

        return $this->render('consultas/grupos.html.twig', [
            'grupos' => $grupos
        ]);
    }

    /**
     * @Route("/alumnado/{grupo}", name="listado_grupo")
     */
    public function ej11Action(Grupo $grupo)
    {
        /** @var EntityManager $em */
        $em = $this->getDoctrine()->getManager();

        $alumnado = $em->createQueryBuilder()
            ->select('a')
            ->from('AppBundle:Alumno', 'a')
            ->orderBy('a.apellidos', 'ASC')
            ->addOrderBy('a.nombre', 'ASC')
            ->where('a.grupo = :grupo')
            ->setParameter('grupo', $grupo)
            ->getQuery()
            ->getResult();

        return $this->render('consultas/alumnado.html.twig', [
            'alumnado' => $alumnado
        ]);
    }

    /**
     * @Route("/ej16", name="listado_profesorado")
     */
    public function ej16Action()
    {
        /** @var EntityManager $em */
        $em = $this->getDoctrine()->getManager();

        $profesorado = $em->createQueryBuilder()
            ->select('p')
            ->addSelect('g')
            ->from('AppBundle:Profesor', 'p')
            ->leftJoin('p.tutoria', 'g')
            ->orderBy('p.apellidos', 'ASC')
            ->addOrderBy('p.nombre', 'ASC')
            ->where('SIZE(p.partes)=0')
            ->getQuery()
            ->getResult();

        return $this->render('consultas/profesorado.html.twig', [
            'profesorado' => $profesorado
        ]);
    }
}
