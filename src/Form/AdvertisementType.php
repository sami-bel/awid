<?php

namespace App\Form;

use App\Entity\Advertisement;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Intl\Intl;
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

//            ->add('transportMode', ChoiceType::class, [
//                'choices' => $this->transportMode,
//                'label' => false,
//            ])
//            ->add('weight', ChoiceType::class, [
//                'choices' => $this->weight,
//                'label' => false,
//            ])
//            ->add('packageType', ChoiceType::class, [
//                'choices' => $this->packageType,
//                'label' => false,
//            ])
            ->add('fromCountry',ChoiceType::class, [
                'choices' => array_combine(array_values(Intl::getRegionBundle()->getCountryNames()),array_keys(Intl::getRegionBundle()->getCountryNames())),
                'label' => false,
            ])
            ->add('fromCity',null, array(
                'label' => false,

                'attr' =>[
                    'placeholder'=> 'Ville'
                ]))
            ->add('toCountry',ChoiceType::class, [
                'choices' => array_combine(array_values(Intl::getRegionBundle()->getCountryNames()),array_keys(Intl::getRegionBundle()->getCountryNames())),
                'attr' =>[
                    'placeholder'=> 'Titre'
                ],
                'label' => false
            ])

            ->add('toCity',null, array(
                'label' => false,

                'attr' =>[
                    'placeholder'=> 'Ville'
                ]))
            ->add('date',DateType::class, array(
                'label' => false,
                'widget' => 'single_text',
                'attr' =>[
                    'placeholder'=> 'Titre'
                ]))
            ->add('description',TextareaType::class, array(
                'label' => false,

                'attr' =>[
                    'placeholder'=> 'Description'
                ]))

            ->add('save', SubmitType::class, array())
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Advertisement::class,
        ]);
    }
}
