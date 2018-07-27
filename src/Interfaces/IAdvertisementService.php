<?php
namespace App\Interfaces;

use App\Entity\Advertisement;

/**
 * Created by Sami Belbacha
 */
interface IAdvertisementService
{
    public function addAdvertisement( Advertisement $adver);
}