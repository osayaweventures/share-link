<?php declare(strict_types=1);

namespace Osayaweventures\ShareLinks\Dto;

use Illuminate\Support\Collection;

class Twitter implements Channel
{

    public function getName(): string
    {
        return 'twitter';
    }

    public function getUrl(): string
    {
        return 'https://twitter.com/intent/tweet';
    }

    public function getQueryParams(Collection $params): array
    {
        $hashTags = preg_replace("/\s+/", '', $params->get('hashtags') ?? '');
        $related = preg_replace("/\s+/", '', $params->get('related') ?? '');

        $query = [
            'url' => $params->get('url'),
            'text' => $params->get('text'),
            'via' => $params->get('handle'),
        ];

        if ($hashTags !== "") {
            $query['hashtags'] = $hashTags;
        }

        if ($related !== "") {
            $query['related'] = $related;
        }

        return $query;
    }
}
