<?php
/**
* @author Jhon Mike Soares <https://github.com/jhonmike>
*/

namespace Zf2User\Entity;

use Doctrine\ORM\EntityRepository;

class UserRepository extends EntityRepository
{
	public function findByUsernameAndPassword($username = '', $password = '')
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
