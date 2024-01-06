<?php

namespace App\Service;

use Endroid\QrCode\Builder\BuilderInterface;
use Symfony\Component\HttpFoundation\Response;
use Endroid\QrCodeBundle\Response\QrCodeResponse;

class QrCode
{


    public function __construct(BuilderInterface $customQrCodeBuilder)
    {
        $result = $customQrCodeBuilder
            ->size(400)
            ->margin(20)
            ->build();
    }

    public function qrResponse(Response $response):  void
    {
        $response = new QrCodeResponse($result);
    }



}