<?php
/**
 * Created by Sami Belbacha
 */

namespace App\Entity;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * User
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */

class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /** @ORM\Column(type="string") */
    private $tel;

    public function __construct()
    {
        parent::__construct();

    }


    /**
     * @return mixed
     */
    public function getTel()
    {
        return $this->tel;
    }


    /**
     * @param mixed $tel
     *
     * @return User
     */
    public function setTel($tel)
    {
        $this->tel = $tel;

        return $this;
    }


}