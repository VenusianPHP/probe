---
type: Trap
title: 0.7 import paths
description: Historical wrench 0.7 Fabricate import map. Superseded by 0.8 Voyager paths in venusian/probe.
tags: [trap, 0.7, imports, container, casters, historical]
generated: { by: agent:cursor-grok-4.6, at: "2026-08-23T04:10:00Z" }
status: deprecated
sources:
  - id: changelog
    resource: CHANGELOG.md
    title: 0.7.0 historical notes
  - id: current
    resource: traps/08-import-paths.md
    title: 0.8 import paths
---

# Historical (do not copy)

This trap described `scrapyard-io/wrench` **0.7** against Fabricate. Live 0.8 source uses Voyager / `$this->app` / Computer — see [0.8 import paths](08-import-paths.md).[^current]

| Was (0.6-ish) | Used (0.7 wrench) |
|---------------|-------------------|
| `$this->program` | `$this->container` |
| `Fabricate\Contracts\NutsAndBolts\DeferrableProvider` | `Fabricate\NutsAndBolts\Contracts\DeferrableProvider` |
| `Fabricate\Contracts\Chassis\BindingResolutionException` | `Fabricate\Chassis\Exceptions\BindingResolutionException` |
| Hard `HtmlString` caster import | Remove or `class_exists` — HtmlString not in 0.7 |
| Unguarded Process caster | `class_exists('Fabricate\Process\ProcessResult')` |

[^changelog]: 0.7.0 historical notes
[^current]: 0.8 import paths
