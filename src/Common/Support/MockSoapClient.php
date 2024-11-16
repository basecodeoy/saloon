<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace BaseCodeOy\Saloon\Common\Support;

use Laminas\Soap\Client;
use Laminas\Soap\Client\Common;

final class MockSoapClient extends Client
{
    private string $lastRequest;

    #[\Override()]
    public function _doRequest(Common $client, $request, $location, $action, $version, $oneWay = null)
    {
        $this->lastRequest = $request;

        return '';
    }

    #[\Override()]
    public function getLastRequest(): string
    {
        return $this->lastRequest;
    }
}
