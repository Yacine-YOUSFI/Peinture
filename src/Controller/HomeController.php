<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\PeintureRepository;
use App\Repository\UserRepository;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Serializer\Encoder\JsonEncoder;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="app_home", methods={"GET"})
     */
    public function index(SerializerInterface $serializer, PeintureRepository $PeintureRepository)
    {        
        $data = [];
        $peintures= [];

        $peintures = $PeintureRepository->lastThree(); 
        foreach ($peintures as $peinture) {
           $data[] = [
               'user' => $peinture->getUser()->getId(),
               'name' => $peinture->getNom(),
               'prix' => $peinture->getPrix(),
           ];
        }
        //return $this->json($data);
        return $this->render('home/index.html.twig', [
            'peintures' => $this->json($data)
        ]);
    }
}
