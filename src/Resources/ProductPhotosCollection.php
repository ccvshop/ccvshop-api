<?php

declare(strict_types=1);

namespace CCVShop\Api\Resources;

use CCVShop\Api\BaseResourceCollection;
use CCVShop\Api\Interfaces\Resources\PutData;

class ProductPhotosCollection extends BaseResourceCollection implements PutData
{
    /**
     * @return array<string,list<mixed>>
     */
    public function getPutData(): array
    {
        $data = [];
        $items = $this->getIterator();
        /** @var ProductPhoto $item */
        foreach ($items as $item) {
            $subdata = [
                'file_type' => $item->file_type,
                'alttext' => $item->alttext,
                'source' => $item->source,
                'is_mainphoto' => $item->is_mainphoto,
            ];

            // Filter the array to remove entries with null values
            $data[] = array_filter($subdata, static function ($value) {
                return ! is_null($value);
            });
        }

        return ['productphotos' => $data];
    }
}
