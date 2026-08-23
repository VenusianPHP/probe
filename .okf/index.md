---
okf_version: "0.2"
---

# venusian/probe Knowledge Bundle

Package knowledge for `venusian/probe` (PsySH REPL for Venusian apps, v0.8.0). Successor of `scrapyard-io/wrench`.
Read this index first; open only the concepts needed for the task.

**Trust rule:** Prefer `status: stable`. Treat `deprecated` as historical only. Concepts below are `draft` until a human verifies the 0.8 rename.
**Placement:** Package-root `.okf/` only — not under `src/`.
**Scope:** This companion package only. Voyager domain rules live in `venusian/framework` OKF.
**Version note:** Claims track **0.8.0** (Voyager types, `$this->app`, Computer binary `probe`, casters, pcntl default).

# Orientation

* [Package (0.8)](orientation/package.md) - Composer identity, namespace, role vs framework.

# Components

* [Components](components/) - Provider, Computer command, casters, alias autoloader, config.
* [ProbeServiceProvider](components/service-provider.md) - Deferred provider; binds `command.probe`. (`draft`)
* [ProbeCommand](components/probe-command.md) - Computer `probe` PsySH REPL. (`draft`)
* [ProbeCaster](components/probe-caster.md) - VarDumper casters for Voyager types. (`draft`)
* [ClassAliasAutoloader](components/class-alias-autoloader.md) - Short-name class aliases in the shell. (`draft`)
* [config/probe.php](components/config.md) - Publishable probe config keys. (`draft`)

# Conventions

* [Companion provider (not Voyager domain)](conventions/companion-provider.md) - Keeps its own provider; discovers via `extra.venusian.providers`. (`draft`)

# Traps

* [pcntl + MPSSE/FTDI](traps/pcntl-hardware-fork.md) - `probe.use_pcntl` defaults false; forks break macOS hardware IO. (`draft`)
* [0.8 import paths](traps/08-import-paths.md) - `$this->app`, Voyager contracts, System Application, guarded casters. (`draft`)
* [0.7 import paths](traps/07-import-paths.md) - Historical Fabricate/Wrench paths. (`deprecated`)

# Playbooks

* [Require probe](playbooks/require-probe.md) - Composer require + discovery. (`draft`)
* [Use probe](playbooks/use-probe.md) - Run REPL, execute, publish config. (`draft`)
