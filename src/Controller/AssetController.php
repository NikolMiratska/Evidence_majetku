<?php

namespace App\Controller;

use App\Entity\AssetsManager;
use App\Form\AssetFormType;
use App\Repository\AssetsManagerRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use function Symfony\Component\String\u;

class AssetController extends AbstractController
{
    private $em;
    private $assetsManagerRepository;
    private $userRepository;
    public function __construct(AssetsManagerRepository $assetsManagerRepository, EntityManagerInterface $em, UserRepository $userRepository)
    {
        $this->assetsManagerRepository = $assetsManagerRepository;
        $this->em = $em;
        $this->userRepository = $userRepository;
    }
    #[Route('/')]
    public function homepage(Request $request, EntityManagerInterface $em, PaginatorInterface $paginator): Response
    {
        $users = $this->userRepository->findAll();

        $dql   = "SELECT a FROM App\Entity\AssetsManager a";
        $query = $em->createQuery($dql);

        $pagination = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1), /*page number*/
            10 /*limit per page*/
        );

        return $this->render('Assets/homepage.html.twig',
            [
                'users' => $users,
                'assets' => $pagination,
            ]);
    }

    #[Route('/create', name: 'create_asset')]
    public function create(Request $request): Response
    {
        $asset =  new AssetsManager();
        $form = $this->createForm(AssetFormType::class, $asset);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $newAsset = $form->getData();

            $documentPath = $form->get('documentPath')->getData();
            if($documentPath){
                $newFileName = uniqid() . '.' . $documentPath->guessExtension();

                try {
                    $documentPath->move(
                        $this->getParameter('kernel.project_dir') . '/public/uploads',
                        $newFileName
                    );
                } catch (FileException $e) {
                    return new Response($e->getMessage());
                }

                $newAsset->setDocumentPath('/uploads/' . $newFileName);
            }

            $this->em->persist($newAsset);
            $this->em->flush();

            return $this->redirectToRoute('list');
        }

        return $this->render('Assets/create.html.twig', [
            'form' => $form->createView()
        ]);

    }

    #[Route('/list', name: 'list')]
    public function assetList(Request $request, EntityManagerInterface $em, PaginatorInterface $paginator): Response
    {
        $dql   = "SELECT a FROM App\Entity\AssetsManager a";
        $query = $em->createQuery($dql);

        $pagination = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1), /*page number*/
            10 /*limit per page*/
        );

        return $this->render('Assets/asssetList.html.twig',
            [
                'assets' => $pagination
            ]);
    }

    #[Route('/details/{id}', name: 'detail_asset')]
    public function assetDetail($id, Request $request): Response
    {
        $assets = $this->assetsManagerRepository->find($id);

        return $this->render('Assets/details.html.twig',
            [
                'assets' => $assets
            ]);
    }

    #[Route('/edit/{id}', name: 'edit_asset')]
    public function edit($id, Request $request): Response
    {
        $assets = $this->assetsManagerRepository->find($id);
        $form = $this->createForm(AssetFormType::class, $assets);

        $form->handleRequest($request);
        $documentPath = $form->get('documentPath')->getData();

        if ($form->isSubmitted() && $form->isValid()){
            if ($documentPath){
                if ($assets->getDocumentPath() !== null) {
                    if (file_exists(
                        $this->getParameter('kernel.project_dir') . $assets->getDocumentPath()
                    )) {
                        $this->getParameter('kernel.project_dir') . $assets->getDocumentPath();

                        $newFileName = uniqid() . '.' . $documentPath->guessExtension();

                        try {
                            $documentPath->move(
                                $this->getParameter('kernel.project_dir') . '/public/uploads',
                                $newFileName
                            );
                        } catch (FileException $e) {
                            return new Response($e->getMessage());
                        }

                        $assets->setDocumentPath('/uploads/' . $newFileName);
                        $this->em->flush();
                        return $this->redirectToRoute('list');
                    }
                }
            } else {
                $assets->setName($form->get('name')->getData());
                $assets->setInventoryNumber($form->get('inventoryNumber')->getData());
                $assets->setDescription($form->get('description')->getData());
                $assets->setUnitPrice($form->get('unitPrice')->getData());
                $assets->setSupplier($form->get('supplier')->getData());
                $assets->setManufacturer($form->get('manufacturer')->getData());
                $assets->setGuaranteePeriod($form->get('guaranteePeriod')->getData());
                $assets->setAssetType($form->get('assetType')->getData());
                $assets->setSubsumptionDate($form->get('subsumptionDate')->getData());
                $assets->setEliminationDate($form->get('eliminationDate')->getData());
                $assets->setAssetLocation($form->get('assetLocation')->getData());
                $assets->setAssignedPerson($form->get('assignedPerson')->getData());
                $assets->setManufacturingNumber($form->get('manufacturingNumber')->getData());
                $assets->setDateCreated($form->get('dateCreated')->getData());
                $assets->setNote($form->get('note')->getData());
//                $assets->setDocumentPath($form->get('documentPath')->getData());

                $this->em->flush();
                return $this->redirectToRoute('list');
            }
        }

        return $this->render('Assets/edit.html.twig', [
           'assets' => $assets,
           'form' => $form->createView()
        ]);
    }

    #[Route('/delete/{id}', methods: ['GET', 'DELETE'], name: 'delete_asset')]
    public function delete($id){
        $assets = $this->assetsManagerRepository->find($id);
        $this->em->remove($assets);
        $this->em->flush();

        return $this->redirectToRoute('list');
    }

    #[Route('/users')]
    public function usersList(): Response
    {
        $users = $this->userRepository->findAll();

        return $this->render('Assets/usersList.html.twig',
            [
                'users' => $users
            ]);
    }

}