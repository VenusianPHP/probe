---
type: Trap
title: 0.8 import paths
description: Probe 0.8 must use $this->app, Voyager contracts (DeferrableProvider, Vessel BindingResolutionException), System Application, and Computer — not Fabricate/Wrench 0.7 paths or $this->container.
tags: [trap, 0.8, imports, container, casters, voyager]
generated: { by: agent:cursor-grok-4.6, at: "2026-08-23T04:10:00Z" }
status: draft
sources:
  - id: nab-sp
    resource: venusian/framework src/Voyager/NutsAndBolts/ServiceProvider.php
    title: ServiceProvider::$app
  - id: deferrable
    resource: venusian/framework src/Voyager/Contracts/NutsAndBolts/DeferrableProvider.php
    title: DeferrableProvider
  - id: binding
    resource: venusian/framework src/Voyager/Contracts/Vessel/BindingResolutionException.php
    title: BindingResolutionException
  - id: console-kernel
    resource: venusian/framework src/Voyager/System/Console/Kernel.php
    title: bootstrap loadDeferredProviders
  - id: provider
    resource: src/ProbeServiceProvider.php
    title: Current provider
  - id: caster
    resource: src/ProbeCaster.php
    title: Casters (HtmlString / Process / Application)
---

# Trap

0.7 wrench / Fabricate imports and `$this->container` break against Voyager 0.8. Prefer these targets:[^nab-sp][^deferrable][^binding]

| Was (0.7 wrench) | Use (0.8 probe) |
|------------------|-----------------|
| `ScrapyardIO\Wrench\` | `Venusian\Probe\` |
| `Fabricate\*` | `Voyager\*` |
| `$this->container` | `$this->app`[^nab-sp] |
| `getScrapyardIO()` | `getVenusian()` |
| `Fabricate\NutsAndBolts\Contracts\DeferrableProvider` | `Voyager\Contracts\NutsAndBolts\DeferrableProvider`[^deferrable] |
| `Fabricate\Chassis\Exceptions\BindingResolutionException` | `Voyager\Contracts\Vessel\BindingResolutionException`[^binding] |
| `Fabricate\Core\Machine` | `Voyager\System\Application` |
| `Fabricate\Core\Console\AboutCommand` | `Voyager\System\Console\AboutCommand` |
| Workshop binary | **computer** |
| Hard Process caster import | `class_exists('Voyager\Process\ProcessResult')`[^caster] |

# Deferred load

Console kernel bootstrap must call `loadDeferredProviders()` so the deferred probe provider actually registers `command.probe` before Computer lists/runs commands.[^console-kernel]

# Related

- [ProbeServiceProvider](../components/service-provider.md)
- [ProbeCaster](../components/probe-caster.md)
- Package [CHANGELOG.md](../../CHANGELOG.md)
- Historical [0.7 import paths](07-import-paths.md)

[^nab-sp]: ServiceProvider::$app
[^deferrable]: DeferrableProvider
[^binding]: BindingResolutionException
[^console-kernel]: bootstrap loadDeferredProviders
[^provider]: Current provider
[^caster]: Casters (HtmlString / Process / Application)
