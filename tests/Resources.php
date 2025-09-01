<?php

namespace CCVShop\ApiTests;

use PHPUnit\Framework\TestCase;

abstract class Resources extends TestCase
{
    /**
     * Maakt op basis van json schema een dummy data object.
     *
     * @param array<string,mixed> $schema
     *
     * @return array<int,mixed>|bool|float|int|object|string
     */
    protected function generateMockFromSchema(array $schema)
    {
        if (isset($schema['enum'])) {
            // Kies de eerste waarde uit enum, enums zijn altijd strings.
            return (string) $schema['enum'][0];
        }

        switch ($schema['type'] ?? 'object') {
            case 'null|string':
            case 'string|null':
            case 'string':
                if (($schema['format'] ?? '') === 'date-time') {
                    return gmdate('Y-m-d\TH:i:s\Z');
                }
                if (($schema['format'] ?? '') === 'email') {
                    return 'test@ccvshop.nl';
                }
                if (($schema['format'] ?? '') === 'uri') {
                    return 'https://ccvshop.nl';
                }

                return 'dummy_string';
            case 'null|integer':
            case 'integer|null':
            case 'integer':
                return 123;
            case 'null|number':
            case 'number|null':
            case 'number':
                return 123.45;
            case 'boolean':
                return true;
            case 'array':
                $itemsSchema = $schema['items'] ?? ['type' => 'string'];

                return [$this->generateMockFromSchema($itemsSchema)];
            case 'null|object':
            case 'object|null':
            case 'object':
            default:
                $obj = array_map(function ($propSchema) {
                    return $this->generateMockFromSchema($propSchema);
                }, $schema['properties'] ?? []);

                return (object) $obj;
        }
    }
}
