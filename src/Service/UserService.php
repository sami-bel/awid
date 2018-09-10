<?php
namespace App\Service;

use App\Entity\User;

use App\Interfaces\IUserService;
use App\Repository\UserRepository;

/**
 * Created by Sami Belbacha
 */
class UserService implements IUserService
{

    /**
     * @var UserRepository $userRepository
     */
    private $userRepository ;


    /**
     * UserService constructor.
     *
     * @param \App\Repository\UserRepository $userRepository
     */
    public function __construct( UserRepository $userRepository )
    {
        $this->userRepository = $userRepository ;
    }

    public function findUser( int $id) : User
    {
        return $this->userRepository->find($id);
    }


}