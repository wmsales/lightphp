<?php

namespace Core;

class Crafter
{
    public function run($command, $arguments)
    {
        if (is_null($command)) {
            $this->showHelp();
            return;
        }

        switch ($command) {
            case 'migrate':
                $this->handleMigrate($arguments);
                break;
            case 'create:model':
                $this->handleCreateModel($arguments);
                break;
            case 'create:controller':
                $this->handleCreateController($arguments);
                break;
            case 'create:view':
                $this->handleCreateView($arguments);
                break;
            case 'cache:clear':
                $this->handleCacheClear();
                break;
            default:
                echo "Unknown command: $command\n";
                $this->showHelp();
                break;
        }
    }

    private function createFile($filePath, $content)
    {
        // Revisa si la carpeta existe, si no, lo crea
        $directory = dirname($filePath);
        if (!is_dir($directory)) {
            mkdir($directory, 0755, true);
        }

        // Crear archivo
        file_put_contents($filePath, $content);

        // permisos en Linux
        if (function_exists('chmod')) {
            chmod($filePath, 0644);
        }
    }

    protected function handleMigrate($arguments)
    {
        // codigo para manejar migraciones de base de datos
        echo "Running migrations...\n";
    }

    protected function handleCreateModel($arguments)
    {
        $modelName = $arguments[0] ?? 'NewModel';
        $modelName = ucfirst($modelName) . 'Model';
        $filePath = "App/Model/{$modelName}.php";

        $this->createFile($filePath, "<?php\n\nnamespace App\\Model;\n\nclass $modelName\n{\n    // Model code here\n}\n");
        echo "Model created: $modelName\n";
    }

    protected function handleCreateController($arguments)
    {
        $controllerName = $arguments[0] ?? 'NewController';
        $controllerName = ucfirst($controllerName) . 'Controller';
        $filePath = "App/Controllers/{$controllerName}.php";

        $this->createFile($filePath, "<?php\n\nnamespace App\\Controllers;\n\nclass $controllerName\n{\n    // Controller code here\n}\n");
        echo "Controller created: $controllerName\n";
    }

    protected function handleCreateView($arguments)
    {
        $viewName = $arguments[0] ?? 'new_view';
        $viewName = strtolower($viewName) . '_view';
        $filePath = "App/Views/{$viewName}.php";

        $this->createFile($filePath, "<?php\n\n// View code here\n");
        echo "View created: $viewName\n";
    }

    protected function handleCacheClear()
    {
        // codigo para limpiar el cache 
        echo "Cache cleared.\n";
    }

    protected function showHelp()
    {
        echo "                                                                                                                  
                                                               (      (     
   (                  (         )                        (     )\ )   )\ )  
   )\    (        )   )\ )   ( /(     (    (             )\   (()/(  (()/(  
 (((_)   )(    ( /(  (()/(   )\())   ))\   )(    ___   (((_)   /(_))  /(_)) 
 )\___  (()\   )(_))  /(_)) (_))/   /((_) (()\  |___|  )\___  (_))   (_))   
((/ __|  ((_) ((_)_  (_) _| | |_   (_))    ((_)       ((/ __| | |    |_ _|  
 | (__  | '_| / _` |  |  _| |  _|  / -_)  | '_|        | (__  | |__   | |   
  \___| |_|   \__,_|  |_|    \__|  \___|  |_|           \___| |____| |___|  
                                                                            
                                                                                                                  \n\n";
        echo "  migrate            Run database migrations\n";
        echo "  create:model       Create a new model\n";
        echo "  create:controller  Create a new controller\n";
        echo "  create:view        Create a new view\n";
        echo "  cache:clear        Clear application cache\n";
        echo "\nUsage:\n";
        echo "  crafter <command> [arguments]\n";
        echo "\nExamples:\n";
        echo "  crafter migrate\n";
        echo "  crafter create:model User\n";
        echo "  crafter cache:clear\n";
    }
}
