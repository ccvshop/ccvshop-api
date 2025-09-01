<?php

declare(strict_types=1);

namespace CCVShop\Api\Resources;

use CCVShop\Api\BaseResourceCollection;
use CCVShop\Api\Interfaces\Resources\PutData;

class ProductLabelCollection extends BaseResourceCollection implements PutData
{
    /**
     * @return array{labels: list<int|null>}
     */
    public function getPutData(): array
    {
        $data = [];

        $items = $this->getIterator();
        /** @var ProductLabel $item */
        foreach ($items as $item) {
            $data[] = $item->label_id;
        }

        return ['labels' => $data];
    }
}
