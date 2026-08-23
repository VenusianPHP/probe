---
type: Playbook
title: Require probe
description: Install venusian/probe 0.8 alongside a Venusian application / framework 0.8.
tags: [playbook, composer, install]
generated: { by: agent:cursor-grok-4.6, at: "2026-08-23T04:10:00Z" }
status: draft
sources:
  - id: composer
    resource: composer.json
    title: Package require + venusian.providers
  - id: package
    resource: .okf/orientation/package.md
    title: Package orientation
---

# Steps

1. In a Venusian application on framework **0.8**:

```bash
composer require venusian/probe:^0.8.0
```

2. Confirm Composer discovery lists the provider:

```json
"extra": {
  "venusian": {
    "providers": [
      "Venusian\\Probe\\ProbeServiceProvider"
    ]
  }
}
```

(Already declared by this package — the app’s package discovery / services manifest should pick it up.)[^composer]

3. Ensure console bootstrap loads deferred providers (`loadDeferredProviders()`), or `computer probe` will not see `command.probe`.

4. Optionally publish config:

```bash
computer vendor:publish --provider="Venusian\\Probe\\ProbeServiceProvider"
```

# Verify

- `composer show venusian/probe` reports `0.8.0` (or your lock).
- `computer list` / `computer probe --help` shows the probe command after deferred providers load.
- Class exists: `Venusian\Probe\Console\ProbeCommand`.

# Related

- [Use probe](use-probe.md)
- [Companion provider](../conventions/companion-provider.md)
- [0.8 import paths](../traps/08-import-paths.md)

[^composer]: Package require + venusian.providers
