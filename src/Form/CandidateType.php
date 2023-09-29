<?php

namespace App\Form;

use App\Entity\Candidate;
use App\Entity\Category;
use App\Entity\Experience;
use App\Entity\Gender;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CandidateType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstName', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                ],
                'label' => 'First name'
            ])
            ->add('lastName', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                ],
                'label' => 'Last name'
            ])
            ->add('adress', TextType::class, [
                'label' => 'Address'
            ])
            ->add('country', TextType::class, [
                'label' => 'Country'
            ])
            ->add('nationality', TextType::class, [
                'label' => 'Nationality'
            ])
            ->add('currentLocation', TextType::class, [
                'label' => 'Current Location'
            ])
            ->add('birthAt', DateType::class, [
                'widget' => 'single_text',
                // 'html5' => false,
                'label' => 'Birthdate',
                'attr' => [
                    'class' => 'datepicker'
                ],
                'required' => false,
                'input' => 'datetime_immutable'
            ])
            ->add('placeOfBirth', TextType::class, [
                'label' => 'Birthplace'
            ])
            // ->add('isAvailable')
            ->add('shortDescription', TextareaType::class, [
                'label' => 'Short description for your profile, as well as more personnal informations (e.g. your hobbies/interests ). You can also paste any link you want.
                ',
                'attr' => [
                    'class' => 'materialize-textarea',
                    'cols' => 50,
                    'rows' => 10
                ]
            ])
            ->add('gender', EntityType::class, [
                'class' => Gender::class,
                'choice_label' => 'name'
            ])
            // ->add('passportFile')
            // ->add('curriculumVitae')
            // ->add('profilPicture')
            ->add('category', EntityType::class, [
                'class' => Category::class,
                'choice_label' => 'name',
            ])
            ->add('experience', EntityType::class, [
                'class' => Experience::class,
                'choice_label' => 'experience',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Candidate::class,
        ]);
    }
}
