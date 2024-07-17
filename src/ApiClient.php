<?php
declare(strict_types=1);

namespace CCVShop\Api;

use CCVShop\Api\Endpoints\AppCodeBlocks;
use CCVShop\Api\Endpoints\AppConfigs;
use CCVShop\Api\Endpoints\CashUps;
use CCVShop\Api\Endpoints\Credentials;
use CCVShop\Api\Endpoints\FiscalTransactionSignatures;
use CCVShop\Api\Endpoints\Labels;
use CCVShop\Api\Endpoints\Languages;
use CCVShop\Api\Endpoints\OrderLabels;
use CCVShop\Api\Endpoints\OrderRows;
use CCVShop\Api\Endpoints\ProductPhotos;
use CCVShop\Api\Endpoints\ProductLabels;
use CCVShop\Api\Endpoints\Settings;
use CCVShop\Api\Endpoints\Webhooks;
use CCVShop\Api\Endpoints\Webshops;
use CCVShop\Api\Endpoints\Merchant;
use CCVShop\Api\Endpoints\Apps;
use CCVShop\Api\Endpoints\Orders;
use CCVShop\Api\Endpoints\Products;

class ApiClient
{
    /**
     * Stores Credentials of the API connection.
     * @var ApiCredentials
     */
    public ApiCredentials $apiCredentials;
    public Credentials $credentials;
    public Endpoints\Merchant $merchant;
    public Webshops $webshops;
    public Apps $apps;
    public Webhooks $webhooks;
    public Orders $orders;
    public OrderRows $orderRows;
    public FiscalTransactionSignatures $fiscalTransactionSignatures;
    public AppCodeBlocks $appCodeBlocks;
    public AppConfigs $appConfigs;
    public CashUps $cashUps;
    public Languages $languages;
    public Settings $settings;

    public Products $products;
    public ProductPhotos $productPhotos;

    public Labels $labels;

    public ProductLabels $productLabels;

    public OrderLabels $orderLabels;

    /**
     * @param string|null $hostName Fallback in .env['CCVSHOP_API_HOSTNAME']
     * @param string|null $apiPublic Fallback in .env['CCVSHOP_API_PUBLIC']
     * @param string|null $apiSecret Fallback in .env['CCVSHOP_API_SECRET']
     */
    public function __construct(?string $hostName = null, ?string $apiPublic = null, ?string $apiSecret = null)
    {
        $this->apiCredentials = new ApiCredentials(
            $hostName ?? $_ENV['CCVSHOP_API_HOSTNAME'],
            $apiPublic ?? $_ENV['CCVSHOP_API_PUBLIC'],
            $apiSecret ?? $_ENV['CCVSHOP_API_SECRET']
        );

        $this->credentials                  = new Credentials($this);
        $this->merchant                     = new Merchant($this);
        $this->webshops                     = new Webshops($this);
        $this->apps                         = new Apps($this);
        $this->webhooks                     = new Webhooks($this);
        $this->orders                       = new Orders($this);
        $this->orderRows                    = new OrderRows($this);
        $this->fiscalTransactionSignatures  = new FiscalTransactionSignatures($this);
        $this->appCodeBlocks                = new AppCodeBlocks($this);
        $this->cashUps                      = new CashUps($this);
        $this->languages                    = new Languages($this);
        $this->settings                     = new Settings($this);
        $this->products                     = new Products($this);
        $this->productPhotos                = new ProductPhotos($this);
        $this->labels                       = new Labels($this);
        $this->appConfigs                   = new AppConfigs($this);
        $this->productLabels                = new ProductLabels($this);
        $this->orderLabels                  = new OrderLabels($this);
    }
}
