<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel;

use Endroid\QrCode\Label\Font\OpenSans;
use Endroid\QrCode\RoundBlockSizeMode;
use Endroid\QrCode\Writer\PngWriter;


/**
 * @Route ("/qr")
 */
class QrController extends AbstractController
{
    /**
     * @Route("/", name="app_qr")
     */
    public function index(): Response
    {
        return $this->render('qr/index.html.twig', [
            'controller_name' => 'QrController',
        ]);
    }


    /**
     * @Route("/generacioqr/{valor}", name="app_qr_generacio", methods={"GET"})
     * Llegeix un valor que se li passa per la url i ho converteix en un QR
     * @param string $valor
     * @return Response
     */

    public function generacioQr(string $valor): Response
    {
        $builder = Builder::create()
        ->writer(new PngWriter())
            ->data($valor)
            ->writerOptions([])
            ->validateResult(false)
            ->encoding(new Encoding('UTF-8'))
            ->size(300)
            ->margin(10)
;

        $result = $builder->build();

        return new Response($result->getString(), 200, ['Content-Type' => $result->getMimeType()]);
    }




}
