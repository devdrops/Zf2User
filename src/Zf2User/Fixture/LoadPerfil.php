<?php

namespace Zf2User\Fixture;

use Doctrine\Common\DataFixtures\AbstractFixture,
    Doctrine\Common\Persistence\ObjectManager;

use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

use Zf2User\Entity\Perfil;

class LoadPerfil extends AbstractFixture implements OrderedFixtureInterface
{

    public function load(ObjectManager $manager)
    {
        $admin = $manager->getReference('Zf2User\Entity\User',1);
        $boot1 = $manager->getReference('Zf2User\Entity\User',2);
        $boot2 = $manager->getReference('Zf2User\Entity\User',3);

        $perfil = new Perfil();
        $perfil->setUser($admin)
               ->setName("Developer")
               ->setDateBirth("14-05-1992");
        $manager->persist($perfil);

        $perfil = new Perfil();
        $perfil->setUser($boot1)
               ->setName("Boot 1")
               ->setDateBirth("14-05-1992");
        $manager->persist($perfil);

        $perfil = new Perfil();
        $perfil->setUser($boot2)
               ->setName("Boot 2")
               ->setDateBirth("14-05-1992");
        $manager->persist($perfil);

        $manager->flush();
    }

    public function getOrder() {
        return 8;
    }
}
