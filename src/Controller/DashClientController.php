<?php

namespace App\Controller;

use App\Entity\StoreName;
use App\Form\StoreNameType;
use App\Repository\StoreNameRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashClientController extends AbstractController
{
    /**
     * @Route("/Client", name="app_dash_client")
     */
    public function index(StoreNameRepository $storeNameRepository): Response
    {
        return $this->render('dash_client/index.html.twig', [
            'store_names' => $storeNameRepository->findAll(),
        ]);
    }
}
