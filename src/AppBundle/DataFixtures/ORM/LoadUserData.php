<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use UserBundle\Entity\User;

/**
 * LoadUser.
 *
 * Carga en base de datos de usuarios
 *
 */
class LoadUserData extends AbstractFixture implements ContainerAwareInterface, OrderedFixtureInterface
{
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function getOrder()
    {
        return 0;
    }

    function __construct()
    {
        $this->faker = \Faker\Factory::create();
        $this->faker->addProvider(new \Faker\Provider\es_ES\PhoneNumber($this->faker));
        $this->faker->addProvider(new \Faker\Provider\es_ES\Person($this->faker));
        $this->faker->addProvider(new \Faker\Provider\es_ES\Address($this->faker));
        $this->faker->addProvider(new \Faker\Provider\Internet($this->faker));
    }

    private function addUsers()
    {
        for ($i=1; $i <= 20; $i++) {
            $userManager = $this->container->get('fos_user.user_manager');
            $entidad = $userManager->createUser();
            $entidad->setEnabled(true);
            $entidad->setUsername($this->faker->userName());
            $entidad->setEmail($this->faker->email());
            $entidad->setNombre($this->faker->firstName());
            $entidad->setApellidos($this->faker->lastName());
            $entidad->setTelefono($this->faker->randomNumber(9));
            $entidad->setPlainPassword('usuario');
            $entidad->setRoles(array('ROLE_USER'));
            $this->setReference("USER".$i, $entidad);
            $userManager->updateUser($entidad);
        }
    }

    private function addAdmin()
    {
        $userManager = $this->container->get('fos_user.user_manager');
        $entidad = $userManager->createUser();
        $entidad->setEnabled(true);
        $entidad->setUsername('admin');
        $entidad->setEmail('alvaro.galgal@gmail.com');
        $entidad->setNombre('Alvaro');
        $entidad->setApellidos('Galan');
        $entidad->setTelefono(666444777);
        $entidad->setPlainPassword('admin');
        $entidad->setRoles(array('ROLE_ADMIN'));
        $this->setReference("USER0", $entidad);
        $userManager->updateUser($entidad);
    }

    function load(ObjectManager $manager)
    {
        $this->addAdmin();
        $this->addUsers();
    }
}