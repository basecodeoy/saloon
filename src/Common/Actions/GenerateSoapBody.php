<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace BaseCodeOy\Saloon\Common\Actions;

use BaseCodeOy\Saloon\Common\Support\MockSoapClient;

final readonly class GenerateSoapBody
{
    public static function execute(string $wsdl, string $method, array $data): string
    {
        $mockSoapClient = new MockSoapClient($wsdl);
        $mockSoapClient->{$method}($data);

        return $mockSoapClient->getLastRequest();
    }
}
