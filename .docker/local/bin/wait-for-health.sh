#!/usr/bin/env bash

set -eou pipefail

echo "Waiting for service to be healthy"
while ! curl --fail http://localhost/health; do echo "Waiting for service to be healthy"; sleep 1; done
