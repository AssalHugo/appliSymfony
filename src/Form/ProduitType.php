<?php

namespace App\Form;

use App\Entity\Distributeur;
use App\Form\ReferenceType;
use App\Form\DistributeurType;
use App\Entity\Produit;
use App\Entity\Reference;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;


class ProduitType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class, ['label' => 'Nom produit :'])
            ->add('prix', NumberType::class,['label' => 'Prix :'])
            ->add('quantite', NumberType::class, ['label' => 'Quantité :'])
            ->add('rupture', CheckboxType::class, ['label' => 'Rupture de stock ?','required' => false])
            ->add('lienImage', FileType::class, ['label' => 'Image :', 'required' => false, 'data_class' => null, 'empty_data' => 'aucune image'])
            ->add('reference', ReferenceType::class, [
                'label' => 'Référence du produit',
                "required" => false,
            ])
            ->add('distributeurs', EntityType::class, [
                'class' => Distributeur::class,
                'choice_label' => 'nom',
                'label' => 'Selection des distributeurs',
                'multiple' => true,
                'required' => false,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Produit::class,
        ]);
    }
}
