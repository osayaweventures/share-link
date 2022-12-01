<?php declare(strict_types=1);

namespace Osayaweventures\ShareLinks;

use Illuminate\Support\Collection;
use Statamic\Facades\File;
use Statamic\Facades\YAML;
use Osayaweventures\ShareLinks\Blueprints\ShareLink;
use Osayaweventures\ShareLinks\ShareLink as ShareLinkAddon;

use function is_null;

class ShareLinksContent extends Collection
{
    public function __construct($items = null)
    {
        parent::__construct($items);

        if (! is_null($items)) {
            $items = collect($items)->all();
        }

        $this->items = $items ?? $this->getDefaults();
    }

    public static function load($items = null): static
    {
        return new static($items);
    }

    public function augmented()
    {
        $defaultValues = ShareLink::blueprint()
            ->fields()
            ->addValues($this->items)
            ->augment()
            ->values();

        return $defaultValues
            ->only(array_keys($this->items))
            ->all();
    }

    public function save()
    {
        File::put($this->path(), YAML::dump($this->items));
    }

    protected function path(): string
    {
        return ShareLinkAddon::contentPath();
    }

    protected function getDefaults(): array
    {
        return collect(YAML::file($this->path())->parse())->all();
    }
}
