<?php

namespace AuthDoctrine\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

use Zend\Form\Annotation;

/**
 * Users
 *
 * @ORM\Table(name="users")
 * @ORM\Entity(repositoryClass="AuthDoctrine\Entity\Repository\UserRepository")
 * @Annotation\Name("user")
 * @Annotation\Hydrator("Zend\Stdlib\Hydrator\ClassMethods")
 */
class User
{
    const ADMIN_ROLE     = 1;
    const MODERATOR_ROLE = 2;
    const USER_ROLE      = 3;
    const GUEST_ROLE     = 4;

    public static $ROLE_NAME = array(
        1 => 'admin',
        2 => 'moderator',
        3 => 'user',
        4 => 'guest',
    );

    public static $ROLE_LABEL = array(
        1 => 'Администратор',
        2 => 'Модератор',
        3 => 'Пользователь',
        4 => 'Гость',
    );

    /**
     * @var integer
     *
     * @ORM\Column(name="usr_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @Annotation\Exclude()
     */
    private $usrId;

    /**
     * @var string
     *
     * @ORM\Column(name="usr_name", type="string", length=100, nullable=false)
	 * @Annotation\Filter({"name":"StringTrim"})
     * @Annotation\Validator({"name":"StringLength", "options":{"min":1, "max":30}})
     * @Annotation\Validator({"name":"Regex", "options":{"pattern":"/^[a-zA-Z][a-zA-Z0-9_-]{0,24}$/"}})
     * @Annotation\Attributes({"type":"text"})
     * @Annotation\Options({"label":"Username:"})	 
     */
    private $usrName;

    /**
     * @var string
     *
     * @ORM\Column(name="usr_password", type="string", length=100, nullable=false)
     * @Annotation\Attributes({"type":"password"})
     * @Annotation\Options({"label":"Password:"})	
     */
    private $usrPassword;

    /**
     * @var string
     *
     * @ORM\Column(name="usr_email", type="string", length=60, nullable=false)
	 * @Annotation\Type("Zend\Form\Element\Email")
     * @Annotation\Options({"label":"Your email address:"})
     */
    private $usrEmail;

    /**
     * @var integer
     *
     * @ORM\Column(name="usr_Role", type="integer", nullable=false)
	 * @ORM\JoinColumn(name="usr_Role", referencedColumnName="usr_Role")
	 * @Annotation\Type("Zend\Form\Element\Select")
	 * @Annotation\Options({
	 * "label":"User Role:",
	 * "value_options":{ "0":"Admin", "1":"Moderator", "2": "User"}})
     */
    private $usrRole;

    /**
     * @var boolean
     *
     * @ORM\Column(name="usr_active", type="boolean", nullable=false)
	 * @Annotation\Type("Zend\Form\Element\Radio")
	 * @Annotation\Options({
	 * "label":"User Active:",
	 * "value_options":{"1":"Yes", "0":"No"}})
     */
    private $usrActive;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="usr_registration_date", type="datetime", nullable=true)
     * @Annotation\Attributes({"type":"datetime","min":"2010-01-01T00:00:00Z","max":"2020-01-01T00:00:00Z","step":"1"})
     * @Annotation\Options({"label":"Registration Date:", "format":"Y-m-d\TH:iP"})
     */
    private $usrRegistrationDate; // = '2013-07-30 00:00:00'; // new \DateTime() - coses synatx error
	
    /**
     * @var boolean
     *
     * @ORM\Column(name="usr_email_confirmed", type="boolean", nullable=false)
	 * @Annotation\Type("Zend\Form\Element\Radio")
	 * @Annotation\Options({
	 * "label":"User confirmed email:",
	 * "value_options":{"1":"Yes", "0":"No"}})
     */
    private $usrEmailConfirmed;

    /**
     * Get usrId
     *
     * @return integer
     */
    public function getUsrId()
    {
        return $this->usrId;
    }

	public function __construct()
	{
		$this->usrRegistrationDate = new \DateTime();
	}
	
    /**
     * Set usrName
     *
     * @param string $usrName
     * @return Users
     */
    public function setUsrName($usrName)
    {
        $this->usrName = $usrName;
    
        return $this;
    }

    /**
     * Get usrName
     *
     * @return string 
     */
    public function getUsrName()
    {
        return $this->usrName;
    }

    /**
     * Set usrPassword
     *
     * @param string $usrPassword
     * @return Users
     */
    public function setUsrPassword($usrPassword)
    {
        $this->usrPassword = $usrPassword;
    
        return $this;
    }

    /**
     * Get usrPassword
     *
     * @return string 
     */
    public function getUsrPassword()
    {
        return $this->usrPassword;
    }

    /**
     * Set usrEmail
     *
     * @param string $usrEmail
     * @return Users
     */
    public function setUsrEmail($usrEmail)
    {
        $this->usrEmail = $usrEmail;
    
        return $this;
    }

    /**
     * Get usrEmail
     *
     * @return string 
     */
    public function getUsrEmail()
    {
        return $this->usrEmail;
    }

    /**
     * Set usrRole
     *
     * @param integer $usrRole
     * @return Users
     */
    public function setUsrRoleId($usrRole)
    {
        $this->usrRole = $usrRole;
    
        return $this;
    }

    /**
     * Get usrRole
     *
     * @return integer
     */
    public function getUsrRoleId()
    {
        return $this->usrRole;
    }

    /**
     * @return string
     */
    public function getUsrRoleName()
    {
        return self::$ROLE_NAME[$this->usrRole];
    }

    /**
     * @return string
     */
    public function getUsrRoleLabel()
    {
        return self::$ROLE_LABEL[$this->usrRole];
    }

    /**
     * Set usrActive
     *
     * @param boolean $usrActive
     * @return Users
     */
    public function setUsrActive($usrActive)
    {
        $this->usrActive = $usrActive;
    
        return $this;
    }

    /**
     * Get usrActive
     *
     * @return boolean 
     */
    public function getUsrActive()
    {
        return $this->usrActive;
    }

    /**
     * Set usrRegistrationDate
     *
     * @param string $usrRegistrationDate
     * @return Users
     */
    public function setUsrRegistrationDate($usrRegistrationDate)
    {
        $this->usrRegistrationDate = $usrRegistrationDate;
    
        return $this;
    }

    /**
     * Get usrRegistrationDate
     *
     * @return string 
     */
    public function getUsrRegistrationDate()
    {
        return $this->usrRegistrationDate;
    }
	
    /**
     * Set usrEmailConfirmed
     *
     * @param string $usrEmailConfirmed
     * @return Users
     */
    public function setUsrEmailConfirmed($usrEmailConfirmed)
    {
        $this->usrEmailConfirmed = $usrEmailConfirmed;
    
        return $this;
    }

    /**
     * Get usrEmailConfirmed
     *
     * @return string 
     */
    public function getUsrEmailConfirmed()
    {
        return $this->usrEmailConfirmed;
    }

    /**
     * Get either a Gravatar URL or complete image tag for a specified email address.
     *
     * @param string $email The email address
     * @param string $s Size in pixels, defaults to 80px [ 1 - 2048 ]
     * @param string $d Default imageset to use [ 404 | mm | identicon | monsterid | wavatar ]
     * @param string $r Maximum rating (inclusive) [ g | pg | r | x ]
     * @param boolean $img True to return a complete IMG tag False for just the URL
     * @param array $atts Optional, additional key/value attributes to include in the IMG tag
     * @return String containing either just a URL or a complete image tag
     * @source http://gravatar.com/site/implement/images/php/
     */
    public function getGrAvatar( $s = 80, $d = 'mm', $r = 'g', $img = false, $atts = array() ) {
        $url = 'http://www.gravatar.com/avatar/';
        $url .= md5( strtolower( trim( $this->usrEmail ) ) );
        $url .= "?s=$s&d=$d&r=$r";
        if ( $img ) {
            $url = '<img src="' . $url . '"';
            foreach ( $atts as $key => $val )
                $url .= ' ' . $key . '="' . $val . '"';
            $url .= ' />';
        }
        return $url;
    }
}