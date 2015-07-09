<?php

namespace Application\Bundles\PostBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\EventArgs;
use Doctrine\ORM\Mapping as ORM;

/**
 * Post
 *
 * @ORM\Table("post")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class Post
{
    const TYPE_REGULAR = "regular";
    const TYPE_IMAGE = "image";
    const TYPE_VIDEO = "video";
    const TYPE_SOUND = "sound";
    const TYPE_QUOTE = "quote";
    const TYPE_LINK = "link";
    const TYPE_GALLERY = "gallery";
    const TYPE_TWITTER = "twitter";

    const STATUS_ACTIVE = "active";
    const STATUS_PASSIVE = "passive";
    const STATUS_DRAFT = "passive";
    const STATUS_DELETED = "deleted";

    public static function getTypeList(){
        return [
            self::TYPE_REGULAR,
            self::TYPE_IMAGE,
            self::TYPE_VIDEO,
            self::TYPE_SOUND,
            self::TYPE_QUOTE,
            self::TYPE_LINK,
            self::TYPE_GALLERY,
            self::TYPE_TWITTER
        ];
    }

    public static function getStatusList(){
        return [
            self::STATUS_ACTIVE,
            self::STATUS_PASSIVE,
            self::STATUS_DRAFT,
            self::STATUS_DELETED
        ];
    }

    public function __construct(){
        $this->tags = new ArrayCollection();
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
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="body", type="text", nullable=true)
     */
    private $body;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=25)
     */
    private $type;

    /**
     * @var integer
     *
     * @ORM\ManyToOne(targetEntity="Application\Sonata\UserBundle\Entity\User")
     * @ORM\JoinColumn(name="author", referencedColumnName="id")
     *
     */
    private $author;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_time", type="datetime")
     */
    private $createdTime;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="last_updated_time", type="datetime")
     */
    private $lastUpdatedTime;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=25)
     */
    private $status;

    /**
     * @var integer
     *
     * @ORM\Column(name="view_count", type="integer", nullable=true)
     */
    private $viewCount;

    /**
     * @ORM\ManyToMany(targetEntity="Application\Bundles\PostBundle\Entity\Tag", mappedBy="posts")
     **/
    private $tags;


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
     * Set title
     *
     * @param string $title
     * @return Post
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set text
     *
     * @param string $body
     * @return Post
     */
    public function setBody($body)
    {
        $this->body = $body;

        return $this;
    }

    /**
     * Get text
     *
     * @return string 
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * Set type
     *
     * @param integer $type
     * @return Post
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return integer 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set author
     *
     * @param integer $author
     * @return Post
     */
    public function setAuthor($author)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author
     *
     * @return integer 
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Set createdTime
     *
     * @param \DateTime $createdTime
     * @return Post
     */
    public function setCreatedTime($createdTime)
    {
        $this->createdTime = $createdTime;

        return $this;
    }

    /**
     * Get createdTime
     *
     * @return \DateTime 
     */
    public function getCreatedTime()
    {
        return $this->createdTime;
    }

    /**
     * Set lastUpdatedTime
     *
     * @param \DateTime $lastUpdatedTime
     * @return Post
     */
    public function setLastUpdatedTime($lastUpdatedTime)
    {
        $this->lastUpdatedTime = $lastUpdatedTime;

        return $this;
    }

    /**
     * Get lastUpdatedTime
     *
     * @return \DateTime 
     */
    public function getLastUpdatedTime()
    {
        return $this->lastUpdatedTime;
    }

    /**
     * Set status
     *
     * @param integer $status
     * @return Post
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return integer 
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set viewCount
     *
     * @param integer $viewCount
     * @return Post
     */
    public function setViewCount($viewCount)
    {
        $this->viewCount = $viewCount;

        return $this;
    }

    /**
     * Get viewCount
     *
     * @return integer 
     */
    public function getViewCount()
    {
        return $this->viewCount;
    }


    /**
     * @param Tag $tag
     * @return Post
     */
    public function addTag($tag){
        $this->tags->add($tag);

        return $this;
    }

    /**
     * @param Tag $tag
     * @return Post
     */
    public function removeTag($tag){
        $this->tags->remove($tag);

        return $this;
    }

    /**
     * @param Tag[] $tags
     * @return Post
     */
    public function setTags($tags){
        $this->tags = $tags;

        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getTags(){
        return $this->tags;
    }

    /** @ORM\PrePersist() */
    public function prePersist(){
        $this->setCreatedTime(new \DateTime());
        $this->setLastUpdatedTime(new \DateTime());
    }

    /** @ORM\PreUpdate() */
    public function preUpdate(){
        $this->setLastUpdatedTime(new \DateTime());
    }
}
