<?php declare(strict_types=1);

namespace Osayaweventures\ShareLinks\Dto;

use Illuminate\Support\Collection;

class Facebook implements Channel
{
    public function getName(): string
    {
        return 'facebook';
    }

    public function getUrl(): string
    {
        return 'https://www.facebook.com/sharer/sharer.php';
    }

    public function getQueryParams(Collection $params): array
    {
        return [
            'u' => $params->get('url'),
            'quote' => $params->get('text'),
        ];
    }
}
