<?php
// src/AppBundle/Entity/User.php

namespace AppBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

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

    public function __construct()
    {
        parent::__construct();
        $this->pistas = new ArrayCollection();
    }

    public function __toString() {
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
}
