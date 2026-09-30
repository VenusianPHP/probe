---
type: Playbook
title: Require probe
description: Install venusian/probe 0.10 in a Venusian application on framework 0.10.
tags: [playbook, composer, install]
generated: { by: claude-opus-5-5, at: "2026-09-30T00:00:00Z" }
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

1. In a Venusian application on framework **0.10**:

```bash
composer require venusian/probe:^0.10.0
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

- `composer show venusian/probe` reports `0.10.x` (or your lock).
- `computer list` / `computer probe --help` shows the probe command after deferred providers load.
- Class exists: `Venusian\Probe\Console\ProbeCommand`.

# Related

- [Use probe](use-probe.md)
- [Companion provider](../conventions/companion-provider.md)
- [0.10 import paths](../traps/010-import-paths.md)

[^composer]: Package require + venusian.providers
