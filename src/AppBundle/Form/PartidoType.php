<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class PartidoType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('fecha', 'datetime', array('date_widget' => "single_text", 'time_widget' => "single_text"))
            ->add('pista')
            ->add('p1j1', 'entity', array('class' => 'AppBundle\Entity\User', 'required' => false, 'label' => 'Pareja 1'))
            ->add('p1j2', 'entity', array('class' => 'AppBundle\Entity\User', 'required' => false, 'label' => 'Pareja 1'))
            ->add('p2j1', 'entity', array('class' => 'AppBundle\Entity\User', 'required' => false, 'label' => 'Pareja 2'))
            ->add('p2j2', 'entity', array('class' => 'AppBundle\Entity\User', 'required' => false, 'label' => 'Pareja 2'))
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Partido'
        ));
    }
}
