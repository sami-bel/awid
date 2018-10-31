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
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Intl\Intl;
use Symfony\Component\Security\Core\Security;

class DashboardController extends AbstractController
{


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
        $this->securityService      = $securityService;
    }

    public function index(Request $request)
    {
        return $this->render('dashboard/dashboardIndex.html.twig');
    }

}