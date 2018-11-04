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
use Symfony\Component\HttpFoundation\Response;

class MainController extends AbstractController
{

    public function index()
    {
        return $this->render('main/index.html.twig');
    }

    public function hello(\Swift_Mailer $mailer){

        $messageMaler = (new \Swift_Message('Hello Email'))
            ->setFrom('send@example.com')
            ->setTo('belbacha.sami@gmail.com')
            ->setBody(
                $this->renderView(
                // templates/emails/registration.html.twig
                    'Message/email.html.twig',
                    array('name' => "sami")
                ),
                'text/html'
            );

        $mailer->send($messageMaler);

        return new Response('ok');
    }

}