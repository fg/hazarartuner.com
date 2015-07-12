<?php

namespace Application\Bundles\PostBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Category
 *
 * @ORM\Table("category")
 * @ORM\Entity
 */
class Category
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var integer
     *
     * @ORM\Column(name="post_count", type="integer", nullable=true)
     */
    private $postCount;

    /**
     * @var integer
     *
     * @ORM\Column(name="order_num", type="integer")
     */
    private $orderNum;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Category
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set postCount
     *
     * @param integer $postCount
     * @return Category
     */
    public function setPostCount($postCount)
    {
        $this->postCount = $postCount;

        return $this;
    }

    /**
     * Get postCount
     *
     * @return integer 
     */
    public function getPostCount()
    {
        return $this->postCount;
    }

    /**
     * Set orderNum
     *
     * @param integer $orderNum
     * @return Category
     */
    public function setOrderNum($orderNum)
    {
        $this->orderNum = $orderNum;

        return $this;
    }

    /**
     * Get orderNum
     *
     * @return integer 
     */
    public function getOrderNum()
    {
        return $this->orderNum;
    }

    public function __toString(){
        return $this->getName();
    }

}
