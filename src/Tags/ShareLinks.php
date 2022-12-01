<?php

namespace Osayaweventures\ShareLinks\Tags;

use Osayaweventures\ShareLinks\Channels\LinkBuilder;
use Osayaweventures\ShareLinks\Dto\NotFoundChannel;
use Osayaweventures\ShareLinks\ShareLink as ShareLinkAddon;
use Osayaweventures\ShareLinks\Dto\Facebook;
use Osayaweventures\ShareLinks\Dto\LinkedIn;
use Osayaweventures\ShareLinks\Dto\Twitter;
use Illuminate\Support\Facades\Request;
use Osayaweventures\ShareLinks\Dto\Whatsapp;
use Statamic\Facades\YAML;
use Statamic\Tags\Tags;

class ShareLinks extends Tags
{
    /**
     * The handle of the tag.
     *
     * @var string
     */
    protected static $handle = 'share_links';

    /**
     * Get the social sharing link by channel name
     *
     * Use {{ share_links }} tag to get links in your view.
     */
    public function index()
    {
        return view('share-links::buttons')->with($this->getSettings());
    }

    /*
     * Maps to {{ share_links:channel }}
     *
     * Where `channel` is the name of the social channel e.g. Facebook
     *
     * @return string|null
     */
    public function wildcard($channel): ?string
    {
        return $this->getLink($channel);
    }

    /**
     * The {{ share_links:dump }} tag.
     */
    public function dump()
    {
        return dd($this->getLinks());
    }

    /**
     * Get links for all enabled channels
     */
    private function getLinks(): array
    {
        $this->params['url'] = $this->params->get('url') ?? Request::fullUrl();

        $links = (new LinkBuilder(
               $this->params,
            ...[new Facebook(), new Twitter(), new LinkedIn(), new Whatsapp]
        ))->links();

        $settings = $this->getSettings();

        return collect($links)->filter(static function ($value, $key) use ($settings) {
            return $settings[$key] === true;
        })->all();
    }

    private function getLink(?string $channel): ?string
    {
        return $this->getLinks()[$channel] ?? null ;
    }

    /**
     * Load settings from yaml file
     */
    private function getSettings(): array
    {
        return collect(YAML::file(ShareLinkAddon::contentPath())->parse())->all();
    }
}
