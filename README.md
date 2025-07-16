k# API de Tareas con Laravel 11

Este proyecto es una pequeña API RESTful desarrollada en **Laravel 11** para la gestión de tareas (CRUD) con:

* Validación limpia usando **Form Requests**.
* Lógica de negocio encapsulada en **Services**.
* Acceso a datos desacoplado mediante **Repositories**.
* Paginación de resultados.
* Seeders y Factories para datos de prueba.
* Soporte de Docker (puerto 83).

---

## Tabla de Contenidos

1. [Características](#características)
2. [Requisitos](#requisitos)
3. [Instalación](#instalación)
4. [Configuración](#configuración)
5. [Estructura del Proyecto](#estructura-del-proyecto)
6. [Endpoints de la API](#endpoints-de-la-api)
7. [Seeders y Factories](#seeders-y-factories)
8. [Ejecución con Docker](#ejecución-con-docker)
9. [Pruebas](#pruebas)
10. [Contribuciones](#contribuciones)
11. [Licencia](#licencia)

---

## Características

* **Listar tareas** con paginación.
* **Crear**, **actualizar** y **eliminar** tareas.
* Campos de la tabla `tasks`:

    * `id` (autoincremental)
    * `titulo` (string)
    * `descripcion` (text, opcional)
    * `completado` (boolean)
    * `fecha_limite` (date, opcional)
    * `created_at`, `updated_at`
* Validaciones centralizadas via **Form Requests**.
* Lógica de acceso a datos en **Repositories**.
* Lógica de negocio en **Services**.
* Seeders para poblar datos de ejemplo.

---

## Requisitos

* PHP >= 8.1
* Composer
* MySQL (o MariaDB)
* Docker & Docker Compose (opcional)

---

## Instalación

1. Clona el repositorio:

   ```bash
   git clone https://tu-repositorio.git
   cd nombre-del-proyecto
   ```

2. Instala las dependencias:

   ```bash
   composer install
   ```

3. Copia el archivo de entorno y configura datos:

   ```bash
   cp .env.example .env
   ```

4. Genera la clave de aplicación:

   ```bash
   php artisan key:generate
   ```

5. Ajusta la conexión a base de datos en `.env`:

   ```dotenv
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=nombre_bd
   DB_USERNAME=usuario
   DB_PASSWORD=contra

   APP_URL=http://localhost:83
   ```

6. Ejecuta migraciones y seeders:

   ```bash
   php artisan migrate --seed
   ```

---

## Configuración

* **Form Requests**:

    * `StoreTaskRequest` para validación al crear.
    * `UpdateTaskRequest` para validación al actualizar.

* **Repositories**:

    * Interfaz: `TaskRepositoryInterface`.
    * Implementación: `EloquentTaskRepository`.

* **Service**:

    * `TaskService` centraliza la lógica de negocio.

* **Controller**:

    * `TaskController` maneja rutas y orquesta la petición.

---

## Estructura del Proyecto

```text
app/
├── Http/
│   ├── Controllers/
│   │   └── Api/
│   │       └── TaskController.php
│   ├── Requests/
│   │   ├── StoreTaskRequest.php
│   │   └── UpdateTaskRequest.php
├── Models/
│   └── Task.php
├── Repositories/
│   ├── TaskRepositoryInterface.php
│   └── EloquentTaskRepository.php
├── Services/
│   └── TaskService.php

database/
├── migrations/
│   └── xxxx_create_tasks_table.php
├── factories/
│   └── TaskFactory.php
└── seeders/
    ├── TaskSeeder.php
    └── DatabaseSeeder.php

routes/
└── api.php

README.md
```

---

## Endpoints de la API

Todos los endpoints usan prefijo `/api`:

| Método | Ruta               | Descripción                   |
| ------ | ------------------ | ----------------------------- |
| GET    | `/api/tareas`      | Lista tareas (paginadas)      |
| POST   | `/api/tareas`      | Crea una nueva tarea          |
| PUT    | `/api/tareas/{id}` | Actualiza una tarea existente |
| DELETE | `/api/tareas/{id}` | Elimina una tarea             |

### Ejemplos

* **Listar tareas:**

  ```http
  GET http://localhost:83/api/tareas?per_page=15&page=2
  ```

* **Crear tarea:**

  ```http
  POST http://localhost:83/api/tareas
  Content-Type: application/json

  {
    "titulo": "Comprar regalo",
    "descripcion": "Regalo de cumpleaños",
    "fecha_limite": "2025-08-10"
  }
  ```

* **Actualizar tarea:**

  ```http
  PUT http://localhost:83/api/tareas/5
  Content-Type: application/json

  {
    "completado": true
  }
  ```

* **Eliminar tarea:**

  ```http
  DELETE http://localhost:83/api/tareas/5
  ```

---

## Seeders y Factories

* `database/factories/TaskFactory.php`: define datos faker.
* `database/seeders/TaskSeeder.php`: crea 50 registros.
* **Comando:**

  ```bash
  php artisan migrate:fresh --seed
  ```

---

## Ejecución con Docker

1. Define en `docker-compose.yml`:

   ```yaml
   services:
     app:
       build: .
       ports:
         - "83:80"
   ```
2. Inicia contenedores:

   ```bash
   docker-compose up -d --build
   ```
3. Accede en:

   http://localhost:83/
   ```

```}
```

