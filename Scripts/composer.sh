#!/usr/bin/env bash

containercommand=""
if [[ -x $(which "docker") ]]; then
    containercommand="docker compose"
fi
if [[ -x $(which "podman") ]]; then
    containercommand="podman compose"
fi
if [[ -x $(which "podman-compose") ]]; then
    containercommand="podman-compose"
fi

$containercommand run --rm tools composer "$@"
result=$?
$containercommand down
exit $result
