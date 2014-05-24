<?php

namespace Mada\Bundle\CarAppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Car
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Mada\Bundle\CarAppBundle\Entity\CarRepository")
 */
class Car
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="model", type="string", length=25)
     */
    private $model;

    /**
     * @var string
     *
     * @ORM\Column(name="colour", type="string", length=15)
     */
    private $colour;

    /**
     * @var integer
     *
     * @ORM\Column(name="seatsNumber", type="integer")
     */
    private $seatsNumber;
     /**
     * @var string
     *
     * @ORM\Column(name="anFabricatie", type="string", length=4)
     */
    private $anfabricatie;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="ownerId", type="integer")
     */
    private $ownerId;
      /**
     * @ORM\OneToOne(targetEntity="Users", inversedBy="car")
     * @ORM\JoinColumn(name="ownerId", referencedColumnName="id")
     **/
    private $owner;
    
    public function getAnfabricatie() {
        return $this->anfabricatie;
    }

    public function setAnfabricatie($anfabricatie) {
        $this->anfabricatie = $anfabricatie;
        return $this;
    }

        /**
     * Get carId
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set model
     *
     * @param string $model
     * @return Car
     */
    public function setModel($model)
    {
        $this->model = $model;

        return $this;
    }

    /**
     * Get model
     *
     * @return string 
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * Set colour
     *
     * @param string $colour
     * @return Car
     */
    public function setColour($colour)
    {
        $this->colour = $colour;

        return $this;
    }

    /**
     * Get colour
     *
     * @return string 
     */
    public function getColour()
    {
        return $this->colour;
    }

    /**
     * Set seatsNumber
     *
     * @param integer $seatsNumber
     * @return Car
     */
    public function setSeatsNumber($seatsNumber)
    {
        $this->seatsNumber = $seatsNumber;

        return $this;
    }

    /**
     * Get seatsNumber
     *
     * @return integer 
     */
    public function getSeatsNumber()
    {
        return $this->seatsNumber;
    }
}
