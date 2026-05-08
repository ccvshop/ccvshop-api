<?php

namespace CCVShop\ApiTests\Endpoints;

class GenericEndpointTest extends \CCVShop\ApiTests\Resources
{
    protected function setUp(): void
    {
        parent::setUp();

        // Environment variables should be registered for these checks.
        $this->assertNotEmpty(getenv('CCVSHOP_API_HOSTNAME'), 'CCVSHOP_API_HOSTNAME is missing in ENV');
        $this->assertNotEmpty(getenv('CCVSHOP_API_PUBLIC'), 'CCVSHOP_API_PUBLIC is missing in ENV');
        $this->assertNotEmpty(getenv('CCVSHOP_API_SECRET'), 'CCVSHOP_API_SECRET is missing in ENV');
    }

    /**
     * @dataProvider provider_getResourceObject
     *
     * @param object $resource
     *
     * @return void
     */
    public function testGetResourceObject(string $className): void
    {
        $apiClient = new \CCVShop\Api\ApiClient(getenv('CCVSHOP_API_HOSTNAME'), getenv('CCVSHOP_API_PUBLIC'), getenv('CCVSHOP_API_SECRET'));

        $class = sprintf('\CCVShop\Api\Endpoints\%s', $className);

        $endpoint = new $class($apiClient);

        $resource = $endpoint->getResourceObject();

        $resourceName = get_class($resource);

        if (substr($resourceName, -1) === 'y') {
            $resourceName = substr($resourceName, 0, -1) . 'ies';
        } else {
            $resourceName .= 's';
        }

        $this->assertStringContainsString($className, $resourceName);
    }

    public static function provider_getResourceObject(): array
    {
        $files = scandir('./src/Endpoints');

        $return = [];
        foreach ($files as $file) {
            if (!is_file('./src/Endpoints/' . $file)) {
                continue;
            }

            // Collections are skipped, they don't contain endpoints.
            if (strpos($file, 'Collection') !== false) {
                continue;
            }

            $className = basename($file, '.php');
            $return[] = [$className => $className];
        }

        return $return;
    }
}
