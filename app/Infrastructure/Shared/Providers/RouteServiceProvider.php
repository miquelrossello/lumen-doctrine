<?php
declare(strict_types=1);


namespace App\Infrastructure\Shared\Providers;


use Illuminate\Support\ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{

    /**
     * Finds all route files which are inside App/Infrastructure/`**`/Routes/*
     * @return array File routes
     */
    private function findRouteFiles(): array {
        // Scan the App\Infrastructure directory
        $infrastructureDir = scandir(__DIR__ . '/../..');
        $routeFilesPaths = [];

        foreach($infrastructureDir as $item) {
            // Ignore parent dirs
            if ($item === '.' || $item === '..')
                continue;

            // Parse names to lower case
            //$item = strtolower($item);

            $itemPath = __DIR__ . '/../../' . $item;

            if ($this->dirHasRoutesDir($itemPath)) {
                $phpFilesFromDir = $this->getAllPhpFilesFromDir($itemPath . '/routes');

                foreach ($phpFilesFromDir as $file) {
                    array_push($routeFilesPaths, $itemPath . '/routes/' . $file);
                }
            }
        }

        return $routeFilesPaths;
    }

    /**
     * Return all php files from dir path
     * @param string $dirPath Where to scan '*.php' files
     * @return array PHP files
     */
    private function getAllPhpFilesFromDir(string $dirPath): array
    {
        $dirFiles = scandir($dirPath);
        $phpFiles = array();

        foreach($dirFiles as $file) {
            if (preg_match('/^.*(.php)$/', $file))
                array_push($phpFiles, $file);
        }

        return $phpFiles;
    }

    /**
     * Check if on directory exists routes folder
     * @param string $dirPath Where to scan if exists routes dir
     * @return bool If directory has routes dir
     */
    private function dirHasRoutesDir(string $dirPath): bool
    {
        // Parse dir content names to lower case
        $dirContent = scandir($dirPath);
        foreach ($dirContent as $key => $item)
            $dirContent[$key] = strtolower($item);

        return array_search('routes', $dirContent) !== false;
    }

    public function boot()
    {
        $routeFilePaths = $this->findRouteFiles();

        $this->app->router->group([
            'namespace' => 'App\Infrastructure'
        ], function($router) use ($routeFilePaths) {
            foreach ($routeFilePaths as $routeFilePath)
                include $routeFilePath;

            // Keep including the default file where register routes
            include __DIR__ . '/../Routes/web.php';
        });
    }
}
