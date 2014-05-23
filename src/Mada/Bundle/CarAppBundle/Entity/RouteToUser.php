<?php

namespace Mada\Bundle\CarAppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * RouteToUser
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Mada\Bundle\CarAppBundle\Entity\RouteToUserRepository")
 */
class RouteToUser
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
     * @ORM\Column(name="routeId", type="integer")
     */
    private $routeId;
    
    /**
     * @ORM\ManyToOne(targetEntity="Routes",inversedBy="passanger")
     * @ORM\JoinColumn(name="routeId", referencedColumnName="id")
     **/
    private $routes;


    /**
     * @var integer
     *
     * @ORM\Column(name="userId", type="integer")
     */
    private $userId;
    /**
     * @ORM\ManyToOne(targetEntity="Users", inversedBy="routes")
     * @ORM\JoinColumn(name="userId", referencedColumnName="id")
     **/
    private $passenger;
    

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
     * Set routeId
     *
     * @param integer $routeId
     * @return RouteToUser
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

    /**
     * Set userId
     *
     * @param integer $userId
     * @return RouteToUser
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * Get userId
     *
     * @return integer 
     */
    public function getUserId()
    {
        return $this->userId;
    }
}
