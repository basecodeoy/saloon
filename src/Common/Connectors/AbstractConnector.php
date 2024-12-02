<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace BaseCodeOy\Saloon\Common\Connectors;

use Saloon\Http\Connector;
use Saloon\Traits\Plugins\AlwaysThrowOnErrors;

abstract class AbstractConnector extends Connector
{
    use AlwaysThrowOnErrors;

    public static function create(mixed ...$arguments): static
    {
        return new static(...$arguments);
    }
}
