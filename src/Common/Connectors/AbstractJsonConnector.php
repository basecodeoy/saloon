<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace BaseCodeOy\Saloon\Common\Connectors;

use Saloon\Traits\Plugins\AlwaysThrowOnErrors;

abstract class AbstractJsonConnector extends AbstractConnector
{
    use AlwaysThrowOnErrors;

    /**
     * @return array<string, string>
     */
    #[\Override()]
    protected function defaultHeaders(): array
    {
        return [
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ];
    }
}
