<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;

class RegisterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname',TextType::class, [
                'label'=>'Prénom',
                'constraints'=>new Length(null,2, 30),
                'attr'=> [
                    'placeholder'=>'Veuillez saisir votre prénom'
                ]
            ])
            ->add('lastname',TextType::class, [
                'label'=>'Nom',
                'constraints'=>new Length(null,2, 30),

                'attr'=> [
                    'placeholder'=>'Veuillez saisir votre nom'
                ]
            ])
            ->add('email', EmailType::class,  [
                'label'=>'Email',
                'attr'=> [
                    'placeholder'=>'Veuillez saisir votre email'
                ]
            ])
            ->add('password', RepeatedType::class, [
                'type'=> PasswordType::class,
                'invalid_message' => 'Password and confirmation are different',
                'label'=> 'Password',
                'required' => true,
                'first_options'=>
                    ['label' => 'Password',
                        'constraints'=>new Length(null,2, 20),
                        'attr'=> [
                            'placeholder'=> 'Your password'
                        ]],
                'second_options' =>
                    ['label' => 'Confirm password',
                        'constraints'=>new Length(null,2, 20),
                        'attr'=> [
                            'placeholder'=> 'Confirm password'
                        ]]])
            ->add('submit', SubmitType::class, [
                'label'=>'Valider'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
