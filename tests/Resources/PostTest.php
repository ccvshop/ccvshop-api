<?php

namespace CCVShop\ApiTests\Resources;

use CCVShop\Api\ApiClient;
use CCVShop\Api\BaseResource;
use CCVShop\Api\Interfaces\Resources\PostData;
use JsonSchema\Validator;

class PostTest extends \CCVShop\ApiTests\Resources
{
    public static function schemaEntityPostProvider(): array
    {
        return [
            [\CCVShop\Api\Resources\AppCodeBlock::class, 'internal.resource.appcodeblocks.post.v1.json'],
            [\CCVShop\Api\Resources\AppConfig::class, 'internal.resource.appconfig.input.v1.json'],
            [\CCVShop\Api\Resources\AppMessage::class, 'internal.resource.appmessages.post.v1.json'],

            [\CCVShop\Api\Resources\Category::class, 'internal.resource.categories.post.v1.json'],
            //            [\CCVShop\Api\Resources\Credential::class, 'internal.resource.credentials.post.v1.json'],
            [\CCVShop\Api\Resources\Label::class, 'internal.resource.labels.post.v1.json'],
            [\CCVShop\Api\Resources\Language::class, 'internal.resource.languages.post.v1.json'],

            [\CCVShop\Api\Resources\ProductKeyword::class, 'internal.resource.productkeywords.post.v1.json'],
            [\CCVShop\Api\Resources\ProductPhoto::class, 'internal.resource.productphotos.post.v1.json'],
            [\CCVShop\Api\Resources\ProductProperty::class, 'internal.resource.productproperties.post.v1.json'],
            [\CCVShop\Api\Resources\ProductPropertyGroup::class, 'internal.resource.productpropertygroups.post.v1.json'],
            [\CCVShop\Api\Resources\ProductPropertyOption::class, 'internal.resource.productpropertyoptions.post.v1.json'],
            [\CCVShop\Api\Resources\ProductPropertyValue::class, 'internal.resource.productpropertyvalues.post.v1.json'],
            [\CCVShop\Api\Resources\ProductToCategory::class, 'internal.resource.producttocategories.post.v1.json'],
            [\CCVShop\Api\Resources\ProductToPropertyGroup::class, 'internal.resource.producttopropertygroups.post.v1.json'],
            [\CCVShop\Api\Resources\Product::class, 'internal.webshop.resource.products.post.v1.json'],
            [\CCVShop\Api\Resources\ProductRelevant::class, 'internal.resource.productrelevant.post.v1.json'],
            [\CCVShop\Api\Resources\Redirect::class, 'internal.resource.redirects.post.v1.json'],

            [\CCVShop\Api\Resources\Webhook::class, 'internal.resource.webhooks.post.v1.json'],

            // SalesPOS
            [
                \CCVShop\Api\Resources\FiscalTransactionSignature::class,
                'internal.salespos.resource.fiscaltransactionsignatures.post.v1.json',
                \CCVShop\Api\BaseEndpoint::ACCEPT_HEADER_SALESPOS,
            ],
        ];
    }

    /**
     * @dataProvider schemaEntityPostProvider
     *
     * @param string $resourceName
     * @param string $schemaPath
     *
     * @return void
     */
    public function testPostData(string $resourceName, string $schemaPath): void
    {
        $client = new ApiClient('https://ameijer.ccvdev.nl/API/Rest', 'demo', 'demo');

        /** @var BaseResource $resourceName */
        $resource = new $resourceName($client);

        if (! ($resource instanceof PostData)) {
            $this->fail($resourceName . ' is not a PostData.');
        }

        $schema = file_get_contents(sprintf('https://ameijer.ccvdev.nl/API/Schema/%s', $schemaPath));

        $schemaObject = json_decode($schema, true, 512, JSON_THROW_ON_ERROR);
        $mockData = (object) $this->generateMockFromSchema($schemaObject);

        $resource = \CCVShop\Api\Factory\ResourceFactory::createFromApiResult($mockData, $resource);

        $patchData = $resource->getPostData();

        $validator = new Validator();
        $validator->validate($patchData, $schema);

        $this->assertTrue($validator->isValid(), 'Error creating mock data');
    }
}
