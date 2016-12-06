<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\PistaPared;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

/**
 * LoadPistaPared.
 *
 * Carga en base de datos de tipos de pared de pistas
 *
 */
class LoadPistaParedData extends AbstractFixture implements OrderedFixtureInterface
{
    public function getOrder()
    {
        return 0;
    }

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $tipos = array("Cristal", "Muro");

        $i = 1;
        foreach ($tipos as $tipo) {
            $pistaPared = new PistaPared();
            $pistaPared->setNombre($tipo);
            $manager->persist($pistaPared);
            $this->setReference("PISTAPARED" . $i, $pistaPared);
            $i ++;
        }

        $manager->flush();
    }
}