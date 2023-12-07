<?php

namespace App\Controller;

use App\Entity\AssetsManager;
use App\Entity\User;
use App\Form\AssetFormType;
use App\Form\EditUserFormType;
use App\Repository\AssetsManagerRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
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
            $newOwner = $form->getData();

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

            if ($asset->getOwnedBy() !== null){
                $selectedOwner = $asset->getOwnedBy()->getName();
            } else {
                $newOwnerName = $form->get('newOwner')->getData();

                $newOwner = new User();
                $newOwner->setName($newOwnerName);
//
//                $this->em->persist($newOwner);
//                $this->em->flush();

                $selectedOwner = $newOwner;
            }

//            $this->em->persist($newAsset->getOwnedBy());
            $this->em->persist($newAsset);
            $this->em->persist($newOwner);
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
            50 /*limit per page*/
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
        $assets->getStringRepresentation1();
        $assets->getStringRepresentation2();

        return $this->render('Assets/details.html.twig',
            [
                'assets' => $assets
            ]);
    }
    #[Route('/userDetails/{id}', name: 'detail_user')]
    public function userDetail($id, Request $request): Response
    {
        $users = $this->userRepository->find($id);

        return $this->render('Assets/userDetails.html.twig',
            [
                'users' => $users
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
//            if ($documentPath){
//                $documentPaths = $form->get('documentPaths')->getData();
//
//                foreach ($documentPaths as $documentPath) {
//                    // Handle each uploaded file
//                    if ($documentPath instanceof UploadedFile) {
//                        $newFileName = uniqid() . '.' . $documentPath->guessExtension();
//
//                        try {
//                            $documentPath->move(
//                                $this->getParameter('kernel.project_dir') . '/public/uploads',
//                                $newFileName
//                            );
//                        } catch (FileException $e) {
//                            return new Response($e->getMessage());
//                        }
//
//                        $assets->setDocumentPath('/uploads/' . $newFileName);
//                        $this->em->flush();
//                        return $this->redirectToRoute('list');
//                    }
//                }
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
                $assets->setAssignedPerson($form->get('newOwner')->getData());
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

    #[Route('/deleteUser/{id}', methods: ['GET', 'DELETE'], name: 'delete_user')]
    public function deleteUser($id){
        $users = $this->userRepository->find($id);
        $this->em->remove($users);
        $this->em->flush();

        return $this->redirectToRoute('user');
    }

    #[Route('/users', name: 'user')]
    public function usersList(Request $request, EntityManagerInterface $em, PaginatorInterface $paginator): Response
    {
        $dql   = "SELECT a FROM App\Entity\User a";
        $query = $em->createQuery($dql);

        $pagination = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1), /*page number*/
            50 /*limit per page*/
        );

        return $this->render('Assets/usersList.html.twig',
            [
                'users' => $pagination
            ]);
    }

    #[Route('/editUser/{id}', name: 'edit_user')]
    public function editUser($id, Request $request): Response
    {
        $users = $this->userRepository->find($id);
        $form = $this->createForm(EditUserFormType::class, $users);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){

                $users->setName($form->get('name')->getData());
                $users->setEmail($form->get('email')->getData());


                $this->em->flush();
                return $this->redirectToRoute('user');
            }

        return $this->render('Assets/editUser.html.twig', [
            'users' => $users,
            'form' => $form->createView()
        ]);
    }

    #[Route('/uploads/{documentPath}', name: 'download_file', requirements: ['documentPath' => '.+'])]
    public function downloadFileAction($documentPath = null): BinaryFileResponse
    {
        if ($documentPath) {
            $documentPath = $this->getParameter('kernel.project_dir') . '/public/' . $documentPath;

            if (!file_exists($documentPath)) {
                throw $this->createNotFoundException('The file does not exist');
            }

            $response = new BinaryFileResponse($documentPath);
            $originalFileName = pathinfo($documentPath, PATHINFO_FILENAME);
            $response->setContentDisposition(
                ResponseHeaderBag::DISPOSITION_ATTACHMENT,
                $originalFileName . '.' . pathinfo($documentPath, PATHINFO_EXTENSION)
            );

        return $response;
            }
    }

    #[Route('deleteFile/{id}/{filename}', name: 'deleteFile')]
    public function deleteFile($id, $filename): Response
    {
        $assets = $this->assetsManagerRepository->find($id);

        if (!$assets) {
            throw $this->createNotFoundException('Asset not found');
        }

        if (!in_array('/uploads/' . $filename, $assets->getDocumentPaths())) {
            throw $this->createNotFoundException('File not found');
        }

        $filePath = $this->getParameter('kernel.project_dir') . '/public/uploads/' . $filename;

        if (!file_exists($filePath)) {
            throw $this->createNotFoundException('File not found');
        }

        try {
            unlink($filePath);
        } catch (\Exception $e) {
            return new Response($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        // Remove the filename from the entity's documentPaths array
        $assets->removeDocumentPath('/uploads/' . $filename);

        // Update the entity in the database
        $this->em->flush();

        return $this->redirectToRoute('edit_asset', ['id' => $id]);
    }

    #[Route('/search', name: 'search')]
    public function search(Request $request): Response
    {
        $query = $request->query->get('query');

//        $results = $this->getDoctrine()->getRepository(AssetsManager::class)->findBySearchQuery($query);
        $results = $this->assetsManagerRepository->findBySearchQuery($query);

        return $this->render('Assets/search.html.twig', ['results' => $results]);
    }
}