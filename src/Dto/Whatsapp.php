<?php declare(strict_types=1);

namespace Osayaweventures\ShareLinks\Dto;

use Illuminate\Support\Collection;

class Whatsapp implements Channel
{
    public function getName(): string
    {
        return 'whatsapp';
    }

    public function getUrl(): string
    {
        return 'https://api.whatsapp.com/send';
    }

    public function getQueryParams(Collection $params): array
    {
        return [
            'text' => $params->get('url'),
        ];
    }
}
