<?php
/**
 * Created by PhpStorm.
 * User: sami
 * Date: 02/08/18
 * Time: 21:45
 */

namespace App\Controller;


use App\Entity\Message;
use App\Form\MessageType;
use App\Interfaces\IMessageService;
use App\Interfaces\IUserService;
use App\Repository\UserRepository;
use App\Service\UserService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Validator\Constraints\DateTime;

class MessageController extends AbstractController
{

    /**
     * @var IMessageService
     */
    private $MessageService;
    /**
     * @var Security securityService
     */
    private $securityService;

    /**
     * @var IUserService userService
     */
    private $userService;

    /**
     * MessageController constructor.
     *
     * @param \App\Interfaces\IMessageService $MessageService
     * @param \Symfony\Component\Security\Core\Security $securityService
     * @param IUserService $userService
     */
    public function __construct(IMessageService $MessageService, Security $securityService,IUserService $userService)
    {
        $this->MessageService  = $MessageService;
        $this->userService     = $userService;
        $this->securityService = $securityService;
    }

    public function addMessage(Request $request, int $toUserId)
    {
        $message = new Message();
        $toUser  = $this->userService->findUser($toUserId);
        $user    = $this->securityService->getToken()->getUser();


        if ($toUser == null)
        {
            //ToDo :
        }

        $form    = $this->createForm(MessageType::class, $message);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $message->setCreateAt(new \DateTime());
            $message->setFromUser($user);
            $message->setToUser($toUser);


            $this->MessageService->addMessage($message);

            return $this->redirectToRoute('all_advertisements', array('adverType' => 1));
        }

        return $this->render('Message/messageForm.html.twig', ['form' => $form->createView()]);
    }


}