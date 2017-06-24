<?php

namespace WebGrocBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Workflow\Event\Event;

class GrocListType extends AbstractType {
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('weekDate');

        $builder->addEventListener(FormEvents::PRE_SET_DATA, [$this, 'preSetData']);
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

    public function preSetData(FormEvent $event) {
        $list = $event->getData();
        $form = $event->getForm();

        if ($list->getId() !== null) {
            $form->add('items', CollectionType::class, [
                'entry_type'   => GrocItemType::class,
                'by_reference' => false,
                'allow_add'    => true,
                'allow_delete' => true,
            ]);
        }
    }
}
