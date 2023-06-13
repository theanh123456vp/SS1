<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Order;
use Symfony\Component\Form\ChoiceList\ChoiceList;
use Symfony\Component\Form\AbstractType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class OrderFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder

            ->add('priceProduct', IntegerType::class, [
                'attr' => array(
                    'class' => 'hidden',
                ),
                'label' => false,
                'required' => false
            ])
            ->add('nameProduct', TextType::class, [
                'attr' => array(
                    'class' => 'hidden',
                ),
                'label' => false,
                'required' => false
            ])
            ->add('name', TextType::class, [
                'label' => false,
                'attr' => [
                    'class' => 'form-control ',
                    'placeholder' => 'Họ và tên',
                ],
            ])
            ->add('phoneNumber', NumberType::class, [
                'label' => false,
                'attr' => [
                    'class' => 'form-control ',
                    'placeholder' => 'Your Phone Number',
                ],
            ])
            ->add('address', TextType::class, [
                'label' => false,
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Số nhà, đường,...',
                ],

            ])
            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'You should agree to order.',
                    ]),
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Order::class,
        ]);
    }
}