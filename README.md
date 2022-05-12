# Soundclock

## Lancer le serveur

```
php -S 0.0.0.0:8080 -t public
```

## Composer

```
composer create-project symfony/website-skeleton Soundclock
```

## Fixture

```
composer require --dev orm-fixtures
```

## Service Slug

``` 
Service.yaml

parameters:
    app.slugger_to_lower: true
```

## Event Listener

```
App\EventListener\MusicListener:
        tags:
            -
                # le nom du type d'évènement, dans notre cas, un évènement doctrine entity listener
                name: doctrine.orm.entity_listener
                # le nom de l'event : avant update
                event: preUpdate
                # l'entity sur laquelle on veut être notifier
                entity: App\Entity\Music
                # method attribute is optional
                method: updateMusic
            -
                # le nom du type d'évènement, dans notre cas, un évènement doctrine entity listener
                name: doctrine.orm.entity_listener
                # le nom de l'event : avant création
                event: prePersist
                # l'entity sur laquelle on veut être notifier
                entity: App\Entity\Music
                # method attribute is optional
                method: updateMusic
```

## Faker

```
composer require fzaninotto/faker --dev
```

## JWT

```
composer require "lexik/jwt-authentication-bundle"
bin/console lexik:jwt:generate-keypair
```

### Dans security.yaml

```
firewalls:
    # A METTRE AVANT MAIN, sinon pas prit en compte
    login:
        pattern: ^/api/login
        stateless: true
        json_login:
            check_path: /api/login_check
            success_handler: lexik_jwt_authentication.handler.authentication_success
            failure_handler: lexik_jwt_authentication.handler.authentication_failure

    # partie secure de l'API
    api_secure:
        pattern:   ^/api/secure
        stateless: true
        jwt: ~
    
    # partie publique de l'API
    api_public:
        pattern:   ^/api
        stateless: true
    #   jwt: ~

access_control:
        - { path: ^/api/login, roles: PUBLIC_ACCESS }
        - { path: ^/api, roles: PUBLIC_ACCESS }
        - { path: ^/api/secure,roles: IS_AUTHENTICATED_FULLY }
```

### Dans route.yaml

```
api_login_check:
    path: /api/login_check
```

### Réécriture payload dans service.yaml

```
acme_api.event.jwt_created_listener:
        class: App\EventListener\JWTCreatedListener
        tags:
            - { name: kernel.event_listener, event: lexik_jwt_authentication.on_jwt_created, method: onJWTCreated }
```

## API DOC

https://symfony.com/bundles/NelmioApiDocBundle/current/index.html

```
composer require nelmio/api-doc-bundle
composer require twig asset
```

### Dans packages/nelmio_api_doc.yaml

```
    components:
            securitySchemes:
                bearerAuth:            # arbitrary name for the security scheme this will be use in annotations @Security(name="bearerAuth")
                    type: http
                    scheme: bearer
                    bearerFormat: JWT 
        security:
            - bearerAuth: []
        # https://swagger.io/docs/specification/paths-and-operations/
        paths: # documentation de la route pour obtenir le token lexkit
            /api/login_check:
                post:
                    summary: Auth method
                    description: authenticate method
                    # https://swagger.io/docs/specification/grouping-operations-with-tags/
                    tags:
                        - Sound'Clock API Auth
                    # https://swagger.io/docs/specification/describing-parameters/
                    requestBody:
                        description: JSON Object
                        required: true
                        content: 
                            application/json:
                                schema:
                                    type: object
                                    properties:
                                        username:
                                            type: string
                                        password:
                                            type: string
                    responses:
                        '200':
                            description: JWT Token
                            content:
                                application/json:
                                    schema: 
                                        type: object
                                        properties:
                                            token:
                                                type: string
```

### Dans route/nelmio_api_doc.yaml

```
app.swagger_ui:
   path: /api/doc
   methods: GET
   defaults: { _controller: nelmio_api_doc.controller.swagger_ui }
```

### Ce qu'il faut faire pour une route par exemple dans 

#### Pour un POST

```
        paths:
            # Creation d'une musique                                              
            /api/musics:
                post:
                    summary: Creat Music
                    description: Creat Method 
                    # https://swagger.io/docs/specification/grouping-operations-with-tags/
                    tags:
                        - Sound'Clock API Music
                    # https://swagger.io/docs/specification/describing-parameters/
                    requestBody:
                        description: Multipart-form-data
                        required: true
                        content: 
                            multipart/form-data:
                                schema:
                                    type: object
                                    properties:
                                        title:
                                            type: string
                                        description:
                                            type: string
                                        releaseDate: 
                                            type: date
                                        picture:
                                            type: string
                                            format: binary
                                        file: 
                                            type: string
                                            format: binary
                                        user:
                                            type: integer

                    responses:
                        '200':
                            description: Creat Music
                            content:
                                 multipart/form-data:
                                    schema: 
                                        type: object
                                        properties:
                                            title:
                                                type: string
                                            description:
                                                type: string
                                            releaseDate: 
                                                type: date
                                            picture:
                                                type: string
                                                format: binary
                                            file: 
                                                type: string
                                                format: binary
                                            user:
                                                type: integer
```

#### Pour un GET Show all

```
            # Show All Genre
                        /api/genre:
                            get:
                                summary: Show all Genres
                                description: Show All Methods
                                # https://swagger.io/docs/specification/grouping-operations-with-tags/
                                tags:
                                    - Sound'Clock API Genre
                                # https://swagger.io/docs/specification/describing-parameters/

                                responses:
                                    '200':
                                        description: Show All Methods
                                        content:
                                            application/json:
                                                schema: 
                                                    type: array
                                                    items: 
                                                        type: string
```

##### Pour un GET Show one

```
            /api/genre/{id}:
                get:
                    summary: Show One By ID Genre
                    description: Show One By ID Methods
                    # https://swagger.io/docs/specification/grouping-operations-with-tags/
                    tags:
                        - Sound'Clock API Genre
                    # https://swagger.io/docs/specification/describing-parameters/
                    parameters:
                      - in: path
                        name: id
                        schema:
                            type: integer
                        required: true

                    responses:
                        '200':
                            description: Show One By ID Genre
                            content:
                                application/json:
                                    schema: 
                                        type: array
                                        items: 
                                            type: string
```