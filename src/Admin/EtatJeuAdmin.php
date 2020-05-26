<?php

declare(strict_types=1);

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Sonata\AdminBundle\Form\Type\ModelType;
use App\Entity\NommenclatureEtat;

final class EtatJeuAdmin extends AbstractAdmin
{

    protected function configureDatagridFilters(DatagridMapper $datagridMapper): void
    {
        $datagridMapper
            ->add('date')
			->add('nommenclatureEtat.nom', null, ['label' => 'Etat'])
            ->add('commentaire')
            ->add('jouable')
            ->add('piecesManquantes')
            ;
    }

    protected function configureListFields(ListMapper $listMapper): void
    {
        $listMapper
            ->add('date')
            ->add('nommenclatureEtat.nom', null, ['label' => 'Etat'])
            ->add('jouable')
            ->add('piecesManquantes')
            ->add('commentaire')
            ->add('_action', null, array(
                'actions' => array(
                    'show' => array(),
                    'edit' => array(),
                    'delete' => array(),
                ),
            ))
        ;
    }

    protected function configureFormFields(FormMapper $formMapper): void
    {
		$repo = $this->getConfigurationPool()->getContainer()->get('doctrine')->getManager()->getRepository(NommenclatureEtat::class);
		
        $formMapper
        ->add('date', DateType::class, array(
            'widget' => 'single_text',
            'format' => 'dd/MM/yyyy',
            'disabled' => true,
        ))
        ->add('commentaire')
        ->add('jeu', ModelType::class, array(
            'class' => 'App\Entity\Jeu',
            'property' => 'nomJeuNomProprietaire',
            'disabled' => true,
        ))
        ->add('nommenclatureEtat', ModelType::class, array(
            'class' => 'App\Entity\NommenclatureEtat',
            'property' => 'nom',
			'query' => $repo->getChoicesQB(),
        ))
        ->add('jouable')
        ->add('piecesManquantes')
        ->add('flagInventaire', null, ['label' => 'Case à decocher pour valider l\'inventaire']);
    }

    protected function configureShowFields(ShowMapper $showMapper): void
    {
        $showMapper
            ->add('jeu.proprietaire', ModelType::class, array(
                'class' => 'App\Entity\Proprietaire',
                'property' => 'nom'))
            ->add('date')
            ->add('nommenclatureEtat.nom')
            ->add('jouable')
            ->add('piecesManquantes')
            ->add('commentaire')
        ;
    }
}
