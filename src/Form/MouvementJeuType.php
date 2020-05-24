<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class MouvementJeuType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
			->addEventListener(
            FormEvents::PRE_SET_DATA,
            function (FormEvent $event) {
                $form = $event->getForm();
                $data = $event->getData();
				if ($data != null && $data->getDateMouvement() < new \DateTime() ) {
					$form->add('StringInfoMouvement', 'textarea', array('disabled' => true, 'label' => false));
				} else {
					$form
					->add('dateMouvement', DateType::class, array(
                            'widget' => 'single_text',
                            'format' => 'dd/MM/yyyy',
                            'disabled' => true,
							'data' => new \DateTime(),
                        ))
					->add('commentaire')
					->add('gestionnaireJeu')
					->add('jeux')
					->add('destination');
				}
			}
			);
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'App\Entity\MouvementJeu'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'dglas_jeubundle_mouvementjeu';
    }


}
