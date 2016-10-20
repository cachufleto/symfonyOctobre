<?php
namespace Sami\Bundle\BlogBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class UsersType extends AbstractType
{
    public function buildForm(FormBuilderInterface $objetDeTypeFormBuilder, array $options)
    {
      // paramétrage du formulaire
      $objetDeTypeFormBuilder->add('username', \Symfony\Component\Form\Extension\Core\Type\TextType::class, array('label' => 'Nom d\'utilisateur :'));
      $objetDeTypeFormBuilder->add('password', \Symfony\Component\Form\Extension\Core\Type\PasswordType::class, array('label' => 'Mot de passe :'));
      $objetDeTypeFormBuilder->add('email', \Symfony\Component\Form\Extension\Core\Type\EmailType::class, array('label' => 'Adresse de courriel :'));
      // exemple d'utilisation d'entité comme source de données pour alimenter une liste de selection
      /* N'a pas d'utilité dans le cas de la création d'utilisateur...
      $objetDeTypeFormBuilder->add('posts', \Symfony\Bridge\Doctrine\Form\Type\EntityType::class, array(
        'class' => 'SamiBlogBundle:Posts',
        'choice_label' => 'title',
        'query_builder' => function(\Doctrine\ORM\EntityRepository $entityRepository){
          $objetDeTypeQueryBuilder = $entityRepository->createQueryBuilder('reqSQL');
          $objetDeTypeQueryBuilder->where('reqSQL.title LIKE :texte');
          $objetDeTypeQueryBuilder->setParameter('texte', '%art%');
          return $objetDeTypeQueryBuilder;
        }
      ));
      */
      $objetDeTypeFormBuilder->add('create', \Symfony\Component\Form\Extension\Core\Type\SubmitType::class, array('label' => 'Créér'));
    }
}
?>