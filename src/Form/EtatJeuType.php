<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class EtatJeuType extends AbstractType
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
                if ($data == null || $data->getJeu() == null || $data->getJeu()->getId() == null) {
                    $form 
                    // ->add('date', DateType::class, array(
                    //     'widget' => 'single_text',
                    //     'format' => 'dd/MM/yyyy',
                    //     // 'data' => new \DateTime(),
                    //     'disabled' => true,
                    // ))
                    ->add('commentaire')
                    ->add('nommenclatureEtat', 'entity', array(
                        'class' => 'App\Entity\NommenclatureEtat',
						'choice_label' => 'nom',
						'query_builder' => function(\Dglas\JeuBundle\Repository\NommenclatureEtatRepository $er) {
							return $er->getChoicesQB();
						},
                    ))
                    ->add('jouable', null, ['data' => true])
                    ->add('piecesManquantes');
                } else {
                    if (! $data->getFlagInventaire()) {
                        $form->add('detail', 'textarea', array('disabled' => true, 'label' => false));
                    } else {
                        $form 
                        ->add('date', DateType::class, array(
                            'widget' => 'single_text',
                            'format' => 'dd/MM/yyyy',
                            'disabled' => true,
                        ))
                        ->add('jeu', null, array(
                            'class' => 'App\Entity\Jeu',
                            'choice_label' => 'nomJeuNomProprietaire',
                            'disabled' => true,
                        ))
                        ->add('commentaire', 'textarea')
                        ->add('nommenclatureEtat', 'entity', array(
                            'class' => 'App\Entity\NommenclatureEtat',
                            'choice_label' => 'nom',
							'query_builder' => function(\Dglas\JeuBundle\Repository\NommenclatureEtatRepository $er) {
								return $er->getChoicesQB();
							},
                        ))
                        ->add('jouable', null)
                        ->add('piecesManquantes')
                        ->add('flagInventaire', null, ['label' => 'Case à decocher pour valider l\'inventaire']);
                    }                    
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
            'data_class' => 'App\Entity\EtatJeu'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'dglas_jeubundle_etatjeu';
    }


}
