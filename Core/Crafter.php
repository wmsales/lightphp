<?php

namespace Core;

class Crafter
{
    private $cache;

    public function __construct()
    {
        $this->cache = new Cache(); // Instancia de Cache
    }

    public function run($command, $arguments)
    {
        if (is_null($command)) {
            $this->showHelp();
            return;
        }

        switch ($command) {
            case 'migrate:init':
                $this->handleMigrateInit();
                break;
            case 'migrate':
                $this->handleMigrate($arguments);
                break;
            case 'create:migration':
                $this->handleCreateMigration($arguments);
                break;
            case 'rollback':
                $this->handleRollback($arguments);
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

        // Permisos en Linux
        if (function_exists('chmod')) {
            chmod($filePath, 0644);
        }
    }

    protected function handleMigrateInit()
    {
        exec('php vendor/bin/phoenix init', $output, $return_var);
        echo implode("\n", $output) . "\n";
        if ($return_var === 0) {
            echo "Phoenix initialized successfully.\n";
        } else {
            echo "An error occurred while initializing Phoenix.\n";
        }
    }

    protected function handleMigrate($arguments)
    {
        exec('php vendor/bin/phoenix migrate', $output, $return_var);
        echo implode("\n", $output) . "\n";
        if ($return_var === 0) {
            echo "Migrations executed successfully.\n";
        } else {
            echo "An error occurred while executing migrations.\n";
        }
    }

    protected function handleCreateMigration($arguments)
    {
        $migrationName = $arguments[0] ?? 'NewMigration';
        exec("php vendor/bin/phoenix create \"$migrationName\"", $output, $return_var);
        echo implode("\n", $output) . "\n";
        if ($return_var === 0) {
            echo "Migration '$migrationName' created successfully.\n";
        } else {
            echo "An error occurred while creating the migration.\n";
        }
    }

    protected function handleRollback($arguments)
    {
        exec('php vendor/bin/phoenix rollback', $output, $return_var);
        echo implode("\n", $output) . "\n";
        if ($return_var === 0) {
            echo "Last migration rolled back successfully.\n";
        } else {
            echo "An error occurred while rolling back the migration.\n";
        }
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
        $this->cache->clear();  // Limpia toda la caché
        echo "All cache cleared.\n";
    }

    protected function showHelp()
    {
        echo "                                                                                                                  
                                                               (      (     
   (                  (         )                         (     )\ )   )\ )  
   )\    (        )   )\ )   ( /(     (    (              )\   (()/(  (()/(  
 (((_)   )(    ( /(  (()/(   )\())   ))\   )(           (((_)   /(_))  /(_)) 
 )\___  (()\   )(_))  /(_)) (_))/   /((_) (()\          )\___  (_))   (_))   
((/ __|  ((_) ((_)_  (_) _| | |_   (_))    ((_)   ___  ((/ __| | |    |_ _|  
 | (__  | '_| / _` |  |  _| |  _|  / -_)  | '_|  |___|  | (__  | |__   | |   
  \___| |_|   \__,_|  |_|    \__|  \___|  |_|            \___| |____| |___|  
                                                                             
                                                                                                                  \n\n";
        echo "  migrate:init       Initialize Phoenix for migrations\n";
        echo "  migrate            Run database migrations\n";
        echo "  create:migration   Create a new migration\n";
        echo "  rollback           Rollback the last migration\n";
        echo "  create:model       Create a new model\n";
        echo "  create:controller  Create a new controller\n";
        echo "  create:view        Create a new view\n";
        echo "  cache:clear        Clear application cache\n";
        echo "\nSupported adapters:\n";
        echo "  - MySQL\n";
        echo "  - PostgreSQL\n";
        echo "\nUsage:\n";
        echo "  crafter <command> [arguments]\n";
        echo "\nExamples:\n";
        echo "  crafter migrate:init\n";
        echo "  crafter migrate\n";
        echo "  crafter create:migration AddUsersTable\n";
        echo "  crafter rollback\n";
        echo "  crafter cache:clear\n";
    }
}
