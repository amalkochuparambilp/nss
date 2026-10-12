# NSS Connect

NSS Connect is a Laravel 11 application.

## Run locally

Requirements: PHP 8.2+, Composer, and MySQL.

1. Install PHP dependencies:

   ```sh
   composer install
   ```

2. Create your local environment file and generate an application key:

   ```sh
   cp .env.example .env
   php artisan key:generate
   ```

3. Create a MySQL database and set `DB_HOST`, `DB_PORT`, `DB_DATABASE`,
   `DB_USERNAME`, and `DB_PASSWORD` in `.env`.
4. Run migrations and start the development server:

   ```sh
   php artisan migrate
   php artisan serve
   ```

   Open <http://localhost:8000>.

## Deploy with Docker

The included `Dockerfile` builds the Laravel app for production. It uses MySQL;
the database must be provisioned separately and reachable from the app.

### Render

1. Create a new Blueprint from this repository and select `render.yaml`.
2. In the Render service's **Environment** settings, set `APP_URL` to the
   service's public HTTPS URL and provide `DB_HOST`, `DB_PORT`, `DB_DATABASE`,
   `DB_USERNAME`, and `DB_PASSWORD` for a MySQL database reachable from Render.
3. Deploy, then run `php artisan migrate --force` once against the production
   database from a machine that can connect to it. The free Render plan does
   not include an interactive service shell.

Render does not provide a managed MySQL service in this Blueprint, so use a
MySQL provider that allows connections from Render.

### Railway

1. Create a Railway project from this repository. Railway will use
   `railway.json` and the included Dockerfile.
2. Add a MySQL service (or provide credentials for another reachable MySQL
   database). Set `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, and
   `DB_PASSWORD` in the app service's variables. For a Railway MySQL service,
   use Railway's variable references to connect the app to that service.
3. Set `APP_KEY` to a newly generated key (`php artisan key:generate --show`),
   set `APP_ENV=production`, `APP_DEBUG=false`, and set `APP_URL` to the
   Railway public URL.
4. Deploy, then run `php artisan migrate --force` once from the app service's
   shell.

Both deployment configurations use file-based sessions/cache and the
synchronous queue by default, avoiding extra database tables or services for
those features. Uploaded files and other container-local files are ephemeral;
configure persistent storage or object storage before relying on them in
production.
