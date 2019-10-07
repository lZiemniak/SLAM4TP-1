<?php

namespace App\Form;

use App\Entity\Admin;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\ResetType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class AdminConnexionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('login',TextType::class,array('label'=>'Login:','attr'=>array('class'=>'form-control','placeholder'=>'Login..')))
            ->add('mdp',PasswordType::class,array('label'=>'Mot De Passe:','attr'=>array('class'=>'form-control','placeholder'=>'Mot De Passe ...')))
            ->add('Valider',SubmitType::class, array('label' =>'Valider','attr' => array('class'=>'btn btn-primary btn-block')))
            ->add('Annuler',ResetType::class, array('label'=>'Annuler','attr' => array('class' => 'btn btn-primary btn-block')))
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Admin::class,
        ]);
    }
}
