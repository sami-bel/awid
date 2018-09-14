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

    public function addAdvertisement(Request $request, string $adverType)
    {
        $adver = new Advertisement();
        $form  = $this->createForm(AdvertisementType::class, $adver);
        $user  = $this->securityService->getToken()->getUser();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            if ($adverType == Advertisement::ADVERTISEMENT_SEND ||$adverType == Advertisement::ADVERTISEMENT_TAKE) {

                $adver->setAdvertisementType($adverType);
            }
            else
            {
                return new Response('error');
            }

            $adver->setUser($user);


            $this->advertisementService->addAdvertisement($adver);

            return $this->redirectToRoute('my_advertisements', array('adverType' => $adverType));
        }

        if( $adverType == Advertisement::ADVERTISEMENT_SEND_TYPE  ){

            $adverTitle = "Ajouter un Coli";
        }else {
            $adverTitle  = "Ajouter un Trajet";
        }

        return $this->render('advertisement/advertisementForm.html.twig',
            [
                'form'       => $form->createView(),
                'adverTitle' => $adverTitle,
            ]);
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

    public function getMyAdvertisements(Request $request, int $adverType)
    {
        $user           = $this->securityService->getToken()->getUser();
        $advertisements = $this->advertisementService->getMyAdvertisements($user->getId(),$adverType);

        if( $adverType == Advertisement::ADVERTISEMENT_SEND  ){

            $adverTitle = "Mes Colis";
        }else {
            $adverTitle  = "Mes Trajets";
        }

        return $this->render('advertisement/advertisementList.html.twig',
            [
                'advertisements' => $advertisements,
                'adverTitle'     => $adverTitle,
            ]
        );


    }

    public function getAllAdvertisement(Request $request, int $adverType)
    {
        $user           = $this->securityService->getToken()->getUser();
        $advertisements = $this->advertisementService->getAllAdvertisement($adverType);

        if( $adverType == Advertisement::ADVERTISEMENT_SEND  ){

            $adverTitle = "Colis";
        }else {
            $adverTitle  = "Trajets";
        }

        return $this->render('advertisement/advertisementList.html.twig', [
            'advertisements' => $advertisements,
            'adverTitle'     => $adverTitle,
        ]
        );

    }

}