<?php declare(strict_types=1);

namespace Vendor\requests;

require __DIR__ . '/../autoload.php';

class Api
{
    protected function __construct(array|object $body, int $httpResponseCode, $error)
    {
        http_response_code($httpResponseCode);

        echo json_encode([
            'reponse' => [
                'body' => (array) $body
            ],
            'error' => $error
        ]);

        exit;
    }

    public static function response(array|object $body = [], int $httpResponseCode = 200, $error = false): self
    {
        return new self($body, $httpResponseCode, $error);
    }

    public static function debug(mixed $body)
    {
        var_dump($body);

        exit;
    }
}
