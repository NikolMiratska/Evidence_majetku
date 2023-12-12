<?php

namespace App\Controller;

use App\Entity\AssetsCategory;
use App\Entity\AssetsLocation;
use App\Entity\AssetsManager;
use App\Entity\AssetsWorkplace;
use App\Entity\AssetType;
use App\Entity\User;
use App\Form\AssetFormType;
use App\Form\CategoryFormType;
use App\Form\EditCategoryFormType;
use App\Form\EditLocationFormType;
use App\Form\EditTypeFormType;
use App\Form\EditUserFormType;
use App\Form\EditWorkplaceFormType;
use App\Form\LocationFormType;
use App\Form\OwnerFormType;
use App\Form\PropertyFormType;
use App\Form\TypeFormType;
use App\Form\WorkplaceFormType;
use App\Repository\AssetsCategoryRepository;
use App\Repository\AssetsLocationRepository;
use App\Repository\AssetsManagerRepository;
use App\Repository\AssetsWorkplaceRepository;
use App\Repository\AssetTypeRepository;
use App\Repository\UserRepository;
use App\Service\CategoryGenerator;
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
    private $assetTypeRepository;
    private $assetsCategoryRepository;
    private $assetsLocationRepository;
    private $assetsWorkplaceRepository;
    public function __construct(AssetsManagerRepository $assetsManagerRepository, EntityManagerInterface $em, UserRepository $userRepository, AssetTypeRepository $assetTypeRepository, AssetsCategoryRepository $assetsCategoryRepository, AssetsLocationRepository $assetsLocationRepository, AssetsWorkplaceRepository $assetsWorkplaceRepository)
    {
        $this->assetsManagerRepository = $assetsManagerRepository;
        $this->em = $em;
        $this->userRepository = $userRepository;
        $this->assetTypeRepository = $assetTypeRepository;
        $this->assetsCategoryRepository = $assetsCategoryRepository;
        $this->assetsLocationRepository = $assetsLocationRepository;
        $this->assetsWorkplaceRepository = $assetsWorkplaceRepository;
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

//            $documentPath = $form->get('documentPath')->getData();
//            if($documentPath){
//                $newFileName = uniqid() . '.' . $documentPath->guessExtension();
//
//                try {
//                    $documentPath->move(
//                        $this->getParameter('kernel.project_dir') . '/public/uploads',
//                        $newFileName
//                    );
//                } catch (FileException $e) {
//                    return new Response($e->getMessage());
//                }
//
//                $newAsset->setDocumentPath('/uploads/' . $newFileName);
//            }

            $documentPaths = $form->get('documentPaths')->getData();
            if($documentPaths){

                foreach ($newAsset as $documentPaths){
                    $newFileName = uniqid() . '.' . $documentPaths->guessExtension();

                    try {
                        $documentPaths->move(
                            $this->getParameter('kernel.project_dir') . '/public/uploads',
                            $newFileName
                        );
                    } catch (FileException $e) {
                        return new Response($e->getMessage());
                    }

                    $newAsset->setDocumentPath('/uploads/' . $newFileName);
                }
//                $newFileName = uniqid() . '.' . $documentPaths->guessExtension();
//
//                try {
//                    $documentPaths->move(
//                        $this->getParameter('kernel.project_dir') . '/public/uploads',
//                        $newFileName
//                    );
//                } catch (FileException $e) {
//                    return new Response($e->getMessage());
//                }
//
//                $newAsset->setDocumentPath('/uploads/' . $newFileName);
            }

            $this->em->persist($documentPaths);
            $this->em->flush();

            return $this->redirectToRoute('list');
        }

        return $this->render('Assets/create.html.twig', [
            'form' => $form->createView()
        ]);

    }

    // Your controller action to show the confirmation page
    #[Route('/confirmDelete/{id}')]
    public function confirmDeleteAction(AssetsCategory $category, Request $request): Response
    {
        $entityManager = $this->getDoctrine()->getManager();

//        $category = $this->assetsCategoryRepository->find($id);
        // Fetch associated assets for the category
        $associatedAssets = $entityManager
            ->getRepository(AssetsManager::class)
            ->findBy(['AssetsCategory' => $category]);

        return $this->render('Assets/confirmDelete.html.twig', [
            'category' => $category,
            'associatedAssets' => $associatedAssets,
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
    public function assetDetail($id, Request $request, CategoryGenerator $categoryGenerator): Response
    {
        $assets = $this->assetsManagerRepository->find($id);

        $categories = $this->assetsManagerRepository->find($id);

        if (!$categories) {
            throw $this->createNotFoundException('Product not found');
        }

        $categoryName = $categories->getCategory();
        $category = $categoryGenerator->generateCategory($categoryName);


        return $this->render('Assets/details.html.twig',
            [
                'assets' => $assets,
                'category' => $category,
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

    #[Route('/categoryDetails/{id}', name: 'detail_category')]
    public function categoryDetail($id, Request $request): Response
    {
        $categories = $this->assetsCategoryRepository->find($id);

        return $this->render('Assets/categoryDetails.html.twig',
            [
                'categories' => $categories
            ]);
    }

    #[Route('/locationDetails/{id}', name: 'detail_location')]
    public function locationDetail($id, Request $request): Response
    {
        $locations = $this->assetsLocationRepository->find($id);

        return $this->render('Assets/locationDetails.html.twig',
            [
                'locations' => $locations
            ]);
    }

    #[Route('/typeDetails/{id}', name: 'detail_type')]
    public function typeDetail($id, Request $request): Response
    {
        $types = $this->assetTypeRepository->find($id);

        return $this->render('Assets/typeDetails.html.twig',
            [
                'types' => $types
            ]);
    }

    #[Route('/workplaceDetails/{id}', name: 'detail_workplace')]
    public function workplaceDetail($id, Request $request): Response
    {
        $workplaces = $this->assetsWorkplaceRepository->find($id);

        return $this->render('Assets/workplaceDetails.html.twig',
            [
                'workplaces' => $workplaces
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
                $assets->setAssetLocation($form->get('locationAsset')->getData());
                $assets->setAssignedPerson($form->get('ownedBy')->getData());
                $assets->setManufacturingNumber($form->get('manufacturingNumber')->getData());
                $assets->setDateCreated($form->get('dateCreated')->getData());
                $assets->setNote($form->get('note')->getData());
                $assets->setDateBought($form->get('dateBought')->getData());
                $assets->setOrderNumber($form->get('orderNumber')->getData());
                $assets->setOrderURL($form->get('orderURL')->getData());
                $assets->setEliminated($form->get('eliminated')->getData());
                $assets->setCategory($form->get('categoryAsset')->getData());
                $assets->setWorkplace($form->get('workplaceAsset')->getData());
                $assets->setComplaint($form->get('complaint')->getData());
                $assets->setDateReceived($form->get('dateReceived')->getData());
                $assets->setNextServiceDue($form->get('nextServiceDue')->getData());
                $assets->setServiceInterval($form->get('serviceInterval')->getData());
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

    #[Route('/deleteType/{id}', methods: ['GET', 'DELETE'], name: 'delete_type')]
    public function deleteType($id){
        $types = $this->assetTypeRepository->find($id);
        $this->em->remove($types);
        $this->em->flush();

        return $this->redirectToRoute('type');
    }

    #[Route('/deleteCategory/{id}', methods: ['GET', 'DELETE'], name: 'delete_category')]
    public function deleteCategory($id){
        $categories = $this->assetsCategoryRepository->find($id);
        $this->em->remove($categories);
        $this->em->flush();

        return $this->redirectToRoute('category');
    }

    #[Route('/deleteLocation/{id}', methods: ['GET', 'DELETE'], name: 'delete_location')]
    public function deleteLocation($id){
        $locations = $this->assetsLocationRepository->find($id);
        $this->em->remove($locations);
        $this->em->flush();

        return $this->redirectToRoute('location');
    }

    #[Route('/deleteWorkplace/{id}', methods: ['GET', 'DELETE'], name: 'delete_workplace')]
    public function deleteWorkplace($id){
        $workplaces = $this->assetsWorkplaceRepository->find($id);
        $this->em->remove($workplaces);
        $this->em->flush();

        return $this->redirectToRoute('workplace');
    }

//    #[Route('/details/{id}')]
//    public function generateCategoryForProduct(CategoryGenerator $categoryGenerator, int $id)
//    {
//        // Retrieve the product entity from the database
//        $categories = $this->assetsCategoryRepository->find($id);
//
//        if (!$categories) {
//            throw $this->createNotFoundException('Product not found');
//        }
//
//        // Access the 'name' column value of the product entity
//        $productName = $categories->getCategory();
//
//        // Use the product name to generate a category
//        $category = $categoryGenerator->generateCategory($productName);
//
//        return $this->render('Assets/details.html.twig', [
//            'category' => $category,
//        ]);
//    }

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

        $asset =  new AssetsManager();
        $form = $this->createForm(OwnerFormType::class, $asset);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){

            if ($asset->getOwnedBy() !== null){
                $selectedOwner = $asset->getOwnedBy()->getName();
            } else {
                $newOwnerName = $form->get('newOwner')->getData();

                $newOwner = new User();
                $newOwner->setName($newOwnerName);

                $selectedOwner = $newOwner;
            }

            $this->em->persist($newOwner);
            $this->em->flush();

            return $this->redirectToRoute('user');
        }

        return $this->render('Assets/usersList.html.twig',
            [
                'users' => $pagination,
                'form' => $form->createView(),
            ]);
    }

    #[Route('/types', name: 'type')]
    public function typeList(Request $request, EntityManagerInterface $em, PaginatorInterface $paginator): Response
    {
        $dql   = "SELECT a FROM App\Entity\AssetType a";
        $query = $em->createQuery($dql);

        $pagination = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1), /*page number*/
            50 /*limit per page*/
        );

        $asset =  new AssetsManager();
        $form = $this->createForm(TypeFormType::class, $asset);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){

            if ($asset->getTypeAsset() !== null){
                $selectedType = $asset->getTypeAsset()->getType();
            } else {
                $newTypeName = $form->get('newType')->getData();

                $newType = new AssetType();
                $newType->setType($newTypeName);

                $selectedType = $newType;
            }

            $this->em->persist($newType);
            $this->em->flush();

            return $this->redirectToRoute('type');
        }

        return $this->render('Assets/typeList.html.twig',
            [
                'types' => $pagination,
                'form' => $form->createView(),
            ]);
    }

    #[Route('/categories', name: 'category')]
    public function categoryList(Request $request, EntityManagerInterface $em, PaginatorInterface $paginator): Response
    {
        $dql   = "SELECT a FROM App\Entity\AssetsCategory a";
        $query = $em->createQuery($dql);

        $pagination = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1), /*page number*/
            50 /*limit per page*/
        );

        $asset =  new AssetsManager();
        $form = $this->createForm(CategoryFormType::class, $asset);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){

            if ($asset->getCategoryAsset() !== null){
                $selectedCategory = $asset->getCategoryAsset()->getCategory();
            } else {
                $newCategoryName = $form->get('newCategory')->getData();

                $newCategory = new AssetsCategory();
                $newCategory->setCategory($newCategoryName);

                $selectedCategory = $newCategory;
            }

            $this->em->persist($newCategory);
            $this->em->flush();

            return $this->redirectToRoute('category');
        }

        return $this->render('Assets/categoryList.html.twig',
            [
                'categories' => $pagination,
                'form' => $form->createView(),
            ]);
    }

    #[Route('/locations', name: 'location')]
    public function locationList(Request $request, EntityManagerInterface $em, PaginatorInterface $paginator): Response
    {
        $dql   = "SELECT a FROM App\Entity\AssetsLocation a";
        $query = $em->createQuery($dql);

        $pagination = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1), /*page number*/
            50 /*limit per page*/
        );

        $asset =  new AssetsManager();
        $form = $this->createForm(LocationFormType::class, $asset);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){

            if ($asset->getLocationAsset() !== null){
                $selectedLocation = $asset->getLocationAsset()->getLocation();
            } else {
                $newLocationName = $form->get('newLocation')->getData();

                $newLocation = new AssetsLocation();
                $newLocation->setLocation($newLocationName);

                $selectedLocation = $newLocation;
            }

            $this->em->persist($newLocation);
            $this->em->flush();

            return $this->redirectToRoute('location');
        }

        return $this->render('Assets/locationList.html.twig',
            [
                'locations' => $pagination,
                'form' => $form->createView(),
            ]);
    }

    #[Route('/workplaces', name: 'workplace')]
    public function workplaceList(Request $request, EntityManagerInterface $em, PaginatorInterface $paginator): Response
    {
        $dql   = "SELECT a FROM App\Entity\AssetsWorkplace a";
        $query = $em->createQuery($dql);

        $pagination = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1), /*page number*/
            50 /*limit per page*/
        );

        $asset =  new AssetsManager();
        $form = $this->createForm(WorkplaceFormType::class, $asset);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){

            if ($asset->getWorkplaceAsset() !== null){
                $selectedWorkplace = $asset->getWorkplaceAsset()->getWorkplace();
            } else {
                $newWorkplaceName = $form->get('newWorkplace')->getData();

                $newWorkplace = new AssetsWorkplace();
                $newWorkplace->setWorkplace($newWorkplaceName);

                $selectedWorkplace = $newWorkplace;
            }

            $this->em->persist($newWorkplace);
            $this->em->flush();

            return $this->redirectToRoute('workplace');
        }

        return $this->render('Assets/workplaceList.html.twig',
            [
                'workplaces' => $pagination,
                'form' => $form->createView(),
            ]);
    }

    #[Route('/editUser/{id}', name: 'edit_user')]
    public function editUser($id, Request $request): Response
    {
        $users = $this->userRepository->find($id);
        $form = $this->createForm(EditUserFormType::class, $users);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){

            $newAsset = $form->getData();
            $profilePic = $form->get('profilePic')->getData();
            if($profilePic){
                $newFileName = uniqid() . '.' . $profilePic->guessExtension();

                try {
                    $profilePic->move(
                        $this->getParameter('kernel.project_dir') . '/public/profile',
                        $newFileName
                    );
                } catch (FileException $e) {
                    return new Response($e->getMessage());
                }

                $newAsset->setProfilePic('/profile/' . $newFileName);
            }


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

    #[Route('/editCategory/{id}', name: 'edit_category')]
    public function editCategory($id, Request $request): Response
    {
        $categories = $this->assetsCategoryRepository->find($id);
        $form = $this->createForm(EditCategoryFormType::class, $categories);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $categories->setCategory($form->get('category')->getData());

            $this->em->flush();
            return $this->redirectToRoute('category');
        }

        return $this->render('Assets/editCategory.html.twig', [
            'categories' => $categories,
            'form' => $form->createView()
        ]);
    }

    #[Route('/editLocation/{id}', name: 'edit_location')]
    public function editLocation($id, Request $request): Response
    {
        $locations = $this->assetsLocationRepository->find($id);
        $form = $this->createForm(EditLocationFormType::class, $locations);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $locations->setLocation($form->get('location')->getData());

            $this->em->flush();
            return $this->redirectToRoute('location');
        }

        return $this->render('Assets/editLocation.html.twig', [
            'locations' => $locations,
            'form' => $form->createView()
        ]);
    }

    #[Route('/editType/{id}', name: 'edit_type')]
    public function editType($id, Request $request): Response
    {
        $types = $this->assetTypeRepository->find($id);
        $form = $this->createForm(EditTypeFormType::class, $types);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $types->setType($form->get('type')->getData());

            $this->em->flush();
            return $this->redirectToRoute('type');
        }

        return $this->render('Assets/editType.html.twig', [
            'types' => $types,
            'form' => $form->createView()
        ]);
    }

    #[Route('/editWorkplace/{id}', name: 'edit_workplace')]
    public function editWorkplace($id, Request $request): Response
    {
        $workplaces = $this->assetsWorkplaceRepository->find($id);
        $form = $this->createForm(EditWorkplaceFormType::class, $workplaces);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $workplaces->setWorkplace($form->get('workplace')->getData());

            $this->em->flush();
            return $this->redirectToRoute('workplace');
        }

        return $this->render('Assets/editWorkplace.html.twig', [
            'workplaces' => $workplaces,
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

    #[Route('/user/{id}/assets', name: 'user_assets')]
    public function userAssetsAction($id): Response
    {
        $userAssets = $this->assetsManagerRepository->findBy(['ownedBy' => $id]);
//        $userAssets = $this->userRepository->findBy(['isOwnedBy' => $id]);

        return $this->render('Assets/userAssets.html.twig', ['userAssets' => $userAssets]);
    }

    #[Route('/createProperty', name: 'create_property')]
    public function createProperty(Request $request): Response
    {
        $asset =  new AssetsManager();
        $form = $this->createForm(PropertyFormType::class, $asset);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $newAsset = $form->getData();

            if ($asset->getOwnedBy() !== null){
                $selectedOwner = $asset->getOwnedBy()->getName();
            } else {
                $newOwnerName = $form->get('newOwner')->getData();

                $newOwner = new User();
                $newOwner->setName($newOwnerName);

                $selectedOwner = $newOwner;
            }

            if ($asset->getLocationAsset() !== null){
                $selectedLocation = $asset->getLocationAsset()->getLocation();
            } else {
                $newLocationName = $form->get('newLocation')->getData();

                $newLocation = new AssetsLocation();
                $newLocation->setLocation($newLocationName);

                $selectedLocation = $newLocation;
            }

            if ($asset->getTypeAsset() !== null){
                $selectedType = $asset->getTypeAsset()->getType();
            } else {
                $newTypeName = $form->get('newType')->getData();

                $newType = new AssetType();
                $newType->setType($newTypeName);

                $selectedType = $newType;
            }

            if ($asset->getWorkplaceAsset() !== null){
                $selectedWorkplace = $asset->getWorkplaceAsset()->getWorkplace();
            } else {
                $newWorkplaceName = $form->get('newWorkplace')->getData();

                $newWorkplace = new AssetsWorkplace();
                $newWorkplace->setWorkplace($newWorkplaceName);

                $selectedWorkplace = $newWorkplace;
            }

            if ($asset->getCategoryAsset() !== null){
                $selectedCategory = $asset->getCategoryAsset()->getCategory();
            } else {
                $newCategoryName = $form->get('newCategory')->getData();

                $newCategory = new AssetsCategory();
                $newCategory->setCategory($newCategoryName);

                $selectedCategory = $newCategory;
            }

            $this->em->persist($newAsset);
            $this->em->persist($newOwner);
            $this->em->persist($newLocation);
            $this->em->persist($newType);
            $this->em->persist($newWorkplace);
            $this->em->persist($newCategory);
            $this->em->flush();

            return $this->redirectToRoute('create_property');
        }

        return $this->render('Assets/createProperty.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
