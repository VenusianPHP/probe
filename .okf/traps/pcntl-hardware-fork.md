---
type: Trap
title: pcntl + MPSSE/FTDI
description: PsySH pcntl forking defaults off — forks break macOS CoreFoundation/IOKit paths used by MPSSE, FTDI, and libusb.
tags: [trap, pcntl, hardware, ftdi, mpsse]
generated: { by: agent:cursor-grok-4.6, at: "2026-08-23T04:10:00Z" }
status: draft
sources:
  - id: config
    resource: config/probe.php
    title: use_pcntl default false
  - id: command
    resource: src/Console/ProbeCommand.php
    title: setUsePcntl from config
---

# Trap

PsySH can fork (`pcntl`) before each statement so a fatal error does not kill the REPL. That fork is **unsafe** with macOS CoreFoundation / IOKit, which MPSSE, FTDI, and libusb touch.[^config]

# Rule

1. Keep `probe.use_pcntl` **false** (default via `PROBE_USE_PCNTL`).[^config]
2. Only set `true` / `PROBE_USE_PCNTL=true` when you need fatal isolation **and** you are not opening native device handles.
3. Probe applies the config with `$config->setUsePcntl((bool) $appConfig->get('probe.use_pcntl', false))`.[^command]

# Related

- [config/probe.php](../components/config.md)
- [ProbeCommand](../components/probe-command.md)

[^config]: use_pcntl default false
[^command]: setUsePcntl from config
