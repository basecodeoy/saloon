<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace BaseCodeOy\Saloon\Common\Connectors;

use BaseCodeOy\Saloon\Common\Traits\HasCursorPaginationTrait;
use Saloon\Http\Auth\TokenAuthenticator;
use Saloon\Http\Response;
use Saloon\PaginationPlugin\Contracts\HasPagination;

abstract class AbstractMicroserviceConnector extends AbstractJsonConnector implements HasPagination
{
    use HasCursorPaginationTrait;

    public ?int $tries = 3;

    public ?int $retryInterval = 500;

    #[\Override()]
    public function resolveBaseUrl(): string
    {
        return $this->configByKey('base_url');
    }

    #[\Override()]
    public function hasRequestFailed(Response $response): bool
    {
        // Client Error
        if ($response->status() >= 400 && $response->status() < 500) {
            return true;
        }

        // Server Error
        if ($response->status() >= 500) {
            return true;
        }

        return $response->json('error') !== null;
    }

    #[\Override()]
    protected function defaultAuth(): TokenAuthenticator
    {
        return new TokenAuthenticator($this->configByKey('token'));
    }

    #[\Override()]
    protected function defaultConfig(): array
    {
        return [
            'timeout' => 30,
        ];
    }

    protected function getServiceName(): string
    {
        return str(static::class)
            ->before('\\Connectors')
            ->afterLast('\\')
            ->snake()
            ->toString();
    }

    protected function configByKey(string $key): mixed
    {
        return config(
            \sprintf(
                'services.microservices.%s.%s',
                $this->getServiceName(),
                $key,
            ),
        );
    }
}
