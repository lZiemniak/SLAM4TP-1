<?php

namespace App\Form;

use App\Entity\Bien;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Entity\Type;

use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\ResetType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;



class BienType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            
            
            ->add('nb_piece',NumberType::class,array('label'=>'Nombre de Pièces:','attr'=>array('class'=>'form-control','placeholder'=>'Nb_pieces..')))
            ->add('nb_chambre',NumberType::class,array('label'=>'Nombre de Chambres:','attr'=>array('class'=>'form-control','placeholder'=>'Nb_chambres ...')))
            ->add('superficie',NumberType::class,array('label'=>'Superficie:','attr'=>array('class'=>'form-control','placeholder'=>'Superficie..')))
            ->add('prix',NumberType::class,array('label'=>'Prix:','attr'=>array('class'=>'form-control','placeholder'=>'Prix..')))
            ->add('chauffage',TextType::class, array('label'=>'Chauffage:','attr'=>array('class'=>'form-control','placeholder'=>'Chauffage..')))
            ->add('annee',NumberType::class, array('label'=>'Année:','attr'=>array('class'=>'form-control','placeholder'=>'Année..')))
            ->add('localisation',TextType::class,array('label'=>'localisation:','attr'=>array('class'=>'form-control','placeholder'=>'localisation..')))
            ->add('etat',TextType::class,array('label'=>'Etat:','attr'=>array('class'=>'form-control','placeholder'=>'État ...')))
            ->add('type',EntityType::class, array('class'=>'App\Entity\Type','choice_label'=>'libelle','multiple'=>false,'required'=>true,'placeholder'=>"--Choisir Type--"))
            ->add('Valider',SubmitType::class, array('label' =>'Valider','attr' => array('class'=>'btn btn-primary btn-block')))
            
        ;
        
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Bien::class,
        ]);
    }
}
