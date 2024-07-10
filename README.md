# Manual
1. Antes de utilizar el ViewComposerCommand, deben crear el comando:
`view-composer:create`

2. Para crear el comando, deben abrir la terminal de su editor de codigo y escribir:
`php artisan make:command [nombre-clase] --command=[nombre-comando]`. Donde `[nombre-clase]` es el nombre de la clase donde se alojará el codigo, y 
`[nombre-comando]` es la firma o identificador del comando que va a reconocer Artisan **(recuerden quitar los corchetes)**.

3. Ingrese en la terminal el comando `php artisan make:command ViewComposerCommand --command=view-composer:create`
4. Por ultimo, copiar el codigo que se encuentra en el fichero ViewComposerCommand del repositorio, pegarlo en el fichero que se generó en el paso anterior y escribir el comando `php artisan view-composer:create [nombre-clase]`.

Nota: el codigo generado mantiene la convención de laravel, la primera letra en mayuscula y al final concatena el proposito de esa clase.
En el paso anterior, si se coloca por ejemplo `php artisan view-composer:create Post`, se crea la clase con el nombre PostComposer en su respectiva ubicación dentro de la esctructura de carpetas del proyecto, app/View/Composers/PostComposer.php (el codigo se encarga de crear automaticamente la estructura de carpeta, en caso de que no exista)

Para mas información, visite la documentación oficial de Laravel 11: [Laravel 11 - View Composer](http://https://laravel.com/docs/11.x/views#view-composers "Laravel 11 - View Composer").
