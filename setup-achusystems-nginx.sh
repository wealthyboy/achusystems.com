#!/usr/bin/env bash
set -Eeuo pipefail

DOMAIN="achusystems.com"
WWW_DOMAIN="www.achusystems.com"
WEBROOT="/home/forge/achusystems.com"
PHP_VERSION="8.2"
SITE_AVAILABLE="/etc/nginx/sites-available/${DOMAIN}"
SITE_ENABLED="/etc/nginx/sites-enabled/${DOMAIN}"
ISSUE_SSL=0

usage() {
    cat <<'EOF'
Usage:
  ./setup-achusystems-nginx.sh [--issue-ssl]

Options:
  --issue-ssl   After Nginx is working, ask Certbot to issue a Let's Encrypt
                certificate for achusystems.com and www.achusystems.com.
                Only use this after DNS points both names to this server.
  -h, --help    Show this help.
EOF
}

while [[ $# -gt 0 ]]; do
    case "$1" in
        --issue-ssl)
            ISSUE_SSL=1
            ;;
        -h|--help)
            usage
            exit 0
            ;;
        *)
            echo "Unknown option: $1" >&2
            usage
            exit 2
            ;;
    esac
    shift
done

if [[ $EUID -eq 0 ]]; then
    SUDO=""
else
    if ! command -v sudo >/dev/null 2>&1; then
        echo "ERROR: sudo is required when not running as root." >&2
        exit 1
    fi
    SUDO="sudo"
fi

info() { printf '\n[INFO] %s\n' "$*"; }
ok()   { printf '[ OK ] %s\n' "$*"; }
warn() { printf '[WARN] %s\n' "$*" >&2; }
fail() { printf '[FAIL] %s\n' "$*" >&2; exit 1; }

info "Checking required services"

command -v nginx >/dev/null 2>&1 || fail "Nginx is not installed."

PHP_SOCKET=""
for candidate in     "/run/php/php${PHP_VERSION}-fpm.sock"     "/var/run/php/php${PHP_VERSION}-fpm.sock"
do
    if [[ -S "$candidate" ]]; then
        PHP_SOCKET="$candidate"
        break
    fi
done

if [[ -z "$PHP_SOCKET" ]]; then
    fail "Could not find the PHP ${PHP_VERSION} FPM socket. Expected /run/php/php${PHP_VERSION}-fpm.sock."
fi

ok "Using PHP-FPM socket: $PHP_SOCKET"

info "Preparing web root: $WEBROOT"

if [[ ! -d "$WEBROOT" ]]; then
    $SUDO mkdir -p "$WEBROOT"
    $SUDO chown forge:forge "$WEBROOT" 2>/dev/null || true
    ok "Created $WEBROOT"
else
    ok "Web root already exists."
fi

if [[ ! -f "$WEBROOT/index.php" && ! -f "$WEBROOT/index.html" ]]; then
    warn "No index.php or index.html currently exists in $WEBROOT."
    warn "That is okay if you still need to upload the Achu Systems website."
fi

BACKUP=""
if [[ -f "$SITE_AVAILABLE" ]]; then
    BACKUP="${SITE_AVAILABLE}.backup.$(date +%Y%m%d%H%M%S)"
    info "Backing up existing Nginx config"
    $SUDO cp "$SITE_AVAILABLE" "$BACKUP"
    ok "Backup: $BACKUP"
fi

TMP_CONFIG="$(mktemp)"
trap 'rm -f "$TMP_CONFIG"' EXIT

cat > "$TMP_CONFIG" <<EOF
server {
    listen 80;
    listen [::]:80;

    server_name ${DOMAIN} ${WWW_DOMAIN};

    root ${WEBROOT};
    index index.php index.html index.htm;

    charset utf-8;

    access_log /var/log/nginx/${DOMAIN}-access.log;
    error_log  /var/log/nginx/${DOMAIN}-error.log;

    client_max_body_size 32M;

    location / {
        try_files \$uri \$uri/ /index.php?\$query_string;
    }

    location ~ \.php$ {
        try_files \$uri =404;

        include fastcgi_params;
        fastcgi_pass unix:${PHP_SOCKET};

        fastcgi_index index.php;
        fastcgi_param SCRIPT_FILENAME \$document_root\$fastcgi_script_name;
        fastcgi_param DOCUMENT_ROOT \$document_root;

        fastcgi_read_timeout 120;
    }

    location ^~ /.well-known/acme-challenge/ {
        allow all;
        try_files \$uri =404;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }

    location ~* /(composer\.(json|lock)|package(-lock)?\.json|phpunit\.xml|README\.md|artisan)$ {
        deny all;
    }

    location ~* \.(?:css|js|jpg|jpeg|gif|png|webp|svg|ico|woff|woff2|ttf|eot)$ {
        try_files \$uri =404;
        expires 7d;
        access_log off;
        add_header Cache-Control "public, max-age=604800";
    }
}
EOF

info "Installing Nginx site configuration"
$SUDO cp "$TMP_CONFIG" "$SITE_AVAILABLE"
$SUDO ln -sfn "$SITE_AVAILABLE" "$SITE_ENABLED"

info "Testing Nginx configuration"
if ! $SUDO nginx -t; then
    warn "Nginx configuration test failed."

    if [[ -n "$BACKUP" && -f "$BACKUP" ]]; then
        warn "Restoring previous Achu Systems config."
        $SUDO cp "$BACKUP" "$SITE_AVAILABLE"
    else
        warn "Removing the new Achu Systems site config."
        $SUDO rm -f "$SITE_ENABLED" "$SITE_AVAILABLE"
    fi

    $SUDO nginx -t || true
    fail "Setup aborted. Existing Nginx sites were left untouched."
fi

ok "Nginx configuration is valid."

info "Reloading Nginx"
if command -v systemctl >/dev/null 2>&1; then
    $SUDO systemctl reload nginx
else
    $SUDO service nginx reload
fi
ok "Nginx reloaded."

if command -v systemctl >/dev/null 2>&1; then
    if systemctl list-unit-files | grep -q "^php${PHP_VERSION}-fpm.service"; then
        $SUDO systemctl enable --now "php${PHP_VERSION}-fpm" >/dev/null 2>&1 || true
    fi
fi

if [[ "$ISSUE_SSL" -eq 1 ]]; then
    info "SSL requested"

    command -v certbot >/dev/null 2>&1 || fail "Certbot is not installed."

    cat <<EOF

Before Certbot runs, both DNS records must point to this server:

  ${DOMAIN}
  ${WWW_DOMAIN}

EOF

    read -r -p "Continue with Let's Encrypt SSL now? [y/N] " answer
    case "$answer" in
        y|Y|yes|YES)
            $SUDO certbot --nginx \
                -d "$DOMAIN" \
                -d "$WWW_DOMAIN" \
                --redirect
            ok "SSL configuration completed."
            ;;
        *)
            warn "SSL step skipped."
            ;;
    esac
fi

cat <<EOF

============================================================
Achu Systems Nginx setup complete
============================================================

Domain:
  https://${DOMAIN}

Web root:
  ${WEBROOT}

Nginx config:
  ${SITE_AVAILABLE}

PHP:
  PHP ${PHP_VERSION} FPM
  ${PHP_SOCKET}

Useful commands:

  sudo nginx -t
  sudo systemctl reload nginx
  sudo systemctl status php${PHP_VERSION}-fpm

Logs:

  /var/log/nginx/${DOMAIN}-access.log
  /var/log/nginx/${DOMAIN}-error.log

If SSL has NOT been configured yet:
  1. Point achusystems.com to this server's public IP.
  2. Point www.achusystems.com to the same server (or CNAME it to achusystems.com).
  3. Re-run:
       ./setup-achusystems-nginx.sh --issue-ssl

This script does NOT modify or remove any other Nginx site.
============================================================
EOF
