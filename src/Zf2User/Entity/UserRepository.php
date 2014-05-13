<?php

namespace Zf2User\Entity;

use Doctrine\ORM\EntityRepository;

class UserRepository extends EntityRepository
{
	public function findByUserAndPassword($username = '', $password = '')
	{
		$user = $this->findOneByUsername($username);
		if ($user)
		{
			$hashPassword = $user->encryptPassword($password);
			if ($hashPassword == $user->getPassword())
				return $user;
			else
				return false;
		} else {
			return false;
		}
	}
}
