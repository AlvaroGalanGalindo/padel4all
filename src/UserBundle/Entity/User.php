<?php
// src/AppBundle/Entity/User.php

namespace UserBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection as ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $nombre;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $apellidos;

    /**
     * @ORM\Column(type="string", length=9, nullable=true)
     */
    protected $telefono;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Pista", mappedBy="user")
     */
    protected $pistas;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Partido", mappedBy="user")
     */
    protected $partidos;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Partido", mappedBy="p1j1")
     */
    protected $partidos_p1j1;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Partido", mappedBy="p1j2")
     */
    protected $partidos_p1j2;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Partido", mappedBy="p2j1")
     */
    protected $partidos_p2j1;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Partido", mappedBy="p2j2")
     */
    protected $partidos_p2j2;


    public function __construct()
    {
        parent::__construct();
        $this->pistas = new ArrayCollection();
        $this->partidos = new ArrayCollection();
        $this->partidos_p1j1 = new ArrayCollection();
        $this->partidos_p1j2 = new ArrayCollection();
        $this->partidos_p2j1 = new ArrayCollection();
        $this->partidos_p2j2 = new ArrayCollection();
        $this->setRoles(array('ROLE_USER'));
    }

    public function __toString() {
        return $this->getNickNombre();
    }

    public function getNickNombre() {
        return $this->username." (".$this->nombre." ".$this->apellidos.")";
    }


    /**
     * Set nombre
     *
     * @param string $nombre
     * @return User
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
     * @return User
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
     * Set telefono
     *
     * @param string $telefono
     * @return User
     */
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;

        return $this;
    }

    /**
     * Get telefono
     *
     * @return string 
     */
    public function getTelefono()
    {
        return $this->telefono;
    }

    /**
     * Add pistas
     *
     * @param \AppBundle\Entity\Pista $pistas
     * @return Pista
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

    /**
     * Add partidos
     *
     * @param \AppBundle\Entity\Pista $pistas
     * @return Pista
     */
    public function addPartido(\AppBundle\Entity\Partido $partido)
    {
        $this->partidos[] = $partido;

        return $this;
    }

    /**
     * Remove partidos
     *
     * @param \AppBundle\Entity\Pista $pistas
     */
    public function removePartido(\AppBundle\Entity\Partido $partido)
    {
        $this->partidos->removeElement($partido);
    }

    /**
     * Get partidos
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPartidos()
    {
        return $this->partidos;
    }

    /**
     * Add partidos_p1j1
     *
     * @param \AppBundle\Entity\Partido $partidosP1j1
     * @return User
     */
    public function addPartidosP1j1(\AppBundle\Entity\Partido $partidosP1j1)
    {
        $this->partidos_p1j1[] = $partidosP1j1;

        return $this;
    }

    /**
     * Remove partidos_p1j1
     *
     * @param \AppBundle\Entity\Partido $partidosP1j1
     */
    public function removePartidosP1j1(\AppBundle\Entity\Partido $partidosP1j1)
    {
        $this->partidos_p1j1->removeElement($partidosP1j1);
    }

    /**
     * Get partidos_p1j1
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPartidosP1j1()
    {
        return $this->partidos_p1j1;
    }

    /**
     * Add partidos_p1j2
     *
     * @param \AppBundle\Entity\Partido $partidosP1j2
     * @return User
     */
    public function addPartidosP1j2(\AppBundle\Entity\Partido $partidosP1j2)
    {
        $this->partidos_p1j2[] = $partidosP1j2;

        return $this;
    }

    /**
     * Remove partidos_p1j2
     *
     * @param \AppBundle\Entity\Partido $partidosP1j2
     */
    public function removePartidosP1j2(\AppBundle\Entity\Partido $partidosP1j2)
    {
        $this->partidos_p1j2->removeElement($partidosP1j2);
    }

    /**
     * Get partidos_p1j2
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPartidosP1j2()
    {
        return $this->partidos_p1j2;
    }

    /**
     * Add partidos_p2j1
     *
     * @param \AppBundle\Entity\Partido $partidosP2j1
     * @return User
     */
    public function addPartidosP2j1(\AppBundle\Entity\Partido $partidosP2j1)
    {
        $this->partidos_p2j1[] = $partidosP2j1;

        return $this;
    }

    /**
     * Remove partidos_p2j1
     *
     * @param \AppBundle\Entity\Partido $partidosP2j1
     */
    public function removePartidosP2j1(\AppBundle\Entity\Partido $partidosP2j1)
    {
        $this->partidos_p2j1->removeElement($partidosP2j1);
    }

    /**
     * Get partidos_p2j1
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPartidosP2j1()
    {
        return $this->partidos_p2j1;
    }

    /**
     * Add partidos_p2j2
     *
     * @param \AppBundle\Entity\Partido $partidosP2j2
     * @return User
     */
    public function addPartidosP2j2(\AppBundle\Entity\Partido $partidosP2j2)
    {
        $this->partidos_p2j2[] = $partidosP2j2;

        return $this;
    }

    /**
     * Remove partidos_p2j2
     *
     * @param \AppBundle\Entity\Partido $partidosP2j2
     */
    public function removePartidosP2j2(\AppBundle\Entity\Partido $partidosP2j2)
    {
        $this->partidos_p2j2->removeElement($partidosP2j2);
    }

    /**
     * Get partidos_p2j2
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPartidosP2j2()
    {
        return $this->partidos_p2j2;
    }

    public function getNumPartidos() {
        return count($this->partidos_p1j1) + count($this->partidos_p1j2) +
               count($this->partidos_p2j1) + count($this->partidos_p2j2);
    }

    public function getNumPartidosIzquierda() {
        return count($this->partidos_p1j1) + count($this->partidos_p2j1);
    }

    public function getNumPartidosReves() {
        return count($this->partidos_p1j2) + count($this->partidos_p2j2);
    }

    public function getPartidosGanados() {
        $aPareja1 = [$this->partidos_p1j1, $this->partidos_p1j2];
        $aPareja2 = [$this->partidos_p2j1, $this->partidos_p2j2];
        $num_partidos = 0;
        foreach ($aPareja1 as $partidos) {
            foreach ($partidos as $partido) {
                if (!empty($partido->getResultado()) && $partido->getResultado()->getPareja1Ganadora()) { $num_partidos++; }
            }
        }
        foreach ($aPareja2 as $partidos) {
            foreach ($partidos as $partido) {
                if (!empty($partido->getResultado()) && $partido->getResultado()->getPareja2Ganadora()) { $num_partidos++; }
            }
        }
        return $num_partidos;
    }

    public function getPartidosGanadosIzquierda() {
        $num_partidos = 0;
        foreach ($this->partidos_p1j1 as $partido) {
            if (!empty($partido->getResultado()) && $partido->getResultado()->getPareja1Ganadora()) { $num_partidos++; }
        }
        foreach ($this->partidos_p2j1 as $partido) {
            if (!empty($partido->getResultado()) && $partido->getResultado()->getPareja2Ganadora()) { $num_partidos++; }
        }
        return $num_partidos;
    }

    public function getPartidosGanadosReves() {
        $num_partidos = 0;
        foreach ($this->partidos_p1j2 as $partido) {
            if (!empty($partido->getResultado()) && $partido->getResultado()->getPareja1Ganadora()) { $num_partidos++; }
        }
        foreach ($this->partidos_p2j2 as $partido) {
            if (!empty($partido->getResultado()) && $partido->getResultado()->getPareja2Ganadora()) { $num_partidos++; }
        }
        return $num_partidos;
    }
}
