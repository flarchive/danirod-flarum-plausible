<?php

namespace Danirod\FlarumPlausible;

use Flarum\Foundation\AbstractValidator;

class PlausibleConfigValidator extends AbstractValidator
{
    // In case of reference: https://stackoverflow.com/a/26987741/2033517
    const DOMAIN_REGEX = "/^((?!-))(xn--)?[a-z0-9][a-z0-9-_]{0,61}[a-z0-9]{0,1}\.(xn--)?([a-z0-9\-]{1,61}|[a-z0-9-]{1,30}\.[a-z]{2,})$/";

    protected $rules = [
        'domain' => ['required', 'regex:' . self::DOMAIN_REGEX],
        'proxy-domain' => ['regex:' . self::DOMAIN_REGEX],
    ];

    protected function getMessages()
    {
        return [
            'domain.required' => resolve('translator')->trans('danirod-plausible.admin.validation.domain.required'),
            'domain.regex' => resolve('translator')->trans('danirod-plausible.admin.validation.domain.regex'),
            'proxy-domain.regex' => resolve('translator')->trans('danirod-plausible.admin.validation.proxy_domain.regex'),
        ];
    }
}
