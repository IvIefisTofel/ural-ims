<?php

namespace Settings\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Settings
 *
 * @ORM\Table(name="lit_settings")
 * @ORM\Entity
 */
class Settings
{
    /**
     * @var integer
     *
     * @ORM\Column(name="settingID", type="integer", precision=0, scale=0, nullable=false, unique=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $settingID;

    /**
     * @var integer
     *
     * @ORM\Column(name="groupID", type="integer", precision=0, scale=0, nullable=false, unique=false)
     */
    private $groupID;

    /**
     * @var string
     *
     * @ORM\Column(name="headerName", type="string", length=255, precision=0, scale=0, nullable=false, unique=false)
     */
    private $headerName;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, precision=0, scale=0, nullable=false, unique=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="value", type="text", precision=0, scale=0, nullable=false, unique=false)
     */
    private $value;

    /**
     * @var string
     *
     * @ORM\Column(name="htmlControlType", type="string", length=255, precision=0, scale=0, nullable=false, unique=false)
     */
    private $htmlControlType;

    /**
     * @var integer
     *
     * @ORM\Column(name="weight", type="integer", precision=0, scale=0, nullable=false, unique=false)
     */
    private $weight;


    /**
     * Get settingID
     *
     * @return integer
     */
    public function getSettingID()
    {
        return $this->settingID;
    }

    /**
     * Set groupID
     *
     * @param integer $groupID
     * @return Settings
     */
    public function setGroupID($groupID)
    {
        $this->groupID = $groupID;

        return $this;
    }

    /**
     * Get groupID
     *
     * @return integer
     */
    public function getGroupID()
    {
        return $this->groupID;
    }

    /**
     * Set headerName
     *
     * @param string $headerName
     * @return Settings
     */
    public function setHeaderName($headerName)
    {
        $this->headerName = $headerName;

        return $this;
    }

    /**
     * Get headerName
     *
     * @return string
     */
    public function getHeaderName()
    {
        return $this->headerName;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Settings
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
     * Set value
     *
     * @param string $value
     * @return Settings
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get value
     *
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set htmlControlType
     *
     * @param string $htmlControlType
     * @return Settings
     */
    public function setHtmlControlType($htmlControlType)
    {
        $this->htmlControlType = $htmlControlType;

        return $this;
    }

    /**
     * Get htmlControlType
     *
     * @return string
     */
    public function getHtmlControlType()
    {
        return $this->htmlControlType;
    }

    /**
     * Set weight
     *
     * @param integer $weight
     * @return Settings
     */
    public function setWeight($weight)
    {
        $this->weight = $weight;

        return $this;
    }

    /**
     * Get weight
     *
     * @return integer
     */
    public function getWeight()
    {
        return $this->weight;
    }
}
