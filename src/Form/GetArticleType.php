<?php

namespace App\Form;

use App\Entity\MaterialsInWarehouse;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GetArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Amount', null, ['label' => 'Ilość'])
            ->add('VAT', null, ['label' => 'VAT'])
            ->add('UnitPrice', null, ['label' => 'Cena jednostkowa'])
            ->add('WareHouse', null, ['label' => 'Magazyn'])
            ->add('Article', null, ['label' => 'Artykuł'])
            ->add('Zatwierdź', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => MaterialsInWarehouse::class,
        ]);
    }
}
