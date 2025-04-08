<?php
declare(strict_types=1);

namespace CCVShop\Api;

use CCVShop\Api\Endpoints\AppCodeBlocks;
use CCVShop\Api\Endpoints\AppConfigs;
use CCVShop\Api\Endpoints\AppMessages;
use CCVShop\Api\Endpoints\Attributes;
use CCVShop\Api\Endpoints\AttributeValues;
use CCVShop\Api\Endpoints\CashUps;
use CCVShop\Api\Endpoints\Categories;
use CCVShop\Api\Endpoints\CategoryTree;
use CCVShop\Api\Endpoints\Credentials;
use CCVShop\Api\Endpoints\FiscalTransactionSignatures;
use CCVShop\Api\Endpoints\Labels;
use CCVShop\Api\Endpoints\Languages;
use CCVShop\Api\Endpoints\OrderLabels;
use CCVShop\Api\Endpoints\OrderRows;
use CCVShop\Api\Endpoints\Packages;
use CCVShop\Api\Endpoints\ProductAttributesValues;
use CCVShop\Api\Endpoints\ProductAttributeSets;
use CCVShop\Api\Endpoints\ProductPhotos;
use CCVShop\Api\Endpoints\ProductLabels;
use CCVShop\Api\Endpoints\ProductProperties;
use CCVShop\Api\Endpoints\ProductPropertyGroups;
use CCVShop\Api\Endpoints\ProductPropertyOptions;
use CCVShop\Api\Endpoints\ProductPropertyValues;
use CCVShop\Api\Endpoints\ProductToCategories;
use CCVShop\Api\Endpoints\ProductToPropertyGroups;
use CCVShop\Api\Endpoints\Redirects;
use CCVShop\Api\Endpoints\Settings;
use CCVShop\Api\Endpoints\Webhooks;
use CCVShop\Api\Endpoints\Webshops;
use CCVShop\Api\Endpoints\Merchant;
use CCVShop\Api\Endpoints\Apps;
use CCVShop\Api\Endpoints\Orders;
use CCVShop\Api\Endpoints\Products;
use CCVShop\Api\Endpoints\ProductsRelevant;

class ApiClient
{
    /**
     * Stores Credentials of the API connection.
     * @var ApiCredentials
     */
    public ApiCredentials              $apiCredentials;
    public Attributes                  $attributes;
    public AttributeValues             $attributeValues;
    public Credentials                 $credentials;
    public Endpoints\Merchant          $merchant;
    public Webshops                    $webshops;
    public Apps                        $apps;
    public Webhooks                    $webhooks;
    public Orders                      $orders;
    public OrderRows                   $orderRows;
    public FiscalTransactionSignatures $fiscalTransactionSignatures;
    public AppCodeBlocks               $appCodeBlocks;
    public AppMessages                 $appMessages;
    public AppConfigs                  $appConfigs;
    public ProductsRelevant            $productsRelevant;
    public CashUps                     $cashUps;
    public Languages                   $languages;
    public Settings                    $settings;
    public Products                    $products;
    public Packages                    $packages;
    public ProductPhotos               $productPhotos;
    public ProductToCategories         $productToCategories;
    public Categories                  $categories;
    public CategoryTree                $categoryTree;
    public Labels                      $labels;
    public ProductLabels               $productLabels;
    public OrderLabels                 $orderLabels;
    public ProductPropertyGroups       $productPropertyGroups;
    public ProductToPropertyGroups     $productToPropertyGroups;
    public ProductProperties           $productProperties;
    public ProductPropertyOptions      $productPropertyOptions;
    public ProductPropertyValues       $productPropertyValues;
    public ProductAttributesValues     $productAttributeValues;
    public ProductAttributeSets        $productAttributesSets;
    public Redirects                   $redirects;


    /**
     * @param string $hostName
     * @param string $apiPublic
     * @param string $apiSecret
     */
    public function __construct(string $hostName = '', string $apiPublic = '', string $apiSecret = '')
    {
        $this->apiCredentials = new ApiCredentials(
            $hostName,
            $apiPublic,
            $apiSecret,
        );

        $this->credentials                 = new Credentials($this);
        $this->merchant                    = new Merchant($this);
        $this->webshops                    = new Webshops($this);
        $this->apps                        = new Apps($this);
        $this->webhooks                    = new Webhooks($this);
        $this->orders                      = new Orders($this);
        $this->orderRows                   = new OrderRows($this);
        $this->fiscalTransactionSignatures = new FiscalTransactionSignatures($this);
        $this->appCodeBlocks               = new AppCodeBlocks($this);
        $this->appConfigs                  = new AppConfigs($this);
        $this->productsRelevant            = new ProductsRelevant($this);
        $this->appMessages                 = new AppMessages($this);
        $this->cashUps                     = new CashUps($this);
        $this->languages                   = new Languages($this);
        $this->settings                    = new Settings($this);
        $this->products                    = new Products($this);
        $this->packages                    = new Packages($this);
        $this->categories                  = new Categories($this);
        $this->categoryTree                = new CategoryTree($this);
        $this->productPhotos               = new ProductPhotos($this);
        $this->productToCategories         = new ProductToCategories($this);
        $this->labels                      = new Labels($this);
        $this->productLabels               = new ProductLabels($this);
        $this->orderLabels                 = new OrderLabels($this);
        $this->productPropertyGroups       = new ProductPropertyGroups($this);
        $this->productProperties           = new ProductProperties($this);
        $this->productPropertyValues       = new ProductPropertyValues($this);
        $this->productPropertyOptions      = new ProductPropertyOptions($this);
        $this->productToPropertyGroups     = new ProductToPropertyGroups($this);
        $this->productAttributeValues      = new ProductAttributesValues($this);
        $this->productAttributesSets       = new ProductAttributeSets($this);
        $this->attributes                  = new Attributes($this);
        $this->attributeValues             = new AttributeValues($this);
        $this->redirects                   = new Redirects($this);
    }
}
