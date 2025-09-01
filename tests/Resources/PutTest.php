<?php

namespace CCVShop\ApiTests\Resources;

use CCVShop\Api\ApiClient;
use CCVShop\Api\BaseResource;
use CCVShop\Api\BaseResourceCollection;
use CCVShop\Api\Interfaces\Resources\PutData;
use CCVShop\ApiTests\Resources;
use JsonSchema\Validator;

class PutTest extends Resources
{
    public static function schemaEntityPutProvider(): array
    {
        return [
            [\CCVShop\Api\Resources\Creditpoint::class, 'internal.resource.creditpoints.put.v1.json'],
            [\CCVShop\Api\Resources\Setting::class, 'internal.resource.settings.put.v1.json'],
        ];
    }

    public static function schemaEntityPutCollectionProvider(): array
    {
        return [
            [\CCVShop\Api\Resources\ProductPhotosCollection::class, 'internal.resource.productphotos.put.v1.json', \CCVShop\Api\Resources\ProductPhoto::class],
            [\CCVShop\Api\Resources\OrderLabelCollection::class, 'internal.resource.orderlabels.put.v1.json', \CCVShop\Api\Resources\OrderLabel::class],
            [\CCVShop\Api\Resources\ProductLabelCollection::class, 'internal.resource.productlabels.put.v1.json', \CCVShop\Api\Resources\ProductLabel::class],
        ];
    }

    /**
     * @dataProvider schemaEntityPutProvider
     *
     * @param string $resourceName
     * @param string $schemaPath
     *
     * @return void
     */
    public function testPutData(string $resourceName, string $schemaPath): void
    {
        $client = new ApiClient('https://ameijer.ccvdev.nl/API/Rest', 'demo', 'demo');

        /** @var BaseResource $resourceName */
        $resource = new $resourceName($client);

        if (! ($resource instanceof PutData)) {
            $this->fail($resourceName . ' is not a PutData.');
        }

        $schema = file_get_contents(sprintf('https://ameijer.ccvdev.nl/API/Schema/%s', $schemaPath));

        $schemaObject = json_decode($schema, true, 512, JSON_THROW_ON_ERROR);
        $mockData = (object) $this->generateMockFromSchema($schemaObject);

        $resource = \CCVShop\Api\Factory\ResourceFactory::createFromApiResult($mockData, $resource);

        $patchData = $resource->getPutData();

        $validator = new Validator();
        $validator->validate($patchData, $schema);

        $this->assertTrue($validator->isValid(), 'Error creating mock data');
    }

    /**
     * @dataProvider schemaEntityPutCollectionProvider
     *
     * @param string $collectionName
     * @param string $schemaPath
     * @param string $resourceName
     *
     * @return void
     *
     * @throws \JsonException
     * @throws \ReflectionException
     */
    public function testPutCollectionData(string $collectionName, string $schemaPath, string $resourceName): void
    {
        $client = new ApiClient('https://ameijer.ccvdev.nl/API/Rest', 'demo', 'demo');

        /** @var BaseResource $resourceName */
        $resource = new $resourceName($client);
        /** @var BaseResourceCollection $collection */
        $collection = new $collectionName();

        if (! ($collection instanceof PutData)) {
            $this->fail($resourceName . ' is not a PutData.');
        }

        $schema = file_get_contents(sprintf('https://ameijer.ccvdev.nl/API/Schema/%s', $schemaPath));

        $schemaObject = json_decode($schema, true, 512, JSON_THROW_ON_ERROR);
        $mockData = (object) $this->generateMockFromSchema($schemaObject);

        // Collection vullen met een aantal rows.
        $collection[] = \CCVShop\Api\Factory\ResourceFactory::createFromApiResult($mockData, $resource);
        $collection[] = \CCVShop\Api\Factory\ResourceFactory::createFromApiResult($mockData, $resource);
        $collection[] = \CCVShop\Api\Factory\ResourceFactory::createFromApiResult($mockData, $resource);

        $putData = $collection->getPutData();

        $validator = new Validator();
        $validator->validate($putData, $schema);

        $this->assertTrue($validator->isValid(), 'Error creating mock data');
    }
}
