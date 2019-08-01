<?php
namespace User\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="default_configuration")
 */

class DefaultConfiguration
{
	/**
	 * @ORM\Id
	 * @ORM\GeneratedValue
	 * @ORM\column(name="id")
	 */
	private $id ;


	/**
	 * @ORM\column(name="option_name")
	 */
	private $optionName;


	/**
	 * @ORM\column(name="option_value")
	 */
	private $optionValue;


	/**
	 * @ORM\column(name="date_updated")
	 */
	private $dateUpdated;

    /**
     * @ORM\column(name="option_label")
     */
    private $optionLabel;


    /**
     * @ORM\column(name="option_value_one")
     */
    private $optionValueOne;

    /**
     * @ORM\column(name="option_value_two")
     */
    private $optionValueTwo;


    /**
     * @ORM\column(name="option_description")
     */
    private $optionDescription;



    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getOptionName()
    {
        return $this->optionName;
    }

    /**
     * @param mixed $optionName
     *
     * @return self
     */
    public function setOptionName($optionName)
    {
        $this->optionName = $optionName;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getOptionValue()
    {
        return $this->optionValue;
    }

    /**
     * @param mixed $optionValue
     *
     * @return self
     */
    public function setOptionValue($optionValue)
    {
        $this->optionValue = $optionValue;

        return $this;
    }

    public function getOptionLabel()
    {
        return $this->optionLabel;
    }

    public function setOptionLabel($optionLabel)
    {
        $this->optionLabel = $optionLabel;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDateUpdated()
    {
        return $this->dateUpdated;
    }

    /**
     * @param mixed $dateUpdated
     *
     * @return self
     */
    public function setDateUpdated($dateUpdated)
    {
        $this->dateUpdated = $dateUpdated;

        return $this;
    }

    public function getOptionValueOne()
    {
        return $this->optionValueOne;
    }

    public function setOptionValueOne($optionValueOne)
    {
        $this->optionValueOne = $optionValueOne;
        return $this;
    }

        public function getOptionValueTwo()
    {
        return $this->optionValueTwo;
    }

    public function setOptionValueTwo($optionValueTwo)
    {
        $this->optionValueTwo = $optionValueTwo;
        return $this;
    }

    public function getOptionDescription()
    {
        return $this->optionDescription;
    }

    public function setOptionDescription($optionDescription)
    {
        $this->optionDescription = $optionDescription;
        return $this;
    }
}