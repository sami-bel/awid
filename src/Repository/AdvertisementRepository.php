<?php

namespace App\Repository;

use App\Entity\Advertisement;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManager;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Advertisement|null find($id, $lockMode = null, $lockVersion = null)
 * @method Advertisement|null findOneBy(array $criteria, array $orderBy = null)
 * @method Advertisement[]    findAll()
 * @method Advertisement[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AdvertisementRepository extends ServiceEntityRepository
{
    /**
     * @var EntityManager
     */
    private $em ;

    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Advertisement::class);
        $this->em = $this->getEntityManager();

    }

    public function addAdvertisement(Advertisement $adver) : Advertisement
    {
        $this->em->persist($adver);
        $this->em->flush();
        return $adver;
    }

    public function updateAdvertisement(Advertisement $adver) : Advertisement
    {
        $this->em->persist($adver);
        $this->em->flush();
        return $adver;
    }

    public function deleteAdvertisement(Advertisement $adver)
    {
        $this->em->remove($adver);
        $this->em->flush();
    }

    public function findAdvertisement( int $id): Advertisement
    {
        return $this->em->find(Advertisement::class,$id);
    }

    public function findMyAdvertisements( int $userId): array
    {
        return $this->em->getRepository(Advertisement::class)->findBy(['user' => $userId]);
    }

    public function findAllAdvertisements(): array
    {
        return $this->em->getRepository(Advertisement::class)->findAll();
    }




//    /**
//     * @return Advertisement[] Returns an array of Advertisement objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Advertisement
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
