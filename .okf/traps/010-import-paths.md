---
type: Trap
title: 0.10 import paths
description: 0.8 → 0.10 map — Voyager\System gone; FrameworkCore contract, DataBindingException, signalsAreCached, venusian-voyager splits, no about.
tags: [trap, 0.10, imports, casters, voyager]
generated: { by: claude-opus-5-5, at: "2026-09-30T00:00:00Z" }
status: draft
sources:
  - id: core
    resource: venusian/framework src/Voyager/Contracts/Core/FrameworkCore.php
    title: FrameworkCore
  - id: binding
    resource: venusian/framework src/Voyager/Contracts/Vessel/DataBindingException.php
    title: DataBindingException
  - id: console-kernel
    resource: venusian/framework src/Voyager/Core/Console/Kernel.php
    title: bootstrap loadDeferredProviders
  - id: command
    resource: src/Console/ProbeCommand.php
    title: getCasters
  - id: caster
    resource: src/ProbeCaster.php
    title: ProbeCaster
---

# Map

0.10 has no `Voyager\System` namespace. Targets:[^core][^binding]

| Was (0.8) | Use (0.10) |
|-----------|------------|
| `voyager/*` / `venusian-voyager/*` `^0.8` | `venusian-voyager/*` `^0.10.0` |
| `Voyager\System\Application` | `Voyager\Contracts\Core\FrameworkCore` (concrete `Voyager\Core\RenderedInstance`)[^core] |
| `class_exists('Voyager\System\Application')` caster guard | Unguarded `FrameworkCore` key — contracts is required[^command] |
| `Voyager\System\Console\AboutCommand` | None — 0.10 ships no `about` |
| `Voyager\Contracts\Vessel\BindingResolutionException` | `Voyager\Contracts\Vessel\DataBindingException`[^binding] |
| `eventsAreCached()` | `signalsAreCached()`[^caster] |
| `Voyager\System\Console\Kernel` | `Voyager\Core\Console\Kernel`[^console-kernel] |

# Deferred load

`Kernel::bootstrap()` calls `loadDeferredProviders()` → deferred probe provider registers `command.probe` before Computer lists or runs commands.[^console-kernel]

# Related

- [ProbeServiceProvider](../components/service-provider.md)
- [ProbeCaster](../components/probe-caster.md)
- Historical [0.8 import paths](08-import-paths.md)

[^core]: FrameworkCore
[^binding]: DataBindingException
[^console-kernel]: bootstrap loadDeferredProviders
[^command]: getCasters
[^caster]: ProbeCaster
