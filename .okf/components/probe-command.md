---
type: Module
title: ProbeCommand
description: Computer console command probe — PsySH REPL with casters, aliases, and optional execute.
resource: src/Console/ProbeCommand.php
tags: [component, console, psysh, repl]
generated: { by: agent:cursor-grok-4.6, at: "2026-08-23T04:10:00Z" }
status: draft
sources:
  - id: command
    resource: src/Console/ProbeCommand.php
    title: ProbeCommand
  - id: config
    resource: config/probe.php
    title: probe config
  - id: binding
    resource: venusian/framework src/Voyager/Contracts/Vessel/BindingResolutionException.php
    title: BindingResolutionException (0.8)
---

# Role

`Venusian\Probe\Console\ProbeCommand` is the Computer command named `probe`. It boots a PsySH shell against the Venusian application container.[^command]

# Surface

| Piece | Detail |
|-------|--------|
| Name | `probe` |
| Description | Interact with your application |
| Argument | `include` (array) — files to include before the shell |
| Option | `--execute=` — run code non-interactively |
| Exception import (0.8) | `Voyager\Contracts\Vessel\BindingResolutionException`[^binding] |
| App accessor | `getVenusian()` |

# Behavior (high level)

1. Build PsySH `Configuration` from input; disable update checks.
2. `trust_project` from `config('probe.trust_project')`.
3. `use_pcntl` from `config('probe.use_pcntl')` — **default false** (hardware-safe).[^config]
4. Register [ProbeCaster](probe-caster.md) (and config `probe.casters`).
5. Register [ClassAliasAutoloader](class-alias-autoloader.md) from Composer classmap + `probe.alias` / `probe.dont_alias`.
6. Optionally whitelist a small set of Computer commands inside the shell; merge `probe.commands`.
7. Interactive `run()` or `--execute` path; always unregister the alias loader.

# Related

- [ProbeCaster](probe-caster.md)
- [ClassAliasAutoloader](class-alias-autoloader.md)
- [pcntl trap](../traps/pcntl-hardware-fork.md)
- [Use probe](../playbooks/use-probe.md)

[^command]: ProbeCommand
[^config]: probe config
[^binding]: BindingResolutionException (0.8)
