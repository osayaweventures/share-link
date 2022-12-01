<?php declare(strict_types=1);

namespace Osayaweventures\ShareLinks\Dto;

use Illuminate\Support\Collection;

class LinkedIn implements Channel
{
    public function getName(): string
    {
        return 'linkedin';
    }

    public function getUrl(): string
    {
        return 'https://www.linkedin.com/shareArticle';
    }

    public function getQueryParams(Collection $params): array
    {
        return [
            'mini' => 'true',
            'url' => $params->get('url'),
            'title' => $params->get('title'),
            'summary' => $params->get('text'),
            'source' => $params->get('source'),
        ];
    }
}
