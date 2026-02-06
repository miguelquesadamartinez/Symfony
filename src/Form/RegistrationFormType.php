<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('fullName', TextType::class, [
                'label' => 'Nombre completo',
                'constraints' => [
                    new NotBlank(['message' => 'Ingresa tu nombre.']),
                    new Length(['min' => 3, 'minMessage' => 'Debe tener al menos {{ limit }} caracteres.']),
                ],
            ])
            ->add('email', EmailType::class, [
                'label' => 'Email',
                'constraints' => [
                    new NotBlank(['message' => 'Ingresa tu email.']),
                    new Email(['message' => 'Email no válido.']),
                ],
            ])
            ->add('plainPassword', PasswordType::class, [
                'label' => 'Contraseña',
                'mapped' => false,
                'constraints' => [
                    new NotBlank(['message' => 'Ingresa una contraseña.']),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Debe tener al menos {{ limit }} caracteres.',
                        'max' => 4096,
                    ]),
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
