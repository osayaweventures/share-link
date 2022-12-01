<?php declare(strict_types=1);

namespace Osayaweventures\ShareLinks\Dto;

use Illuminate\Support\Collection;

interface Channel
{
    public function getName(): string;

    public function getUrl(): string;

    public function getQueryParams(Collection $params): array;
}
