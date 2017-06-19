<?php

namespace WebGrocBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * GrocItem
 *
 * @ORM\Table(name="groc_item")
 * @ORM\Entity(repositoryClass="WebGrocBundle\Repository\GrocItemRepository")
 */
class GrocItem
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(name="name", type="string", length=255, unique=true)
     * @Assert\NotBlank()
     * @Assert\Length(max=255)
     */
    private $name;

    /**
     * @var float
     * @ORM\Column(name="price", type="decimal", precision=10, scale=2)
     * @Assert\Range(min=0, max=99999999)
     */
    private $price;

    /**
     * @ORM\ManyToOne(targetEntity="GrocType")
     * @ORM\JoinColumn(name="type_id", referencedColumnName="id")
     * @var GrocType $type
     */
    protected $type;

    /**
     * GrocItem constructor.
     */
    public function __construct() {
        $this->price = 0.0;
    }


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return GrocItem
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
     * Set price
     *
     * @param string $price
     *
     * @return GrocItem
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return string
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set type
     *
     * @param GrocType $type
     *
     * @return GrocItem
     */
    public function setType(GrocType $type = null)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return GrocType
     */
    public function getType()
    {
        return $this->type;
    }
}
