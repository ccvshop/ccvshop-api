<?php

namespace CCVShop\Api;

class ParentResource
{
    public string $path;
    public int $id;

    /**
     * @param string $path
     * @param int $id
     */
    public function __construct(string $path, int $id)
    {
        $this->path = $path;
        $this->id   = $id;
    }
}
