<?php

namespace App\Form;

use App\Entity\Pers;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class NewPersType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('fam')
            ->add('im')
            ->add('ot')
            ->add('DR', DateType::class, [
    'input' => 'datetime',
	'widget' => 'single_text',
    // this is actually the default format for single_text
   // 'attr' => ['class' => 'js-datepicker'],
	'format' => 'dd.MM.yyyy',
	'html5' => false
])
            ->add('passportS')
            ->add('passportN')
            ->add('passportD', DateType::class, [
    'input' => 'datetime',
	'widget' => 'single_text',
	//'attr' => ['class' => 'js-datepicker'],
	'format' => 'dd.MM.yyyy',
	'html5' => false,
	'required' => false
])
            ->add('passportBy')
            ->add('INN')
            ->add('employeeNum')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Pers::class,
        ]);
    }
}
