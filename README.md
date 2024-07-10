# Manual
1. Antes de utilizar el ViewComposerCommand, deben crear el comando:
`view-composer:create`

2. Para crear el comando, deben abrir la terminal de su editor de codigo y escribir:
`php artisan make:command [nombre-clase] --command=[nombre-comando]`. Donde `[nombre-clase]` es el nombre de la clase donde se alojará el codigo, y 
`[nombre-comando]` es la firma o identificador de comando que va a reconocer Artisan **(recuerden quitar los corchetes)**.

3. Copiar el codigo que se encuentra en el fichero ViewComposerCommand y pegarlo en el existente.

Para mas información, visite la documentación oficial de Laravel 11: [Laravel 11 - View Composer](http://https://laravel.com/docs/11.x/views#view-composers "Laravel 11 - View Composer").
