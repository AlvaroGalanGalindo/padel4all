<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection as ArrayCollection;

/**
 * Pista
 *
 * @ORM\Table(name="pista")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PistaRepository")
 */
class Pista
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
     * @var string
     *
     * @ORM\Column(name="propietario", type="string", length=255)
     */
    private $propietario;

    /**
     * @var string
     *
     * @ORM\Column(name="direccion", type="string", length=255, nullable=true)
     */
    private $direccion;

    /**
     * @var string
     *
     * @ORM\Column(name="localidad", type="string", length=255, nullable=true)
     */
    private $localidad;

    /**
     * @var string
     *
     * @ORM\Column(name="provincia", type="string", length=255, nullable=true)
     */
    private $provincia;

    /**
     * @var string
     *
     * @ORM\Column(name="telefono", type="string", length=255, nullable=true)
     */
    private $telefono;

    /**
     * @var string
     *
     * @ORM\Column(name="horario", type="string", length=255, nullable=true)
     */
    private $horario;

    /**
     * @var string
     *
     * @ORM\Column(type="decimal", precision=4, scale=2)
     */
    private $precio;

    /**
     * @var bool
     *
     * @ORM\Column(name="climatizada", type="boolean")
     */
    private $climatizada;

    /**
     * @var bool
     *
     * @ORM\Column(name="cubierta", type="boolean")
     */
    private $cubierta;

    /**
     * @var bool
     *
     * @ORM\Column(name="puertas", type="boolean")
     */
    private $puertas;

    /**
     * @ORM\ManyToOne(
     *      targetEntity="AppBundle\Entity\PistaTipo",
     *      inversedBy="pistas"
     * )
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    protected $tipo;

    /**
     * @ORM\ManyToOne(
     *      targetEntity="AppBundle\Entity\PistaPared",
     *      inversedBy="pistas"
     * )
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    protected $pared;

    /**
     * @ORM\ManyToOne(
     *      targetEntity="AppBundle\Entity\User",
     *      inversedBy="pistas"
     * )
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    protected $user;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Partido", mappedBy="pista")
     */
    protected $partidos;


    public function __construct()
    {
        $this->partidos = new ArrayCollection();
    }

    public function __toString() {
        return $this->nombre . " (". $this->propietario . ")";
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
     * @return Pista
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
     * Set propietario
     *
     * @param string $propietario
     * @return Pista
     */
    public function setPropietario($propietario)
    {
        $this->propietario = $propietario;

        return $this;
    }

    /**
     * Get propietario
     *
     * @return string 
     */
    public function getPropietario()
    {
        return $this->propietario;
    }

    /**
     * Set direccion
     *
     * @param string $direccion
     * @return Pista
     */
    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;

        return $this;
    }

    /**
     * Get direccion
     *
     * @return string 
     */
    public function getDireccion()
    {
        return $this->direccion;
    }

    /**
     * Set localidad
     *
     * @param string $localidad
     * @return Pista
     */
    public function setLocalidad($localidad)
    {
        $this->localidad = $localidad;

        return $this;
    }

    /**
     * Get localidad
     *
     * @return string 
     */
    public function getLocalidad()
    {
        return $this->localidad;
    }

    /**
     * Set provincia
     *
     * @param string $provincia
     * @return Pista
     */
    public function setProvincia($provincia)
    {
        $this->provincia = $provincia;

        return $this;
    }

    /**
     * Get provincia
     *
     * @return string 
     */
    public function getProvincia()
    {
        return $this->provincia;
    }

    /**
     * Set telefono
     *
     * @param string $telefono
     * @return Pista
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
     * Set horario
     *
     * @param string $horario
     * @return Pista
     */
    public function setHorario($horario)
    {
        $this->horario = $horario;

        return $this;
    }

    /**
     * Get horario
     *
     * @return string 
     */
    public function getHorario()
    {
        return $this->horario;
    }

    /**
     * Set precio
     *
     * @param string $precio
     * @return Pista
     */
    public function setPrecio($precio)
    {
        $this->precio = $precio;

        return $this;
    }

    /**
     * Get precio
     *
     * @return string 
     */
    public function getPrecio()
    {
        return $this->precio;
    }

    /**
     * Set climatizada
     *
     * @param boolean $climatizada
     * @return Partido
     */
    public function setClimatizada($climatizada)
    {
        $this->climatizada = $climatizada;

        return $this;
    }

    /**
     * Get climatizada
     *
     * @return boolean
     */
    public function getClimatizada()
    {
        return $this->climatizada;
    }

    /**
     * Set cubierta
     *
     * @param boolean $cubierta
     * @return Partido
     */
    public function setCubierta($cubierta)
    {
        $this->cubierta = $cubierta;

        return $this;
    }

    /**
     * Get cubierta
     *
     * @return boolean
     */
    public function getCubierta()
    {
        return $this->cubierta;
    }

    /**
     * Set puertas
     *
     * @param boolean $puertas
     * @return Partido
     */
    public function setPuertas($puertas)
    {
        $this->puertas = $puertas;

        return $this;
    }

    /**
     * Get puertas
     *
     * @return boolean
     */
    public function getPuertas()
    {
        return $this->puertas;
    }

    /**
     * Set tipo
     *
     * @param \AppBundle\Entity\PistaTipo $tipo
     * @return Pista
     */
    public function setTipo(\AppBundle\Entity\PistaTipo $tipo = null)
    {
        $this->tipo = $tipo;

        return $this;
    }

    /**
     * Get tipo
     *
     * @return \AppBundle\Entity\PistaTipo 
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * Set pared
     *
     * @param \AppBundle\Entity\PistaPared $pared
     * @return Pista
     */
    public function setPared(\AppBundle\Entity\PistaPared $pared = null)
    {
        $this->pared = $pared;

        return $this;
    }

    /**
     * Get pared
     *
     * @return \AppBundle\Entity\PistaPared
     */
    public function getPared()
    {
        return $this->pared;
    }

    /**
     * Set user
     *
     * @param \AppBundle\Entity\User $user
     * @return Pista
     */
    public function setUser(\AppBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \AppBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Add partidos
     *
     * @param \AppBundle\Entity\Partido $partido
     * @return PistaTipo
     */
    public function addPartido(\AppBundle\Entity\Partido $partido)
    {
        $this->partidos[] = $partido;

        return $this;
    }

    /**
     * Remove partidos
     *
     * @param \AppBundle\Entity\Partido $partido
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
}
