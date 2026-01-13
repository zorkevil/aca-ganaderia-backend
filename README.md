Proyecto Laravel – Guía de instalación

Este proyecto está desarrollado en Laravel y utiliza MySQL como base de datos.
El repositorio contiene el código fuente y los seeders necesarios para levantar un entorno funcional desde cero.

Instalación del proyecto

1. Instalar dependencias

composer install

2. Configuración del entorno

Copiar el archivo de ejemplo y editarlo:

cp .env.example .env

Generar la key de la aplicación:

php artisan key:generate

3. Configuración de la base de datos

Editar las siguientes variables en el archivo .env:

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nombre_base
DB_USERNAME=usuario
DB_PASSWORD=password

Luego ejecutar migraciones y seeders:

php artisan migrate --seed

4. Variables de entorno especiales

Gestión de imágenes y archivos

Estas variables definen dónde se almacenan y desde qué URL se sirven las imágenes del proyecto:

IMAGES_DRIVER=local
FILES_URL=http://localhost

IMAGES_DRIVER
Define el driver de almacenamiento (por defecto local).

FILES_URL
URL base desde donde se accede a los archivos/imágenes.
En producción debe apuntar al dominio correspondiente.

5. Integración con API Mercado Agroganadero (MAG)

El proyecto se integra con la API del Mercado Agroganadero (MAG).
Las siguientes variables deben configurarse según el entorno:

MAG_BASE_URL=
MAG_USER=
MAG_PASSWORD=
MAG_TIMEOUT=
MAG_VERIFY_SSL=

Descripción de variables:

MAG_BASE_URL
URL base de la API del Mercado Agroganadero.

MAG_USER
Usuario de acceso a la API.

MAG_PASSWORD
Contraseña de acceso a la API.

MAG_TIMEOUT
Timeout de las solicitudes (en segundos).

MAG_VERIFY_SSL
Verificación de certificado SSL (true o false).

6. Permisos de carpetas

Asegurarse de que Laravel tenga permisos de escritura en:

storage/
bootstrap/cache/

7. Limpieza y optimización (opcional)

php artisan config:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache

8. Tareas programadas (Scheduler)

El proyecto utiliza el scheduler de Laravel para ejecutar tareas automáticas mediante cron.

Actualmente se encuentra configurada la siguiente tarea:

Sincronización de precios y categorías (MAG).

Job: SyncMagPreciosCategorias
Función: Sincroniza precios y categorías desde la API del Mercado Agroganadero (MAG).
Frecuencia: Martes, Miércoles y Viernes
Horario: 12:00 hs
Zona horaria: America/Argentina/Buenos_Aires
Restricción: La tarea no se ejecuta si una instancia previa sigue en curso (withoutOverlapping).

Configuración requerida en el servidor

Para que el scheduler de Laravel funcione correctamente, es necesario configurar un cron del sistema que ejecute Laravel cada minuto.

Ejemplo de entrada en el crontab:

* * * * * cd /ruta/al/proyecto && php artisan schedule:run >> /dev/null 2>&1

Asegurarse de usar el path correcto del proyecto y la versión de PHP adecuada.

Consideraciones

El cron debe ejecutarse con un usuario que tenga permisos sobre el proyecto.

La tarea depende de las variables de entorno de MAG, por lo que estas deben estar correctamente configuradas en el .env.

El uso de withoutOverlapping evita ejecuciones duplicadas si el proceso demora más de lo esperado.