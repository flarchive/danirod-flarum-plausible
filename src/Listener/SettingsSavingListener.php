<?php

namespace Danirod\FlarumPlausible\Listener;

use Danirod\FlarumPlausible\PlausibleConfigValidator;
use Flarum\Settings\Event\Saving;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class SettingsSavingListener
{
    /** @var PlausibleConfigValidator */
    private $validator;

    public function __construct(PlausibleConfigValidator $validator)
    {
        $this->validator = $validator;
    }

    public function handle(Saving $event)
    {
        if ($this->isMyEvent($event)) {
            $payload = $this->removeNamespace($event->settings);
            $this->validator->assertValid($payload);
        }
    }

    private function isMyEvent(Saving $saving)
    {
        return collect($saving->settings)->some(function ($_v, $key) {
            return Str::startsWith($key, "danirod-plausible.");
        });
    }

    private function removeNamespace(array $payload): array
    {
        return collect($payload)->mapWithKeys(function ($item, $key) {
            $new_key = Str::remove('danirod-plausible.', $key);
            return [$new_key => $item];
        })->toArray();
    }
}
