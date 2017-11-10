<?php


namespace AppBundle\Entity;
use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="cars")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CarsRepository")
 */

class Cars
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */ 
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Customer")
     * @ORM\JoinColumn(name="customer", referencedColumnName="id", nullable=true)
     */
    public $customer;

    /**
     * @var string
     * @ORM\Column(name="carname", type="string")
     */
    protected $carname;

    /**
     * @var string
     * @ORM\Column(name="carmodel", type="string")
     */
    protected $carmodel;

    /**
     * @var string
     * @ORM\Column(name="is_deleted", type="string",columnDefinition="ENUM('Yes','No')")
     */
    protected $isDeleted;
    
    /**
     * @var \DateTime
     * @ORM\Column(name="created_dt", type="datetime", nullable=true)
     */
    protected $createdat;

    /**
     * @var \DateTime
     * @ORM\Column(name="updated_dt", type="datetime", nullable=true)
     */
    protected $updatedat;
          

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
     * Set carname
     *
     * @param string $carname
     *
     * @return Cars
     */
    public function setCarname($carname)
    {
        $this->carname = $carname;

        return $this;
    }

    /**
     * Get carname
     *
     * @return string
     */
    public function getCarname()
    {
        return $this->carname;
    }

    /**
     * Set carmodel
     *
     * @param string $carmodel
     *
     * @return Cars
     */
    public function setCarmodel($carmodel)
    {
        $this->carmodel = $carmodel;

        return $this;
    }

    /**
     * Get carmodel
     *
     * @return string
     */
    public function getCarmodel()
    {
        return $this->carmodel;
    }

    /**
     * Set isDeleted
     *
     * @param string $isDeleted
     *
     * @return Cars
     */
    public function setIsDeleted($isDeleted)
    {
        $this->isDeleted = $isDeleted;

        return $this;
    }

    /**
     * Get isDeleted
     *
     * @return string
     */
    public function getIsDeleted()
    {
        return $this->isDeleted;
    }

    /**
     * Set createdat
     *
     * @param \DateTime $createdat
     *
     * @return Cars
     */
    public function setCreatedat($createdat)
    {
        $this->createdat = $createdat;

        return $this;
    }

    /**
     * Get createdat
     *
     * @return \DateTime
     */
    public function getCreatedat()
    {
        return $this->createdat;
    }

    /**
     * Set updatedat
     *
     * @param \DateTime $updatedat
     *
     * @return Cars
     */
    public function setUpdatedat($updatedat)
    {
        $this->updatedat = $updatedat;

        return $this;
    }

    /**
     * Get updatedat
     *
     * @return \DateTime
     */
    public function getUpdatedat()
    {
        return $this->updatedat;
    }

    /**
     * Set customer
     *
     * @param \AppBundle\Entity\customer $customer
     *
     * @return Cars
     */
    public function setCustomer(\AppBundle\Entity\customer $customer = null)
    {
        $this->customer = $customer;

        return $this;
    }

    /**
     * Get customer
     *
     * @return \AppBundle\Entity\customer
     */
    public function getCustomer()
    {
        return $this->customer;
    }
}
