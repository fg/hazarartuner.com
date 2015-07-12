<?php
/**
 * Created by PhpStorm.
 * User: hazart
 * Date: 08/07/15
 * Time: 17:02
 */

namespace Application\Bundles\PostBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class CategoryAdmin extends Admin
{
    // Fields to be shown on create/edit forms
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('name', 'text', array("label" => "Kategori Adı"))
            ->add('order_num', 'text', array("label" => "Sıra"))
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $mapper){
        $mapper->add('name');

    }

    // Fields to be shown on lists
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('name')
        ;
    }
}