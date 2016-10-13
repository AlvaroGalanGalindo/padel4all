<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Resultado
 *
 * @ORM\Table(name="resultado")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ResultadoRepository")
 */
class Resultado
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
     * @var int
     *
     * @ORM\Column(name="set1p1", type="smallint", nullable=true)
     */
    private $set1p1;

    /**
     * @var int
     *
     * @ORM\Column(name="set1p2", type="smallint", nullable=true)
     */
    private $set1p2;

    /**
     * @var int
     *
     * @ORM\Column(name="set2p1", type="smallint", nullable=true)
     */
    private $set2p1;

    /**
     * @var int
     *
     * @ORM\Column(name="set2p2", type="smallint", nullable=true)
     */
    private $set2p2;

    /**
     * @var int
     *
     * @ORM\Column(name="set3p1", type="smallint", nullable=true)
     */
    private $set3p1;

    /**
     * @var int
     *
     * @ORM\Column(name="set3p2", type="smallint", nullable=true)
     */
    private $set3p2;

    /**
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Partido", inversedBy="resultado")
     * @ORM\JoinColumn(name="partido_id", referencedColumnName="id")
     */
    private $partido;


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
     * Set set1p1
     *
     * @param integer $set1p1
     * @return Resultado
     */
    public function setSet1p1($set1p1)
    {
        $this->set1p1 = $set1p1;

        return $this;
    }

    /**
     * Get set1p1
     *
     * @return integer 
     */
    public function getSet1p1()
    {
        return $this->set1p1;
    }

    /**
     * Set set1p2
     *
     * @param integer $set1p2
     * @return Resultado
     */
    public function setSet1p2($set1p2)
    {
        $this->set1p2 = $set1p2;

        return $this;
    }

    /**
     * Get set1p2
     *
     * @return integer 
     */
    public function getSet1p2()
    {
        return $this->set1p2;
    }

    /**
     * Set set2p1
     *
     * @param integer $set2p1
     * @return Resultado
     */
    public function setSet2p1($set2p1)
    {
        $this->set2p1 = $set2p1;

        return $this;
    }

    /**
     * Get set2p1
     *
     * @return integer 
     */
    public function getSet2p1()
    {
        return $this->set2p1;
    }

    /**
     * Set set2p2
     *
     * @param integer $set2p2
     * @return Resultado
     */
    public function setSet2p2($set2p2)
    {
        $this->set2p2 = $set2p2;

        return $this;
    }

    /**
     * Get set2p2
     *
     * @return integer 
     */
    public function getSet2p2()
    {
        return $this->set2p2;
    }

    /**
     * Set set3p1
     *
     * @param integer $set3p1
     * @return Resultado
     */
    public function setSet3p1($set3p1)
    {
        $this->set3p1 = $set3p1;

        return $this;
    }

    /**
     * Get set3p1
     *
     * @return integer 
     */
    public function getSet3p1()
    {
        return $this->set3p1;
    }

    /**
     * Set set3p2
     *
     * @param integer $set3p2
     * @return Resultado
     */
    public function setSet3p2($set3p2)
    {
        $this->set3p2 = $set3p2;

        return $this;
    }

    /**
     * Get set3p2
     *
     * @return integer 
     */
    public function getSet3p2()
    {
        return $this->set3p2;
    }
}
