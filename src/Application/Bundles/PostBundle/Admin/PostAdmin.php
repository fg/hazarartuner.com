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
        $author = $this->getConfigurationPool()->getContainer()->get('security.token_storage')->getToken()->getUser();

        $formMapper
            ->add('title', 'text', array('label' => 'Başlık'))
            ->add('body', 'textarea', array('label' => 'İçerik'))
            ->add('author', 'hidden', array('data' => $author->getId()))
            ->add('type', 'choice', array(
                'choices' => $this->typeList
            ))
            ->add('createdTime', null, array('data' => new \DateTime()))
            ->add('lastUpdatedTime', null, array('data' => new \DateTime()))
            ->add('body') //if no type is specified, SonataAdminBundle tries to guess it
            ->add('status', 'choice', array(
                'choices' => $this->statusList
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
}