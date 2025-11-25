#!/bin/bash

echo "🚀 Iniciando deploy automático..."

# 1. Instalar dependencias
echo "📦 Instalando dependencias PHP..."
composer install --optimize-autoloader --no-dev

echo "📦 Instalando dependencias Node.js..."
npm ci

# 2. Compilar assets
echo "🎨 Compilando assets..."
npm run build

# 3. Configurar aplicación
echo "🔧 Configurando aplicación..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

# 4. Migrar y poblar base de datos
echo "🗄️ Configurando base de datos..."
php artisan migrate:fresh --seed --force

# 5. Configurar storage
echo "🔗 Configurando storage..."
php artisan storage:link

# 6. Limpiar cachés
echo "🧹 Limpiando cachés..."
php artisan cache:clear

echo "✅ Deploy completado - Aplicación lista con datos de prueba!"