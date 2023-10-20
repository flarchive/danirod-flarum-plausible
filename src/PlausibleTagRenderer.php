<?php

namespace Danirod\FlarumPlausible;

use Flarum\Frontend\Document;
use Flarum\User\User;
use Psr\Http\Message\ServerRequestInterface;

class PlausibleTagRenderer
{
    /** @var PlausibleConfig */
    protected $config;

    public function __construct(PlausibleConfig $config)
    {
        $this->config = $config;
    }

    public function __invoke(Document $document, ServerRequestInterface $request)
    {
        if ($this->enableTracking($request)) {
            $path = realpath(__DIR__.'/../resources/js/plausible.html');
            $content = file_get_contents($path);
            $content = str_replace("%DOMAIN%", $this->config->getDomain(), $content);
            $content = str_replace("%SERVE%", $this->getScriptTagDomain(), $content);
            $document->head[] = $content;
        } else {
            $comment = "<!-- Tracking is disabled for this request -->";
            $document->head[] = $comment;
        }
    }

    private function enableTracking(ServerRequestInterface $request): bool
    {
        // If the tracking is not enabled, not much to say.
        if (!$this->config->isEnabled()) {
            return false;
        }

        // If the current session is an admin one, only if not excluded.
        $user = $this->getUser($request);
        if ($user != null && $user->isAdmin() && $this->config->isAdminExcluded()) {
            return false;
        }

        return true;
    }

    private function getUser(ServerRequestInterface $request): ?User
    {
        $user = $request->getAttribute('actor');
        if ($user->id == 0) {
            return null;
        }
        return $user;
    }

    private function getScriptTagDomain(): string {
        $domain = $this->config->getProxyDomain();
        if ($domain && mb_strlen($domain) > 0) {
            return $domain;
        }
        return "plausible.io";
    }
}
