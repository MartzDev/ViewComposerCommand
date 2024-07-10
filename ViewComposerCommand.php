<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File; // Importar la clase File
use Illuminate\Support\Str;

class ViewComposerCommand extends Command
{
    /**
     * Desarrollado por MartzDev - https://github.com/MartzDev
     * Si realizan modificaciones en esta clase, primero deben ejecutar el comando composer dump-autoload (para reconstruir la caché de carga)
     * y luego el comando view-composer:create
     */
    protected $mensajeError = [
        'nombre' => 'El argumento --nombre es obligatorio.',
    ];

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'view-composer:create {nombre : El nombre de la clase}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Este comando crea una vista composer para compartir datos en vistas especificas';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Obtiene los valores de los argumentos
        $nombreComposer = Str::ucfirst($this->argument('nombre'));

        // Valida los argumentos obligatorios
        if (is_null($nombreComposer)) {
            $this->error($this->mensajeError['nombre']);
            return; // Salir del comando si falta el nombre
        }

        // Verifica y crea la estructura de carpeta View\Composers en app
        $rutaDirectorioComposer = app_path('View/Composers');
        if (!is_dir($rutaDirectorioComposer)) {
            mkdir($rutaDirectorioComposer, 0755, true);
        }

        // Generar la clase composer
        $ClaseComposer = $nombreComposer . 'Composer';
        $rutaArchivoComposer = $rutaDirectorioComposer . DIRECTORY_SEPARATOR . $ClaseComposer . '.php';

        if (File::exists($rutaArchivoComposer)) {
            $this->error('La clase composer ' . $ClaseComposer . ' ya existe.');
            return; // Salir del comando si existe la ruta del archivo
        }

        $contenidoComposer = $this->generarClaseComposer($ClaseComposer);
        File::put($rutaArchivoComposer, $contenidoComposer);

        $this->info('La clase composer ' . $ClaseComposer . ' ha sido creada correctamente.');

        // Ejecuta el comando view-composer:create personalizado
        Artisan::call('view-composer:create', [
            'nombre' => $nombreComposer,
        ]);
    }

    /**
     * @param string $nombreComposer nombre de la clase
     * @return string codigo de la clase
     */
    private function generarClaseComposer(string $nombreComposer): string
    {
        $codigoClaseComposer = "<?php\n";
        $codigoClaseComposer .= "namespace App\View\Composers;\n";
        $codigoClaseComposer .= "use Illuminate\View\View;\n";

        // Inserción dinámica de la variable
        $codigoClaseComposer .= "class " . $nombreComposer . " {\n";

        $codigoClaseComposer .= "    /**\n";
        $codigoClaseComposer .= "     * Crea un nuevo compositor de variables.\n";
        $codigoClaseComposer .= "     */\n";
        $codigoClaseComposer .= "    public function __construct(\n";
        $codigoClaseComposer .= "        protected int \$dato = 1\n";
        $codigoClaseComposer .= "    ) {\n";
        $codigoClaseComposer .= "        // ...\n";
        $codigoClaseComposer .= "    }\n\n";

        $codigoClaseComposer .= "    /**\n";
        $codigoClaseComposer .= "     * Enlaza datos a la vista.\n";
        $codigoClaseComposer .= "     */\n";
        $codigoClaseComposer .= "    public function compose(View \$view): void\n";
        $codigoClaseComposer .= "    {\n";
        $codigoClaseComposer .= "        \$view->with('clave', \$this->dato);\n";
        $codigoClaseComposer .= "    }\n";
        $codigoClaseComposer .= "}\n";

        return $codigoClaseComposer;

        /**
         * Las siguientes lineas de codigo es por si lo usarán mediante plantillas
         */

        // Definir la ruta de la plantilla
        // $rutaPlantilla = base_path('helpers' . DIRECTORY_SEPARATOR . 'TemplateComposer.php');

        // Verificar si existe el archivo de plantilla
        // if (!File::exists($rutaPlantilla)) {
        //     $this->error('El archivo de plantilla composer ' . $rutaPlantilla . ' no existe.');
        //     return;
        // }

        // Obtener el contenido de la plantilla
        // $contenidoPlantilla = File::get($rutaPlantilla);

        // Reemplazar marcadores de posición con valores reales
        // $contenidoPlantilla = str_replace('{{ nombreComposer }}', $nombreComposer, $contenidoPlantilla);

        // Devolver el código de clase composer generado
        // return $contenidoPlantilla;
    }
}
