<?php

namespace App\Form;

use App\Entity\Game;
use App\Entity\GameGenre;
use App\Repository\GameGenreRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GameType extends AbstractType
{


    public function __construct(
        private GameGenreRepository $gameGenreRepository,
    )
    {
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'label' => "Titre du film"
            ])
            ->add('description', TextType::class, [
                'label' => "description du produit"
            ])
            ->add('genres', EntityType::class, [
                'class' => GameGenre::class,
                'multiple' => true,
                'expanded' => true,
                'choice_label' => function ($entity) {
                    return $entity->getLabel();
                }
            ])
            ->add('genres_add', CollectionType::class, [
                'entry_type' => GameGenreType::class,
                'entry_options' => ['label' => false],
                'mapped' => false,
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'valider'
            ])
            ->addEventListener(FormEvents::SUBMIT, function (FormEvent $event): void {
//                dump($event->getForm()->get('genres_add')->getData());
//                dd($event->getData());

                $newGenreEntities = $event->getForm()->get('genres_add')->getData();
                if (count($newGenreEntities) > 0) {
                    foreach ($newGenreEntities as $newGenreEntity) {
                        if (null === $gameGenre = $this->gameGenreRepository->findOneBy(['label' => $newGenreEntity->getLabel()])) {
                            $gameGenre = new GameGenre();
                            $gameGenre->setLabel($newGenreEntity->getLabel());
                        }

                        $event->getData()->addGenre($gameGenre);
                    }
                }

            });
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Game::class,
        ]);
    }
}
