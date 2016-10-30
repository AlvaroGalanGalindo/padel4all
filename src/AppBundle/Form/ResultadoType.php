<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ResultadoType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('set1p1', 'integer', array('label' => 'SET 1', 'required' => false))
            ->add('set1p2', 'integer', array('label' => 'SET 1', 'required' => false))
            ->add('set2p1', 'integer', array('label' => 'SET 2', 'required' => false))
            ->add('set2p2', 'integer', array('label' => 'SET 2', 'required' => false))
            ->add('set3p1', 'integer', array('label' => 'SET 3', 'required' => false))
            ->add('set3p2', 'integer', array('label' => 'SET 3', 'required' => false))
            ->add('partido')
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Resultado'
        ));
    }
}
