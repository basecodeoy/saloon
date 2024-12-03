<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace BaseCodeOy\Saloon\Data\Casts;

use Spatie\LaravelData\Casts\Cast;
use Spatie\LaravelData\Support\Creation\CreationContext;
use Spatie\LaravelData\Support\DataProperty;
use function BaseCodeOy\Support\Functions\int_normalize;

final readonly class IntegerCast implements Cast
{
    #[\Override()]
    public function cast(DataProperty $dataProperty, mixed $value, array $properties, CreationContext $creationContext): ?int
    {
        return int_normalize($value);
    }
}
