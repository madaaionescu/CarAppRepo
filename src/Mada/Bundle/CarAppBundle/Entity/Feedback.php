<?php

namespace Mada\Bundle\CarAppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Feedback
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Mada\Bundle\CarAppBundle\Entity\FeedbackRepository")
 */
class Feedback
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
     * @var integer
     *
     * @ORM\Column(name="rating", type="integer")
     * @Assert\Range(
     *          min = 0,
     *          max = 5,
     *          minMessage = "Valoare minima: 0",
     *          maxMessage = "Valoare maxima: 5")
     * @Assert\NotBlank(message="Trebuie sa dati un rating intre 0 si 5!")
     */
    private $rating;

    /**
     * @var string
     *
     * @ORM\Column(name="comment", type="text")
     */
    private $comment;

    /**
     * @var integer
     *
     * @ORM\Column(name="routeId", type="integer")
     */
    private $routeId;
    
     /**
     * @var integer
     *
     * @ORM\Column(name="ownerId", type="integer")
     */
    private $ownerId;
    /**
     * @ORM\ManyToOne(targetEntity="Users", inversedBy="feedback")
     * @ORM\JoinColumn(name="ownerId", referencedColumnName="id")
     **/
    private $owner;

    public function __construct($route) {
        $this->routeId = $route;
    }
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
     * Set rating
     *
     * @param integer $rating
     * @return Feedback
     */
    public function setRating($rating)
    {
        $this->rating = $rating;

        return $this;
    }

    /**
     * Get rating
     *
     * @return integer 
     */
    public function getRating()
    {
        return $this->rating;
    }

    /**
     * Set comment
     *
     * @param string $comment
     * @return Feedback
     */
    public function setComment($comment)
    {
        $this->comment = $comment;

        return $this;
    }

    /**
     * Get comment
     *
     * @return string 
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * Set routeId
     *
     * @param integer $routeId
     * @return Feedback
     */
    public function setRouteId($routeId)
    {
        $this->routeId = $routeId;

        return $this;
    }

    /**
     * Get routeId
     *
     * @return integer 
     */
    public function getRouteId()
    {
        return $this->routeId;
    }
    
    public function getOwner() {
        return $this->owner;
    }

    public function setOwner($owner) {
        $this->owner = $owner;
        return $this;
    }
    
    public function getOwnerId() {
        return $this->ownerId;
    }

    public function setOwnerId($ownerId) {
        $this->ownerId = $ownerId;
        return $this;
    }
}
