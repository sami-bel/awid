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


    public function addAdvertisement( Advertisement $adver)
    {

    }
}