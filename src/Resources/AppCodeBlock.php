<?php

declare(strict_types=1);

namespace CCVShop\Api\Resources;

use CCVShop\Api\BaseResource;
use CCVShop\Api\Endpoints\AppCodeBlocks;
use CCVShop\Api\Interfaces\Resources\PostData;

/**
 * @SuppressWarnings(PHPMD.CamelCasePropertyName)
 */
class AppCodeBlock extends BaseResource implements PostData
{
    // SONAR_IGNORE_START
    public ?string $href = null;
    public ?int $id = null;
    public ?int $app_id = null;
    public ?string $placeholder = null;
    public ?string $title = null;
    public ?string $value = null;
    public ?Entities\AppCodeBlock\InteractiveContent $interactive_content = null;
    // SONAR_IGNORE_END
    /**
     * @var array<string, string>
     */
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

    /**
     * @return array<string,string|object>
     */
    public function getPostData(): array
    {
        return [
            'placeholder' => $this->placeholder,
            'value' => $this->value,
            'title' => $this->title,
            'interactive_content' => $this->interactive_content,
        ];
    }
}
