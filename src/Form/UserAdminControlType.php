<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\CallbackTransformer;

class UserAdminControlType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
//            ->add('username')
//            ->add('roles')
//            ->add('password')
//            ->add('email')
//            ->add('voorletters')
//            ->add('tussenvoegsel')
//            ->add('achternaam')
//            ->add('adres')
//            ->add('postcode')
//            ->add('woonplaats')
//            ->add('telefoon')
//            ->add('activiteiten')


            ->add('username',TextType::class
                , array(
                    'label' => 'Gebruikersnaam'))
            ->add('roles', ChoiceType::class, [
                'choices'  => [
                    'Gebruiker' => "ROLE_USER",
                    'Admin' => "ROLE_ADMIN",
                ],
            ])
            ->add('plainPassword', RepeatedType::class, array(
                'type' => PasswordType::class,
                'first_options'  => array('label' => 'Wachtwoord'),
                'second_options' => array('label' => 'Herhaal wachtwoord'),
            ))
            ->add('voorletters')
            ->add('tussenvoegsel')
            ->add('achternaam')
            ->add('adres')
            ->add('postcode')
            ->add('woonplaats')
            ->add('email')
            ->add('telefoon');

        ;

        //roles field data transformer
        $builder->get('roles')
            ->addModelTransformer(new CallbackTransformer(
                function ($rolesArray) {
                    // transform the array to a string
                    return count($rolesArray)? $rolesArray[0]: null;
                },
                function ($rolesString) {
                    // transform the string back to an array
                    return [$rolesString];
                }
            ));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
