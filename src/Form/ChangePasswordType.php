<?php

namespace App\Form;

use App\Entity\User;
use Doctrine\DBAL\Types\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;

class ChangePasswordType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class, [
                'disabled'=>true,
                'label'=>'Mon adresse mail'
            ])
            ->add('firstname',\Symfony\Component\Form\Extension\Core\Type\TextType::class, [
                'disabled'=>true,
               'label'=>'Mon prénom'
            ])
            ->add('lastname', \Symfony\Component\Form\Extension\Core\Type\TextType::class, [
                'disabled'=>true,
            'label'=>'Mon nom'])
            ->add('old_password', PasswordType::class, [
                'mapped'=>false,
                'label'=> 'Mon mot de passe actuel',
                'attr'=>['placeholder'=>'Veuillez saisir votre mot de passe actuel'
                ]
            ])
            ->add('new_password', RepeatedType::class, [
                'type'=> PasswordType::class,
                'mapped'=>false,
                'invalid_message' => 'Le mot de passe est différent de la confirmation',
                'label'=> 'Mon nouveau mot de passe',
                'required' => true,
                'first_options'=>
                    ['label' => 'Mon nouveau mot de passe',
                        'constraints'=>new Length(null,2, 20),
                        'attr'=> [
                            'placeholder'=> 'Votre nouveau mot de passe'
                        ]],
                'second_options' =>
                    ['label' => 'Confirmer votre nouveau mot de passe',
                        'constraints'=>new Length(null,2, 20),
                        'attr'=> [
                            'placeholder'=> 'Confirmer le nouveau mot de passe'
                        ]]])
            ->add('submit', SubmitType::class, [
                'label'=>'MAJ mot de passe'
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
