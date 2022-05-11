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