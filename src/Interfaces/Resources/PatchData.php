<?php

declare(strict_types=1);

namespace CCVShop\Api\Interfaces\Resources;

interface PatchData
{
    public function getId(): int;

    /**
     * @return array<string,mixed>
     */
    public function getPatchData(): array;
}
