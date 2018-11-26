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
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\File\MimeType\FileinfoMimeTypeGuesser;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
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
                'adverType'  => $adverType
            ]);
    }

    public function showAdvertisement(Request $request, string $id){

        $adver = $this->advertisementService->findAdvertisement($id);
        return $this->render('advertisement/advertisementDetail.html.twig',['adver' =>$adver]);


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

        if( $adver->getAdvertisementType() == Advertisement::ADVERTISEMENT_SEND_TYPE  ){

            $adverTitle = "Modifier un Coli";
        }else {
            $adverTitle  = "Modifier un Trajet";
        }

        return $this->render('advertisement/advertisementForm.html.twig', ['form' => $form->createView(), 'adverTitle' => $adverTitle,]);
    }

    public function deleteAdvertisement(Request $request, int $id)
    {
        $response = $this->advertisementService->deleteAdvertisement($id);
        return new JsonResponse(["status"=>$response]);
    }

    public function getMyAdvertisements(Request $request, int $adverType)
    {
        $user           = $this->securityService->getToken()->getUser();
        $advertisements = $this->advertisementService->getMyAdvertisements($user->getId(),$adverType);

        if( $adverType == Advertisement::ADVERTISEMENT_SEND  ){

            $adverTitle = "Mes Colis";
            $isSend     = true;
        }else {
            $adverTitle  = "Mes Trajets";
            $isSend      = false;
        }

        return $this->render('advertisement/advertisementList.html.twig',
            [
                'advertisements' => $advertisements,
                'adverTitle'     => $adverTitle,
                'myAdver'        => true,
                'isSend'         => $isSend

            ]
        );


    }

    public function getAllAdvertisement(Request $request, int $adverType)
    {
        $user           = $this->securityService->getToken()->getUser();
        $advertisements = $this->advertisementService->getAllAdvertisement($adverType);

        if( $adverType == Advertisement::ADVERTISEMENT_SEND  ){

            $adverTitle = "Colis";
            $isSend      = true;
        }else {
            $adverTitle  = "Trajets";
            $isSend      = false;
        }

        return $this->render('advertisement/advertisementList.html.twig', [
            'advertisements' => $advertisements,
            'adverTitle'     => $adverTitle,
            'myAdver'        => false,
            'isSend'         => $isSend

            ]
        );

    }
    public function downloadDeclarationConfidence()
    {
        $pdfPath = $this->getParameter('kernel.project_dir') . '/public/doc/DECLARATION-DE-CONFIANCE.pdf';

        $response = new BinaryFileResponse($pdfPath);

        // To generate a file download, you need the mimetype of the file
        $mimeTypeGuesser = new FileinfoMimeTypeGuesser();

        // Set the mimetype with the guesser or manually
        if($mimeTypeGuesser->isSupported()){
            // Guess the mimetype of the file according to the extension of the file
            $response->headers->set('Content-Type', $mimeTypeGuesser->guess($pdfPath));
        }else{
            // Set the mimetype of the file manually, in this case for a text file is text/plain
            $response->headers->set('Content-Type', 'text/plain');
        }

        // Set content disposition inline of the file
        $response->setContentDisposition(
            ResponseHeaderBag::DISPOSITION_ATTACHMENT,
            "DECLARATION-DE-CONFIANCE.pdf"
        );

        return $response;
    }

}