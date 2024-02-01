<?php

namespace App\Form;

use App\Entity\Utilisateur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;

class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'minlength' => '5',
                    'maxlength' => '50',
                ],
                'label' => 'Adresse Email',
                'label_attr' => [ 
                    'class' => 'form-label',
                ],
                'constraints' => [
                    new Assert\NotBlank(),
                    new Assert\Email(),
                    new Assert\Length([
                        'min' => 5,
                        'max' => 50,
                    ])
                ]  
            ])
            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'first_options'  => [
                    'label' => 'Mot de passe',
                ],
                'second_options' => [
                    'label' => 'Confirmation du mot de passe',
                ],
                'invalid_message' => 'Les mots de passe ne correspondent pas',       
            ])
            ->add('nom', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'minlength' => '3',
                    'maxlength' => '50',
                ],
                'label' => 'Nom ',
                'label_attr' => [
                    'class' => 'form-label',
                ],
                'constraints' => [
                    new Assert\NotBlank(),
                    new Assert\Length([
                        'min' => 3,
                        'max' => 50,
                    ]),
                ],
            ])
            ->add('prenom', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'minlength' => '3',
                    'maxlength' => '50',
                ],
                'label' => 'Prenom',
                'label_attr' => [
                    'class' => 'form-label',
                ],
                'constraints' => [
                    new Assert\NotBlank(),
                    new Assert\Length([
                        'min' => 3,
                        'max' => 50,
                    ]),
                ],
            ])
            ->add('dateNaissance', DateType::class, [
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
                'label' => 'Date de naissance',
                'attr' => [
                    'class' => 'form-control',
                ],
                'constraints' => [
                    new Assert\NotBlank(),
                ],
            ])
            ->add('adresse1', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                ],
                'label' => 'Adresse 1',
                'constraints' => [
                    new Assert\NotBlank(),
                    new Assert\Length([
                        'min' => 5,
                        'max' => 50,
                    ]),
                ],
            ])
            ->add('adresse2', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                ],
                'label' => 'Adresse 2',
                'required' => false,
                'constraints' => [
                    new Assert\Length([
                        'max' => 50,
                    ]),
                ],
            ])
            ->add('codepostale', IntegerType::class, [
                'attr' => [
                    'class' => 'form-control',
                ],
                'label' => 'Code postal',
                'constraints' => [
                    new Assert\NotBlank(),
                    new Assert\Type(['type' => 'integer']),
                ],
            ])
            ->add('ville', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                ],
                'label' => 'Ville',
                'constraints' => [
                    new Assert\NotBlank(),
                    new Assert\Length([
                        'min' => 3,
                        'max' => 25,
                    ]),
                ],
            ])
            ->add('admin', CheckboxType::class, [
                'label' => 'Administrateur',
                'required' => false,
            ])
            ->add('submit', SubmitType::class, [
                'attr' => [
                    'class' => 'btn btn-primary',
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Utilisateur::class,
        ]);
    }
}

