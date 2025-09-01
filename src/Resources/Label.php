<?php

declare(strict_types=1);

namespace CCVShop\Api\Resources;

use CCVShop\Api\BaseResource;
use CCVShop\Api\Endpoints\Labels;
use CCVShop\Api\Interfaces\Resources\PostData;

/**
 * @SuppressWarnings(PHPMD.CamelCasePropertyName)
 */
class Label extends BaseResource implements PostData
{
    public ?int $id = null;
    public ?string $image_location = null;
    public ?string $tooltip = null;
    public bool $show_on_products = false;
    public bool $show_on_orders = false;
    public bool $show_on_invoices = false;

    public function getEndpoint(): Labels
    {
        return $this->client->labels;
    }

    /**
     * @return array<string,string|int|bool>
     */
    public function getPostData(): array
    {
        return [
            'image_location' => $this->image_location,
            'tooltip' => $this->tooltip,
            'show_on_products' => $this->show_on_products,
            'show_on_orders' => $this->show_on_orders,
            'show_on_invoices' => $this->show_on_invoices,
        ];
    }
}
