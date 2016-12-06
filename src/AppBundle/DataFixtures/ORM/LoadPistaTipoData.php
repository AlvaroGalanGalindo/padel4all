<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\PistaTipo;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

/**
 * LoadPistaTipo.
 *
 * Carga en base de datos de tipos de pistas
 *
 */
class LoadPistaTipoData extends AbstractFixture implements OrderedFixtureInterface
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
        $tipos = array("Privada", "Alquiler", "Gratuita");

        $i = 1;
        foreach ($tipos as $tipo) {
            $pistaTipo = new PistaTipo();
            $pistaTipo->setNombre($tipo);
            $manager->persist($pistaTipo);
            $this->setReference("PISTATIPO" . $i, $pistaTipo);
            $i ++;
        }

        $manager->flush();
    }
}