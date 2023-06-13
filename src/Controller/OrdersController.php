<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Order;
use App\Form\OrderFormType;
use App\Repository\Product2Repository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

class OrdersController extends AbstractController
{
    private $em;
    private $product2Repository;
    public function __construct(EntityManagerInterface $em, Product2Repository $product2Repository)
    {
        $this->em = $em;
        $this->product2Repository = $product2Repository;
    }

    #[Route('/order/product2/{id}', name: 'app_order2')]
    public function order(Request $request, EntityManagerInterface $entityManager, $id): Response
    {

        $productID = $this->product2Repository->find($id);
        $order = new Order();
        $forms = $this->createForm(OrderFormType::class, $order);
        $forms->handleRequest($request);

        if ($forms->isSubmitted() && $forms->isValid()) {
            $entityManager->persist($order);
            $entityManager->flush();
            return $this->redirectToRoute('index');
        }

        if (!($forms->isSubmitted())) {
            $forms->get('nameProduct')->setData(($productID->getName()));
            $forms->get('priceProduct')->setData(($productID->getPrice()));
        }

        if ($forms->isSubmitted() && !($forms->isValid())) {
            echo '<script>alert("Sai thông tin liên hệ!")</script>';
        }

        return $this->render('registration/order.html.twig', [
            'productID' => $productID,
            'orderForm' => $forms->createView(),
        ]);
    }
}