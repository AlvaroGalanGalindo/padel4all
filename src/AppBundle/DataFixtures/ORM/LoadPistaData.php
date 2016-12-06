<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Pista;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

/**
 * LoadPista.
 *
 * Carga en base de datos de pistas
 *
 */
class LoadPistaData extends AbstractFixture implements OrderedFixtureInterface
{
    protected $faker;

    public function getOrder()
    {
        return 10;
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
        $entity = new Pista();
        $entity->setPropietario($this->faker->company());
        $entity->setDireccion($this->faker->streetAddress());
        $entity->setLocalidad($this->faker->city());
        $entity->setProvincia("Cáceres");
        $entity->setTelefono($this->faker->randomNumber(9));

        $entity->setNombre("Pista " . $this->faker->randomNumber(1));
        $entity->setPrecio($this->faker->randomFloat(1,1,5));
        $entity->setHorario("Todos los días de 10:00 a 22:00");
        $entity->setClimatizada($this->faker->boolean(25));
        $entity->setCubierta($this->faker->boolean(50));
        $entity->setPuertas($this->faker->boolean(20));

        $entity->setTipo($this->getReference("PISTATIPO".rand(1,3)));
        $entity->setPared($this->getReference("PISTAPARED".rand(1,2)));
        $entity->setUser($this->getReference('USER'.rand(0,20)));

        return $entity;
    }

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        for ($i=1; $i <= 10; $i++) {
            $entity = $this->getData();
            $this->setReference("PISTA".$i, $entity);
            $manager->persist($entity);
        }

        $manager->flush();
    }
}
