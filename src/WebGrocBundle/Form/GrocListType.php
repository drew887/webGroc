<?php

namespace WebGrocBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GrocListType extends AbstractType {
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('weekDate');

        $builder->add('items', CollectionType::class, [
            'entry_type'   => GrocItemType::class,
            'by_reference' => false,
            'allow_add'    => true,
            'allow_delete' => true,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults([
            'data_class' => 'WebGrocBundle\Entity\GrocList',
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix() {
        return 'webgrocbundle_groclist';
    }


}
