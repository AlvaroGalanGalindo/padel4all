<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Resultado;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

/**
 * LoadResultado.
 *
 * Carga en base de datos de resultados
 *
 */
class LoadResultadoData extends AbstractFixture implements OrderedFixtureInterface
{
    protected $faker;

    public function getOrder()
    {
        return 30;
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
        $entity = new Resultado();
        $entity->setPartido($this->getReference('PARTIDOCOMPLETO'.$i));

        for ($j=1; $j <=3; $j++) {
            $resul1 = rand(1,6);
            if ($resul1 <= 4) {
                $resul2 = 6;
            } else if ($resul1 == 5) {
                $resul2 = 7;
            } else {
                $resul2 = rand(1,4);
            }
            switch ($j) {
                case 1:
                    $entity->setSet1p1($resul1);
                    $entity->setSet1p2($resul2);
                    break;
                case 2:
                    $entity->setSet2p1($resul1);
                    $entity->setSet2p2($resul2);
                    break;
                case 3:
                    $entity->setSet3p1($resul1);
                    $entity->setSet3p2($resul2);
                    break;
            }
        }

        return $entity;
    }

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        for ($i=1; $i <= 5; $i++) {
            $entity = $this->getData($i);
            $this->setReference("RESULTADO".$i, $entity);
            $manager->persist($entity);
        }

        $manager->flush();
    }
}
