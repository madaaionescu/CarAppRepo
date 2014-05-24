<?php

namespace Mada\Bundle\CarAppBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Users
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Users extends BaseUser
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @var string
     * @Assert\NotBlank()
     * @Assert\Email()
     */
    protected $email;
    
    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=30)
     * @Assert\NotBlank()
     */
    private $name;
      /**
     * @ORM\OneToOne(targetEntity="Car", mappedBy="owner")
     **/
    private $car;
       /**
     * @ORM\OneToMany(targetEntity="RouteToUser", mappedBy="passenger")
     **/
    private $routes;
    
      /**
     * @ORM\OneToMany(targetEntity="Routes", mappedBy="owner")
     **/
    private $route;
    
      /**
     * @ORM\OneToMany(targetEntity="Feedback", mappedBy="owner")
     **/
    private $feedback;
    
    /**
     * @var string
     *
     * @ORM\Column(name="statut", type="string", length=20)
     */
    private $statut;

    /**
     * @var integer
     *
     * @ORM\Column(name="age", type="integer")
     * @Assert\Length(
     *          max = "2")
     * @Assert\GreaterThanOrEqual(
     *     value = 18, message="Nu esti major! :)")
     * @Assert\LessThan(
     *     value = 90)
     */
    private $age;
    
    /**
     * @var string 
     *
     * @ORM\Column(name="gender", type="string", length=10)
     */
    private $gender;
    
    
    /**
     * @var string 
     *
     * @Assert\Regex("/^[+0-9][0-9]{9,13}$/")
     * @ORM\Column(name="phone", type="string", length=15)
     */
    private $phone;
    

    
   // ----fosuserbundle
//     public function __construct()
//    {
//        parent::__construct();
//        // your own logic
//    }
    /// ----
    
    public function getGender() {
        return $this->gender;
    }

    public function setGender($gender) {
        $this->gender = $gender;
        return $this;
    }

    
    /**
     * Get userId
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
     * @return Users
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
     * Set statut
     *
     * @param string $statut
     * @return Users
     */
    public function setStatut($statut)
    {
        $this->statut = $statut;

        return $this;
    }

    /**
     * Get statut
     *
     * @return string 
     */
    public function getStatut()
    {
        return $this->statut;
    }

    /**
     * Set age
     *
     * @param integer $age
     * @return Users
     */
    public function setAge($age)
    {
        $this->age = $age;

        return $this;
    }

    /**
     * Get age
     *
     * @return integer 
     */
    public function getAge()
    {
        return $this->age;
    }
    
            public function getCar() {
            return $this->car;
        }

        public function getRoute() {
            return $this->route;
        }

        public function getFeedback() {
            return $this->feedback;
        }

        public function getPhone() {
            return $this->phone;
        }


        public function setCar($car) {
            $this->car = $car;
            return $this;
        }

        public function setRoute($route) {
            $this->route = $route;
            return $this;
        }

        public function setFeedback($feedback) {
            $this->feedback = $feedback;
            return $this;
        }

        public function setPhone($phone) {
            $this->phone = $phone;
            return $this;
        }

}