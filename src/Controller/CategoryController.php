<?php

namespace App\Controller;

use App\Entity\Category;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Program;


#[Route('/category', name:'category_')]
class CategoryController extends AbstractController
{
    #[Route('/', name:'index')]
    public function index(CategoryRepository $categoryRepository): Response
    {
        $categories = $categoryRepository->findAll();

        return $this->render('/category/index.html.twig', [
            'categories' => $categories,
        ]);
    }

    #[Route('/{categoryName}', methods: ['GET'], name:'show')]
    public function show(string $categoryName, EntityManagerInterface $entityManager): Response
    {
        $categoryRepository = $entityManager->getRepository(Category::class);
        $programRepository = $entityManager->getRepository(Program::class);

        $category = $categoryRepository->findOneBy(['name' => $categoryName]);

        if (!$category)
        {
            throw $this->createNotFoundException('Erreur 404 : Aucune séries nomée : ' . $categoryName);
        }

            $programs = $programRepository->findBy(['category' => $category ]);

            return $this->render('category/show.html.twig', [
                'category' => $category,
                'programs' => $programs,
            ]);
        

    }
}