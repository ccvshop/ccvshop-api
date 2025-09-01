<?php

namespace CCVShop\ApiTests\Resources;

use CCVShop\Api\ApiClient;
use CCVShop\Api\BaseResource;
use CCVShop\Api\Interfaces\Endpoints\GetAll;
use CCVShop\ApiTests\Resources;
use JsonSchema\Validator;

class GetTest extends Resources
{
    public static function schemaGetOneProvider(): array
    {
        return [
            [\CCVShop\Api\Resources\AppCodeBlock::class, 'vnd.verto.webshop.resource.appcodeblocks.v1.json'],
            [\CCVShop\Api\Resources\AppConfig::class, 'vnd.verto.webshop.resource.appconfig.v1.json'],
            [\CCVShop\Api\Resources\AppMessage::class, 'vnd.verto.webshop.resource.appmessages.v1.json'],
            [\CCVShop\Api\Resources\App::class, 'vnd.verto.webshop.resource.apps.v1.json'],
            [\CCVShop\Api\Resources\AttributeValue::class, 'vnd.verto.webshop.resource.attributevalues.v1.json'],
            [\CCVShop\Api\Resources\Attribute::class, 'vnd.verto.webshop.resource.attributes.v1.json'],

            [\CCVShop\Api\Resources\Category::class, 'vnd.verto.webshop.resource.categories.v1.json'],
            [\CCVShop\Api\Resources\CategoryTree::class, 'vnd.verto.webshop.resource.categorytree.v1.json'],
            [\CCVShop\Api\Resources\Credential::class, 'vnd.verto.webshop.resource.credentials.v1.json'],
            [\CCVShop\Api\Resources\Creditpoint::class, 'vnd.verto.webshop.resource.creditpoints.v1.json'],
            [\CCVShop\Api\Resources\CreditpointMutation::class, 'vnd.verto.webshop.resource.creditpointmutations.v1.json'],
            [\CCVShop\Api\Resources\Label::class, 'vnd.verto.webshop.resource.labels.v1.json'],
            [\CCVShop\Api\Resources\Language::class, 'vnd.verto.webshop.resource.languages.v1.json'],
            [\CCVShop\Api\Resources\Merchant::class, 'vnd.verto.webshop.entity.merchant.v1.json'],
            [\CCVShop\Api\Resources\OrderLabel::class, 'vnd.verto.webshop.resource.orderlabels.v1.json'],
            [\CCVShop\Api\Resources\OrderRow::class, 'vnd.verto.webshop.resource.orderrows.v1.json'],
            [\CCVShop\Api\Resources\Order::class, 'vnd.verto.webshop.resource.orders.v1.json'],
            [\CCVShop\Api\Resources\Package::class, 'vnd.verto.webshop.resource.packages.v1.json'],
            [\CCVShop\Api\Resources\ProductAttributeValue::class, 'vnd.verto.webshop.resource.productattributevalues.v1.json'],
            [\CCVShop\Api\Resources\ProductAttributeSet::class, 'vnd.verto.webshop.resource.productattributesets.v1.json'],
            [\CCVShop\Api\Resources\ProductKeyword::class, 'vnd.verto.webshop.resource.productkeywords.v1.json'],
            [\CCVShop\Api\Resources\ProductLabel::class, 'vnd.verto.webshop.resource.productlabels.v1.json'],
            [\CCVShop\Api\Resources\ProductPhoto::class, 'vnd.verto.webshop.resource.productphotos.v1.json'],
            [\CCVShop\Api\Resources\ProductProperty::class, 'vnd.verto.webshop.resource.productproperties.v1.json'],
            [\CCVShop\Api\Resources\ProductPropertyGroup::class, 'vnd.verto.webshop.resource.productpropertygroups.v1.json'],
            [\CCVShop\Api\Resources\ProductPropertyOption::class, 'vnd.verto.webshop.resource.productpropertyoptions.v1.json'],
            [\CCVShop\Api\Resources\ProductPropertyValue::class, 'vnd.verto.webshop.resource.productpropertyvalues.v1.json'],
            [\CCVShop\Api\Resources\ProductToCategory::class, 'vnd.verto.webshop.resource.producttocategories.v1.json'],
            [\CCVShop\Api\Resources\ProductToPropertyGroup::class, 'vnd.verto.webshop.resource.producttopropertygroups.v1.json'],
            [\CCVShop\Api\Resources\Product::class, 'vnd.verto.webshop.resource.products.v1.json'],
            [\CCVShop\Api\Resources\ProductRelevant::class, 'vnd.verto.webshop.resource.productrelevant.v1.json'],
            [\CCVShop\Api\Resources\Redirect::class, 'vnd.verto.webshop.resource.redirects.v1.json'],
            [\CCVShop\Api\Resources\Setting::class, 'vnd.verto.webshop.entity.settings.v1.json'],
            [\CCVShop\Api\Resources\User::class, 'vnd.verto.webshop.resource.users.v1.json'],
            [\CCVShop\Api\Resources\Webhook::class, 'vnd.verto.webshop.resource.webhooks.v1.json'],
            [\CCVShop\Api\Resources\Webshop::class, 'vnd.verto.webshop.resource.webshops.v1.json'],

            // SalesPOS
            [\CCVShop\Api\Resources\Cashup::class, 'vnd.verto.salespos.resource.cashups.v1.json', \CCVShop\Api\BaseEndpoint::ACCEPT_HEADER_SALESPOS],
            [
                \CCVShop\Api\Resources\FiscalTransactionSignature::class,
                'vnd.verto.salespos.resource.fiscaltransactionsignatures.v1.json',
                \CCVShop\Api\BaseEndpoint::ACCEPT_HEADER_SALESPOS,
            ],
        ];
    }

    public static function schemaGetAllProvider(): array
    {
        return [
            //            ['appCodeBlocks'],
            //            ['appConfigs'],
            //            ['appMessages'],
            ['apps'],
            //            ['attributeValues'],
            ['attributes'],
            //            ['cashUps', \CCVShop\Api\BaseEndpoint::ACCEPT_HEADER_SALESPOS],
            ['categories'],
            //            ['categoryTree'],
            ['credentials'],
            //            ['creditPoints'],
            //            ['creditpointMutations'],
            //            ['fiscalTransactionSignatures', \CCVShop\Api\BaseEndpoint::ACCEPT_HEADER_SALESPOS],
            ['labels'],
            ['languages'],
            //            ['merchant'],
            //            ['orderLabels'],
            //            ['orderRows'],
            ['orders'],
            ['packages'],
            //            ['productAttributeValues'],
            //            ['productAttributesSets'],
            //            ['productKeywords'],
            //            ['productLabels'],
            //            ['productPhotos'],
            //            ['productProperties'],
            ['productPropertyGroups'],
            //            ['productPropertyOptions'],
            //            ['productPropertyValues'],
            //            ['productToCategories'],
            //            ['productToPropertyGroups'],
            ['products'],
            //            ['productsRelevant'],
            ['redirects'],
            //            ['settings'],
            ['users'],
            ['webhooks'],
            ['webshops'],
        ];
    }

    /**
     * @dataProvider schemaGetOneProvider
     *
     * @param string $resource
     * @param string $schemaPath
     *
     * @return void
     *
     * @throws \JsonException
     * @throws \ReflectionException
     */
    public function testGetOneSchema(string $resource, string $schemaPath): void
    {
        $client = new ApiClient('https://ameijer.ccvdev.nl/API/Rest', 'demo', 'demo');

        /** @var BaseResource $resource */
        $resource = new $resource($client);

        $schema = file_get_contents(sprintf('https://ameijer.ccvdev.nl/API/Schema/%s', $schemaPath));

        $schemaObject = json_decode($schema, true, 512, JSON_THROW_ON_ERROR);
        $mockData = (object) $this->generateMockFromSchema($schemaObject);

        $validator = new Validator();
        $validator->validate($mockData, $schema);

        $this->assertTrue($validator->isValid(), 'Error creating mock data');

        $resource = \CCVShop\Api\Factory\ResourceFactory::createFromApiResult($mockData, $resource);
    }

    /**
     * @dataProvider schemaGetAllProvider
     *
     * @param string $endpoint
     * @param string $acceptHeader
     *
     * @return void
     */
    public function testGetAllSchema(string $endpoint, string $acceptHeader = \CCVShop\Api\BaseEndpoint::ACCEPT_HEADER_WEBSHOP)
    {
        $client = new ApiClient('https://ameijer.ccvdev.nl/API/Rest', 'demo', 'demo');
        $endpointHandler = $client->getEndpoint($endpoint);

        if ($endpointHandler instanceof GetAll) {
            $result = $endpointHandler->getAll();

            $schema = file_get_contents(sprintf('https://ameijer.ccvdev.nl/API/Schema/vnd.verto.webshop.resource.collection.%s.v1.json', strtolower($endpoint)));
            $validator = new Validator();
            $validator->validate($result, $schema);

            $this->assertTrue($validator->isValid());
        }
    }
}
