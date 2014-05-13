<?php

namespace Zf2User\Fixture;

use Doctrine\Common\DataFixtures\AbstractFixture,
    Doctrine\Common\Persistence\ObjectManager;

use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

use Zf2User\Entity\User;

class LoadUser extends AbstractFixture implements OrderedFixtureInterface
{

    public function load(ObjectManager $manager)
    {
        $visitante   = $manager->getReference('DftAcl\Entity\Role',1);
        $cliente     = $manager->getReference('DftAcl\Entity\Role',2);
        $funcionario = $manager->getReference('DftAcl\Entity\Role',3);
        $admin       = $manager->getReference('DftAcl\Entity\Role',4);
        $developer   = $manager->getReference('DftAcl\Entity\Role',5);

        $user = new User();
        $user->setEmail("teste@k13.com.br")
             ->setUsername("developer")
             ->setPassword(123456)
             ->setPasswordClue('123456')
             ->setStatus(true)
             ->setRole($developer)
             ->setBusiness(NULL);
        $manager->persist($user);

        $empresa = $manager->getReference('DftBusiness\Entity\Business',1);

        $user = new User();
        $user->setEmail("admistrador@k13.com.br")
             ->setUsername("administrador")
             ->setPassword(123456)
             ->setPasswordClue('123456')
             ->setStatus(true)
             ->setRole($admin)
             ->setBusiness($empresa);
        $manager->persist($user);

        $manager->flush();
    }

    public function getOrder() {
        return 7;
    }
}
