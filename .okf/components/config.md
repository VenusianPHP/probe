---
type: Module
title: config/probe.php
description: Publishable probe configuration — commands, aliases, trust_project, use_pcntl.
resource: config/probe.php
tags: [component, config]
generated: { by: agent:cursor-grok-4.6, at: "2026-08-23T04:10:00Z" }
status: draft
sources:
  - id: config
    resource: config/probe.php
    title: probe.php
  - id: command
    resource: src/Console/ProbeCommand.php
    title: config consumers
---

# Keys

| Key | Purpose | Default / env |
|-----|---------|----------------|
| `commands` | Extra Computer command classes available inside probe | `[]` |
| `alias` | Explicit namespaces/classes allowed to short-alias | `[]` |
| `dont_alias` | Namespaces/classes never aliased | `[]` |
| `trust_project` | PsySH project trust mode | `env('PROBE_TRUST_PROJECT', env('TINKER_TRUST_PROJECT', 'always'))`[^config] |
| `use_pcntl` | PsySH process forking | `env('PROBE_USE_PCNTL', false)` — **keep false** for hardware[^config] |

`ProbeCommand` also merges optional `probe.casters` when present (custom caster map).[^command]

# Publish

When booted in console, the provider publishes this file to the app `config/probe.php`.

# Related

- [pcntl trap](../traps/pcntl-hardware-fork.md)
- [ProbeServiceProvider](service-provider.md)

[^config]: probe.php
[^command]: config consumers
