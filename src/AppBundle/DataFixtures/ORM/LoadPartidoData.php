<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Partido;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

class LoadPartidoData extends AbstractFixture implements OrderedFixtureInterface
{
    protected $faker;

    public function getOrder()
    {
        return 20;
    }

    function __construct()
    {
        $this->faker = \Faker\Factory::create();
        $this->faker->addProvider(new \Faker\Provider\es_ES\PhoneNumber($this->faker));
        $this->faker->addProvider(new \Faker\Provider\es_ES\Person($this->faker));
        $this->faker->addProvider(new \Faker\Provider\es_ES\Address($this->faker));
        $this->faker->addProvider(new \Faker\Provider\Internet($this->faker));
    }

    private function getData($i)
    {
        $creador = $this->getReference('USER'.rand(0,20));

        $entity = new Partido();
        $entity->setUser($creador);
        $entity->setFecha($this->faker->dateTimeBetween($startDate = '+1 days', $endDate = '+1 months', $timezone = date_default_timezone_get()) );
        $entity->setPista($this->getReference("PISTA".rand(1,10)));

        if ($i <= 10) {
            $fin = false;
            $jugadores = [];
            do {
                $num = rand(1,10);
                if (!in_array($num, $jugadores)) {
                    $jugadores[] = $num;
                    $fin = count($jugadores) == 3;
                }
            } while (!$fin);
            $entity->setP1j1($creador);
            $entity->setP1j2($this->getReference("USER".$jugadores[0]));
            $entity->setP2j1($this->getReference("USER".$jugadores[1]));
            $entity->setP2j2($this->getReference("USER".$jugadores[2]));
        }

        return $entity;
    }

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $contPartido = 0;
        $contPartidoCompleto = 0;
        for ($i=1; $i <= 20; $i++) {
            $entity = $this->getData($i);
            if (empty($entity->getP1j1())) {
                $contPartido++;
                $this->setReference("PARTIDO".$contPartido, $entity);
            } else {
                $contPartidoCompleto++;
                $this->setReference("PARTIDOCOMPLETO".$contPartidoCompleto, $entity);
            }

            $manager->persist($entity);
        }

        $manager->flush();
    }
}
