# ATUNADO API

## API REST - Rutas públicas

### Series

#### Obtener una lista de series

-   URL : "/public/series"
-   Método : GET
-   Descripcion: Retorna una lista paginada de series.
-   Parametros:
    -   query (opcional): Filtrar series por título.

Ejemplo de respuesta:

```json
{
    "data": [
        {
            "id": 1,
            "type": "serie",
            "attributes": {
                "title": "Serie 1",
                "image": "url_to_image",
                "updated_at": "2024-09-30T00:00:00Z"
            }
        }
    ],
    "links": {
        "first": "http://api.example.com/series?page=1",
        "last": "http://api.example.com/series?page=3",
        "prev": null,
        "next": "http://api.example.com/series?page=2"
    },
    "meta": {
        "current_page": 1,
        "total_pages": 3
    }
}
```

#### Obtener una serie especifica

-   URL: /public/series/{id}
-   Método: GET
-   Descripción: Retorna la información detallada de una serie específica.
-   Parámetros:
    -   id (requerido): ID de la serie.

Ejemplo de respuesta:

```json
{
    "id": 1,
    "type": "serie",
    "attributes": {
        "title": "Serie 1",
        "description": "Descripción de la serie 1",
        "image": "url_to_image",
        "author": "nombre_del_autor",
        "updated_at": "2024-09-30T00:00:00Z"
    },
    "relationships": {
        "chapters": [
            {
                "id": 1,
                "type": "chapter",
                "attributes": {
                    "order": 1,
                    "created_at": "2024-09-30T00:00:00Z"
                }
            }
        ]
    }
}
```

#### Obtener un capítulo específico

-   URL: /public/chapters/{id}
-   Método: GET
-   Descripción: Retorna la información de un capítulo específico de una serie.
-   Parámetros:
    -   id (requerido): ID del capítulo.

Ejemplo de respuesta:

```json
{
    "id": 1,
    "type": "chapter",
    "attributes": {
        "order": 1,
        "created_at": "2024-09-30T00:00:00Z"
    },
    "relationships": {
        "images": [
            {
                "id": 1,
                "type": "image",
                "attributes": {
                    "order": 1,
                    "image": "url_to_image"
                }
            }
        ],
        "serie": {
            "id": 1,
            "name": "Serie 1"
        }
    }
}
```

## API REST - Rutas Protegidas

Autenticación: Todas las rutas en este prefijo requieren autenticación con token Bearer (Sanctum).

Encabezado de Autenticación:

```markdown
Authorization: Bearer <TOKEN_DE_AUTENTICACIÓN>
```

### Series

#### Listar todas las series

-   URL: /v1/series
-   Método: GET
-   Descripción: Retorna una lista de todas las series disponibles.
-   Autenticación requerida: Sí (Bearer Token).

Ejemplo de respuesta:

```json
{
    "data": [
        {
            "id": 1,
            "type": "serie",
            "attributes": {
                "title": "Serie 1",
                "image": "url_to_image",
                "updated_at": "2024-09-30T00:00:00Z"
            }
        }
    ]
}
```

#### Crear una nueva serie

-   URL: /v1/series
-   Método: POST
-   Descripción: Crea una nueva serie.
-   Autenticación requerida: Sí (Bearer Token).
-   Parámetros:
    -   title (requerido): Título de la serie.
    -   description (opcional): Descripción de la serie.
    -   image (opcional): URL de la imagen de la serie.

Ejemplo de cuerpo de la petición:

```json
{
    "title": "Nueva Serie",
    "description": "Descripción de la nueva serie",
    "image": "url_to_image"
}
```

Ejemplo de la respuesta:

```json
{
    "id": 2,
    "type": "serie",
    "attributes": {
        "title": "Nueva Serie",
        "description": "Descripción de la nueva serie",
        "image": "url_to_image",
        "updated_at": "2024-09-30T00:00:00Z"
    }
}
```

#### Mostrar una serie específica

-   URL: /v1/series/{id}
-   Método: GET
-   Descripción: Retorna la información detallada de una serie específica.
-   Autenticación requerida: Sí (Bearer Token).
-   Parámetros:
    -   id (requerido): ID de la serie.

Ejemplo de respuesta:

```json
{
    "id": 1,
    "type": "serie",
    "attributes": {
        "title": "Serie 1",
        "description": "Descripción de la serie 1",
        "image": "url_to_image",
        "updated_at": "2024-09-30T00:00:00Z"
    },
    "relationships": {
        "chapters": [
            {
                "id": 1,
                "type": "chapter",
                "attributes": {
                    "order": 1,
                    "created_at": "2024-09-30T00:00:00Z"
                }
            }
        ]
    }
}
```

#### Actualizar una serie existente

-   URL: /v1/series/{id}
-   Método: POST
-   Descripción: Actualiza los datos de una serie existente.
-   Autenticación requerida: Sí (Bearer Token).
-   Parámetros:
    -   id (requerido): ID de la serie.
    -   title (opcional): Título de la serie.
    -   description (opcional): Descripción de la serie.
    -   image (opcional): URL de la imagen de la serie.

Ejemplo de cuerpo de la petición:

```json
{
    "id": 1,
    "title": "Serie Actualizada",
    "description": "Descripción actualizada",
    "image":"url_to_image",
    "_method":"PUT"
}
```

Ejemplo de respuesta:

```json
{
    "id": 1,
    "type": "serie",
    "attributes": {
        "title": "Serie Actualizada",
        "description": "Descripción actualizada",
        "image": "url_to_image",
        "updated_at": "2024-09-30T00:00:00Z"
    }
}
```
#### Eliminar una serie
- URL: /v1/series/{id}
- Método: DELETE
- Descripción: Elimina una serie específica.
- Autenticación requerida: Sí (Bearer Token).
- Parámetros:
    - id (requerido): ID de la serie.

Ejemplo de respuesta:

```json
{
  "message": "Serie eliminada correctamente."
}
```

### Capítulos
#### Listar todos los capítulos de una serie
- URL: /v1/chapters
- Método: GET
- Descripción: Retorna una lista de capítulos disponibles.
- Autenticación requerida: Sí (Bearer Token).

Ejemplo de respuesta:

```json 
{
  "data": [
    {
      "id": 1,
      "type": "chapter",
      "attributes": {
        "order": 1,
        "created_at": "2024-09-30T00:00:00Z"
      }
    }
  ]
}
```

#### Crear un nuevo capítulo
- URL: /v1/chapters
- Método: POST
- Descripción: Crea un nuevo capítulo para una serie.
- Autenticación requerida: Sí (Bearer Token).
- Parámetros:
    - order (requerido): Orden del capítulo.
    - serie_id (requerido): ID de la serie a la que pertenece el capítulo.

Ejemplo de cuerpo de la petición:

```json
{
  "order": 1,
  "serie_id": 1
}
```
Ejemplo de respuesta:
```json
{
  "id": 2,
  "type": "chapter",
  "attributes": {
    "order": 2,
    "created_at": "2024-09-30T00:00:00Z"
  }
}
```
#### Mostrar un capítulo específico

- URL: /v1/chapters/{id}
- Método: GET
- Descripción: Retorna la información de un capítulo específico.
- Autenticación requerida: Sí (Bearer Token).
- Parámetros:
    - id (requerido): ID del capítulo.

Ejemplo de respuesta:
```json
{
  "id": 1,
  "type": "chapter",
  "attributes": {
    "order": 1,
    "created_at": "2024-09-30T00:00:00Z"
  },
  "relationships": {
    "serie": {
      "id": 1,
      "name": "Serie 1"
    }
  }
}
```

#### Actualizar un capítulo
- URL: /v1/chapters/{id}
- Método: POST
- Descripción: Actualiza los datos de un capítulo existente.
- Autenticación requerida: Sí (Bearer Token).
- Parámetros:
    - id (requerido): ID del capítulo.

Ejemplo de cuerpo de la petición:
```json
{
    "id": 2,
    "order": 2,
    "_method":"PUT"
}
```
Ejemplo de respuesta:
```json
{
    "id": 1,
    "type": "chapter",
    "attributes": {
        "order": 2,
        "created_at": "2024-09-30T00:00:00Z"
    }
}
```
#### Eliminar un capítulo
- URL: /v1/chapters/{id}
- Método: DELETE
- Descripción: Elimina un capítulo específico.
- Autenticación requerida: Sí (Bearer Token).
- Parámetros:
    - id (requerido): ID del capítulo.

Ejemplo de respuesta:
```json
{
    "message": "Capítulo eliminado correctamente."
}
```
### Imágenes
#### Crear una nueva imagen
URL: /v1/images
Método: POST
Descripción: Sube una nueva imagen.
Autenticación requerida: Sí (Bearer Token).
Ejemplo de cuerpo de la petición:
```json
{
    "order":"2",
    "image":"url_to_image"
}
```
Ejemplo de respuesta:

```json
{
  "id": 2,
  "type": "image",
  "attributes": {
    "order": 2,
    "image": "url_to_image"
  }
}
```

#### Eliminar una imagen
- URL: /v1/images/{id}
- Método: DELETE
- Descripción: Elimina una imagen específica.
- Autenticación requerida: Sí (Bearer Token).
- Parámetros:
    - id (requerido): ID de Imagen.

Ejemplo de respuesta:
```json
{
  "message": "Imagen eliminada correctamente."
}
```
