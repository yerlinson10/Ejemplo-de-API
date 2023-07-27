# Documentación del proyecto

## Instalación del proyecto

Para instalar el proyecto, el primer paso es clonar el repositorio:

 ```git
    git clone https://github.com/yerlinson10/Prueba-backend-ABS-Depot.git
```

Una vez clonado, proceda a crear la base de datos y configurar el proyecto:

```php
Flight::register('db', 'PDO', array('mysql:host=localhost;dbname=test','user','pass'));
```

---

## Uso de la API

Endpoint para agregar una nueva tarea

Ruta: : `/tasks/`
Método: `POST`

**Parámetros (JSON)**

```json
{
    "description": "Prueba desde postman"
}
```

**Respuesta (JSON)**

```json
{
    "success": true,
    "message": "Tarea agregada correctamente"
}
```

---

Endpoint para obtener todas las tareas
Ruta: `/tasks/`
Método: `GET`

**Respuesta (JSON)**

```json
{
    "success": true,
    "tasks": [
        {
            "id": 1,
            "0": 1,
            "description": "Primera tarea de prueba",
            "1": "Primera tarea de prueba",
            "completed": 1,
            "2": 1
        },
        {
            "id": 4,
            "0": 4,
            "description": "Prueba desde postman",
            "1": "Prueba desde postman",
            "completed": 0,
            "2": 0
        }
    ]
}
```

---
Endpoint para obtener una de las tareas

Ruta: `/tasks/{id}`
Método: `POST`

**Respuesta (JSON)**

```json
{
    "success": true,
    "tasks": [
        {
            "id": 1,
            "0": 1,
            "description": "Primera tarea de prueba",
            "1": "Primera tarea de prueba",
            "completed": 1,
            "2": 1
        }
    ]
}
```
---
Endpoint para marcar una tarea como completada o desmarcarla

Ruta: `/tasks/{id}`
Método: `PUT`
**Respuesta (JSON)**

```json
{
    "success": true,
    "message": "Tarea desmarcada como completada"
}
```

```json
{
    "success": true,
    "message": "Tarea marcada como completada"
}
```

---
Endpoint para eliminar una tarea

Ruta: `/tasks/{id}`
Método: `DELETE`
**Respuesta (JSON)**

```json
{
    "success": true,
    "message": "Tarea eliminada correctamente"
}
```

---

## Errores

Cómo se ven los mensajes de errores:

```json
{
    "success": false,
    "message": {
        "errorInfo": [
            "23000",
            1048,
            "Column 'description' cannot be null"
        ]
    }
}
```
