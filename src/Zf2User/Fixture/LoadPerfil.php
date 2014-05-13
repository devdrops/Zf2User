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
        $userDeve = $manager->getReference('Zf2User\Entity\User',1);
        $userAdmin = $manager->getReference('Zf2User\Entity\User',2);

        $guarapuava = $manager->getReference('Zf2Base\Entity\Cidade',6025);

        $perfil = new Perfil();
        $perfil->setCidade($guarapuava)
               ->setUser($userDeve)
               ->setName("Developer")
               ->setCpfCnpj(NULL)
               ->setDateBirth("14-05-1992")
               ->setPerson(1);
        $manager->persist($perfil);

        $perfil = new Perfil();
        $perfil->setCidade($guarapuava)
               ->setUser($userAdmin)
               ->setName("Administrador")
               ->setCpfCnpj('67.270.866/0001-93')
               ->setDateBirth("14-05-1992")
               ->setPerson(2);
        $manager->persist($perfil);

        $manager->flush();
    }

    public function getOrder() {
        return 8;
    }
}
