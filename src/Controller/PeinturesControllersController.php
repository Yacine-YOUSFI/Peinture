<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\PeintureRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;

class PeinturesControllersController extends AbstractController
{
    /**
     * @Route("/peintures", name="app_peintures_controllers", methods={"GET"})
     */
    public function index(PeintureRepository $PeintureRepository, PaginatorInterface $paginator, Request $request): Response
    {
        $data = [];
        $peintures= [];

        $data = $PeintureRepository->findAll(); 
        $peintures = $paginator->paginate(
            $data,
            $request->query->getInt('page', 1),
            6
        );
        return $this->render('peintures_controllers/index.html.twig', [
            'peintures' => $peintures,
        ]);
    }
}
