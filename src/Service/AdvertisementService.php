<?php
namespace App\Service;

use App\Entity\Advertisement;
use App\Interfaces\IAdvertisementService;
use App\Repository\AdvertisementRepository;
use Symfony\Component\Security\Core\Security;

/**
 * Created by Sami Belbacha
 */
class AdvertisementService implements IAdvertisementService
{

    private $advertisementRepository ;

    /**
     * @var Security securityService
     */
    private $securityService;


    /**
     * AdvertisementService constructor.
     *
     * @param \App\Repository\AdvertisementRepository   $advertisementRepository
     * @param \Symfony\Component\Security\Core\Security $securityService
     */
    public function __construct( AdvertisementRepository $advertisementRepository, Security $securityService )
    {
        $this->advertisementRepository = $advertisementRepository ;
        $this->securityService         = $securityService;
    }

    public function findAdvertisement( int $id) : Advertisement
    {
        return $this->advertisementRepository->find($id);
    }

    public function addAdvertisement( Advertisement $adver) : Advertisement
    {
        return $this->advertisementRepository->addAdvertisement($adver);
    }

    public function updateAdvertisement( Advertisement $adver) : Advertisement
    {
        return $this->advertisementRepository->updateAdvertisement($adver);
    }

    public function deleteAdvertisement( int $id) : bool
    {
        $adver = $this->advertisementRepository->find($id);

        if ($this->isMyAdver($adver) == false){

            return false;
        }
        if ($adver == null) {
            return false;
        }
        return $this->advertisementRepository->deleteAdvertisement($adver);
    }

    public function getMyAdvertisements( int $userId, int $adverType): array
    {

        return $this->advertisementRepository->findMyAdvertisements($userId, $adverType);
    }

    public function getAllAdvertisement(int $adverType): array
    {

        return $this->advertisementRepository->findAllAdvertisements($adverType);
    }

    public function isMyAdver(Advertisement $adver): bool
    {
        $user = $this->securityService->getToken()->getUser();

        if($adver->getUser()->getId() != $user->getId()){

            return false;
        }
        return true;
    }
}