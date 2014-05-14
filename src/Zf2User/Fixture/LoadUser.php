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
        $visit       = $manager->getReference('Zf2Acl\Entity\Role',1);
        $client      = $manager->getReference('Zf2Acl\Entity\Role',2);
        $functionary = $manager->getReference('Zf2Acl\Entity\Role',3);
        $admin       = $manager->getReference('Zf2Acl\Entity\Role',4);
        $developer   = $manager->getReference('Zf2Acl\Entity\Role',5);

        $user = new User();
        $user->setEmail("admin@admin.com.br")
             ->setUsername("admin")
             ->setPassword(123456)
             ->setPasswordClue('123456')
             ->setStatus(true)
             ->setRole($admin);
        $manager->persist($user);

        $user = new User();
        $user->setEmail("boot1@teste.com.br")
             ->setUsername("Boot1")
             ->setPassword(123456)
             ->setPasswordClue('123456')
             ->setStatus(true)
             ->setRole($functionary);
        $manager->persist($user);

        $user = new User();
        $user->setEmail("boot2@teste.com.br")
             ->setUsername("Boot2")
             ->setPassword(123456)
             ->setPasswordClue('123456')
             ->setStatus(true)
             ->setRole($functionary);
        $manager->persist($user);

        $manager->flush();
    }

    public function getOrder() {
        return 7;
    }
}
