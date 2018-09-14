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
use Symfony\Component\Intl\Intl;
use Symfony\Component\Security\Core\Security;

class AdvertisementController extends AbstractController
{

    /**
     * @var IAdvertisementService
     */
    private $advertisementService;
    /**
     * @var Security securityService
     */
    private $securityService;

    /**
     * AdvertisementController constructor.
     *
     * @param \App\Interfaces\IAdvertisementService     $advertisementService
     * @param \Symfony\Component\Security\Core\Security $securityService
     */
    public function __construct(IAdvertisementService $advertisementService, Security $securityService)
    {
        $this->advertisementService = $advertisementService;
        $this->securityService      = $securityService;
    }

    public function addAdvertisement(Request $request, string $adeverType)
    {
        $adver = new Advertisement();
        $form  = $this->createForm(AdvertisementType::class, $adver);
        $user  = $this->securityService->getToken()->getUser();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            if ($adeverType == Advertisement::ADVERTISEMENT_SEND_TYPE) {
                $adver->setAdvertisementType(Advertisement::ADVERTISEMENT_SEND);
            } else if ($adeverType == Advertisement::ADVERTISEMENT_TAKE_TYPE) {
                $adver->setAdvertisementType(Advertisement::ADVERTISEMENT_TAKE);
            } else {
                return new Response('error');
            }

            $adver->setUser($user);


            $this->advertisementService->addAdvertisement($adver);

            return new Response('ok');
        }

        return $this->render('advertisement/advertisementForm.html.twig', ['form' => $form->createView()]);
    }

    public function showAdvertisement(Request $request, string $id){

        $adver = $this->advertisementService->findAdvertisement($id);
    }

    public function updateAdvertisement(Request $request, string $id)
    {
        $adver = $this->advertisementService->findAdvertisement($id);
        if ($adver == null) {
            // TODO:
        }
        $form = $this->createForm(AdvertisementType::class, $adver);
        $user = $this->securityService->getToken()->getUser();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->advertisementService->updateAdvertisement($adver);

            return new Response('ok');
        }

        return $this->render('advertisement/advertisementForm.html.twig', ['form' => $form->createView()]);
    }

    public function deleteAdvertisement(Request $request, string $id)
    {
        $this->advertisementService->deleteAdvertisement($id);
        return new Response('ok');

    }

    public function getMyAdvertisements(Request $request)
    {
        $user           = $this->securityService->getToken()->getUser();
        $advertisements = $this->advertisementService->getMyAdvertisements($user->getId());

        return $this->render('advertisement/advertisementList.html.twig', ['advertisements' => $advertisements]);


    }

    public function getAllAdvertisement(Request $request)
    {
        $user           = $this->securityService->getToken()->getUser();
        $advertisements = $this->advertisementService->getAllAdvertisement();

        return $this->render('advertisement/advertisementList.html.twig', ['advertisements' => $advertisements]);

    }

}