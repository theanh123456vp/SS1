<?php

namespace App\Controller;

use App\Entity\Order;
use App\Form\OrderFormType;
use App\Repository\Product1Repository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class OrderController extends AbstractController
{
    private $em;
    private $product1Repository;
    private $userRepository;
    public function __construct(EntityManagerInterface $em, Product1Repository $product1Repository, UserRepository $userRepository)
    {
        $this->em = $em;
        $this->product1Repository = $product1Repository;
        $this->userRepository = $userRepository;
    }

    #[Route('/order/product1/{id}', name: 'app_order')]
    public function order2(Request $request, EntityManagerInterface $entityManager, $id): Response
    {

        $productID = $this->product1Repository->find($id);
        $order = new Order();
        $forms = $this->createForm(OrderFormType::class, $order);
        $forms->handleRequest($request);

        if ($forms->isSubmitted() && $forms->isValid()) {

            // encode the plain password
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