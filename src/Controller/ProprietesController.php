<?php

namespace App\Controller;

use App\Repository\ProprieteRepository;
use App\Entity\Propriete;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;


final class ProprietesController extends AbstractController
{
    private $repository;

    public function __construct(ProprieteRepository $repository, EntityManagerInterface $em)
    {
        $this->repository = $repository;
        $this->em = $em;
    }

    #[Route('/biens', name: 'proprietes.index')]
    public function index(): Response
    {
        return $this->render('proprietes/index.html.twig', [
            'controller_name' => 'ProprietesController',
            'current_menu' => 'proprietes'
        ]);
    }

    #[Route('/biens/{slug}-{id}', name: 'proprietes.show', requirements: ['slug' => '[a-z0-9\-]*'])]
    public function show(Propriete $propriete, string $slug): Response
    {
        if($propriete->getSlug() !== $slug){
            return $this->redirectToRoute('proprietes.show', [
                'id' => $propriete->getId(),
                'slug' => $propriete->getSlug()
            ],301);
        }
        return $this->render('proprietes/show.html.twig', [
            'propriete' => $propriete,
            'current_menu' => 'proprietes'
        ]);
    }
}
