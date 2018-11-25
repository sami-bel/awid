<?php
namespace App\Service;

use App\Entity\Message;

use App\Interfaces\IMessageService;
use App\Repository\MessageRepository;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Symfony\Component\Security\Core\Security;
use Twig\Template;

/**
 * Created by Sami Belbacha
 */
class MessageService implements IMessageService
{

    private $MessageRepository ;

    private $userService ;
    private $securityService ;
    private $mailer ;
    private $twigEngine ;

    /**
     * MessageService constructor.
     *
     * @param \App\Repository\MessageRepository $MessageRepository
     * @param UserService $userService
     * @param Security $securityService
     * @param \Swift_Mailer $mailer
     * @param EngineInterface $twigEngine
     */
    public function __construct( MessageRepository $MessageRepository, UserService $userService , Security $securityService,\Swift_Mailer $mailer, EngineInterface $twigEngine)
    {
        $this->MessageRepository = $MessageRepository ;
        $this->userService       = $userService;
        $this->securityService   = $securityService;
        $this->mailer            = $mailer;
        $this->twigEngine          = $twigEngine;
    }

    public function findMessage( int $id) : Message
    {
        return $this->MessageRepository->find($id);
    }

    public function addMessage( Message $message) : Message
    {
        return $this->MessageRepository->addMessage($message);
    }

    public function sendMessage($userId, string $content){
        $message = new Message();
        $toUser  = $this->userService->findUser($userId);
        $user    = $this->securityService->getToken()->getUser();


        if ($toUser == null)
        {
            //ToDo :
        }

        $message->setCreateAt(new \DateTime());
        $message->setFromUser($user);
        $message->setToUser($toUser);
        $message->setContent($content);

        $this->addMessage($message);


        // envoyer un mail à l utilisateur

        $messageMailer = (new \Swift_Message('Message JibColis'))
            ->setFrom('send@example.com')
            ->setTo($toUser->getEmail())
            ->setBody(
                $this->twigEngine->render(
                    'Message/email.html.twig',
                    array('name' => $user->getUsername(), 'content' => $message->getContent())
                ),
                'text/html'
            );

        $this->mailer->send($messageMailer);
    }
    public function deleteMessage( int $id)
    {
        $message = $this->MessageRepository->find($id);

        if ($message == null) {
            // TODO:
        }

        $message->setArchived(true);
        return $this->MessageRepository->updateMessage($message);
    }

    public function seeMessage( int $id)
    {
        $message = $this->MessageRepository->find($id);

        if ($message == null) {
            // TODO:
        }

        $message->setSeen(true);
        return $this->MessageRepository->updateMessage($message);
    }

    public function getSentMessages(int $usrId): array{

        $criteria['fromUser'] = $usrId;
        $criteria['archived'] = false;

        return $this->MessageRepository->findMessagesByCriteria($criteria);
    }

    public function getReceivedMessage(int $usrId): array{

        $criteria['toUser'] = $usrId;
        $criteria['archived'] = false;
        return $this->MessageRepository->findMessagesByCriteria($criteria);
    }

//$messages = $this->MessageRepository->findMessagesByCriteria($criteria);
//
//    // grouper les messages selon from user
//$messageFromUsers = [];
//$messagesOrdered   = [];
//$orderUser        = [];
//$i = 1;
//foreach ($messages as $message){
//
//if (! array_key_exists($message->getFromUser()->getId(), $orderUser)){
//$orderUser[$message->getFromUser()->getId()] = $i ;
//$i++;
//}
//$messageFromUsers[$message->getFromUser()->getId()][]= $message;
//
//
//}
//
//foreach ( $messageFromUsers as $key => $value){
//    $messagesOrdered[$orderUser[$key]] = $value;
//}


}