<?php

namespace Mada\Bundle\CarAppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Routes
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Mada\Bundle\CarAppBundle\Entity\RoutesRepository")
 */
class Routes
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
     * @var float
     *
     * @ORM\Column(name="latStart", type="float")
     */
    private $latStart;

    /**
     * @var float
     *
     * @ORM\Column(name="longStart", type="float")
     */
    private $longStart;

    /**
     * @var float
     *
     * @ORM\Column(name="latStop", type="float")
     */
    private $latStop;

    /**
     * @var float
     *
     * @ORM\Column(name="longStop", type="float")
     */
    private $longStop;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateCreated", type="date")
     */
    private $dateCreated;

    /**
     * @var integer
     *
     * @ORM\Column(name="ownerId", type="integer")
     */
    private $ownerId;
    
        /**
     * @var string
     *
     * @ORM\Column(name="startLocation", type="string")
     */
    private $startLocation;
 
      /**
     * @var string
     *
     * @ORM\Column(name="endLocation", type="string")
     */
    private $endLocation;
    
   

              /**
     * @ORM\ManyToOne(targetEntity="Users", inversedBy="route")
     * @ORM\JoinColumn(name="ownerId", referencedColumnName="id")
     **/
    private $owner;
    
    public function getOwner() {
        return $this->owner;
    }

    public function getPassanger() {
        return $this->passanger;
    }

    public function setOwner($owner) {
        $this->owner = $owner;
        return $this;
    }

    public function setPassanger($passanger) {
        $this->passanger = $passanger;
        return $this;
    }

        /**
     * @var integer
     *
     * @ORM\Column(name="seatsAvailable", type="integer")
     */
    private $seatsAvailable;

        /**
     * @ORM\OneToMany(targetEntity="RouteToUser", mappedBy="routes")
     **/
    private $passanger;

    
    public function __construct()
    {
        $this->dateCreated = new \DateTime();
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
     * Set latStart
     *
     * @param float $latStart
     * @return Routes
     */
    public function setLatStart($latStart)
    {
        $this->latStart = $latStart;

        return $this;
    }

    /**
     * Get latStart
     *
     * @return float 
     */
    public function getLatStart()
    {
        return $this->latStart;
    }

    /**
     * Set longStart
     *
     * @param float $longStart
     * @return Routes
     */
    public function setLongStart($longStart)
    {
        $this->longStart = $longStart;

        return $this;
    }

    /**
     * Get longStart
     *
     * @return float 
     */
    public function getLongStart()
    {
        return $this->longStart;
    }

    /**
     * Set latStop
     *
     * @param float $latStop
     * @return Routes
     */
    public function setLatStop($latStop)
    {
        $this->latStop = $latStop;

        return $this;
    }

    /**
     * Get latStop
     *
     * @return float 
     */
    public function getLatStop()
    {
        return $this->latStop;
    }

    /**
     * Set longStop
     *
     * @param float $longStop
     * @return Routes
     */
    public function setLongStop($longStop)
    {
        $this->longStop = $longStop;

        return $this;
    }

    /**
     * Get longStop
     *
     * @return float 
     */
    public function getLongStop()
    {
        return $this->longStop;
    }

    /**
     * Set dateCreated
     *
     * @param \DateTime $dateCreated
     * @return Routes
     */
    public function setDateCreated($dateCreated)
    {
        $this->dateCreated = $dateCreated;

        return $this;
    }

    /**
     * Get dateCreated
     *
     * @return \DateTime 
     */
    public function getDateCreated()
    {
        return $this->dateCreated;
    }

    /**
     * Set ownerId
     *
     * @param integer $ownerId
     * @return Routes
     */
    public function setOwnerId($ownerId)
    {
        $this->ownerId = $ownerId;

        return $this;
    }

    /**
     * Get ownerId
     *
     * @return integer 
     */
    public function getOwnerId()
    {
        return $this->ownerId;
    }

    /**
     * Set seatsAvailable
     *
     * @param integer $seatsAvailable
     * @return Routes
     */
    public function setSeatsAvailable($seatsAvailable)
    {
        $this->seatsAvailable = $seatsAvailable;

        return $this;
    }

    /**
     * Get seatsAvailable
     *
     * @return integer 
     */
    public function getSeatsAvailable()
    {
        return $this->seatsAvailable;
    }
    
     public function getEndLocation() {
        return $this->endLocation;
    }

    public function setEndLocation($endLocation) {
        $this->endLocation = $endLocation;
        return $this;
    }
    public function getStartLocation() {
        return $this->startLocation;
    }

    public function setStartLocation($startLocation) {
        $this->startLocation = $startLocation;
        return $this;
    }
    
}
