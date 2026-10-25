#!/bin/sh
set -e

echo "🚀 LSC Project - Laravel 12 Startup"
echo "======================================"

# ── Wait for PostgreSQL to be ready ──────────────────────────────────────────
echo "⏳ Waiting for PostgreSQL at ${DB_HOST}:${DB_PORT:-5432}..."
MAX_TRIES=30
COUNT=0
until php -r "
  try {
    \$pdo = new PDO(
      'pgsql:host=${DB_HOST};port=${DB_PORT:-5432};dbname=${DB_DATABASE}',
      '${DB_USERNAME}',
      '${DB_PASSWORD}'
    );
    echo 'ok';
  } catch (Exception \$e) {
    exit(1);
  }
" 2>/dev/null | grep -q ok; do
  COUNT=$((COUNT + 1))
  if [ $COUNT -ge $MAX_TRIES ]; then
    echo "❌ PostgreSQL not reachable after ${MAX_TRIES} attempts. Exiting."
    exit 1
  fi
  echo "   Attempt $COUNT/$MAX_TRIES - retrying in 2s..."
  sleep 2
done
echo "✅ PostgreSQL is ready!"

# ── Copy .env if not present ──────────────────────────────────────────────────
if [ ! -f /var/www/html/.env ]; then
  echo "📋 Creating .env from .env.docker..."
  cp /var/www/html/.env.docker /var/www/html/.env
fi

# ── Generate app key if not set ───────────────────────────────────────────────
APP_KEY_VALUE=$(grep "^APP_KEY=" /var/www/html/.env | cut -d'=' -f2)
if [ -z "$APP_KEY_VALUE" ] || [ "$APP_KEY_VALUE" = "base64:" ]; then
  echo "🔑 Generating application key..."
  php artisan key:generate --force
fi

# ── Storage link ──────────────────────────────────────────────────────────────
echo "🔗 Creating storage symlink..."
php artisan storage:link --force 2>/dev/null || true

# ── Ensure storage directories exist ─────────────────────────────────────────
mkdir -p /var/www/html/storage/logs
mkdir -p /var/www/html/storage/framework/sessions
mkdir -p /var/www/html/storage/framework/views
mkdir -p /var/www/html/storage/framework/cache/data
chown -R www-data:www-data /var/www/html/storage
chown -R www-data:www-data /var/www/html/bootstrap/cache

# ── Run migrations ────────────────────────────────────────────────────────────
echo "🗄️  Running database migrations..."
php artisan migrate --force

# ── Cache configuration for production ───────────────────────────────────────
echo "⚡ Caching configuration & routes..."
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan event:cache

echo "✅ Bootstrap complete! Starting services..."
echo "============================================"

exec "$@"
