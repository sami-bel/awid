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

    public function howItWorks(Request $request)
    {
        return $this->render('informations/howItWorks.html.twig');
    }

    public function presentation(Request $request)
    {
        return $this->render('informations/presentation.html.twig');
    }

    public function cgu(Request $request)
    {
        return $this->render('informations/cgu.html.twig');
    }

}