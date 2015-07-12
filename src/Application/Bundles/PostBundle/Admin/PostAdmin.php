<?php
/**
 * Created by PhpStorm.
 * User: hazart
 * Date: 06/07/15
 * Time: 15:19
 */

namespace Application\Bundles\PostBundle\Admin;

use Application\Bundles\PostBundle\Entity\Post;
use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class PostAdmin extends Admin
{
    private $typeList = [];
    private $statusList = [];

    public function __construct($code, $class, $baseControllerName){
        parent::__construct($code, $class, $baseControllerName);

        foreach(Post::getTypeList() as $type){
            $this->typeList[$type] = $type;
        }

        foreach(Post::getStatusList() as $status){
            $this->statusList[$status] = $status;
        }
    }

    // Fields to be shown on create/edit forms
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('image', 'sonata_media_type', array(
                'provider' => 'sonata.media.provider.image',
                'required' => false
            ))
            ->add('title', 'text', array('label' => 'Başlık'))
            ->add('body', 'textarea', array('label' => 'İçerik'))
            ->add('type', 'choice', array(
                'choices' => $this->typeList
            ))
            ->add('body')
            ->add('status', 'choice', array(
                'choices' => $this->statusList
            ))
            ->end()
            ->with("Etiketler")
            ->add('tags', 'sonata_type_model', array(
                'multiple' => true,
                'expanded' => true,
                'label' => ''
            ))
        ;
    }

    // Fields to be shown on filter forms
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('title')
            ->add('author')
        ;
    }

    // Fields to be shown on lists
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('title')
            ->add('author')
        ;
    }

    public function prePersist($post){
        $author = $this->getConfigurationPool()->getContainer()->get('security.token_storage')->getToken()->getUser();

        $post->setAuthor($author);
    }
}