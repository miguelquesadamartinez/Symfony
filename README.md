# Symfony App con gestión de usuarios

Este proyecto incluye:

- Gestión completa de usuarios (registro, login, perfil y panel admin con CRUD).
- Entidad `User` con roles, email único y contraseña hasheada.
- Formularios de registro y edición.
- Vistas Twig básicas.
- Docker con PHP 8.2 + Apache, MySQL 8 y phpMyAdmin.

## Requisitos

- Docker Desktop
- Git (opcional)

## Puesta en marcha con Docker

1. Levantar los servicios:

- `docker compose up -d --build`

2. Instalar dependencias dentro del contenedor PHP:

- `docker compose exec php composer install`

3. Generar el secreto de la app (opcional):

- `docker compose exec php php bin/console secrets:generate-keys`
    - Si no usas secrets, puedes definir `APP_SECRET` manualmente en `.env`.

4. Crear el esquema de base de datos:

- `docker compose exec php php bin/console doctrine:schema:update --force`

5. Abrir la app:

- http://localhost:8080

6. phpMyAdmin:

- http://localhost:8081
    - Servidor: `mysql`
    - Usuario: `symfony`
    - Password: `symfony`

## Rutas principales

- `/register` Registro de usuarios
- `/login` Inicio de sesión
- `/profile` Perfil del usuario autenticado
- `/admin/users` Panel de administración de usuarios

## Notas

- El acceso a `/admin` requiere `ROLE_ADMIN`.
- Por defecto, el primer usuario se crea con `ROLE_USER`. Para hacer un admin:
    - En la base de datos, añade `ROLE_ADMIN` al campo `roles` del usuario, o
    - Usa el formulario de edición en el panel admin (una vez tengas un admin).
- Para cambiar credenciales de MySQL, ajusta `.env` y `docker-compose.yml`.

## Estructura añadida

- `src/Entity/User.php`
- `src/Repository/UserRepository.php`
- `src/Form/RegistrationFormType.php`
- `src/Form/UserType.php`
- `src/Controller/RegistrationController.php`
- `src/Controller/SecurityController.php`
- `src/Controller/UserController.php`
- `templates/` con vistas de seguridad y usuarios
- `docker-compose.yml` y `docker/`
