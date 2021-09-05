<?php

namespace App\Form;

use App\Entity\Hecho;
use App\Entity\DetalleHecho;
use App\Form\DetalleHechoType;
use Symfony\Component\Form\AbstractType;

use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;



class HechoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('fecha')
       
            ->add('detalleHechos', CollectionType::class, [
                'entry_type' => DetalleHechoType::class,
                'entry_options' => [
                    'label' => false
                ], 'by_reference' => false,
                   'allow_add' => true,
                   'allow_delete' => true
            ])

            ->add('save', SubmitType::class,['attr' => ['class' => 'btn btn-success']])
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Hecho::class,
        ]);
    }
}
