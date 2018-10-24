<?php
/**
 * Created by PhpStorm.
 * User: sami
 * Date: 02/08/18
 * Time: 21:45
 */

namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;


class InformationController extends AbstractController
{

    public function whoAreWe(Request $request)
    {
        return $this->render('informations/whoAreWe.html.twig');
    }


    public function objective(Request $request)
    {
        return $this->render('informations/objective.html.twig');
    }

}