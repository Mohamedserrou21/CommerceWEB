<?php

namespace App\Entity;

use App\Repository\StoreNameRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass=StoreNameRepository::class)
 * @Vich\Uploadable
 */
class StoreName
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="text")
     */
    private $about;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="user_role")
     */
    private $user;


    /**
     * @ORM\Column(type="string", length=255)
     * @var string
     */
    private $logo;

    /**
     * @Vich\UploadableField(mapping="product_images", fileNameProperty="logo")
     * @var File
     */
    private $logoFile;




    /**
     * @ORM\Column(type="string", length=255)
     * @var string
     */
    private $carsoule1;

    /**
     * @Vich\UploadableField(mapping="product_images", fileNameProperty="carsoule1")
     * @var File
     */
    private $carsoul1File;
    /**
     * @ORM\Column(type="string", length=255)
     * @var string
     */
    private $carsoule2;

    /**
     * @Vich\UploadableField(mapping="product_images", fileNameProperty="carsoule2")
     * @var File
     */
    private $carsoul2File;

    /**
     * @ORM\Column(type="string", length=255)
     * @var string
     */
    private $carsoule3;

    /**
     * @Vich\UploadableField(mapping="product_images", fileNameProperty="carsoule3")
     * @var File
     */
    private $carsoul3File;


    /**
     * @ORM\Column(type="datetime")
     * @var \DateTime
     */
    private $updatedAt;

    /**
     * @ORM\OneToMany(targetEntity=Produits::class, mappedBy="store")
     */
    private $Products;

    public function __construct()
    {
        $this->Products = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getAbout(): ?string
    {
        return $this->about;
    }

    public function setAbout(string $about): self
    {
        $this->about = $about;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }
    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }







    public function setLogoFile(File $logo = null)
    {
        $this->logoFile = $logo;

        // VERY IMPORTANT:
        // It is required that at least one field changes if you are using Doctrine,
        // otherwise the event listeners won't be called and the file is lost
        if ($logo) {
            // if 'updatedAt' is not defined in your entity, use another property
            $this->updatedAt = new \DateTime('now');
        }
    }

    public function getLogoFile()
    {
        return $this->logoFile;
    }

    public function setLogo($logo)
    {
        $this->logo = $logo;
    }

    public function getlogo()
    {
        return $this->logo;
    }






    public function setcarsoul1File(File $carsoule1 = null)
    {
        $this->carsoul1File = $carsoule1;

        // VERY IMPORTANT:
        // It is required that at least one field changes if you are using Doctrine,
        // otherwise the event listeners won't be called and the file is lost
        if ($carsoule1) {
            // if 'updatedAt' is not defined in your entity, use another property
            $this->updatedAt = new \DateTime('now');
        }
    }

    public function getcarsoul1File()
    {
        return $this->carsoul1File;
    }

    public function setcarsoule1($carsoule1)
    {
        $this->carsoule1 = $carsoule1;
    }

    public function getcarsoule1()
    {
        return $this->carsoule1;
    }



    public function setcarsoul2File(File $carsoule2 = null)
    {
        $this->carsoul2File = $carsoule2;

        // VERY IMPORTANT:
        // It is required that at least one field changes if you are using Doctrine,
        // otherwise the event listeners won't be called and the file is lost
        if ($carsoule2) {
            // if 'updatedAt' is not defined in your entity, use another property
            $this->updatedAt = new \DateTime('now');
        }
    }

    public function getcarsoul2File()
    {
        return $this->carsoul2File;
    }

    public function setcarsoule2($carsoule2)
    {
        $this->carsoule2 = $carsoule2;
    }

    public function getcarsoule2()
    {
        return $this->carsoule2;
    }




    public function setcarsoul3File(File $carsoule3 = null)
    {
        $this->carsoul3File = $carsoule3;

        // VERY IMPORTANT:
        // It is required that at least one field changes if you are using Doctrine,
        // otherwise the event listeners won't be called and the file is lost
        if ($carsoule3) {
            // if 'updatedAt' is not defined in your entity, use another property
            $this->updatedAt = new \DateTime('now');
        }
    }

    public function getcarsoul3File()
    {
        return $this->carsoul3File;
    }

    public function setcarsoule3($carsoule3)
    {
        $this->carsoule3 = $carsoule3;
    }

    public function getcarsoule3()
    {
        return $this->carsoule3;
    }

    /**
     * @return Collection<int, Produits>
     */
    public function getProducts(): Collection
    {
        return $this->Products;
    }

    public function addProduct(Produits $product): self
    {
        if (!$this->Products->contains($product)) {
            $this->Products[] = $product;
            $product->setStore($this);
        }

        return $this;
    }

    public function removeProduct(Produits $product): self
    {
        if ($this->Products->removeElement($product)) {
            // set the owning side to null (unless already changed)
            if ($product->getStore() === $this) {
                $product->setStore(null);
            }
        }

        return $this;
    }
    public function __toString()
    {
        return  $this->name;
    }
}
