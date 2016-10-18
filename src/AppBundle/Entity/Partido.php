<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\DateTime;

/**
 * Partido
 *
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PartidoRepository")
 * @ORM\Table(name="partido")
 */
class Partido
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="datetime")
     */
    private $fecha;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_fin", type="datetime")
     */
    private $fecha_fin;

    /**
     * @ORM\ManyToOne(
     *      targetEntity="AppBundle\Entity\Pista",
     *      inversedBy="partidos"
     * )
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    protected $pista;

    /**
     * @ORM\ManyToOne(
     *      targetEntity="AppBundle\Entity\User",
     *      inversedBy="partidos_p1j1"
     * )
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    protected $p1j1;

    /**
     * @ORM\ManyToOne(
     *      targetEntity="AppBundle\Entity\User",
     *      inversedBy="partidos_p1j2"
     * )
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    protected $p1j2;

    /**
     * @ORM\ManyToOne(
     *      targetEntity="AppBundle\Entity\User",
     *      inversedBy="partidos_p2j1"
     * )
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    protected $p2j1;

    /**
     * @ORM\ManyToOne(
     *      targetEntity="AppBundle\Entity\User",
     *      inversedBy="partidos_p2j2"
     * )
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    protected $p2j2;

    /**
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Resultado", mappedBy="partido")
     */
    private $resultado;


    public function __toString() {
        return "Pista: " . $this->pista . " - " . $this->getFormatFecha();
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
     * Set fecha
     *
     * @param \DateTime $fecha
     * @return Partido
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;
        if (!empty($fecha)) {
            $this->fecha_fin = new \DateTime($fecha->format('Y-m-d H:i'));
            $this->fecha_fin->modify('+90 minutes');
        } else {
            $this->fecha_fin = null;
        }

        return $this;
    }

    /**
     * Get fecha
     *
     * @return \DateTime 
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Get fecha
     *
     * @return string
     */
    public function getFormatFecha()
    {
        return $this->fecha->format('d/m/Y H:i');
    }

    /**
     * Set fecha_fin
     *
     * @param \DateTime $fecha_fin
     * @return Partido
     */
    public function setFechaFin($fecha_fin)
    {
        $this->fecha_fin = $fecha_fin;

        return $this;
    }

    /**
     * Get fecha_fin
     *
     * @return \DateTime
     */
    public function getFechaFin()
    {
        return $this->fecha_fin;
    }

    /**
     * Set pista
     *
     * @param \AppBundle\Entity\Pista $pista
     * @return Partido
     */
    public function setPista(\AppBundle\Entity\Pista $pista = null)
    {
        $this->pista = $pista;

        return $this;
    }

    /**
     * Get pista
     *
     * @return \AppBundle\Entity\Pista
     */
    public function getPista()
    {
        return $this->pista;
    }

    /**
     * Set p1j1
     *
     * @param \AppBundle\Entity\User $p1j1
     * @return Partido
     */
    public function setP1j1(\AppBundle\Entity\User $p1j1 = null)
    {
        $this->p1j1 = $p1j1;

        return $this;
    }

    /**
     * Get p1j1
     *
     * @return \AppBundle\Entity\User 
     */
    public function getP1j1()
    {
        return $this->p1j1;
    }

    /**
     * Set p1j2
     *
     * @param \AppBundle\Entity\User $p1j2
     * @return Partido
     */
    public function setP1j2(\AppBundle\Entity\User $p1j2 = null)
    {
        $this->p1j2 = $p1j2;

        return $this;
    }

    /**
     * Get p1j2
     *
     * @return \AppBundle\Entity\User 
     */
    public function getP1j2()
    {
        return $this->p1j2;
    }

    /**
     * Set p2j1
     *
     * @param \AppBundle\Entity\User $p2j1
     * @return Partido
     */
    public function setP2j1(\AppBundle\Entity\User $p2j1 = null)
    {
        $this->p2j1 = $p2j1;

        return $this;
    }

    /**
     * Get p2j1
     *
     * @return \AppBundle\Entity\User 
     */
    public function getP2j1()
    {
        return $this->p2j1;
    }

    /**
     * Set p2j2
     *
     * @param \AppBundle\Entity\User $p2j2
     * @return Partido
     */
    public function setP2j2(\AppBundle\Entity\User $p2j2 = null)
    {
        $this->p2j2 = $p2j2;

        return $this;
    }

    /**
     * Get p2j2
     *
     * @return \AppBundle\Entity\User 
     */
    public function getP2j2()
    {
        return $this->p2j2;
    }

    public function UserInPartido(User $user) {
        return $this->p1j1 == $user || $this->p1j2 == $user || $this->p2j1 == $user || $this->p2j2 == $user;
    }


    /**
     * Set resultado
     *
     * @param \AppBundle\Entity\Resultado $resultado
     * @return Partido
     */
    public function setResultado(\AppBundle\Entity\Resultado $resultado = null)
    {
        $this->resultado = $resultado;

        return $this;
    }

    /**
     * Get resultado
     *
     * @return \AppBundle\Entity\Resultado 
     */
    public function getResultado()
    {
        return $this->resultado;
    }

    /**
     * Get NumJugadores
     *
     * @return integer
     */
    public function getNumJugadores()
    {
        $numJugadores = 0;
        if (!empty($this->p1j1)) { $numJugadores++; }
        if (!empty($this->p1j2)) { $numJugadores++; }
        if (!empty($this->p2j1)) { $numJugadores++; }
        if (!empty($this->p2j2)) { $numJugadores++; }
        return $numJugadores;
    }

    /**
     * Get Jugadores
     *
     * @return array
     */
    public function getJugadores()
    {
        $jugadores = [];
        if (!empty($this->p1j1)) { $jugadores[] = $this->getP1j1()->getUsername(); }
        if (!empty($this->p1j2)) { $jugadores[] = $this->getP1j2()->getUsername(); }
        if (!empty($this->p2j1)) { $jugadores[] = $this->getP2j1()->getUsername(); }
        if (!empty($this->p2j2)) { $jugadores[] = $this->getP2j2()->getUsername(); }
        return $jugadores;
    }
}
