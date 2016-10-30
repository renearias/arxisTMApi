<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
//use JMS\Serializer\Annotation as Serializer;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use FOS\UserBundle\Model\User as BaseUser;
/**
* @ORM\Entity
* @ORM\HasLifecycleCallbacks
* @ORM\Table(name="usuarios")
* Serializer\ExclusionPolicy("all")
*/
class Usuario extends BaseUser
{
    /**
    * @var integer $id
    *
    * @ORM\Column(name="id",type="integer",options={"unsigned"=false})
    * @ORM\Id
    * @ORM\GeneratedValue(strategy="IDENTITY")
    */
    protected $id;
    /**
    * @ORM\Column(type="string",length=255)
    * Serializer\Expose
    * Serializer\Groups({"list","detail","estadisticas"})
    */
    private $name='';
    /**
    * @ORM\Column(name="cargo",type="string",length=255)
    */
    private $cargo = '';
    /**
    * @ORM\Column(name="trato",type="string",length=50)
    */
    private $trato = '';
    /**
    * @ORM\Column(type="string",length=255, nullable=true)
    */
    protected $path;
   
    /**
    * @ORM\Column(name="telefono", type="string", length=255)
    */
    private $telefono = '';
    /**
    * @ORM\Column(name="direccion", type="text", length=255)
    */
    private $direccion = '';
    
    /**
     * @var integer
     *
     * @ORM\Column(name="created", type="integer", nullable=false)
     */
    private $created;
    
    /**
     * @ORM\Column(name="facebook_id", type="string", length=255, nullable=true)
     */
    private $facebookId;
    
    /**
     * @ORM\Column(name="facebook_access_token", type="string", length=255, nullable=true)
     */
    private $facebookAccessToken;


    /**
     * @var string
     *
     * @ORM\Column(name="data", type="json_array", nullable=true)
     */
    private $data;
    
    
   public function __construct()
    {
      parent::__construct();
      $this->addCreated();
    }
    /**
    * Set name
    *
    * @param string $name
    */
    public function setName($name)
    {
    $this->name = $name;
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
    * Set path
    *
    * @param string $path
    */
    public function setPath($path)
    {
    $this->path = $path;
    }
    /**
    * Get path
    *
    * @return string
    */
    public function getPath()
    {
    return $this->path;
    }
    
   /**
    * Set cargo
    * 
    * @param string $cargo
    */
     public function setCargo($cargo)
    {
        $this->cargo = $cargo;
      
    }

    /**
     * Get cargo
     *
     * @return string 
     */
    public function getCargo()
    {
        return $this->cargo;
    }
    
    /**
    * Set trato
    * 
    * @param string $trato
    */
     public function setTrato($trato)
    {
        $this->trato = $trato;
      
    }

    /**
     * Get trato
     *
     * @return string 
     */
    public function getTrato()
    {
        return $this->trato;
    }

    /**
     * Set created
     *
     * @param integer $created
     * @return Users
     */
    public function setCreated($created)
    {
        $this->created = $created;
        return $this;
    }
    public function addCreated()
    {
        $this->created=time();   
    }

    /**
     * Get created
     *
     * @return integer 
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set data
     *
     * @param string $data
     * @return Users
     */
    public function setData($data)
    {
        $this->data = $data;

        return $this;
    }

    /**
     * Get data
     *
     * @return string 
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * Get uid
     *
     * @return integer 
     */
    public function getUid()
    {
        return $this->uid;
    }
    
    
    public function getAbsolutePath()
    {
        return null === $this->path
            ? null
            : $this->getUploadRootDir().'/'.$this->path;
    }
    /**
     * Serializer\VirtualProperty
     * Serializer\SerializedName("picture")
     * Serializer\Groups({"estadisticas"})
     */
    public function getWebPath()
    {
        return null === $this->path
            //? null
            ? $this->getUploadDir().'/male.png'
            : $this->getUploadDir().'/'.$this->path;
    }

    protected function getUploadRootDir()
    {
        // the absolute directory path where uploaded
        // documents should be saved
        return __DIR__.'/../../../../web/'.$this->getUploadDir();
    }

    protected function getUploadDir()
    {
        // get rid of the __DIR__ so it doesn't screw up
        // when displaying uploaded doc/image in the view.
        return 'uploads/documents/images/profile';
    }
    
    /**
     * @Assert\File(maxSize="6000000",
                   mimeTypes = {"image/*"},
                   mimeTypesMessage = "Por favor suba una imagen valida")
     */
    private $file;

    private $temp;
    /**
     * Sets file.
     *
     * @param UploadedFile $file
     */
    public function setFile(UploadedFile $file = null)
    {
        $this->file = $file;
        // check if we have an old image path
        if (isset($this->path)) {
            // store the old name to delete after the update
            $this->temp = $this->path;
            $this->path = null;
        } else {
            $this->path = 'initial';
        }
    }

    /**
     * Get file.
     *
     * @return UploadedFile
     */
    public function getFile()
    {
        return $this->file;
    }
    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function preUpload()
    {
        if (null !== $this->getFile()) {
            // do whatever you want to generate a unique name
            $filename = sha1(uniqid(mt_rand(), true));
            $this->path = $filename.'.'.$this->getFile()->guessExtension();
        }
    }

    /**
     * @ORM\PostPersist()
     * @ORM\PostUpdate()
     */
    public function upload()
    {
        if (null === $this->getFile()) {
            return;
        }

        // if there is an error when moving the file, an exception will
        // be automatically thrown by move(). This will properly prevent
        // the entity from being persisted to the database on error
        $this->getFile()->move($this->getUploadRootDir(), $this->path);

        // check if we have an old image
        if (isset($this->temp)) {
            // delete the old image
            unlink($this->getUploadRootDir().'/'.$this->temp);
            // clear the temp image path
            $this->temp = null;
        }
        $this->file = null;
    }
    /**
     * @ORM\PostRemove()
     */
    public function removeUpload()
    {
        if ($file = $this->getAbsolutePath()) {
            unlink($file);
        }
    }
     
    public function __toString() {
    return $this->getName();
    }
    

    /**
     * Set telefono
     *
     * @param string $telefono
     *
     * @return Usuario
     */
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;

        return $this;
    }

    /**
     * Get telefono
     *
     * @return string
     */
    public function getTelefono()
    {
        return $this->telefono;
    }

    /**
     * Set direccion
     *
     * @param string $direccion
     *
     * @return Usuario
     */
    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;

        return $this;
    }

    /**
     * Get direccion
     *
     * @return string
     */
    public function getDireccion()
    {
        return $this->direccion;
    }

    /**
     * Set facebookId
     *
     * @param string $facebookId
     *
     * @return Usuario
     */
    public function setFacebookId($facebookId)
    {
        $this->facebookId = $facebookId;

        return $this;
    }

    /**
     * Get facebookId
     *
     * @return string
     */
    public function getFacebookId()
    {
        return $this->facebookId;
    }
    
    /**
     * @param string $facebookAccessToken
     * @return User
     */
    public function setFacebookAccessToken($facebookAccessToken)
    {
        $this->facebookAccessToken = $facebookAccessToken;

        return $this;
    }

    /**
     * @return string
     */
    public function getFacebookAccessToken()
    {
        return $this->facebookAccessToken;
    }
}
