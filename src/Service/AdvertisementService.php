<?php
namespace App\Service;

use App\Entity\Advertisement;
use App\Interfaces\IAdvertisementService;
use App\Repository\AdvertisementRepository;

/**
 * Created by Sami Belbacha
 */
class AdvertisementService implements IAdvertisementService
{

    private $advertisementRepository ;


    /**
     * AdvertisementService constructor.
     *
     * @param \App\Repository\AdvertisementRepository $advertisementRepository
     */
    public function __construct( AdvertisementRepository $advertisementRepository )
    {
        $this->advertisementRepository = $advertisementRepository ;
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

    public function deleteAdvertisement( int $id)
    {
        $adver = $this->advertisementRepository->find($id);

        if ($adver == null) {
            // TODO:
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
}