<?php
/**
 * Created by PhpStorm.
 * User: sami
 * Date: 02/08/18
 * Time: 21:45
 */

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MainController extends AbstractController
{

    public function index()
    {
        return $this->render('main/index.html.twig');
    }
}