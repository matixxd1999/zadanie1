<?php

namespace App\Form;

use App\Entity\Articles;
use App\Entity\MaterialsInWarehouse;
use App\Entity\WareHouses;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReleaseArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Amount', NumberType::class, ['label' => 'Ilość'])
            ->add('WareHouse', EntityType::class, [
                'label' => 'Magazyn',
                'class' => WareHouses::class,
                'query_builder' => function (EntityRepository $er) use ($options) {
                    return $er->UsersWarehouse($options['idUser']);
                }
            ])

            ->add('Article', EntityType::class, [
                'class' => Articles::class,
                'label' => 'Artykuł',
                'required' => true
            ])
            ->add('Zatwierdź', SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => MaterialsInWarehouse::class,
            'idUser' => null,
        ]);
    }
}
