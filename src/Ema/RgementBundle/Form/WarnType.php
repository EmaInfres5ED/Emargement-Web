<?php

namespace Ema\RgementBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class WarnType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
			//->add('nomEleve', 'choice', array('choices' => array('test', 'test2' => 'ah', 'ah2' => 'jaja'),))
			/*->add('retardDate', 'datetime')
			->add('retardHour', 'time')*/
			->add('motif', 'textarea')
			->add('absenceDateDebut', 'datetime')
			->add('absenceDateFin', 'datetime')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Ema\RgementBundle\Entity\Warn'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'ema_rgementbundle_retard';
    }
}
