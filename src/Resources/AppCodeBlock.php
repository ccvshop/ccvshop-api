<?php

namespace CCVShop\Api\Resources;

use CCVShop\Api\BaseResource;
use CCVShop\Api\Endpoints\AppCodeBlocks;

class AppCodeBlock extends BaseResource
{
    //SONAR_IGNORE_START
    public ?string                                   $href                = null;
    public ?int                                      $id                  = null;
    public ?int                                      $app_id              = null;
    public ?string                                   $placeholder         = null;
    public ?string                                   $title               = null;
    public ?string                                   $value               = null;
    public ?Entities\AppCodeBlock\InteractiveContent $interactive_content = null;
    //SONAR_IGNORE_END

    public array $entities = [
        'interactive_content' => Entities\AppCodeBlock\InteractiveContent::class,
    ];

    /**
     * @return AppCodeBlocks
     */
    public function getEndpoint(): AppCodeBlocks
    {
        return $this->client->appCodeBlocks;
    }
}
