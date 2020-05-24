<?php

declare(strict_types=1);

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Sonata\AdminBundle\Form\Type\ModelAutocompleteType;

final class LieuAdmin extends AbstractAdmin
{

    protected function configureDatagridFilters(DatagridMapper $datagridMapper): void
    {
        $datagridMapper
            ->add('nom')
            ->add('lieuParent.nom')
            ->add('jeuUtilisable')
            ->add('inventoriable')
            ->add('defaut')
            ;
    }

    protected function configureListFields(ListMapper $listMapper): void
    {
        $listMapper
            ->add('nom')
            ->add('lieuParent.nom')
            ->add('jeuUtilisable')
            ->add('inventoriable')
            ->add('defaut')
            ->add('_action', null, [
                'actions' => [
                    'show' => [],
                    'edit' => [],
                    'delete' => [],
                ],
            ]);
    }

    protected function configureFormFields(FormMapper $formMapper): void
    {
        $formMapper
            ->add('nom')
			->add('lieuParent', ModelAutocompleteType::class, [
                    'class' => 'App\Entity\Lieu',
                    'property' => 'nom',
                    'label' => 'Lieu parent',
					'required' => false
                ])
            ->add('jeuUtilisable', CheckboxType::class, array(
                'required' => false,
            ))
			->add('inventoriable', CheckboxType::class, array(
                'required' => false,
            ))
			->add('defaut', CheckboxType::class, array(
                'required' => false,
            ))
        ;
    }

    protected function configureShowFields(ShowMapper $showMapper): void
    {
        $showMapper
            ->add('nom')
            ->add('lieuParent.nom')
            ->add('jeuUtilisable')
			->add('inventoriable')
			->add('defaut')
            ->add('lieuFils', null, array(
                'associated_property' => 'nom')
            )
        ;
    }
}
