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
use App\Interfaces\IAdvertisementService;
use App\Service\AdvertisementService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Security;

class AdvertisementController extends AbstractController
{

    /**
     * @var AdvertisementService
     */
    private $advertisementService;
    /**
     * @var Security securitySerivce
     */
    private $securitySerivce;


    /**
     * AdvertisementController constructor.
     *
     * @param \App\Interfaces\IAdvertisementService     $advertisementService
     * @param \Symfony\Component\Security\Core\Security $securityService
     */
    public function __construct(IAdvertisementService $advertisementService, Security $securityService )
    {
        $this->advertisementService = $advertisementService;
        $this->securitySerivce      = $securityService;
    }

    public function addSendingAdvertisement(Request $request)
    {
        $adver = new Advertisement();
        $form  = $this->createForm(AdvertisementType::class,$adver);
        $user  = $this->securitySerivce->getToken()->getUser();

        $form->handleRequest($request);

//        dump($form->getData());
//        die;

        if ($form->isSubmitted() && $form->isValid()) {

            $adver->setAdvertisementType(Advertisement::ADVERTISEMENT_SEND);
            $adver->setUser($user);


            $this->advertisementService->addAdvertisement($adver);
            return new Response('ok');
        }
        return $this->render('advertisement/advertisementForm.html.twig',['form' => $form->createView()]);
    }

    public function addTakingAdvertisement(Request $request)
    {
        $adver = new Advertisement();
        $form  = $this->createForm(AdvertisementType::class,$adver);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $adver->setAdvertisementType(Advertisement::ADVERTISEMENT_TAKE);
        }
        return $this->render('advertisement/advertisementForm.html.twig',['form' => $form->createView()]);
    }
}