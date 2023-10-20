import app from 'flarum/admin/app';

app.initializers.add('danirod/flarum-plausible', (app) => {
  app.extensionData
    .for('danirod-plausible')
    .registerSetting({
      setting: 'danirod-plausible.enabled',
      label: app.translator.trans('danirod-plausible.admin.settings.enable.label'),
      help: app.translator.trans('danirod-plausible.admin.settings.enable.help'),
      type: 'boolean',
    })
    .registerSetting({
      setting: 'danirod-plausible.domain',
      label: app.translator.trans('danirod-plausible.admin.settings.domain.label'),
      help: app.translator.trans('danirod-plausible.admin.settings.domain.help'),
      type: 'text',
      required: true,
    })
    .registerSetting({
      setting: 'danirod-plausible.proxy-domain',
      label: app.translator.trans('danirod-plausible.admin.settings.proxy_domain.label'),
      help: app.translator.trans('danirod-plausible.admin.settings.proxy_domain.help'),
      placeholder: 'plausible.io',
      type: 'string',
    })
    .registerSetting({
      setting: 'danirod-plausible.exclude-admin',
      label: app.translator.trans('danirod-plausible.admin.settings.exclude_admin.label'),
      help: app.translator.trans('danirod-plausible.admin.settings.exclude_admin.help'),
      type: 'boolean',
    });
});
