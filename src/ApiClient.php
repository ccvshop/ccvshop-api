<?php

declare(strict_types=1);

namespace CCVShop\Api;

use CCVShop\Api\Endpoints\AppCodeBlocks;
use CCVShop\Api\Endpoints\AppConfigs;
use CCVShop\Api\Endpoints\AppMessages;
use CCVShop\Api\Endpoints\AppPsp;
use CCVShop\Api\Endpoints\AppPspPaymethods;
use CCVShop\Api\Endpoints\Apps;
use CCVShop\Api\Endpoints\Attributes;
use CCVShop\Api\Endpoints\AttributeValues;
use CCVShop\Api\Endpoints\Brands;
use CCVShop\Api\Endpoints\CashUpInvoices;
use CCVShop\Api\Endpoints\CashUps;
use CCVShop\Api\Endpoints\Categories;
use CCVShop\Api\Endpoints\CategoryTree;
use CCVShop\Api\Endpoints\Credentials;
use CCVShop\Api\Endpoints\CreditPointMutations;
use CCVShop\Api\Endpoints\CreditPoints;
use CCVShop\Api\Endpoints\FiscalCashupSignatures;
use CCVShop\Api\Endpoints\FiscalTransactionSignatures;
use CCVShop\Api\Endpoints\Invoices;
use CCVShop\Api\Endpoints\Labels;
use CCVShop\Api\Endpoints\Languages;
use CCVShop\Api\Endpoints\Merchant;
use CCVShop\Api\Endpoints\OrderLabels;
use CCVShop\Api\Endpoints\OrderRows;
use CCVShop\Api\Endpoints\Orders;
use CCVShop\Api\Endpoints\Packages;
use CCVShop\Api\Endpoints\ProductAttributeSets;
use CCVShop\Api\Endpoints\ProductAttributeValues;
use CCVShop\Api\Endpoints\ProductKeywords;
use CCVShop\Api\Endpoints\ProductLabels;
use CCVShop\Api\Endpoints\ProductPhotos;
use CCVShop\Api\Endpoints\ProductProperties;
use CCVShop\Api\Endpoints\ProductPropertyGroups;
use CCVShop\Api\Endpoints\ProductPropertyOptions;
use CCVShop\Api\Endpoints\ProductPropertyValues;
use CCVShop\Api\Endpoints\ProductRelevant;
use CCVShop\Api\Endpoints\Products;
use CCVShop\Api\Endpoints\ProductToCategories;
use CCVShop\Api\Endpoints\ProductToPropertyGroups;
use CCVShop\Api\Endpoints\Redirects;
use CCVShop\Api\Endpoints\Settings;
use CCVShop\Api\Endpoints\Users;
use CCVShop\Api\Endpoints\Webhooks;
use CCVShop\Api\Endpoints\Webshops;

/**
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 * @SuppressWarnings(PHPMD.NumberOfChildren)
 */
class ApiClient
{
    /**
     * Stores Credentials of the API connection.
     *
     * @var ApiCredentials
     */
    public ApiCredentials $apiCredentials;
    public \GuzzleHttp\ClientInterface $httpClient;

    public AppCodeBlocks $appCodeBlocks;
    public AppConfigs $appConfigs;
    public AppMessages $appMessages;
    public AppPsp $appPsp;
    public AppPspPaymethods $appPspPaymethods;
    public Apps $apps;
    public AttributeValues $attributeValues;
    public Attributes $attributes;
    public Brands $brands;
    public CashUps $cashUps;
    public CashUpInvoices $cashUpInvoices;
    public Categories $categories;
    public CategoryTree $categoryTree;
    public Credentials $credentials;
    public CreditPoints $creditPoints;
    /**
     * @deprecated - use self::$creditPointMutations
     */
    public CreditPointMutations $creditpointMutations;
    public CreditPointMutations $creditPointMutations;
    public FiscalTransactionSignatures $fiscalTransactionSignatures;
    public Invoices $invoices;
    public Labels $labels;
    public Languages $languages;
    public Merchant $merchant;
    public OrderLabels $orderLabels;
    public OrderRows $orderRows;
    public Orders $orders;
    public Packages $packages;
    public ProductAttributeSets $productAttributesSets;
    public ProductAttributeValues $productAttributeValues;
    public ProductKeywords $productKeywords;
    public ProductLabels $productLabels;
    public ProductPhotos $productPhotos;
    public ProductProperties $productProperties;
    public ProductPropertyGroups $productPropertyGroups;
    public ProductPropertyOptions $productPropertyOptions;
    public ProductPropertyValues $productPropertyValues;
    public ProductToCategories $productToCategories;
    public ProductToPropertyGroups $productToPropertyGroups;
    public Products $products;
    /**
     * @deprecated - use self::$productRelevant
     */
    public ProductRelevant $productsRelevant;
    public ProductRelevant $productRelevant;
    public Redirects $redirects;
    public Settings $settings;
    public Users $users;
    public Webhooks $webhooks;
    public Webshops $webshops;

    public FiscalCashupSignatures $fiscalCashupSignatures;

    public bool $sslCheckDisabled = false;

    /**
     * @param string $hostName
     * @param string $apiPublic
     * @param string $apiSecret
     */
    public function __construct(string $hostName = '', string $apiPublic = '', string $apiSecret = '', ?\GuzzleHttp\ClientInterface $httpClient = null)
    {
        $this->apiCredentials = new ApiCredentials(
            $hostName,
            $apiPublic,
            $apiSecret,
        );
        $this->httpClient = $httpClient ?? new \GuzzleHttp\Client();

        $this->appCodeBlocks = new AppCodeBlocks($this);
        $this->appConfigs = new AppConfigs($this);
        $this->appMessages = new AppMessages($this);
        $this->apps = new Apps($this);
        $this->appPsp = new AppPsp($this);
        $this->appPspPaymethods = new AppPspPaymethods($this);
        $this->attributeValues = new AttributeValues($this);
        $this->attributes = new Attributes($this);
        $this->brands = new Brands($this);
        $this->cashUps = new CashUps($this);
        $this->cashUpInvoices = new CashUpInvoices($this);
        $this->categories = new Categories($this);
        $this->categoryTree = new CategoryTree($this);
        $this->credentials = new Credentials($this);
        $this->creditPoints = new CreditPoints($this);
        $this->creditPointMutations = new CreditPointMutations($this);
        $this->fiscalTransactionSignatures = new FiscalTransactionSignatures($this);
        $this->invoices = new Invoices($this);
        $this->labels = new Labels($this);
        $this->languages = new Languages($this);
        $this->merchant = new Merchant($this);
        $this->orderLabels = new OrderLabels($this);
        $this->orderRows = new OrderRows($this);
        $this->orders = new Orders($this);
        $this->packages = new Packages($this);
        $this->productAttributeValues = new ProductAttributeValues($this);
        $this->productAttributesSets = new ProductAttributeSets($this);
        $this->productKeywords = new ProductKeywords($this);
        $this->productLabels = new ProductLabels($this);
        $this->productPhotos = new ProductPhotos($this);
        $this->productProperties = new ProductProperties($this);
        $this->productPropertyGroups = new ProductPropertyGroups($this);
        $this->productPropertyOptions = new ProductPropertyOptions($this);
        $this->productPropertyValues = new ProductPropertyValues($this);
        $this->productToCategories = new ProductToCategories($this);
        $this->productToPropertyGroups = new ProductToPropertyGroups($this);
        $this->products = new Products($this);
        $this->productRelevant = new ProductRelevant($this);
        $this->redirects = new Redirects($this);
        $this->settings = new Settings($this);
        $this->users = new Users($this);
        $this->webhooks = new Webhooks($this);
        $this->webshops = new Webshops($this);
        $this->fiscalCashupSignatures = new FiscalCashupSignatures($this);
        // Deprecated properties.
        $this->creditpointMutations = new CreditPointMutations($this);
        $this->productsRelevant = new ProductRelevant($this);
    }

    public function getEndpoint(string $resource): BaseEndpoint
    {
        if (!isset($this->{$resource})) {
            throw new \InvalidArgumentException('Invalid endpoint: ' . $resource);
        }

        return $this->{$resource};
    }

    /**
     * @return bool
     */
    public function sslCheckDisabled(): bool
    {
        return $this->sslCheckDisabled;
    }

    /**
     * @param bool $disabled
     *
     * @return void
     */
    public function setSslCheckDisabled(bool $disabled = true): void
    {
        $this->sslCheckDisabled = $disabled;
    }
}
