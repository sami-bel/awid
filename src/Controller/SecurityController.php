<?php
/**
 * Created by PhpStorm.
 * User: sami
 * Date: 02/08/18
 * Time: 21:45
 */

namespace App\Controller;


use App\Entity\User;
use App\Form\RegistrationType;
use FOS\UserBundle\Event\FilterUserResponseEvent;
use FOS\UserBundle\Event\GetResponseUserEvent;

use FOS\UserBundle\FOSUserEvents;
use FOS\UserBundle\Model\UserManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use FOS\UserBundle\Event\FormEvent;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Csrf\CsrfTokenManagerInterface;

class SecurityController extends AbstractController
{

    private $tokenManager;
    private $userManager;
    private $eventDispatcher;
    private $tokenStorage;

    public function __construct( EventDispatcherInterface $eventDispatcher,TokenStorageInterface $tokenStorage, CsrfTokenManagerInterface $tokenManager = null, UserManagerInterface $userManager)
    {
        $this->tokenManager = $tokenManager;
        $this->userManager = $userManager;
        $this->eventDispatcher = $eventDispatcher;
        $this->userManager = $userManager;
        $this->tokenStorage = $tokenStorage;
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
    }

    public function getRegisterModel(){

        $user = new User();
        $form = $this->createForm(RegistrationType::class, $user);

        return $this->render("main/modalRegister.html.twig", ["form" => $form->createView()]);

    }
    public function register(Request $request)
    {
        $user = $this->userManager->createUser();
        $user->setEnabled(true);

        $event = new GetResponseUserEvent($user, $request);
        $this->eventDispatcher->dispatch(FOSUserEvents::REGISTRATION_INITIALIZE, $event);


        if (null !== $event->getResponse()) {
            return $event->getResponse();
        }

        $form = $this->createForm(RegistrationType::class, $user);
        $form->setData($user);

        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                $event = new FormEvent($form, $request);
                $this->eventDispatcher->dispatch(FOSUserEvents::REGISTRATION_SUCCESS, $event);

                $this->userManager->updateUser($user);

                if (null === $response = $event->getResponse()) {
                    $url = $this->generateUrl('fos_user_registration_confirmed');
                    $response = new RedirectResponse($url);
                }

                $this->eventDispatcher->dispatch(FOSUserEvents::REGISTRATION_COMPLETED, new FilterUserResponseEvent($user, $request, $response));

                return $response;
            }

            $event = new FormEvent($form, $request);
            $this->eventDispatcher->dispatch(FOSUserEvents::REGISTRATION_FAILURE, $event);

            if (null !== $response = $event->getResponse()) {
                return $response;
            }
        }

        return $this->render('@FOSUser/Registration/register.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    public function confirmed(){

        return $this->redirectToRoute('index');
    }

    public function login(Request $request)
    {
        /** @var $session Session */
        $session = $request->getSession();

        $authErrorKey = Security::AUTHENTICATION_ERROR;
        $lastUsernameKey = Security::LAST_USERNAME;

        // get the error if any (works with forward and redirect -- see below)
        if ($request->attributes->has($authErrorKey)) {
            $error = $request->attributes->get($authErrorKey);
        } elseif (null !== $session && $session->has($authErrorKey)) {
            $error = $session->get($authErrorKey);
            $session->remove($authErrorKey);
        } else {
            $error = null;
        }

        // return un json Response au client
        if($error){

            return new JsonResponse(["error" => $error->getMessage()]);
        }

        if (!$error instanceof AuthenticationException) {
            $error = null; // The value does not come from the security component.
        }

        // last username entered by the user
        $lastUsername = (null === $session) ? '' : $session->get($lastUsernameKey);

        $csrfToken = $this->tokenManager
            ? $this->tokenManager->getToken('authenticate')->getValue()
            : null;

        return $this->renderLogin(array(
            'last_username' => $lastUsername,
            'error' => $error,
            'csrf_token' => $csrfToken,
        ));
    }

}