<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace BaseCodeOy\Saloon\Common\Traits;

use Saloon\Http\PendingRequest;
use Saloon\Traits\Body\HasStringBody;

trait HasSoapBodyTrait
{
    use HasStringBody;

    public function bootHasSoapBodyTrait(PendingRequest $pendingRequest): void
    {
        $pendingRequest->headers()->add('Content-Type', 'application/soap+xml');
    }
}
