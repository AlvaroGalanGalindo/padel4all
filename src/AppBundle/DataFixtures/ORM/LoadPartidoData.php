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

    private function getData()
    {
        $entity = new Partido();
        $entity->setFecha($this->faker->dateTimeBetween($startDate = '+1 days', $endDate = '+1 months', $timezone = date_default_timezone_get()) );
        $entity->setPista($this->getReference("PISTA".rand(1,10)));

        return $entity;
    }

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        for ($i=1; $i <= 10; $i++) {
            $entity = $this->getData();
            $this->setReference("partido".$i, $entity);
            $manager->persist($entity);
        }

        $manager->flush();
    }
}
