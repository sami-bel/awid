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
use Symfony\Component\Security\Csrf\CsrfTokenManagerInterface;

class SecurityController extends AbstractController
{

    private $tokenManager;

    public function __construct(CsrfTokenManagerInterface $tokenManager = null)
    {
        $this->tokenManager = $tokenManager;
    }
    /**
     * @param Request $request
     *
     * @return Response
     */
    public function csrfToken(Request $request)
    {

        $csrfToken = $this->tokenManager ? $this->tokenManager->getToken('authenticate')->getValue() : null;
        return $this->render('main/csrfToken.html.twig',["csrf_token" => $csrfToken]);
//        /** @var $session Session */
//        $session = $request->getSession();
//
//
//        $authErrorKey = Security::AUTHENTICATION_ERROR;
//        $lastUsernameKey = Security::LAST_USERNAME;
//
//        // get the error if any (works with forward and redirect -- see below)
//        if ($request->attributes->has($authErrorKey)) {
//            $error = $request->attributes->get($authErrorKey);
//        } elseif (null !== $session && $session->has($authErrorKey)) {
//            $error = $session->get($authErrorKey);
//            $session->remove($authErrorKey);
//        } else {
//            $error = null;
//        }
//
//        if (!$error instanceof AuthenticationException) {
//            $error = null; // The value does not come from the security component.
//        }
//
//        // last username entered by the user
//        $lastUsername = (null === $session) ? '' : $session->get($lastUsernameKey);
//
//        $csrfToken = $this->tokenManager
//            ? $this->tokenManager->getToken('authenticate')->getValue()
//            : null;
//
//        return $this->renderLogin(array(
//            'last_username' => $lastUsername,
//            'error' => $error,
//            'csrf_token' => $csrfToken,
//        ));
    }
}