<?php

namespace CCVShop\ApiTests\Resources;

use PHPUnit\Framework\TestCase;

class GenericResourceTest extends TestCase
{
    /**
     * @dataProvider provider_getEndpoint
     *
     * @param string $resource
     *
     * @return void
     */
    public function testGetEndpoint(string $className): void
    {
        $apiClient = new \CCVShop\Api\ApiClient(getenv('CCVSHOP_API_HOSTNAME'), getenv('CCVSHOP_API_PUBLIC'), getenv('CCVSHOP_API_SECRET'));

        $resource = \CCVShop\Api\Factory\ResourceFactory::create($apiClient, $className);

        $endpoint = $resource->getEndpoint();

        // Solution to fix singular names than end in `y`.
        if (substr($className, -1) === 'y') {
            $className = substr($className, 0, -1) . 'ies';
        }

        $this->assertStringContainsString($className, get_class($endpoint));
    }

    public static function provider_getEndpoint(): array
    {
        $files = scandir('./src/Resources');

        $return = [];
        foreach ($files as $file) {
            if (!is_file('./src/Resources/' . $file)) {
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
