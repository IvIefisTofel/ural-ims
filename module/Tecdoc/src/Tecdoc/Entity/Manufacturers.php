<?php

namespace Tecdoc\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Manufacturers
 *
 * @ORM\Table(name="lit_manufacturers")
 * @ORM\Entity
 */
class Manufacturers
{
    /**
     * @var integer
     *
     * @ORM\Column(name="mfa_id", type="smallint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $mfaId;

    /**
     * @var string
     *
     * @ORM\Column(name="mfa_brand", type="string", length=60, nullable=true)
     */
    private $mfaBrand;

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
     * Get mfaBrand
     *
     * @return string
     */
    public function getMfaBrand()
    {
        return $this->mfaBrand;
    }
}
