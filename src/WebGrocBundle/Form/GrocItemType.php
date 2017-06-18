<?php

namespace WebGrocBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GrocItemType extends AbstractType {
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('name')
                ->add('price', MoneyType::class, [
                    'currency' => 'CAD',
                    'required' => true,
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
