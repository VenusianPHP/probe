---
type: Playbook
title: Use probe
description: Run the probe REPL, execute one-liners, and tune pcntl / aliases safely.
tags: [playbook, repl, computer]
generated: { by: agent:cursor-grok-4.6, at: "2026-08-23T04:10:00Z" }
status: draft
sources:
  - id: command
    resource: src/Console/ProbeCommand.php
    title: ProbeCommand CLI surface
  - id: config
    resource: config/probe.php
    title: probe config
---

# Interactive REPL

```bash
computer probe
```

Include files before the shell:

```bash
computer probe path/to/bootstrap-snippet.php
```

# One-shot execute

```bash
computer probe --execute="dump(app()->version())"
```

# Config knobs

| Goal | Action |
|------|--------|
| Hardware / FTDI / MPSSE work | Leave `probe.use_pcntl` false[^config] |
| Extra commands in shell | Add FQCNs to `probe.commands` |
| Alias a vendor class | Add prefix to `probe.alias` |
| Never alias a class | Add to `probe.dont_alias` |

# Related

- [ProbeCommand](../components/probe-command.md)
- [pcntl trap](../traps/pcntl-hardware-fork.md)
- [Require probe](require-probe.md)

[^command]: ProbeCommand CLI surface
[^config]: probe config
