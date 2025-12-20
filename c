# CI Pipeline (Most Important): Lint + Audits + Fast feedback on push/PR
name: CI Pipeline

on: [push, pull_request]
# ... existing code ...
concurrency:
  group: ci-${{ github.ref }}
  cancel-in-progress: true

jobs:
  php-lint:
    name: PHP Lint (php -l)
    runs-on: ubuntu-latest
    strategy:
      matrix:
        php: [ '8.1', '8.2', '8.3' ]
    steps:
      - uses: actions/checkout@v4
      - name: Setup PHP ${{ matrix.php }}
        uses: shivammathur/setup-php@v2
        with:
          php-version: ${{ matrix.php }}
          coverage: none
          tools: composer
          ini-values: error_reporting=E_ALL, display_errors=On
      - name: Lint all PHP files
        shell: bash
        run: |
          set -e
          git ls-files '*.php' | tr -d '\r' > php_files.txt || true
          if [ -s php_files.txt ]; then
            while IFS= read -r file; do
              echo "Linting: $file"
              php -l "$file"
            done < php_files.txt
          else
            echo "No PHP files to lint."
          fi

  # ... existing code ...
  js-lint:
    name: JavaScript Lint (ESLint if available)
    runs-on: ubuntu-latest
    if: ${{ hashFiles('**/package.json') != '' }}
    steps:
      - uses: actions/checkout@v4
      - name: Setup Node
        uses: actions/setup-node@v4
        with:
          node-version: '20'
          cache: 'npm'
      - name: Install dependencies
        run: npm ci
      - name: Run ESLint (skip if not configured)
        shell: bash
        run: |
          set -e
          if npx --yes eslint --version >/dev/null 2>&1; then
            npx --yes eslint . || true
          else
            echo "ESLint not found/configured. Skipping."
          fi

  # ... existing code ...
  audits:
    name: Dependency Audits (Composer/NPM)
    runs-on: ubuntu-latest
    steps:
      - uses: actions/checkout@v4

      - name: Setup PHP
        if: ${{ hashFiles('**/composer.lock') != '' || hashFiles('**/composer.json') != '' }}
        uses: shivammathur/setup-php@v2
        with:
          php-version: '8.2'
          coverage: none
          tools: composer
      - name: Composer install (if composer.json exists)
        if: ${{ hashFiles('**/composer.json') != '' }}
        run: composer install --no-interaction --no-progress
      - name: Composer audit (if composer.lock exists)
        if: ${{ hashFiles('**/composer.lock') != '' }}
        run: composer audit || true

      - name: Setup Node
        if: ${{ hashFiles('**/package-lock.json') != '' || hashFiles('**/package.json') != '' }}
        uses: actions/setup-node@v4
        with:
          node-version: '20'
          cache: 'npm'
      - name: NPM install (if package.json exists)
        if: ${{ hashFiles('**/package.json') != '' }}
        run: npm ci
      - name: NPM audit (if package-lock.json exists)
        if: ${{ hashFiles('**/package-lock.json') != '' }}
        run: npm audit --audit-level=moderate || true