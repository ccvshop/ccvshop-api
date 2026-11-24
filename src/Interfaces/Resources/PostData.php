<?php

declare(strict_types=1);

namespace CCVShop\Api\Interfaces\Resources;

interface PostData
{
    /**
     * @return array<string,mixed>
     */
    public function getPostData(): array;
}
