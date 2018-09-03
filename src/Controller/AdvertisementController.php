<?php
/**
 * Created by PhpStorm.
 * User: sami
 * Date: 02/08/18
 * Time: 21:45
 */

namespace App\Controller;


use App\Entity\Advertisement;
use App\Form\AdvertisementType;
use App\Service\AdvertisementService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class AdvertisementController extends AbstractController
{

    /**
     * @var AdvertisementService
     */
    private $advertisementService;
    /**
     * AdvertisementController constructor.
     */
    public function __construct()
    {
//        $this->advertisementService = $this->get('')
    }

    public function addAdvertisement(Request $request)
    {
        $adver = new Advertisement();
        $form = $this->createForm(AdvertisementType::class,$adver);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

        }
        return $this->render('advertisement/advertisementForm.html.twig',['form' => $form->createView()]);

    }
}