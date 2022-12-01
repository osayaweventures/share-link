<?php declare(strict_types=1);

namespace Osayaweventures\ShareLinks;

use Statamic\Facades\Addon;

class ShareLink
{
    public static function version(): string
    {
        return Addon::get('osayaweventures/share-links')->version();
    }

    public static function contentPath(): string
    {
        return base_path('content/share-links.yaml');
    }
}
