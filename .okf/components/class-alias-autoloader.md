---
type: Module
title: ClassAliasAutoloader
description: PsySH session autoloader that aliases short class names from the Composer classmap.
resource: src/ClassAliasAutoloader.php
tags: [component, autoload, alias]
generated: { by: agent:cursor-grok-4.6, at: "2026-08-23T04:10:00Z" }
status: draft
sources:
  - id: loader
    resource: src/ClassAliasAutoloader.php
    title: ClassAliasAutoloader
  - id: config
    resource: config/probe.php
    title: alias / dont_alias
  - id: command
    resource: src/Console/ProbeCommand.php
    title: register / unregister lifecycle
---

# Role

`Venusian\Probe\ClassAliasAutoloader` registers an SPL autoloader for the probe session. Typing a bare class basename in PsySH can resolve to a full FQCN via `class_alias`.[^loader]

# Rules

- Vendor paths under the Composer vendor root are **not** aliased by default.
- `probe.alias` forces include (namespace/class prefixes).[^config]
- `probe.dont_alias` excludes matches.[^config]
- Only bare names (no `\`) trigger aliasing; namespaced lookups pass through.
- Unregistered in `finally` / destructor after the shell exits.[^command]

# Related

- [config/probe.php](config.md)
- [ProbeCommand](probe-command.md)

[^loader]: ClassAliasAutoloader
[^config]: alias / dont_alias
[^command]: register / unregister lifecycle
