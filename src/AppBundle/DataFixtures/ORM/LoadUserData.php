<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

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

    function load(ObjectManager $manager)
    {
        // USUARIOS
        $userManager = $this->container->get('fos_user.user_manager');

        $entidad = $userManager->createUser();
        $entidad->setEnabled(true);
        $entidad->setUsername('admin');
        $entidad->setEmail('alvaro.galgal@gmail.com');
        $entidad->setNombre('Alvaro');
        $entidad->setApellidos('Galan');
        $entidad->setTelefono(666666666);
        $entidad->setPlainPassword('admin');
        $entidad->setRoles(array('ROLE_ADMIN'));
        $this->setReference('Admin', $entidad);
        $userManager->updateUser($entidad);
    }
}