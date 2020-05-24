<?php

declare(strict_types=1);

namespace App\Admin;

use App\Entity\Jeu;
use App\Entity\NommenclatureEtat;
use App\Entity\Lieu;
use App\Entity\EtatJeu;
use App\Entity\MouvementJeu;
use App\Form\EtatJeuType;
use App\Form\MouvementJeuType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Form\Type\ModelAutocompleteType;

final class JeuAdmin extends AbstractAdmin
{

    protected $datagridValues = [

        // display the first page (default = 1)
        '_page' => 1,

        // reverse order (default = 'ASC')
        '_sort_order' => 'DESC',

        // name of the ordered field (default = the model's id field, if any)
        '_sort_by' => 'idPhysique',
    ];
	
    protected function configureDatagridFilters(DatagridMapper $datagridMapper): void
    {
        $em = $this->modelManager->getEntityManager('App\\Entity\\NommenclatureEtat');
			$etatChoices = $em->getRepository('App\Entity\NommenclatureEtat')->getChoices();
		$em = $this->modelManager->getEntityManager('App\\Entity\\Lieu');
			$lieuChoices = $em->getRepository('App\Entity\\Lieu')->getChoices();
			
			
        $datagridMapper
            ->add('idPhysique', null, ['show_filter' => true])
            ->add('nommenclatureJeu.nom', null, ['label' => 'Nom', 'show_filter' => true])
            ->add('etatJeu.flagInventaire', null, ['label' => 'En attente de validation'])
			->add('etatJeu.nommenclatureEtat.id', 'doctrine_orm_callback', 
				[
				'label' => 'Etat',
				'show_filter' => true,
				'callback' => function($queryBuilder, $alias, $field, $value) {
					if ($value['value'] != '') {
						$repo = $this->modelManager->getEntityManager('App\\Entity\\EtatJeu')->getRepository('EtatJeu::class');
			
						$query = $repo->createQueryBuilder('s');
						$query->select('MAX(s.date)')
						->where('s.jeu = o.id');
			
						$queryBuilder->andWhere('s_nommenclatureEtat.id = :state');
						$queryBuilder->andWhere('s_etatJeu.date = ('.$query->getDql().')');
						$queryBuilder->setParameter('state', $value['value']);
					}
				}
				] 
				, ChoiceType::class, array('choices' => $etatChoices))
			->add('mouvementJeu.destination.id', 'doctrine_orm_callback', 
				[
				'label' => 'Lieu',
				'show_filter' => true,
				'callback' => function($queryBuilder, $alias, $field, $value) {
					if ($value['value'] != '') {
						$repo = $this->modelManager->getEntityManager('App\\Entity\\MouvementJeu')->getRepository('MouvementJeu::class');
			
						$query = $repo->createQueryBuilder('s');
						$query->select('MAX(s.dateMouvement)')
						->where('o member of s.jeux');
			
						$queryBuilder->andWhere('s_mouvementJeu_destination.id = :state and s_mouvementJeu.dateMouvement = ('.$query->getDql().')');
						$queryBuilder->setParameter('state', $value['value']);
					}
				}
				] 
				, ChoiceType::class, array('choices' => $lieuChoices))
            ->add('proprietaire.nom', null, ['label' => 'Proprietaire']);
    }

    protected function configureListFields(ListMapper $listMapper): void
    {
        $listMapper
            ->add('idPhysique')
            ->add('nommenclatureJeu.nom', null, ['label' => 'Nom'])
            ->add('proprietaire.nom', null, ['label' => 'Proprietaire'])
            ->add('etatString', null, ['label' => 'Etat'])
			->add('getMouvementString', null, ['label' => 'Lieu'])
            ->add('_action', null, array(
                'actions' => array(
                    'show' => array(),
                    'edit' => array(),
                ),
            ));
    }

    protected function configureFormFields(FormMapper $formMapper): void
    {
        $formMapper
            ->with('Boite de jeu', ['class' => 'col-md-4'])
                ->add('nommenclatureJeu', ModelAutocompleteType::class, [
                    'class' => 'App\Entity\NommenclatureJeu',
                    'property' => 'nom',
                    'label' => 'Nom'
                ])
                ->add('idPhysique')
                ->add('proprietaire', ModelAutocompleteType::class, [
                    'class' => 'App\Entity\Proprietaire',
                    'property' => 'nom',
                    'label' => 'Nom'
                ])
            ->end()
            ->with('Etats', ['class' => 'col-md-6'])
                ->add('etatJeu', CollectionType::class, array(
                    'entry_type' => EtatJeuType::class,
                    'label' => 'Etat',
                    'entry_options' => array(
                        'attr' => array('class' => 'App\Entity\EtatJeu')
                    ),
                    'allow_add' => true
                ))
            ->end()
			->with('Mouvements', ['class' => 'col-md-6'])
				->add('mouvementJeu', CollectionType::class, array(
                    'entry_type' => MouvementJeuType::class,
                    'label' => 'Mouvements',
                    'entry_options' => array(
                        'attr' => array('class' => 'App\Entity\MouvementJeu')
                    ),
                    'allow_add' => true
                ))
			->end()
            ;
    }

    protected function configureShowFields(ShowMapper $showMapper): void
    {
        $showMapper
        ->with('Boite de jeu', ['class'=>'col-md-4'])
            ->add('idPhysique')
            ->add('nommenclatureJeu.nom', null, ['label' => 'Nom'])
            ->add('proprietaire.nom', null, ['label' => 'Proprietaire'])
        ->end()
        
        ->with('Historique des états', ['class'=>'col-md-6'])
            ->add('etatJeu', ModelAutocompleteType::class, [
                'class' => 'App\Entity\EtatJeu',
                'associated_property' => 'dateEtatString'
            ])
        ->end()

        ->with('Historique des mouvements', ['class'=>'col-md-6'])
            ->add('mouvementJeu', null, array(
                'label' => 'Mouvements',
                'associated_property' => 'stringInfoMouvement')
            )
        ->end()
        ;
    }
	
	public function getExportFields()
	{
		return ['idPhysique', 'nommenclatureJeu.nom', 'proprietaire.nom', 'lastEtatJeu.stringDateEtat'];
	}
	
	public function getExportFormats()
    {
        return array(
            'json', 'xml', 'csv', 'xls'
        );
    }
}
