---
type: Module
title: ProbeCaster
description: Symfony VarDumper casters for FrameworkCore, Collection, Stringable, HtmlString, and optional Instrument Model and ProcessResult.
resource: src/ProbeCaster.php
tags: [component, caster, var-dumper]
generated: { by: claude-opus-5-5, at: "2026-09-30T00:00:00Z" }
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

# Casters (0.10)

| Target | Method | Registration |
|--------|--------|--------------|
| `Voyager\Contracts\Core\FrameworkCore` | `castApplication` | Always. Interface key → VarDumper matches `RenderedInstance` and any other core[^command] |
| `Voyager\NutsAndBolts\Collection` | `castCollection` | Always |
| `Voyager\NutsAndBolts\DataObjects\Stringable` | `castStringable` | Always |
| `Voyager\NutsAndBolts\HtmlString` | `castHtmlString` | Always |
| `Voyager\Database\Instrument\Model` | `castModel` | When `class_exists` — Database not required[^command] |
| `Voyager\Process\ProcessResult` | `castProcessResult` | When `class_exists` — Process not required[^command] |

`castApplication` calls each of `configurationIsCached`, `environment`, `environmentFile`, `signalsAreCached`, `runningUnitTests`, `version`, `path`, `basePath`, `configPath`, `databasePath`, `storagePath`, `bootstrapPath`; skips nulls and throwers.[^caster]

`castModel`: attributes + relations + evaluated `$appends`. Hidden keys → protected prefix; visible (or everything not hidden when `$visible` empty) → virtual prefix. Hidden wins.[^caster]

# Related

- [ProbeCommand](probe-command.md)
- [0.8 import paths](../traps/08-import-paths.md)

[^caster]: ProbeCaster
[^command]: getCasters registration
