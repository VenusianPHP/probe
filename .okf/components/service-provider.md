---
type: Module
title: ProbeServiceProvider
description: Deferred Venusian provider that registers command.probe and merges/publishes probe config.
resource: src/ProbeServiceProvider.php
tags: [component, provider, deferred, computer]
generated: { by: claude-opus-5-5, at: "2026-09-30T00:00:00Z" }
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
    title: DeferrableProvider contract
---

# Role

`Venusian\Probe\ProbeServiceProvider` registers the Computer command binding and merges `config/probe.php`.[^provider][^composer]

It implements `DeferrableProvider` and `provides()` → `['command.probe']`, so it loads when that binding (or command list path) needs it. Console bootstrap must call `loadDeferredProviders()` so deferred probe is available for `computer probe` / help listing.[^provider]

# 0.10 API

| Concern | Target |
|---------|--------|
| Base | `Voyager\NutsAndBolts\ServiceProvider` |
| Deferrable | `Voyager\Contracts\NutsAndBolts\DeferrableProvider`[^deferrable] |
| App handle | `$this->app` (not `$this->container` / `$this->program`)[^nab-sp] |
| Singleton | `$this->app->registerSingleton('command.probe', …)` |
| Container exception | `Voyager\Contracts\Vessel\DataBindingException` |

See [0.10 import paths](../traps/010-import-paths.md).

# Lifecycle

1. **register** — singleton `command.probe` → `ProbeCommand`; `$this->commands(['command.probe'])`.
2. **boot** — `mergeConfigFrom` probe config; `publishes` to app `configPath('probe.php')`, ungated. No `about` command in 0.10 → no About entry.
3. **provides** — `command.probe` for deferred loading (console kernel `loadDeferredProviders()` loads this before Computer commands, so `computer probe` resolves).

# Related

- [ProbeCommand](probe-command.md)
- [config/probe.php](config.md)
- [Companion provider](../conventions/companion-provider.md)

[^provider]: ProbeServiceProvider
[^composer]: venusian.providers discovery
[^nab-sp]: Voyager ServiceProvider ($app)
[^deferrable]: DeferrableProvider contract
