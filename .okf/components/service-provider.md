---
type: Module
title: ProbeServiceProvider
description: Deferred Venusian provider that registers command.probe and merges/publishes probe config.
resource: src/ProbeServiceProvider.php
tags: [component, provider, deferred, computer]
generated: { by: agent:cursor-grok-4.6, at: "2026-08-23T04:10:00Z" }
status: draft
sources:
  - id: provider
    resource: src/ProbeServiceProvider.php
    title: ProbeServiceProvider
  - id: composer
    resource: composer.json
    title: venusian.providers discovery
  - id: nab-sp
    resource: venusian/framework src/Voyager/NutsAndBolts/ServiceProvider.php
    title: Voyager ServiceProvider ($app)
  - id: deferrable
    resource: venusian/framework src/Voyager/Contracts/NutsAndBolts/DeferrableProvider.php
    title: DeferrableProvider contract (0.8)
---

# Role

`Venusian\Probe\ProbeServiceProvider` registers the Computer command binding and merges `config/probe.php`.[^provider][^composer]

It implements `DeferrableProvider` and `provides()` → `['command.probe']`, so it loads when that binding (or command list path) needs it. Console bootstrap must call `loadDeferredProviders()` so deferred probe is available for `computer probe` / help listing.[^provider]

# 0.8 API expectations

| Concern | 0.8 target |
|---------|------------|
| Base | `Voyager\NutsAndBolts\ServiceProvider` |
| Deferrable | `Voyager\Contracts\NutsAndBolts\DeferrableProvider`[^deferrable] |
| App handle | `$this->app` (not `$this->container` / `$this->program`)[^nab-sp] |
| Publish gate | `$this->app->runningInConsole()` |
| Singleton | `$this->app->singleton('command.probe', …)` |

See [0.8 import paths](../traps/08-import-paths.md).

# Lifecycle

1. **register** — singleton `command.probe` → `ProbeCommand`; `$this->commands(['command.probe'])`.
2. **boot** — `mergeConfigFrom` probe config; `publishes` to app `configPath('probe.php')` when running in console; `AboutCommand::add('Environment', …)` reports **Probe Installed = YES**.
3. **provides** — `command.probe` for deferred loading (console kernel `loadDeferredProviders()` loads this before Computer commands, so `about` sees the override).

# Related

- [ProbeCommand](probe-command.md)
- [config/probe.php](config.md)
- [Companion provider](../conventions/companion-provider.md)

[^provider]: ProbeServiceProvider
[^composer]: venusian.providers discovery
[^nab-sp]: Voyager ServiceProvider ($app)
[^deferrable]: DeferrableProvider contract (0.8)
