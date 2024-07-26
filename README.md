## Prueba API de contenido

Elegí esta prueba porque me siento mas cómodo trabajando en backend y he usado symfony para construir algunas Apis anteriormente, además pensé que seria mas rápido de construir y testear. 

El proyecto se construyo utilizando symfony en la versión 5.4, php 8.0 y se utilizo mysql 8.0 como gestor de base de datos. en cuanto a la arquitectura del proyecto, se utilizo api platform para la gestión de las rutas y del serializer, la cual llama a un custom action que a su vez llama a un servicio y en caso de necesitar interactuar con la base de datos llama a un repositorio para que se gestione la solicitud.

Se utilizo docker para la construcción del contenedor, que contiene 2 imágenes, una con php que hace funcionar el servidor y otra con mysql para gestionar las bases de datos. Para hacer funcionar la aplicación se debe seguir los siguientes pasos en el directorio raíz del proyecto:

1. `make build`

2. `make start`

3. `make prepare`

4. `make run`

Una vez inicializado el proyecto para generar las llaves de jwt y correr las migraciones se deberá ejecutar:

5. `make generate-ssh-keys`

6. `make ssh-be`

dentro del bash del contenedor, correr los siguiente:

7. `bin/console doctrine:database:create`

8. `bin/console doctrine:migrations:migrate -n`

y con eso ya estaría funcionando la aplicación.

Se creo una api rest con algunos endpoints de los solicitados, ya que por tiempo no se logro realizarlos todos, dichos endpoints funcionales son:

- Endpoints de autenticación:
    ### 1. `POST /api/register` - Registrar un nuevo usuario. payload:
        
        {
            "name":"user",
            "email":"user@user.com",
            "password":"123456"
        }
        

   ### 2. `POST /api/login` - Autentica un usuario y proporciona un token. payload:
       
        {
            "username":"user@user.com",
            "password":"123456"
        }
       

- Endpoints de usuario:
    ### 1. `GET /api/user/{id}` - Obtener los datos del usuario autenticado. necesita bearer token jwt

    ### 2. `PUT /api/user{id}` - Actualiza el perfil del usuario autenticado. necesita bearer token jwt payload:
            {
                "name": "user",
                "email": "user@user.com",
                "current_password": "123456",
                "new_password": "password"
            }

- Endpoints de contenido:
   ###  1. `POST /api/content` - Crear contenido nuevo. necesita bearer token jwt
        payload por form-data (postman):
            title (string)
            description (string)
            file (archivo)

    ### 2. `PUT /api/content/{id}` - Actualizar contenido existente. necesita bearer token jwt
        payload por form-data (postman):
            title (string)
            description (string)
            file (archivo)

    ### 2. `GET /api/content` - Obtener todo el contenido del user. necesita bearer token jwt payload: 
            {
                 "title":"",
                "description":""
            }

    ### 2. `GET /api/content/{id}` - Obtener contenido por id. necesita bearer token jwt

    ### 2. `DELETE /api/content/{id}` - Eliminar contenido por id. necesita bearer token jwt
    
Para los endpoints de usuario se les agrego al final el id del usuario para poder conseguir acceder al usuario.
