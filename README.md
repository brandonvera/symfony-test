Prueba API de contenido

Elegí esta prueba porque me siento mas cómodo trabajando en backend y he usado symfony para construir algunas Apis anteriormente, además pensé que seria mas rápido de construir y testear. 

El proyecto se construyo utilizando symfony en la versión 5.4, php 8.0 y se utilizo mysql 8.0 como gestor de base de datos. en cuanto a la arquitectura del proyecto, se utilizo api platform para la gestión de las rutas y del serializer, la cual llama a un custom action que a su vez llama a un servicio y en caso de necesitar interactuar con la base de datos llama a un repositorio para que se gestione la solicitud.

Se utilizo docker para la construcción del contenedor, que contiene 2 imágenes, una con php que hace funcionar el servidor y otra con mysql para gestionar las bases de datos. Para hacer funcionar la aplicación se debe seguir los siguientes pasos en el directorio raíz del proyecto:

`make build`

`make start`

`make prepare`

`make run`

Una vez inicializado el proyecto para generar las llaves de jwt y correr las migraciones se deberá ejecutar:

`make generate-ssh-keys`
`make ssh-be`

dentro del bash del contenedor, correr los siguiente:

`bin/console doctrine:database:create`

`bin/console doctrine:migrations:migrate -n`

y con eso ya estaría funcionando la aplicación.

Se creo una api rest con algunos endpoints de los solicitados, ya que por tiempo no se logro realizarlos todos, dichos endpoints funcionales son:

- Endpoints de autenticación:
    - `POST /api/register` - Registrar un nuevo usuario.
        payload:
            {
                "name":"user",
                "email":"user@user.com",
                "password":"123456"
            }

    - `POST /api/login` - Autentica un usuario y proporciona un token.
        payload:
            {
                "username":"user@user.com",
                "password":"123456"
            }

- Endpoints de usuario:
    - `GET /api/user/{id}` - Obtener los datos del usuario autenticado.
        necesita bearer token jwt

    - `PUT /api/user{id}` - Actualiza el perfil del usuario autenticado.
        necesita bearer token jwt
        payload:
            {
                "name": "user",
                "email": "user@user.com",
                "current_password": "123456",
                "new_password": "password"
            }

- Endpoints de contenido:
    - `POST /api/content` - Crear contenido nuevo.
        necesita bearer token jwt
        payload por form-data (postman):
            title 
            description
            file (archivo)

    - `PUT /api/content/{id}` - Actualizar contenido existente.
        necesita bearer token jwt
        payload por form-data (postman):
            title
            description
            file (archivo)

Para los endpoints de usuario se les agrego al final el id del usuario para poder conseguir acceder al usuario.