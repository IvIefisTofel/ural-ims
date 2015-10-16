<?php

namespace Tecdoc\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Models
 *
 * @ORM\Table(name="lit_models")
 * @ORM\Entity
 */
class Models
{
    /**
     * @var integer
     *
     * @ORM\Column(name="mod_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $modId;

    /**
     * @var integer
     *
     * @ORM\Column(name="mod_mfa_id", type="smallint", nullable=true)
     */
    private $mfaId;

    /**
     * @var string
     *
     * @ORM\Column(name="mod_name", type="text", nullable=true)
     */
    private $modName;

    /**
     * @var integer
     *
     * @ORM\Column(name="mod_pcon_start", type="integer", nullable=true)
     */
    private $pconStart;

    /**
     * @var integer
     *
     * @ORM\Column(name="mod_pcon_end", type="integer", nullable=true)
     */
    private $pconEnd;

    /**
     * Get modId
     *
     * @return integer
     */
    public function getModId()
    {
        return $this->modId;
    }

    /**
     * Get mfaId
     *
     * @return integer
     */
    public function getMfaId()
    {
        return $this->mfaId;
    }

    /**
     * Get modName
     *
     * @return string
     */
    public function getModName()
    {
        return $this->modName;
    }

    /**
     * Get pconStart
     *
     * @return string
     */
    public function getPconStart()
    {
        if ($this->pconStart !== null)
            return substr($this->pconStart,4).".".substr($this->pconStart,0,4);
        else
            return null;
    }

    /**
     * Get pconEnd
     *
     * @return string
     */
    public function getPconEnd()
    {
        if ($this->pconEnd !== null)
            return substr($this->pconEnd,4).".".substr($this->pconEnd,0,4);
        else
            return null;
    }
}
