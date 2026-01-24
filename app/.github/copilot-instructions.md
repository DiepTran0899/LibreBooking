# LibreBooking AI Coding Agent Instructions

## Project Overview

LibreBooking is a PHP 8.2+ resource scheduling application using:
- **Architecture**: Model-View-Presenter (MVP) pattern with Smarty templates
- **Database**: MySQL 5.5+ with Repository pattern for data access
- **API**: REST API via Slim framework at `/Web/Services/index.php`
- **Dependencies**: Managed via Composer (`composer.json`)

## Architecture & Code Organization

### MVP Pattern Implementation

Every user-facing page follows this strict pattern:

```php
// Web/*.php - Entry point
define('ROOT_DIR', '../');
require_once(ROOT_DIR . 'Pages/ExamplePage.php');
$page = new ExamplePage();
$page->PageLoad();
```

- **Page Classes** (`/Pages`): Thin wrappers around Smarty templates, no business logic
- **Presenter Classes** (`/Presenters`): Orchestrate business logic, coordinate between services/repositories and pages
- **Templates** (`/tpl`): Smarty `.tpl` files for UI rendering (cached to `/tpl_c`)

### Directory Structure Deep Dive

```
/Domain                    # Domain entities and value objects
  /Access                  # Repository interfaces & implementations (data layer abstraction)
  /Events                  # Domain events
  /Values                  # Value objects

/lib/Application           # Application services organized by feature
  /Admin                   # Admin-specific services (ResourceAdminManageReservationsService, etc.)
  /Authentication          # Authentication logic
  /Authorization           # Authorization/permissions
  /Reservation             # Reservation workflows
    /Notification          # Post-reservation notifications
    /Persistence           # Create/update/delete reservation logic
    /Validation            # Pre-reservation validation rules
  /User                    # User management services

/lib/Common                # Shared utilities (logging, dates, localization)
/lib/Database              # Database abstraction layer
/lib/WebService            # API infrastructure (Slim server, routing)

/WebServices               # REST API controllers and responses
/Controls                  # Reusable UI components
/Jobs                      # Scheduled tasks (cron jobs)
/plugins                   # Plugin system with hooks for Authentication, Authorization, PostReservation, etc.
```

### Critical Patterns

**Namespace Pattern**: Related files grouped in directories with `namespace.php` that requires all files:

```php
// lib/Application/Admin/namespace.php
require_once(ROOT_DIR . 'lib/Application/Admin/ReservationFilter.php');
require_once(ROOT_DIR . 'lib/Application/Admin/ManageReservationsService.php');
// ... all files in directory
```

**Repository Pattern**: All data access through interfaces (`IResourceRepository`, `IUserRepository`, etc.) in `/Domain/Access`. Implementations use Database abstraction, never direct SQL in domain/application layers.

**Service Locator**: `ServiceLocator` class provides centralized access to core services (Database, Server, EmailService). Use sparingly - prefer dependency injection in constructors.

**Factory Pattern**: Factories create configured instances (e.g., `UserRepositoryFactory`, `ManageUsersServiceFactory`) respecting user session/permissions.

## Development Workflows

### Running Tests

```bash
# All tests
./vendor/bin/phpunit

# Specific test suite
./vendor/bin/phpunit --testsuite application
./vendor/bin/phpunit --testsuite domain
./vendor/bin/phpunit --testsuite presenters
./vendor/bin/phpunit --testsuite webservices
```

Test organization: `/tests` mirrors main code structure. Use fakes in `/tests/fakes` for testing (e.g., `FakeUserRepository`, `FakeResourceRepository`).

### Code Quality Tools

```bash
# Install dev tools (phive + composer)
composer install-tools

# Lint (check only)
composer lint
# or: ./tools/php-cs-fixer fix -vv --dry-run

# Fix formatting (PSR-12)
composer fix
# or: ./tools/php-cs-fixer fix -v

# Static analysis
composer phpstan
# or: ./vendor/bin/phpstan analyse

# Build/package release
composer build
# or: ./tools/phing
```

**Important**: All code must follow PSR-12 standards. Run `composer fix` before committing.

### Database Migrations

- Schema: `/database_schema/create-schema.sql` (baseline)
- Upgrades: `/database_schema/upgrades/*.sql` (version-specific)
- Use Phing tasks for setup: `composer build` then phing targets

## Project-Specific Conventions

### Configuration

- Config file: `/config/config.dist.php` (array-based, not class-based)
- Access via: `Configuration::Instance()->GetKey(ConfigKeys::SETTING_NAME)`
- Environment vars override config (via `vlucas/phpdotenv`)

### Smarty Templates

- Template syntax: `{translate key='KeyName'}`, `{$VariableName}`, `{if $Condition}...{/if}`
- Templates inherit: `{extends file="base.tpl"}` with `{block name="sectionName"}` overrides
- Icon system: Fugue Icons in `/Web/img/` (PNG format)
- Styling: Bootstrap 5, custom themes in `/Web/css/`

### API Development

- All APIs in `/Web/Services/index.php` use Slim framework
- Registration pattern:

```php
function RegisterResources(SlimServer $server, SlimWebServiceRegistry $registry) {
    $webService = new ResourcesWebService($server, new ResourceRepository());
    $category = new SlimWebServiceRegistryCategory('Resources');
    $category->AddSecureGet('/:resourceId', [$webService, 'GetResource'], WebServices::GetResource);
    $registry->AddCategory($category);
}
```

- Secure endpoints require authentication (check via `AddSecureGet/Post`)
- Admin-only endpoints use `AddAdminGet/Post`
- API toggle: `config['api']['enabled']`

### Logging

- Use `Log::Error()`, `Log::Debug()`, `Log::Info()` (Monolog-based)
- SQL logging controlled via `ConfigKeys::LOGGING_SQL`
- Logs to folder specified in `ConfigKeys::LOGGING_FOLDER`

### Security

- CSRF protection: `EnforceCSRFCheck()` on pages
- Authentication: Plugin-based via `PluginManager::Instance()->LoadAuthentication()`
- Authorization: Role-based (`RoleLevel::APPLICATION_ADMIN`, `RoleLevel::RESOURCE_ADMIN`, etc.)
- Page decorators: `AdminPageDecorator`, `RoleRestrictedPageDecorator`

## Testing Guidelines

- Mock dependencies using PHPUnit's `createMock()` or fake repositories
- Test database operations against repository interfaces, not concrete DB
- Use `TestBase` as parent class for all tests
- Critical: Test files must match class names (`MyClassTest.php` for `MyClass.php`)

## Common Pitfalls

1. **Don't put business logic in Page classes** - belongs in Presenters or Services
2. **Always use ROOT_DIR constant** for file paths, not relative paths
3. **Repository pattern is mandatory** for data access - no direct DB queries in domain/application layers
4. **namespace.php files** are the dependency mechanism - update when adding new files
5. **Smarty template caching** - clear `/tpl_c` if templates don't update during development

## Branching & Contributions

- `develop` branch: latest beta code, target for PRs
- `master` branch: stable releases
- Branch naming: `feature/description`, `bugfix/issue-number-description`
- Commit messages: Follow conventional commits (type/scope format documented in CONTRIBUTING.md)
- All PRs reviewed before merge, must pass CI checks
