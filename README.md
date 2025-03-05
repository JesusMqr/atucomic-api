# ATUNADO API

## API REST - Rutas públicas


### Series

#### Obtener una lista de series


-   URL : /api/public/series
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
                "title": "Serie",
                "type": "manga",
                "cover_image": "https://www.url_to_image.com",
                "updated_at": "2024-09-30T00:00:00Z",
                "status": "completed",
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

-   URL: /api/public/series/{id}
-   Método: GET
-   Descripción: Retorna la información detallada de una serie específica.
-   Parámetros:
    -   id (requerido): ID de la serie.

Ejemplo de respuesta:

```json
{
    "data":{
        "id": 1,
        "type": "serie",
        "attributes": {
            "type": "manga",
            "title": "Serie ",
            "description": "Serie description",
            "banner_image": "https://www.url_to_image.com",
            "cover_image": "https://www.url_to_image.com",
            "author": "Jhon Doe",
            "owner": "username",
            "status": "completed",
            "updated_at": "2024-09-30T00:00:00Z"
            
        },
        "relationships": {
            "chapters": [
                {
                    "id": 1,
                    "type": "chapter",
                    "attributes": {
                        "image":"https://www.url_to_image.com",
                        "order_number": 1,
                        "created_at": "2024-09-30T00:00:00Z"
                    }
                }
            ]
        }
    }
}
```

#### Obtener un capítulo específico

-   URL: /api/public/chapters/{id}
-   Método: GET
-   Descripción: Retorna la información de un capítulo específico de una serie.
-   Parámetros:
    -   id (requerido): ID del capítulo.

Ejemplo de respuesta:

```json
{
    "data":{
        "id": 1,
        "type": "chapter",
        "attributes": {
            "order_number": 1,
            "created_at": "2024-09-30T00:00:00Z",
            "image":"https://www.url_to_image.com"
        },
        "relationships": {
            "images": [
                {
                    "id": 1,
                    "type": "image",
                    "attributes": {
                        "order_number": 1,
                        "image": "https://www.url_to_image.com"
                    }
                }
            ],
            "serie": {
                "id": 1,
                "name": "Serie",
                "type": "Manga",
            },
            "previous_chapter": null,
            "next_chapter": 14
        }
    }
}
```
## API REST - Rutas AUTH

### Usuario

#### Register

-   URL: /api/register
-   Método: POST
-   Descripción: Crea un nuevo usuario en el sistema.
-   Parámetros:
    -   name (requerido): Nombre del usuario.
    -   email (requerido): Correo electrónico del usuario.
    -   password (requerido): Contraseña del usuario.
    -   password_confirmation (requerido): Confirmación de la contraseña.

Ejemplo de cuerpo de la petición:

```json
{
    "name": "John Doe",
    "email": "john.doe@example.com",
    "password": "password123",
    "password_confirmation": "password123"
}
```
Ejemplo de respuesta:
```json
{
    "data": {
        "message": "User created successfully",
        "token": "token_example|5P6zTyeT42Zea91601"
    }
}
```

#### Login

-   URL: /api/login
-   Método: POST
-   Descripción: Autentica a un usuario y retorna un token de acceso.
-   Parámetros:
    -   email (requerido): Correo electrónico del usuario.
    -   password (requerido): Contraseña del usuario.

Ejemplo de cuerpo de la petición:

```json
{
    "email": "john.doe@example.com",
    "password": "password123"
}
```

Ejemplo de respuesta:

```json
{
    "data": {
        "message": "User logged in successfully",
        "token": "token_example|7j90SXCfWD2pAJGGD2"
    }
}
```





## API REST - Rutas Protegidas

Autenticación: Todas las rutas en este prefijo requieren autenticación con token Bearer (Sanctum).

Encabezado de Autenticación:

```markdown
Authorization: Bearer <AUTH_TOKEN>
```

### User
#### Obtener perfil de usuario

-   URL: /api/profile
-   Método: GET
-   Descripción: Retorna la información del perfil del usuario autenticado.
-   Autenticación requerida: Sí (Bearer Token).

Ejemplo de respuesta:

```json
{
    "id": 2,
    "type": "user",
    "attributes": {
        "name": "username",
        "email": "user@example.en"
    }
}
```
#### Actualizar perfil de usuario

-   URL: /api/profile
-   Método: POST
-   Descripción: Actualiza la información del perfil del usuario autenticado.
-   Autenticación requerida: Sí (Bearer Token).
-   Parámetros:
    -   name (opcional): Nombre del usuario.
    -   email (opcional): Correo electrónico del usuario.

Ejemplo de cuerpo de la petición:

```json
{
    "name": "John Doe Updated",
    "email": "john.doe.updated@example.com",
    "_method": "PUT",
}
```

Ejemplo de respuesta:

```json
{
    "message": "Profile updated successfully",
    "user": {
        "id": 2,
        "type": "user",
        "attributes": {
            "name": "John Doe Updated",
            "email": "john.doe.updated@example.com"
        }
    }
}
```

#### Cambiar contraseña

-   URL: /api/change-password
-   Método: PUT
-   Descripción: Cambia la contraseña del usuario autenticado.
-   Autenticación requerida: Sí (Bearer Token).
-   Parámetros:
    -   current_password (requerido): Contraseña actual del usuario.
    -   new_password (requerido): Nueva contraseña del usuario.
    -   new_password_confirmation (requerido): Confirmación de la nueva contraseña.

Ejemplo de cuerpo de la petición:

```json
{
    "password": "current_password123",
    "new_password": "new_password123",
    "new_password_confirmation": "new_password123",
    "_method": "PUT",
}
```

Ejemplo de respuesta:

```json
{
    "message": "Password has been changed successfully."
}
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
                "title": "serie",
                "type": "manga",
                "cover_image": null,
                "updated_at": "2025-02-20T19:39:33.000000Z",
                "status": "completed"
            }
        }
    ],
    "links": {
        "first": "http://127.0.0.1:8000/api/v1/series?page=1",
        "last": "http://127.0.0.1:8000/api/v1/series?page=1",
        "prev": null,
        "next": null
    },
    "meta": {
        "current_page": 1,
        "from": 1,
        "last_page": 1,
        "links": [
            {
                "url": null,
                "label": "&laquo; Previous",
                "active": false
            },
            {
                "url": "http://127.0.0.1:8000/api/v1/series?page=1",
                "label": "1",
                "active": true
            },
            {
                "url": null,
                "label": "Next &raquo;",
                "active": false
            }
        ],
        "path": "http://127.0.0.1:8000/api/v1/series",
        "per_page": 10,
        "to": 1,
        "total": 1
    }
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
    -   type (requerido): Tipo de la serie (por ejemplo, manga).
    -   author (opcional): Autor de la serie.
    -   status (opcional): Estado de la serie (por ejemplo, completed).
    -   banner_image (opcional): URL de la imagen del banner de la serie.
    -   cover_image (opcional): URL de la imagen de la portada de la serie.

Ejemplo de cuerpo de la petición:

```json
{
    "title": "New serie",
    "description": "Description of the new serie",
    "type": "manga",
    "author": "Jhon Doe",
    "status": "completed",
    "banner_image": "htps://url_to_banner_image.com",
    "cover_image": "htps://url_to_cover_image.com"
}
```

Ejemplo de la respuesta:

```json
{
    "id": 2,
    "type": "serie",
    "attributes": {
        "type": "manga",
        "title": "serie",
        "description": "Serie description",
        "banner_image": null,
        "cover_image": null,
        "author": "John Doe",
        "owner": "User",
        "status": "completed",
        "updated_at": "2025-02-20T23:27:14.000000Z"
    },
    "relationships": {
        "chapters": []
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
    "data": {
        "id": 1,
        "type": "serie",
        "attributes": {
            "type": "manga",
            "title": "serie",
            "description": "Serie Description",
            "banner_image": null,
            "cover_image": null,
            "author": "John Doe",
            "owner": "User",
            "status": "completed",
            "updated_at": "2025-02-20T19:39:33.000000Z"
        },
        "relationships": {
            "chapters": [
                {
                    "id": 1,
                    "type": "chapter",
                    "attributes": {
                        "image": "https://gratisography.com/wp-content/uploads/2024/11/gratisography-augmented-reality-800x525.jpg",
                        "order_number": 1,
                        "created_at": "2025-02-20T19:40:17.000000Z"
                    }
                }
            ]
        }
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
    -   type (opcional): Tipo de la serie (por ejemplo, manga).
    -   author (opcional): Autor de la serie.
    -   status (opcional): Estado de la serie (por ejemplo, completed).
    -   banner_image (opcional): URL de la imagen del banner de la serie.
    -   cover_image (opcional): URL de la imagen de la portada de la serie.

Ejemplo de cuerpo de la petición:

```json
{
    "title": "new title",
    "description": "new description",
    "type": "manga",
    "author": "new author",
    "status": "completed",
    "banner_image_url": "https://example.com/banner_image.jpg",
    "cover_image_url": "https://example.com/cover_image.jpg",
    "_method": "PUT"
}
```

Ejemplo de respuesta:

```json
{
    "id": 2,
    "type": "serie",
    "attributes": {
        "type": "manga",
        "title": "new title",
        "description": "new description",
        "banner_image": "https://example.com/banner_image.jpg",
        "cover_image": "https://example.com/cover_image.jpg",
        "author": "nuevo author",
        "owner": "userUpdate",
        "status": "completed",
        "updated_at": "2025-02-20T23:31:46.000000Z"
    },
    "relationships": {
        "chapters": []
    }
}
```

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
    "title": " updated serie",
    "description": "updated description",
    "image":"https://url_to_image.com",
    "_method":"PUT"
}
```

Ejemplo de respuesta:

```json
{
    "id": 1,
    "type": "serie",
    "attributes": {
        "title": "updated serie",
        "description": "updated description",
        "image": "https://url_to_image.com",
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

Ejemplo de respuesta: 204 No Content



### Capítulos

#### Crear un nuevo capítulo
- URL: /v1/chapters
- Método: POST
- Descripción: Crea un nuevo capítulo para una serie.
- Autenticación requerida: Sí (Bearer Token).
- Parámetros:
    - order_number (requerido): Orden del capítulo.
    - serie_id (requerido): ID de la serie a la que pertenece el capítulo.
    - image_url (requerido): URL de la imagen del capítulo.

Ejemplo de cuerpo de la petición:

```json
{
  "order_number": 2,
  "serie_id": 1,
  "image_url": "https://example.com/image.jpg"
}
```
Ejemplo de respuesta:
```json
{
  "id": 3,
  "type": "chapter",
  "attributes": {
    "order_number": 2,
    "created_at": "2025-02-20T23:37:00.000000Z",
    "image": "https://example.com/image.jpg"
  },
  "relationships": {
    "images": [],
    "serie": {
      "id": 1,
      "name": "serie"
    }
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
  "data": {
    "id": 1,
    "type": "chapter",
    "attributes": {
      "order_number": 1,
      "created_at": "2025-02-20T19:40:17.000000Z",
      "image": "https://example.com/image.jpg"
    },
    "relationships": {
      "images": [
        {
          "id": 1,
          "type": "image",
          "attributes": {
            "order_number": 11,
            "image": "https://example.com/image.jpg"
          }
        }
      ],
      "serie": {
        "id": 1,
        "name": "serie"
      }
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
    - order_number (opcional): Orden del capítulo.
    - image_url (opcional): URL de la imagen del capítulo.
    - serie_id (opcional): ID de la serie a la que pertenece el capítulo.

Ejemplo de cuerpo de la petición:
```json
{
    "order_number": 4,
    "image_url": "https://example.com/image.jpg",
    "serie_id": 1,
    "_method": "PUT"
}
```
Ejemplo de respuesta:
```json
{
    "id": 3,
    "type": "chapter",
    "attributes": {
        "order_number": 4,
        "created_at": "2025-02-20T23:37:00.000000Z",
        "image": "https://example.com/image.jpg"
    },
    "relationships": {
        "images": [],
        "serie": {
            "id": 1,
            "name": "serie"
        }
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

Ejemplo de respuesta: 204 No Content.


### Imágenes


#### Crear una nueva imagen
- URL: /v1/images
- Método: POST
- Descripción: Sube una nueva imagen.
- Autenticación requerida: Sí (Bearer Token).
- Parámetros:
    - order (requerido): Orden de la imagen.
    - image_url (requerido): URL de la imagen.
    - chapter_id (requerido): ID del capítulo al que pertenece la imagen.

Ejemplo de cuerpo de la petición:
```json
{
    "order_number": 10,
    "image_url": "https://example.com/image.jpg",
    "chapter_id": 3
}
```
Ejemplo de respuesta:
```json
{
    "order_number": 10,
    "image_url": "https://example.com/image.jpg",
    "chapter_id": 3,
    "owner_id": 1,
    "updated_at": "2025-02-20T23:42:11.000000Z",
    "created_at": "2025-02-20T23:42:11.000000Z",
    "id": 3
}
```


#### Actualizar una imagen
- URL: /v1/images/{id}
- Método: POST
- Descripción: Actualiza los datos de una imagen existente.
- Autenticación requerida: Sí (Bearer Token).
- Parámetros:
    - id (requerido): ID de la imagen.
    - order_number (opcional): Orden de la imagen.
    - image_url (opcional): URL de la imagen.

Ejemplo de cuerpo de la petición:
```json
{
    "order_number": 11,
    "image_url": "https://example.com/image.jpg",
    "_method": "PUT"
}
```
Ejemplo de respuesta:
```json
{
    "id": 6,
    "order_number": 11,
    "image_url": "https://example.com/image.jpg",
    "owner_id": 1,
    "chapter_id": 4,
    "created_at": "2025-02-21T00:30:19.000000Z",
    "updated_at": "2025-02-21T00:31:30.000000Z"
}
```

#### Eliminar una imagen
- URL: /v1/images/{id}
- Método: DELETE
- Descripción: Elimina una imagen específica.
- Autenticación requerida: Sí (Bearer Token).
- Parámetros:
    - id (requerido): ID de Imagen.

Ejemplo de respuesta: 204 No Content.

