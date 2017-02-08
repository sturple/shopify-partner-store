<?php

namespace Fgms\PartnerStoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PageContent
 *
 * @ORM\Table(name="shopify_partner_page_content")
 * @ORM\Entity(repositoryClass="Fgms\PartnerStoreBundle\Repository\PageContentRepository")
 */
class PageContent
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
     * @var \DateTime
     *
     * @ORM\Column(name="updateDate", type="datetime")
     */
    private $updateDate;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255, nullable=true)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="subtitle", type="string", length=255)
     */
    private $subtitle;

    /**
     * @var string
     *
     * @ORM\Column(name="imageLogo", type="string", length=255)
     */
    private $imageLogo;

    /**
     * @var string
     *
     * @ORM\Column(name="guidLogo", type="string", length=255)
     */
    private $guidLogo;

    /**
     * @var string
     *
     * @ORM\Column(name="guidFeatureImage", type="string", length=255)
     */
    private $guidFeatureImage;

    /**
     * @var string
     *
     * @ORM\Column(name="guidBackgroundImage", type="string", length=255)
     */
    private $guidBackgroundImage;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text")
     */
    private $content;

    /**
     * @var string
     *
     * @ORM\Column(name="shopUrl", type="string", length=255)
     */
    private $shopUrl;

    /**
     * @var string
     *
     * @ORM\Column(name="shopEmail", type="string", length=255, nullable=true)
     */
    private $shopEmail;

    /**
     * @var string
     *
     * @ORM\Column(name="promoCode", type="string", length=255)
     */
    private $promoCode;

    /**
     * @var string
     *
     * @ORM\Column(name="collectionFeature", type="string", length=255)
     */
    private $collectionFeature;

    /**
     * @var string
     *
     * @ORM\Column(name="collectionPartner", type="string", length=255)
     */
    private $collectionPartner;

    /**
     * @var string
     *
     * @ORM\Column(name="collectionOther", type="string", length=255)
     */
    private $collectionOther;

    /**
     * @var string
     *
     * @ORM\Column(name="css", type="text", nullable=true)
     */
    private $css;

    /**
     * @ORM\OneToOne(targetEntity="Store",inversedBy="pageContent")
     */
    private $store;
    
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
     * Set updateDate
     *
     * @param \DateTime $updateDate
     *
     * @return PageContent
     */
    public function setUpdateDate($updateDate)
    {
        $this->updateDate = $updateDate;

        return $this;
    }

    /**
     * Get updateDate
     *
     * @return \DateTime
     */
    public function getUpdateDate()
    {
        return $this->updateDate;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return PageContent
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set subtitle
     *
     * @param string $subtitle
     *
     * @return PageContent
     */
    public function setSubtitle($subtitle)
    {
        $this->subtitle = $subtitle;

        return $this;
    }

    /**
     * Get subtitle
     *
     * @return string
     */
    public function getSubtitle()
    {
        return $this->subtitle;
    }

    /**
     * Set imageLogo
     *
     * @param string $imageLogo
     *
     * @return PageContent
     */
    public function setImageLogo($imageLogo)
    {
        $this->imageLogo = $imageLogo;

        return $this;
    }

    /**
     * Get imageLogo
     *
     * @return string
     */
    public function getImageLogo()
    {
        return $this->imageLogo;
    }

    /**
     * Set guidLogo
     *
     * @param string $guidLogo
     *
     * @return PageContent
     */
    public function setGuidLogo($guidLogo)
    {
        $this->guidLogo = $guidLogo;

        return $this;
    }

    /**
     * Get guidLogo
     *
     * @return string
     */
    public function getGuidLogo()
    {
        return $this->guidLogo;
    }

    /**
     * Set guidFeatureImage
     *
     * @param string $guidFeatureImage
     *
     * @return PageContent
     */
    public function setGuidFeatureImage($guidFeatureImage)
    {
        $this->guidFeatureImage = $guidFeatureImage;

        return $this;
    }

    /**
     * Get guidFeatureImage
     *
     * @return string
     */
    public function getGuidFeatureImage()
    {
        return $this->guidFeatureImage;
    }

    /**
     * Set guidBackgroundImage
     *
     * @param string $guidBackgroundImage
     *
     * @return PageContent
     */
    public function setGuidBackgroundImage($guidBackgroundImage)
    {
        $this->guidBackgroundImage = $guidBackgroundImage;

        return $this;
    }

    /**
     * Get guidBackgroundImage
     *
     * @return string
     */
    public function getGuidBackgroundImage()
    {
        return $this->guidBackgroundImage;
    }

    /**
     * Set content
     *
     * @param string $content
     *
     * @return PageContent
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set shopUrl
     *
     * @param string $shopUrl
     *
     * @return PageContent
     */
    public function setShopUrl($shopUrl)
    {
        $this->shopUrl = $shopUrl;

        return $this;
    }

    /**
     * Get shopUrl
     *
     * @return string
     */
    public function getShopUrl()
    {
        return $this->shopUrl;
    }

    /**
     * Set shopEmail
     *
     * @param string $shopEmail
     *
     * @return PageContent
     */
    public function setShopEmail($shopEmail)
    {
        $this->shopEmail = $shopEmail;

        return $this;
    }

    /**
     * Get shopEmail
     *
     * @return string
     */
    public function getShopEmail()
    {
        return $this->shopEmail;
    }

    /**
     * Set promoCode
     *
     * @param string $promoCode
     *
     * @return PageContent
     */
    public function setPromoCode($promoCode)
    {
        $this->promoCode = $promoCode;

        return $this;
    }

    /**
     * Get promoCode
     *
     * @return string
     */
    public function getPromoCode()
    {
        return $this->promoCode;
    }

    /**
     * Set collectionFeature
     *
     * @param string $collectionFeature
     *
     * @return PageContent
     */
    public function setCollectionFeature($collectionFeature)
    {
        $this->collectionFeature = $collectionFeature;

        return $this;
    }

    /**
     * Get collectionFeature
     *
     * @return string
     */
    public function getCollectionFeature()
    {
        return $this->collectionFeature;
    }

    /**
     * Set collectionPartner
     *
     * @param string $collectionPartner
     *
     * @return PageContent
     */
    public function setCollectionPartner($collectionPartner)
    {
        $this->collectionPartner = $collectionPartner;

        return $this;
    }

    /**
     * Get collectionPartner
     *
     * @return string
     */
    public function getCollectionPartner()
    {
        return $this->collectionPartner;
    }

    /**
     * Set collectionOther
     *
     * @param string $collectionOther
     *
     * @return PageContent
     */
    public function setCollectionOther($collectionOther)
    {
        $this->collectionOther = $collectionOther;

        return $this;
    }

    /**
     * Get collectionOther
     *
     * @return string
     */
    public function getCollectionOther()
    {
        return $this->collectionOther;
    }

    /**
     * Set css
     *
     * @param string $css
     *
     * @return PageContent
     */
    public function setCss($css)
    {
        $this->css = $css;

        return $this;
    }

    /**
     * Get css
     *
     * @return string
     */
    public function getCss()
    {
        return $this->css;
    }
    
    /**
     * Set store
     *
     * @param \Fgms\PartnerStoreBundle\Entity\Store $store
     *
     * @return Configuration
     */
    public function setStore(\Fgms\PartnerStoreBundle\Entity\Store $store = null)
    {
        $this->store = $store;
        return $this;
    }
    /**
     * Get store
     *
     * @return \Fgms\PartnerStoreBundle\Entity\Store
     */
    public function getStore()
    {
        return $this->store;
    }        
}

