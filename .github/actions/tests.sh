#!/bin/bash

set -e

npx cypress run  --headless --browser chrome  --config '{"specPattern":["plugins/blocks/vlibras/cypress/tests/functional/*.cy.js"]}'
