<?php

namespace CCVShop\Api\Endpoints;

use CCVShop\Api\BaseEndpoint;
use CCVShop\Api\Exceptions\InvalidHashOnResult;
use CCVShop\Api\Exceptions\InvalidResponseException;
use CCVShop\Api\Interfaces\Endpoints\Get;
use CCVShop\Api\Interfaces\Endpoints\GetAll;
use CCVShop\Api\Interfaces\Endpoints\Post;
use CCVShop\Api\Interfaces\Endpoints\Delete;
use CCVShop\Api\Resources\Label;
use CCVShop\Api\Resources\LabelCollection;
use GuzzleHttp\Exception\GuzzleException;
use InvalidArgumentException;
use JsonException;
use ReflectionException;

class Labels extends BaseEndpoint implements
    Get,
    GetAll,
    Post,
    Delete
{
    protected string $resourcePath = 'labels';

    /**
     * @description Get the resource object
     * @return Label;
     */
    protected function getResourceObject(): Label
    {
        return new Label($this->client);
    }

    /**
     * @description Get the resource collection object
     * @return LabelCollection
     */
    protected function getResourceCollectionObject(): LabelCollection
    {
        return new LabelCollection();
    }

    /**
     * @description Get one by id
     * @param int $id
     * @return Label
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     * @throws JsonException|ReflectionException
     */
    public function get(int $id): Label
    {
        /** @var Label $result */
        return $this->rest_getOne($id, []);
    }

    /**
     * @description Get all by parameters
     * @param array $parameters
     * @return LabelCollection
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     * @throws GuzzleException
     * @throws JsonException|ReflectionException
     */
    public function getAll(array $parameters = []): LabelCollection
    {
        /** @var LabelCollection $result */
        return $this->rest_getAll(null, null, $parameters);
    }

    /**
     * @param Label|null $label
     * @return Label
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     * @throws JsonException|ReflectionException
     */
    public function post(Label $label = null): Label
    {
        if ($label === null) {
            throw new InvalidArgumentException(Label::class . ' required');
        }

        return $this->rest_post([
            'image_location'   => $label->image_location,
            'tooltip'          => $label->tooltip,
            'show_on_products' => $label->show_on_products,
            'show_on_orders'   => $label->show_on_orders,
            'show_on_invoices' => $label->show_on_invoices,
        ]);
    }

    /**
     * @param int $id
     * @return void
     * @throws InvalidHashOnResult
     * @throws InvalidResponseException
     * @throws JsonException
     */
    public function delete(int $id): void
    {
        $this->rest_delete($id);
    }
}
