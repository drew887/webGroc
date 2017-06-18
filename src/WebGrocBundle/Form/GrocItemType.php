<?php

namespace WebGrocBundle\Form;

use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use WebGrocBundle\Entity\GrocType;

class GrocItemType extends AbstractType {
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('name')
                ->add('price', MoneyType::class, [
                    'currency' => 'CAD',
                    'required' => true,
                ])
                ->add('type', EntityType::class, [
                    'required'     => true,
                    'class'        => GrocType::class,
                    'choice_label' => 'name',
                ]);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults([
            'data_class' => 'WebGrocBundle\Entity\GrocItem',
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix() {
        return 'webgrocbundle_grocitem';
    }


}
