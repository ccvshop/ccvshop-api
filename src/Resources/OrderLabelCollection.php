<?php

declare(strict_types=1);

namespace CCVShop\Api\Resources;

use CCVShop\Api\BaseResourceCollection;
use CCVShop\Api\Interfaces\Resources\PutData;

class OrderLabelCollection extends BaseResourceCollection implements PutData
{
    /**
     * @return array<string,list<mixed>>
     */
    public function getPutData(): array
    {
        $data = [];

        $items = $this->getIterator();
        /** @var OrderLabel $item */
        foreach ($items as $item) {
            $data[] = $item->label_id;
        }

        return ['labels' => $data];
    }
}
