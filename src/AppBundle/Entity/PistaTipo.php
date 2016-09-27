<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PistaTipo
 *
 * @ORM\Table(name="pista_tipo")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PistaTipoRepository")
 */
class PistaTipo
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
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255)
     */
    private $nombre;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Pista", mappedBy="tipo")
     */
    protected $pistas;

    public function __construct()
    {
        $this->pistas = new ArrayCollection();
    }

    public function __toString() {
        return $this->nombre;
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
     * @return PistaTipo
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
     * Add pistas
     *
     * @param \AppBundle\Entity\Pista $pistas
     * @return PistaTipo
     */
    public function addPista(\AppBundle\Entity\Pista $pistas)
    {
        $this->pistas[] = $pistas;

        return $this;
    }

    /**
     * Remove pistas
     *
     * @param \AppBundle\Entity\Pista $pistas
     */
    public function removePista(\AppBundle\Entity\Pista $pistas)
    {
        $this->pistas->removeElement($pistas);
    }

    /**
     * Get pistas
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPistas()
    {
        return $this->pistas;
    }
}
