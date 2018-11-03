<?php
namespace App\Service;

use App\Entity\Message;

use App\Interfaces\IMessageService;
use App\Repository\MessageRepository;

/**
 * Created by Sami Belbacha
 */
class MessageService implements IMessageService
{

    private $MessageRepository ;


    /**
     * MessageService constructor.
     *
     * @param \App\Repository\MessageRepository $MessageRepository
     */
    public function __construct( MessageRepository $MessageRepository )
    {
        $this->MessageRepository = $MessageRepository ;
    }

    public function findMessage( int $id) : Message
    {
        return $this->MessageRepository->find($id);
    }

    public function addMessage( Message $message) : Message
    {
        return $this->MessageRepository->addMessage($message);
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