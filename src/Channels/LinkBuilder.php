<?php declare(strict_types=1);

namespace Osayaweventures\ShareLinks\Channels;

use Osayaweventures\ShareLinks\Contract\ShareLink;
use Illuminate\Support\Collection;
use Osayaweventures\ShareLinks\Dto\Channel;

class LinkBuilder implements ShareLink
{
    private Collection $params;

    /** @var Channel[]  */
    private array $channels;

    public function __construct(
        Collection $params,
        Channel ...$channels
    ) {
        $this->params = $params;
        $this->channels = $channels;
    }

    public function links(): array
    {
        $links = [];
        foreach ($this->channels as $channel) {
            $links[$channel->getName()] = $channel->getUrl() . '?' . http_build_query($channel->getQueryParams($this->params));
        }

        return $links;
    }
}
