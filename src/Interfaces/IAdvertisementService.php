<?php
namespace App\Interfaces;

use App\Entity\Advertisement;

/**
 * Created by Sami Belbacha
 */
interface IAdvertisementService
{
    public function findAdvertisement( int $id) : Advertisement;

    public function addAdvertisement( Advertisement $adver) : Advertisement;

    public function updateAdvertisement( Advertisement $adver) : Advertisement;

    public function deleteAdvertisement( int $id): bool ;

    public function getMyAdvertisements( int $userId,int $adverType): array;

    public function getAllAdvertisement(int $adverType): array;

}