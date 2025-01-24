<?php

namespace App\Controller;

use App\Repository\ProprieteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(ProprieteRepository $reposity): Response
    {
        $proprietes = $reposity->findLatest();
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'current_menu' => 'home',
            'proprietes' => $proprietes
        ]);
    }
}
