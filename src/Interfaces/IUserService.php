<?php
namespace App\Interfaces;

use App\Entity\Message;
use App\Entity\User;

/**
 * Created by Sami Belbacha
 */
interface IUserService
{
    public function findUser( int $id): User;

}