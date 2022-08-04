<?php

namespace App\Controller;

use App\Entity\StoreName;
use App\Form\StoreNameType;
use App\Repository\StoreNameRepository;
use App\Repository\ProduitsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/store/name",requirements={"id":"\d+"})
 */
class StoreNameController extends AbstractController
{
    /**
     * @Route("/", name="app_store_name_index", methods={"GET"})
     */
    public function index(StoreNameRepository $storeNameRepository): Response
    {
        return $this->render('store_name/index.html.twig', [
            'store_names' => $storeNameRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_store_name_new", methods={"GET", "POST"})
     */
    public function new(Request $request, StoreNameRepository $storeNameRepository): Response
    {
        $storeName = new StoreName();
        $form = $this->createForm(StoreNameType::class, $storeName);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $storeNameRepository->add($storeName, true);

            return $this->redirectToRoute('app_store_name_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('store_name/new.html.twig', [
            'store_name' => $storeName,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{name}/", name="app_store_name_show", methods={"GET"}, requirements={"id":"\d+"})
     */
    public function show(StoreName $storeName, StoreNameRepository $storeRepository, ProduitsRepository $produitsRepository): Response
    {
        return $this->render('store_name/show.html.twig', [
            'store_name' => $storeName,
            'produit' =>  $storeName->getProducts(),
            'produits' => $produitsRepository->findAll(),
            'stores' => $storeRepository->findAll(),
        ]);
    }





    /**
     * @Route("/{id}/edit", name="app_store_name_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, StoreName $storeName, StoreNameRepository $storeNameRepository): Response
    {
        $form = $this->createForm(StoreNameType::class, $storeName);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $storeNameRepository->add($storeName, true);

            return $this->redirectToRoute('app_store_name_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('store_name/edit.html.twig', [
            'store_name' => $storeName,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_store_name_delete", methods={"POST"})
     */
    public function delete(Request $request, StoreName $storeName, StoreNameRepository $storeNameRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $storeName->getId(), $request->request->get('_token'))) {
            $storeNameRepository->remove($storeName, true);
        }

        return $this->redirectToRoute('app_store_name_index', [], Response::HTTP_SEE_OTHER);
    }
}
