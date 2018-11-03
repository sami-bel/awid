<?php

namespace App\Repository;

use App\Entity\Message;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManager;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Message|null find($id, $lockMode = null, $lockVersion = null)
 * @method Message|null findOneBy(array $criteria, array $orderBy = null)
 * @method Message[]    findAll()
 * @method Message[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MessageRepository extends ServiceEntityRepository
{
    /**
     * @var EntityManager
     */
    private $em ;

    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Message::class);
        $this->em = $this->getEntityManager();

    }

    public function addMessage(Message $message) : Message
    {
        $this->em->persist($message);
        $this->em->flush();
        return $message;
    }

    public function updateMessage(Message $message) : Message
    {
        $this->em->persist($message);
        $this->em->flush();
        return $message;
    }

    public function findMessage(int $id): Message
    {
        return $this->em->find(Message::class,$id);
    }

    public function findMessagesByCriteria(array $criteria): array
    {

        return $this->em->getRepository(Message::class)->findBy($criteria, array('createAt' => 'DESC'));
    }

}
