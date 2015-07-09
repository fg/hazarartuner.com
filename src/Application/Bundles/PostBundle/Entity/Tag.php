<?php

namespace Application\Bundles\PostBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Tag
 *
 * @ORM\Table("tag")
 * @ORM\Entity
 */
class Tag
{
    public function __construct(){
        $this->posts = new ArrayCollection();
    }

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
     * @ORM\ManyToMany(targetEntity="Application\Bundles\PostBundle\Entity\Post", inversedBy="tags")
     * @ORM\JoinTable(name="post_tag")
     **/
    private $posts;


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
     * @return Tag
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
     * @param  ArrayCollection $posts
     * @return Tag
     */
    public function setPosts($posts){
        $this->posts = $posts;

        return $this;
    }

    /**
     * @param Post $post
     * @return Tag
     */
    public function addPost(Post $post){
        $this->posts->add($post);

        return $this;
    }

    public function removePost(Post $post){
        $this->posts->remove($post);

        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getPosts(){
        return $this->posts;
    }

    public function __toString(){
        return $this->getName();
    }
}
