<?php

namespace Fgms\PartnerStoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Fgms\PartnerStoreBundle\Repository\StoreRepository")
 * @ORM\Table(name="shopify_partner_store",uniqueConstraints={@ORM\UniqueConstraint(name="name_idx",columns={"name"})})
 */
class Store
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string",length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string",length=255)
     */
    private $accessToken;

    /**
     * @ORM\Column(type="string",length=100)
     */
    private $status = 'active';

     /**
     * @ORM\OneToOne(targetEntity="Company",mappedBy="store")
     */   
    private $company;
    
     /**
     * @ORM\OneToOne(targetEntity="PageContent",mappedBy="store")
     */   
    private $pageContent;    

     /**
     * @ORM\OneToMany(targetEntity="Announcements",mappedBy="store")
     */   
    private $announcements;
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->forms = new \Doctrine\Common\Collections\ArrayCollection();
    }

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
     * Set name
     *
     * @param string $name
     *
     * @return Store
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
     * Set accessToken
     *
     * @param string $accessToken
     *
     * @return Store
     */
    public function setAccessToken($accessToken)
    {
        $this->accessToken = $accessToken;

        return $this;
    }

    /**
     * Get accessToken
     *
     * @return string
     */
    public function getAccessToken()
    {
        return $this->accessToken;
    }

    /**
     * Set status
     *
     * @param string $status
     *
     * @return Store
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }
    
    /**
     * Set company
     *
     * @param \Fgms\PartnerStoreBundle\Entity\Company $company
     *
     * @return Store
     */
    public function setCompany(\Fgms\PartnerStoreBundle\Entity\Company $company)
    {
        $this->company = $company;
        return $this;
    }

    /**
     * Get company
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCompany()
    {
        return $this->company;
    }
    
    /**
     * Set pageContent
     *
     * @param \Fgms\PartnerStoreBundle\Entity\PageContent $pageContent
     *
     * @return Store
     */
    public function setPageContent(\Fgms\PartnerStoreBundle\Entity\PageContent $pageContent)
    {
        $this->pageContent = $pageContent;
        return $this;
    }

    /**
     * Get pageContent
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPageContent()
    {
        return $this->pageContent;
    }
    
    /**
     * Add announcements
     *
     * @param \Fgms\PartnerStoreBundle\Entity\Announcements $announcements
     *
     * @return Store
     */
    public function addAnnouncements(\Fgms\PartnerStoreBundle\Entity\Announcements $announcements)
    {
        $this->announcements[] = $announcements;
        return $this;
    }
    /**
     * Remove form
     *
     * @param \Fgms\PartnerStoreBundle\Entity\Announcements $announcements
     */
    /*
    public function removeForm(\Fgms\PartnerStoreBundle\Entity\Announcements $announcements)
    {
        $this->announcements->removeElement($announcements);
    }*/
    
    /**
     * Get forms
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAnnouncements()
    {
        return $this->announcements;
    }
    
}
