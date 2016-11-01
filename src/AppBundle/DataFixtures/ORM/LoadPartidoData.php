<?php

namespace AppBundle\DataFixtures\ORM\dev;

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
        $entity = new Partido();
        $entity->setUser($this->getReference('USER'.rand(0,20)));
        $entity->setFecha($this->faker->dateTimeBetween($startDate = '+1 days', $endDate = '+1 months', $timezone = date_default_timezone_get()) );
        $entity->setPista($this->getReference("PISTA".rand(1,10)));

        if ($i < 10) {
            $fin = false;
            $jugadores = [];
            do {
                $num = rand(1,10);
                if (!in_array($num, $jugadores)) {
                    $jugadores[] = $num;
                    $fin = count($jugadores) == 4;
                }
            } while (!$fin);
            $entity->setP1j1($this->getReference("USER".$jugadores[0]));
            $entity->setP1j2($this->getReference("USER".$jugadores[1]));
            $entity->setP2j1($this->getReference("USER".$jugadores[2]));
            $entity->setP2j2($this->getReference("USER".$jugadores[3]));
        }

        return $entity;
    }

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        for ($i=1; $i <= 10; $i++) {
            $entity = $this->getData($i);
            $this->setReference("partido".$i, $entity);
            $manager->persist($entity);
        }

        $manager->flush();
    }
}
