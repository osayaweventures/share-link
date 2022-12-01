<?php

namespace Osayaweventures\ShareLinks;

use Statamic\Facades\CP\Nav;
use Statamic\Facades\Permission;
use Statamic\Facades\User;
use Statamic\Providers\AddonServiceProvider;
use Osayaweventures\ShareLinks\Tags\ShareLinks;

use function is_null;

class ServiceProvider extends AddonServiceProvider
{
    protected $tags = [
        ShareLinks::class,
    ];

    protected $routes = [
        'cp' => __DIR__ . '/../routes/cp.php',
    ];

    public function boot()
    {
        parent::boot();

        $this
            ->bootAddonViews()
            ->bootAddonPermissions()
            ->bootAddonNav();
    }

    protected function bootAddonViews(): static
    {
        $this->publishes([
             __DIR__.'/../resources/views/buttons.antlers.html' => resource_path('views/vendor/share-links/buttons.antlers.php'),
         ], 'share-links-views');

        return $this;
    }

    protected function bootAddonPermissions()
    {
        $this->app->booted(function () {
            Permission::group('share-links', 'Social Share Links', static function () {
                Permission::register('view share-links settings')->label('View share link settings');
                Permission::register('edit share-links settings')->label('Edit share links settings');
            });
        });

        return $this;
    }

    protected function bootAddonNav(): static
    {
        Nav::extend(function ($nav) {
            if ($this->hasShareLinksPermissions()) {
                $nav->tools('Share Links')
                    ->route('sharelinks.edit')
                    ->icon('<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M7.217 10.907a2.25 2.25 0 100 2.186m0-2.186c.18.324.283.696.283 1.093s-.103.77-.283 1.093m0-2.186l9.566-5.314m-9.566 7.5l9.566 5.314m0 0a2.25 2.25 0 103.935 2.186 2.25 2.25 0 00-3.935-2.186zm0-12.814a2.25 2.25 0 103.933-2.185 2.25 2.25 0 00-3.933 2.185z" /></svg>')
                    ->active('share-links');
            }
        });

        return $this;
    }

    private function hasShareLinksPermissions(): bool
    {
        $user = User::current();

        if (is_null($user)) {
            return false;
       }

        return $user->can('view share-links settings')
            || $user->can('edit share-links settings');
    }
}
