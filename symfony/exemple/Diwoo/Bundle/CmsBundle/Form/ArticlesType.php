<?php

namespace Diwoo\Bundle\CmsBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class ArticlesType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, array('label'=>'Titre :'))
            //->add('date', 'datetime')
            ->add('content', TextareaType::class, array('label'=>'Contenu :'))
            ->add('picture', FileType::class, array('label'=>'Image :'))
            ->add('auteur', EntityType::class, array('class' => 'DiwooCmsBundle:Auteurs',
                'choice_label' => 'login',))
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Diwoo\Bundle\CmsBundle\Entity\Articles'
        ));
    }
}
