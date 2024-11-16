<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace BaseCodeOy\Saloon\Common\Requests;

use BaseCodeOy\Saloon\Common\Actions\GenerateSoapBody;
use BaseCodeOy\Saloon\Common\Traits\HasSoapBodyTrait;
use Saloon\Contracts\Body\HasBody;
use Saloon\Http\Request;

abstract class AbstractSoapRequest extends Request implements HasBody
{
    use HasSoapBodyTrait;

    protected function createSoapBody(string $method, array $data): string
    {
        return GenerateSoapBody::execute($this->resolveEndpoint(), $method, $data);
    }
}
