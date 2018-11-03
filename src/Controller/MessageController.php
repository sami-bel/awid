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

        $content = $request->get('messageContent');

        if ($toUser == null)
        {
            //ToDo :
        }

        $message->setCreateAt(new \DateTime());
        $message->setFromUser($user);
        $message->setToUser($toUser);
        $message->setContent($content);

        $this->MessageService->addMessage($message);

        return $this->redirectToRoute('messages_box');

    }

    public function getMessagesBox(Request $request)
    {
        $user      = $this->securityService->getToken()->getUser();
        $messages  = $this->MessageService->getReceivedMessage($user->getId());
        return $this->render('Message/messagesBox.html.twig',["messages" => $messages, "send" => false]);

    }


    public function getReceivedMessage(Request $request)
    {
        $user      = $this->securityService->getToken()->getUser();
        $messages  = $this->MessageService->getReceivedMessage($user->getId());
        return $this->render('Message/messagesList.html.twig',["messages" => $messages ,"send" =>false]);

    }


    public function getSentMessage(Request $request)
    {
        $user      = $this->securityService->getToken()->getUser();
        $messages  = $this->MessageService->getSentMessages($user->getId());
        return $this->render('Message/messagesList.html.twig',["messages" => $messages, "send" =>true]);

    }

    public function showMessage(Request $request, int $messageId)
    {
        $user    = $this->securityService->getToken()->getUser();
        $message = $this->MessageService->findMessage($messageId);
        $replay  = true;



        if ($message->getFromUser()->getId() == $user->getId()){
            $replay = false;
            $username = $message->getToUser()->getUsername();
        }else{
            $username = $message->getFromUser()->getUsername();
        }

        return $this->render('Message/showMessage.html.twig',['message' => $message, "replay" => $replay, "username" => $username]);

    }


}