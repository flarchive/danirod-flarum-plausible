<?php

namespace Danirod\FlarumPlausible;

use Flarum\Settings\SettingsRepositoryInterface;

class PlausibleConfig
{
    /** @var SettingsRepositoryInterface */
    protected $settings;

    public function __construct(SettingsRepositoryInterface $settings)
    {
        $this->settings = $settings;
    }

    public function isEnabled(): bool {
        return (bool) $this->settings->get('danirod-plausible.enabled');
    }

    public function getDomain(): string {
        return $this->settings->get('danirod-plausible.domain');
    }

    public function getProxyDomain(): ?string {
        return $this->settings->get('danirod-plausible.proxy-domain');
    }

    public function isAdminExcluded(): bool {
        return (bool) $this->settings->get('danirod-plausible.exclude-admin');
    }
}
