<?php

declare(strict_types=1);

namespace CCVShop\ApiTests\Endpoints;

use CCVShop\Api\ApiClient;
use CCVShop\Api\BaseResource;
use CCVShop\Api\BaseResourceCollection;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;

class GetForTest extends TestCase
{
    private const PUBLIC = 'test-public';
    private const SECRET = 'test-secret';
    private const DATE   = '2026-01-01T00:00:00+00:00';

    /** @var array<int,array<string,mixed>> */
    private array $history = [];

    /**
     * Every endpoint exposing getFor(Resource $parent) is a nested-collection case.
     * Discovered via reflection so new endpoints are covered automatically.
     *
     * @return array<string,array{0:class-string,1:class-string}>
     */
    public static function getForProvider(): array
    {
        $cases = [];
        foreach (scandir(__DIR__ . '/../../src/Endpoints') ?: [] as $file) {
            if (!preg_match('/^(\w+)\.php$/', $file, $m)) {
                continue;
            }
            $endpointClass = 'CCVShop\\Api\\Endpoints\\' . $m[1];
            if (!class_exists($endpointClass) || !method_exists($endpointClass, 'getFor')) {
                continue;
            }
            $params = (new \ReflectionMethod($endpointClass, 'getFor'))->getParameters();
            $type = $params[0]->getType() ?? null;
            // Skip getFor(int $id) style overloads; we only drive the resource-parent variant.
            if (!$type instanceof \ReflectionNamedType || $type->isBuiltin()) {
                continue;
            }
            $parentClass = $type->getName();
            if (!is_subclass_of($parentClass, BaseResource::class)) {
                continue;
            }
            $cases[$m[1]] = [$endpointClass, $parentClass];
        }

        return $cases;
    }

    /**
     * @dataProvider getForProvider
     *
     * @param class-string $endpointClass
     * @param class-string $parentClass
     */
    public function testGetForRequestsNestedCollection(string $endpointClass, string $parentClass): void
    {
        $parentId = 42;

        // Derive the expected nested URI from the static resource paths (no HTTP).
        $probe      = new ApiClient();
        $childPath  = (new $endpointClass($probe))->getResourcePath();
        $parentPath = (new $parentClass($probe))->getEndpoint()->getResourcePath();
        $uri        = sprintf('/api/rest/v1/%s/%d/%s', $parentPath, $parentId, $childPath);

        $body   = (string) json_encode(['items' => [['id' => 1]], 'next' => null, 'previous' => null]);
        $client = $this->makeClient([$this->signedResponse('GET', $uri, $body)]);

        $parent     = new $parentClass($client);
        $parent->id = $parentId;

        $collection = (new $endpointClass($client))->getFor($parent);

        $this->assertInstanceOf(BaseResourceCollection::class, $collection);
        $this->assertCount(1, $collection);
        $this->assertInstanceOf(BaseResource::class, $collection[0]);
        $this->assertSame($uri, $this->history[0]['request']->getUri()->getPath());
    }

    /** @param Response[] $responses */
    private function makeClient(array $responses): ApiClient
    {
        $this->history = [];
        $stack = HandlerStack::create(new MockHandler($responses));
        $stack->push(Middleware::history($this->history));

        return new ApiClient('https://shop.example.test', self::PUBLIC, self::SECRET, new Client(['handler' => $stack]));
    }

    /** Build a response carrying the x-hash/x-date headers BaseEndpoint::validateResponse expects. */
    private function signedResponse(string $method, string $uri, string $body): Response
    {
        $hash = hash_hmac(
            'sha512',
            implode('|', [self::PUBLIC, $method, $uri, $body, self::DATE]),
            self::SECRET
        );

        return new Response(200, ['x-hash' => $hash, 'x-date' => self::DATE], $body);
    }
}
