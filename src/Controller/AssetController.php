<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use function Symfony\Component\String\u;

class AssetController extends AbstractController
{
    #[Route('/')]
    public function homepage(): Response
    {
//        return new Response('List of assets will be here');

        $assets = [
            ['asset' => 'table', 'id' => '1234', 'status' => 'K likvidaci', 'price' => '4999', 'quantity' => '4'],
            ['asset' => 'chair', 'id' => '1221', 'status' => 'Pouřívané', 'price' => '1999', 'quantity' => '10'],
            ['asset' => 'headphones', 'id' => '121121', 'status' => 'Nepoužívané', 'price' => '1499', 'quantity' => '15'],

        ];

        return $this->render('Assets/homepage.html.twig',
            [
//                'title' => 'List of All Assets',
                'assets' => $assets,
            ]);
    }

    #[Route('/create/{slug}')]
    public function create($slug = null): Response
    {
        if($slug) {
            $title = u(str_replace('-', ' ', $slug))->title(true);
        } else {
            $title = 'Add New Asset';
        }
//        return new Response('New Assests will be added through here - '. $title);
        return $this->render('Assets/create.html.twig',
        [

        ]);
    }

    #[Route('/list/{slug}')]
    public function assetList($slug = null): Response
    {
        if($slug) {
            $title = u(str_replace('-', ' ', $slug))->title(true);
        } else {
            $title = 'Add New Asset';
        }
        $assets = [
            ['asset' => 'table', 'id' => '1234', 'status' => 'K likvidaci', 'price' => '4999', 'quantity' => '4'],
            ['asset' => 'chair', 'id' => '1221', 'status' => 'Pouřívané', 'price' => '1999', 'quantity' => '10'],
            ['asset' => 'headphones', 'id' => '121121', 'status' => 'Nepoužívané', 'price' => '1499', 'quantity' => '15'],

        ];
//        return new Response('List of Assets here - '. $title);
        return $this->render('Assets/asssetList.html.twig',
            [
                'assets' => $assets,
            ]);
    }

    #[Route('/users/{slug}')]
    public function usersList($slug = null): Response
    {
        if($slug) {
            $title = u(str_replace('-', ' ', $slug))->title(true);
        } else {
            $title = 'Add New Asset';
        }
//        return new Response('List of Users here - '. $title);
        return $this->render('Assets/usersList.html.twig',
            [

            ]);
    }

}