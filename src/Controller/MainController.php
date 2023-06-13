<?php

namespace App\Controller;

use App\Repository\Product1Repository;
use App\Repository\Product2Repository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class MainController extends AbstractController
{
    private $product1Responsitory;
    private $product2Responsitory;
    public function __construct(Product1Repository $product1Repository, Product2Repository $product2Repository)
    {
        $this->product1Responsitory = $product1Repository;
        $this->product2Responsitory = $product2Repository;
    }
    /**
     * @Route("/", name="index")
     */
    #[Route('/', methods: ['GET'], name: 'index')]
    public function index(): Response
    {
        $product = $this->product1Responsitory->findAll();
        $products = $this->product2Responsitory->findAll();
        return $this->render("index.html.twig", [
            'product' => $product,
            'products' => $products,
        ]);
    }

}               