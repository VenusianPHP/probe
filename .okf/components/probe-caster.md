---
type: Module
title: ProbeCaster
description: Symfony VarDumper casters for Application, Collection, Stringable, HtmlString, and optional ProcessResult.
resource: src/ProbeCaster.php
tags: [component, caster, var-dumper]
generated: { by: agent:cursor-grok-4.6, at: "2026-08-23T04:10:00Z" }
status: draft
sources:
  - id: caster
    resource: src/ProbeCaster.php
    title: ProbeCaster
  - id: command
    resource: src/Console/ProbeCommand.php
    title: getCasters registration
---

# Role

`Venusian\Probe\ProbeCaster` supplies presenter casters so PsySH dumps of Voyager types show useful virtual properties.[^caster]

# Casters (0.8)

| Target | Method | 0.8 note |
|--------|--------|----------|
| `Voyager\System\Application` | `castApplication` | Register when `class_exists(Application)` — host framework[^command] |
| `Voyager\NutsAndBolts\Collection` | `castCollection` | Collections package, namespaced as NutsAndBolts |
| `Voyager\NutsAndBolts\DataObjects\Stringable` | `castStringable` | Nab DataObjects |
| `Voyager\NutsAndBolts\HtmlString` | `castHtmlString` | Present in 0.8 (absent in 0.7 wrench) |
| `Voyager\Process\ProcessResult` | `castProcessResult` | **Guard** with `class_exists` — Process may be absent[^command] |
| Eloquent Model | `castModel` | Commented / deferred until database is a probe concern |

Hard `use Voyager\Process\ProcessResult` at file top will fatally fail if Process is missing — prefer guarded registration from `ProbeCommand::getCasters()`.

# Related

- [ProbeCommand](probe-command.md)
- [0.8 import paths](../traps/08-import-paths.md)

[^caster]: ProbeCaster
[^command]: getCasters registration
