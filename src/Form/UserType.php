<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'required' => true, 
                'label' => "Email"
                ])
            ->add('email_confirmation', EmailType::class, [
                    'required' => true, 
                    'label' => "Confirmation email"
                    ])    
            
            ->add('plainPassword', PasswordType::class, [
                'required' => true,
                'label' => "Mot de passe "
            ])
            ->add('nom', TextType::class, [
                'required' => true,
                'label' => "Nom",
            'constraints' => [
                new Length([
                   'min' => 2,
                   'minMessage' => 'Le nom doit contenir au minimum {{ limit }} caractères'
                ]),
             ]
          ])
            ->add('prenom', TextType::class, [
                'required' => true,
                'label' => "Prénom" ,
                'constraints' => [
                    new Length([
                        'min' => 3,
                        'minMessage' => 'Le nom doit contenir au minimum {{ limit }} caractères'
                    ]),
                ]
            ])
            ->add('datenaissance', BirthdayType::class, [
                'required' => true,
                'label' => "Date de naissance"
            ])
            ->add('adresse1', TextareaType::class, [
                'label' => "Adresse"
            ])
            ->add('adress2', TextareaType::class, [
                'label' => "Adresse 2"
            ])
            ->add('code_postale', IntegerType::class, [
                'label' => "Code Postal"
            ])
            ->add('ville', TextareaType::class, [
                'label' => "Ville"
            ])
            // ->add('submit', SubmitType::class, [
            //     'label' => 'Modifier',
            // ]);
            
        ;
      
          
            
            
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }

}

