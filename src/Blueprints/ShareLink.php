<?php declare(strict_types=1);

namespace Osayaweventures\ShareLinks\Blueprints;

use Statamic\Facades\Blueprint;
use Statamic\Fields\Blueprint as FieldBlueprint;

class ShareLink
{
    public static function blueprint(): FieldBlueprint
    {
        return Blueprint::make()->setContents([
              'sections' => [
                  'Twitter' => [
                      'fields' => [
                          [
                              'handle' => 'twitter',
                              'field' => [
                                  'type' => 'toggle',
                                  'display' => 'Button Enabled',
                                  'width' => 25,
                              ],
                          ],
                      ],
                  ],
                  'Facebook' => [
                      'fields' => [
                          [
                              'handle' => 'facebook',
                              'field' => [
                                  'type' => 'toggle',
                                  'display' => 'Button Enabled',
                                  'width' => 25,
                              ],
                          ],
                      ],
                  ],
                  'LinkedIn' => [
                      'fields' => [
                          [
                              'handle' => 'linkedin',
                              'field' => [
                                  'type' => 'toggle',
                                  'display' => 'Button Enabled',
                                  'width' => 25,
                              ],
                          ],
                      ],
                  ],
                  'WhatsApp' => [
                      'fields' => [
                          [
                              'handle' => 'whatsapp',
                              'field' => [
                                  'type' => 'toggle',
                                  'display' => 'Button Enabled',
                                  'width' => 25,
                              ],
                          ],
                      ],
                  ],
              ],
          ]);
    }
}
