<?php declare(strict_types=1);

namespace Osayaweventures\ShareLinks\Http\Controllers;

use Illuminate\Http\Request;
use Osayaweventures\ShareLinks\Blueprints\ShareLink;
use Osayaweventures\ShareLinks\ShareLinksContent;
use Statamic\Facades\User;
use Statamic\Http\Controllers\Controller;
use Statamic\Support\Arr;

use function is_null;

class ShareLinksCpController extends Controller
{
    public function edit()
    {
        $this->chekPermission();

        $blueprint = ShareLink::blueprint();
        $fields = $blueprint
            ->fields()
            ->addValues(ShareLinksContent::load()->all())
            ->preProcess();

        return view('share-links::edit', [
            'title' => "Edit Sharelinks config",
            'action' => cp_route('sharelinks.update'),
            'blueprint' => $blueprint->toPublishArray(),
            'meta' => $fields->meta(),
            'values' => $fields->values(),
        ]);
    }

    public function update(Request $request): void
    {
        $this->chekPermission();

        $blueprint = ShareLink::blueprint();
        $fields = $blueprint->fields()->addValues($request->all());

        $fields->validate();

        ShareLinksContent::load(
            $fields->process()->values()->all()
        )->save();
    }

    /**
     * @return void
     */
    private function chekPermission(): void
    {
        $user = User::current();
        if (is_null($user)) {
            abort(403);
        }

        abort_unless($user->can('edit share-links settings'), 403);
    }

}
