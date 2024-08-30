
# Light PHP

Inicia el desarrollo de tu aplicación PHP partiendo del modelo de MVC, con los aspectos básicos.

## Instalación

Para usar este proyecto toma en cuenta que debes tener PHP 7.5 o superior.

Instalar el template:
```bash
  git clone <enlace-del-proyecto>
```

Mover a la carpeta:
```bash
  cd <carpeta-del-proyecto>
```

Copiar las variables de entorno y configurarlas:
```bash
  cp .env.example .env
```

Instalar librerias necesarias:
```bash

  composer install
composer update
``` 

## Levantar un servidor local

Si deseas ver tu aplicación en acción rápidamente, puedes usar el servidor web incorporado en PHP: 

```bash
php -S localhost:8000 -t public
```

## Crafter CLI

Crafter CLI es una herramienta de línea de comandos desarrollada para facilitar el manejo de tareas comunes en tu micro framework PHP. Puedes generar modelos, controladores, vistas, manejar migraciones y limpiar la caché de tu aplicación con simples comandos.

### Uso

Puedes ejecutar Crafter CLI desde la línea de comandos utilizando el archivo `crafter` en la raíz de tu proyecto:

```bash
php crafter <command> [arguments]
```

### Comandos Disponibles

- **migrate:init**: Inicializa Phoenix para gestionar las migraciones en tu proyecto.

  ```bash
  php crafter migrate:init
  ```

- **migrate**: Ejecuta todas las migraciones pendientes de la base de datos.

  ```bash
  php crafter migrate
  ```

- **migrate:dump**: Genera un archivo de migración basado en la estructura actual de la base de datos.

  ```bash
  php crafter migrate:dump
  ```

- **migrate:diff**: Crea una migración basada en las diferencias entre la estructura actual de la base de datos y la estructura esperada.

  ```bash
  php crafter migrate:diff
  ```

- **migrate:status**: Muestra el estado de las migraciones, listando las migraciones ejecutadas y las pendientes.

  ```bash
  php crafter migrate:status
  ```

- **create:migration**: Crea una nueva migración en la carpeta de migraciones.

  ```bash
  php crafter create:migration AddUsersTable
  ```

- **rollback**: Revierte la última migración ejecutada.

  ```bash
  php crafter rollback
  ```

- **create:model**: Crea un nuevo modelo en la carpeta `App/Model`.

  ```bash
  php crafter create:model User
  ```

- **create:controller**: Crea un nuevo controlador en la carpeta `App/Controllers`.

  ```bash
  php crafter create:controller UserController
  ```

- **create:view**: Crea una nueva vista en la carpeta `App/Views`.

  ```bash
  php crafter create:view user_profile
  ```

- **cache:clear**: Limpia toda la caché de la aplicación.

  ```bash
  php crafter cache:clear
  ```

## Licencia

Proyecto bajo el licenciamiento [MIT](https://choosealicense.com/licenses/mit/)


## Soporte

Puedes dejar tus notas, estaremos mejorando este proyecto en nuestro tiempo libre. ☕

