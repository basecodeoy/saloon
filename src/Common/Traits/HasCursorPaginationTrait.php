<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace BaseCodeOy\Saloon\Common\Traits;

use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\PaginationPlugin\CursorPaginator;
use Saloon\Traits\Body\HasJsonBody;

trait HasCursorPaginationTrait
{
    public function paginate(Request $request): CursorPaginator
    {
        return new class(connector: $this, request: $request) extends CursorPaginator
        {
            protected ?int $perPageLimit = 100;

            protected function getNextCursor(Response $response): int|string
            {
                return $response->json('result.meta.page.cursor.next');
            }

            protected function isLastPage(Response $response): bool
            {
                return $response->json('result.meta.page.cursor.next') === null;
            }

            protected function getPageItems(Response $response, Request $request): array
            {
                return $response->json('result.data');
            }

            /**
             * @param HasJsonBody|Request $request
             */
            protected function applyPagination(Request $request): Request
            {
                if (!\in_array(HasJsonBody::class, \class_uses_recursive($request), true)) {
                    return $request;
                }

                if ($this->currentResponse instanceof Response) {
                    $request->body()->merge([
                        ...$request->body()->all(),
                        'params' => [
                            ...\array_filter($request->body()->get('params', []) ?: []),
                            'page' => [
                                'cursor' => $this->getNextCursor($this->currentResponse),
                                'size' => $this->perPageLimit,
                            ],
                        ],
                    ]);
                }

                return $request;
            }
        };
    }
}
