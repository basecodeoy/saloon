<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace BaseCodeOy\Saloon\Common\Requests;

use BaseCodeOy\Datobs\AbstractData;
use Illuminate\Support\Str;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;
use Spatie\LaravelData\DataCollection;

/**
 * @property AbstractData|array $data
 */
abstract class AbstractMicroserviceRequest extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    #[\Override()]
    public function resolveEndpoint(): string
    {
        return '/rpc';
    }

    protected function defaultBody(): array
    {
        $parameters = $this->getMethodData();

        if ($parameters === []) {
            return [
                'jsonrpc' => '2.0',
                'id' => (string) Str::ulid(),
                'method' => $this->getMethodName(),
            ];
        }

        return [
            'jsonrpc' => '2.0',
            'id' => (string) Str::ulid(),
            'method' => $this->getMethodName(),
            'params' => $parameters,
        ];
    }

    protected function getMethodName(): string
    {
        return str(static::class)
            ->afterLast('\\')
            ->before('Request')
            ->snake()
            ->prepend('app.')
            ->toString();
    }

    protected function getMethodData(): array
    {
        if (\property_exists($this, 'data')) {
            $is_data = $this->data instanceof AbstractData || $this->data instanceof DataCollection;

            if ($is_data) {
                return [
                    'data' => $this->data->toArray(),
                ];
            }

            if (\is_array($this->data)) {
                return [
                    'data' => $this->data,
                ];
            }
        }

        return [];
    }
}
