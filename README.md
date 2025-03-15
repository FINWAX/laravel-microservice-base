# Laravel Microservice Base

## About

This project is base of microservice implements on Laravel.

## Usage

### Install

Download and prepare project

```commandline
sh /path-to/scripts/install.sh -u1000 -g1000 -r"FINWAX/laravel-microservice-base" -d"/destination-path" -p"/previous-path-if-needs-import-data"
```

Then do first launch

```commandline
sh /path_to/scripts/first-launch.sh "/path-to/project"
```

Fill and validate env files for dev/test and production.

Then use

```commandline
sh /path_to/scripts/dev-launch.sh "/path-to/project"
```

or

```commandline
sh /path_to/scripts/prod-launch.sh "/path-to/project"
```

### Update

Use update script

```commandline
sh /path_to/scripts/update.sh -u1000 -g1000 -r"FINWAX/laravel-microservice-base" -d"/current-path" -p"/path-to-move-current-version"
```

### Control

If it needs - use `docker compose exec lv ...command`.

Run dev server

```commandline
composer run dev

```

Provide existing migrations

```commandline
php artisan migrate
```

Optimize composer + cache config, events, routes, views

```commandLine
sh /path_to/scripts/optimize.sh "/path-to/project"
```

Clear caches

```commandLine
sh /path_to/scripts/clear.sh "/path-to/project"
```

### View

Check example endpoints:

- `http://127.0.0.1:8087/health/check` - service works normal
- `http://127.0.0.1:8087/health/availability` - service is available
- `http://127.0.0.1:8087/greeting/hello-protected` - auth via Zitadel
- `http://127.0.0.1:8087/greeting/hello-unprotected?name=Nohj` - GET params passed well

## Links

- [Laravel documentation](https://laravel.com/docs)
- [Project GitHub](https://github.com/FINWAX/laravel-microservice-base)
- [FINWAX GitHub](https://github.com/FINWAX)
- [Zitadel Auth](https://zitadel.com/)
