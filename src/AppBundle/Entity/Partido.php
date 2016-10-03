<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Partido
 *
 * @ORM\Table(name="partido")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PartidoRepository")
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
     * @ORM\ManyToOne(
     *      targetEntity="AppBundle\Entity\Pista",
     *      inversedBy="partidos"
     * )
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    protected $pista;


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
}
