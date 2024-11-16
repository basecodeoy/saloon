<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace BaseCodeOy\Saloon\Data\Tonic;

use BaseCodeOy\Datobs\AbstractData;

final class FilterData extends AbstractData
{
    public function __construct(
        public readonly string $attribute,
        public readonly string $value,
        public readonly string $operator,
        public readonly ?string $boolean,
    ) {}
}