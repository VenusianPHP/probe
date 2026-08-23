---
type: Orientation
title: Package (0.8)
description: venusian/probe 0.8.0 — PsySH REPL (Computer command probe) for Venusian applications.
resource: .
tags: [orientation, probe, venusian, 0.8]
generated: { by: agent:cursor-grok-4.6, at: "2026-08-23T04:10:00Z" }
status: draft
sources:
  - id: composer
    resource: composer.json
    title: Package name, version, require, autoload, venusian providers
  - id: readme
    resource: README.md
    title: Package README
  - id: gitattributes
    resource: .gitattributes
    title: export-ignore for .okf, AGENTS.md, CHANGELOG.md, tests
  - id: provider
    resource: src/ProbeServiceProvider.php
    title: ProbeServiceProvider entry
  - id: command
    resource: src/Console/ProbeCommand.php
    title: Computer probe command
---

# What it is

Composer package `venusian/probe` at **0.8.0** — a PsySH-based REPL exposed as the Computer console command `probe` for Venusian applications. Successor of `scrapyard-io/wrench`.[^composer][^command]

| Field | Value |
|-------|-------|
| Name | `venusian/probe` |
| Version | `0.8.0` |
| PHP | `^8.4\|^8.5\|^8.6`[^composer] |
| Namespace | `Venusian\Probe\` → `src/` |
| Role | REPL companion to `venusian/framework` 0.8 |
| Discovery | `extra.venusian.providers` → `Venusian\Probe\ProbeServiceProvider`[^composer] |

`.okf/`, `AGENTS.md`, and `CHANGELOG.md` are `export-ignore` from Composer dist.[^gitattributes]

# Requires (0.8)

| Package | Constraint |
|---------|------------|
| `voyager/console` | `^0.8.0` |
| `voyager/contracts` | `^0.8.0` |
| `voyager/nuts-and-bolts` | `^0.8.0` |
| `psy/psysh` | `^0.12.0` |
| `symfony/var-dumper` | `^5.4\|^6.0\|^7.0\|^8.0` |

# What it is not

- Not a Voyager *domain* component under `src/Voyager/*`. It stays a companion package with its **own** service provider (see [companion provider](../conventions/companion-provider.md)).
- Not a substitute for Computer itself — it *registers into* Computer via deferred `command.probe`.

# Key files

| Path | Role |
|------|------|
| `src/ProbeServiceProvider.php` | Deferred provider, config merge/publish |
| `src/Console/ProbeCommand.php` | PsySH shell + casters + aliases |
| `src/ProbeCaster.php` | Presenter casters |
| `src/ClassAliasAutoloader.php` | Short class aliases in session |
| `config/probe.php` | Commands, alias lists, trust, pcntl |
| `tests/` | Pest v4 specs ported from `laravel/tinker` |

# Related

| Topic | Concept |
|-------|---------|
| Provider | [ProbeServiceProvider](../components/service-provider.md) |
| Command | [ProbeCommand](../components/probe-command.md) |
| Install | [Require probe](../playbooks/require-probe.md) |
| 0.8 pitfalls | [0.8 import paths](../traps/08-import-paths.md) |

[^composer]: Package name, version, require, autoload, venusian providers
[^readme]: Package README
[^gitattributes]: export-ignore for .okf, AGENTS.md, CHANGELOG.md, tests
[^command]: Computer probe command
[^provider]: ProbeServiceProvider entry
