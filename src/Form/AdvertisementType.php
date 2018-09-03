<?php

namespace App\Form;

use App\Entity\Advertisement;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AdvertisementType extends AbstractType
{
    private $transportMode =[
        "Aérien"      => Advertisement::AIR_TRANSPORT_MODE,
        "Ferroviaire" => Advertisement::TRAIN_TRANSPORT_MODE,
        "Maritime"    => Advertisement::MARITIME_TRANSPORT_MODE,
        "Routier"     => Advertisement::ROAD_TRANSPORT_MODE,
    ];

    private $packageType =[
        "Courriels, Livres et documents" => Advertisement::DOCUMENT_TYPE,
        "Vetements et accessoires"       => Advertisement::CLOTHES_ACCESSORY_TYPE,
        "Médicaments"                    => Advertisement::MEDICINE_TYPE,
        "Objets et autres"               => Advertisement::OTHER_TYPE,
    ];


    private $weight =[
        "Inférrieur à 1kg"  => Advertisement::WEIGHT_LOWER_1,
        "Entre 1Kg et 3kg"  => Advertisement::WEIGHT_1_3,
        "Entre 3Kg et 5Kg"  => Advertisement::WEIGHT_3_5,
        "Suppérrieur à 5Kg" => Advertisement::WEIGHT_HIGHER_5,
    ];

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('transportMode', ChoiceType::class, [
                'choices' => $this->transportMode
            ])
            ->add('weight', ChoiceType::class, [
                'choices' => $this->weight
            ])
            ->add('packageType', ChoiceType::class, [
                'choices' => $this->packageType
            ])
            ->add('fromCountry')
            ->add('toCountry')
            ->add('fromCity')
            ->add('toCity')
            ->add('date')
            ->add('Description')
            ->add('price')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Advertisement::class,
        ]);
    }
}
