<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Service\GoogleTextToSpeechService;

class TestController extends AbstractController {
    /**
     * @Route("/test", name="test")
     */
    public function test(
        GoogleTextToSpeechService $google_service
    ){
        return new Response($google_service->convertToText('test.wav'), 200);
    }
}
