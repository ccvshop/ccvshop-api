<?php

namespace CCVShop\ApiTests\Resources;

use CCVShop\Api\ApiClient;
use CCVShop\Api\BaseResource;
use CCVShop\Api\Interfaces\Resources\PatchData;
use CCVShop\ApiTests\Resources;
use JsonSchema\Validator;

class PatchTest extends Resources
{
    public static function schemaEntityPatchProvider(): array
    {
        return [
            [\CCVShop\Api\Resources\AppConfig::class, 'internal.resource.appconfig.patch.v1.json'],
            [\CCVShop\Api\Resources\App::class, 'internal.resource.apps.patch.v1.json'],
            [\CCVShop\Api\Resources\Category::class, 'internal.resource.categories.patch.v1.json'],
            [\CCVShop\Api\Resources\ProductProperty::class, 'internal.resource.productproperties.patch.v1.json'],
            [\CCVShop\Api\Resources\ProductPropertyValue::class, 'internal.resource.productpropertyvalues.patch.v1.json'],
            [\CCVShop\Api\Resources\Product::class, 'internal.webshop.resource.products.patch.v1.json'],
            [\CCVShop\Api\Resources\Redirect::class, 'internal.resource.redirects.patch.v1.json'],
            [\CCVShop\Api\Resources\User::class, 'internal.resource.users.patch.v1.json'],
            [\CCVShop\Api\Resources\Webhook::class, 'internal.resource.webhooks.patch.v1.json'],
            [\CCVShop\Api\Resources\Merchant::class, 'internal.webshop.resource.merchant.patch.v1.json'],

            // SalesPOS
            [
                \CCVShop\Api\Resources\FiscalTransactionSignature::class,
                'internal.salespos.resource.fiscaltransactionsignatures.patch.v1.json',
                \CCVShop\Api\BaseEndpoint::ACCEPT_HEADER_SALESPOS,
            ],
        ];
    }

    /**
     * @dataProvider schemaEntityPatchProvider
     *
     * @param string $resourceName
     * @param string $schemaPath
     *
     * @return void
     */
    public function testPatchData(string $resourceName, string $schemaPath): void
    {
        $client = new ApiClient('https://ameijer.ccvdev.nl/API/Rest', 'demo', 'demo');

        /** @var BaseResource $resourceName */
        $resource = new $resourceName($client);

        if (! ($resource instanceof PatchData)) {
            $this->fail($resourceName . ' is not a PatchData.');
        }

        $schema = file_get_contents(sprintf('https://ameijer.ccvdev.nl/API/Schema/%s', $schemaPath));

        $schemaObject = json_decode($schema, true, 512, JSON_THROW_ON_ERROR);
        $mockData = (object) $this->generateMockFromSchema($schemaObject);

        $resource = \CCVShop\Api\Factory\ResourceFactory::createFromApiResult($mockData, $resource);

        $patchData = $resource->getPatchData();

        $validator = new Validator();
        $validator->validate($patchData, $schema);

        $this->assertTrue($validator->isValid(), 'Error creating mock data');
    }
}
