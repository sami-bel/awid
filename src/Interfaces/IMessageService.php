<?php
namespace App\Interfaces;

use App\Entity\Message;

/**
 * Created by Sami Belbacha
 */
interface IMessageService
{
    public function findMessage( int $id) : Message;

    public function addMessage( Message $message) : Message;

    public function deleteMessage( int $id);

    public function seeMessage( int $id);
    public function sendMessage(int $id , string $content);

    public function getSentMessages(int $usrId): array;

    public function getReceivedMessage(int $usrId): array;

}