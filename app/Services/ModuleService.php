<?php

namespace App\Services;

use App\Facades\VersionManager;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use Nwidart\Modules\Facades\Module;
use ZipArchive;

class ModuleService
{
    public function getModule($module)
    {
        return Module::find($module);
    }

    public function getRequirements(string $module): ?array
    {
        $module = Module::find($module);

        if ($module->get('require') !== null) {
            return $module->get('require');
        }

        return null;
    }

    public function checkRequirements(string $module): bool
    {
        $requirements = $this->getRequirements($module);

        if ($requirements === null) {
            return true;
        }

        foreach ($requirements as $requirement) {
            $module = Module::find($requirement);

            if ($module === null) {
                return false;
            }

            if ($module->isDisabled()) {
                return false;
            }

            if ($module->isEnabled() && ! $this->checkRequirements($module->getName())) {
                return false;
            }
        }

        return true;
    }

    public function getVersion(string $module): ?string
    {
        $module = Module::find($module);

        return $module->get('version');
    }

    public function getBaseVersion(string $module): ?string
    {
        $module = Module::find($module);

        return $module->get('version');
    }

    public function checkBaseVersion(string $module): bool
    {
        $module = Module::find($module);

        if ($module->get('base_version') !== null) {
            return version_compare(VersionManager::getCurrentBaseVersion(), $module->get('base_version'), '>=');
        }

        return true;
    }

    public function getAuthors(string $module): ?array
    {
        $module = Module::find($module);

        return $module->get('authors');
    }

    public function getKeywords(string $module): ?array
    {
        $module = Module::find($module);

        return $module->get('keywords');
    }

    public function getDescription(string $module): ?string
    {
        $module = Module::find($module);

        return $module->get('description');
    }

    public function getSettingsPage(string $module): ?string
    {
        $module = Module::find($module);

        if ($module->get('settings_page') !== null && Route::has($module->get('settings_page'))) {
            return route($module->get('settings_page'));
        }

        return null;
    }

    public function getRemoteVersion(string $module): ?string
    {
        $module = Module::find($module);

        if ($module->get('remote_version_url') !== null) {
            if (Cache::has($module->getName().'_version')) {
                return Cache::get($module->getName().'_version');
            }

            $response = Http::get($module->get('remote_version_url'));
            $response = json_decode($response->body(), true);

            if (! isset($response['version'])) {
                return null;
            }

            Cache::put($module->getName().'_version', $response['version'], now()->addMinutes(60));

            return $response['version'];
        }

        return null;
    }

    public function installModule(string $path): bool
    {
        $destinationPath = base_path('modules');

        $zip = new ZipArchive;
        $zipStatus = $zip->open(storage_path($path));

        if ($zipStatus === true) {

            $zip->extractTo($destinationPath);
            $zip->close();

            File::deleteDirectory(storage_path('app/temp'));

            return true;
        } else {
            return false;
        }
    }

    public function installModuleFromURL(string $url): bool
    {
        $destinationPath = base_path('modules');
        $tempPath = storage_path('app/temp');

        $tempFile = $tempPath.'/'.basename($url);

        File::ensureDirectoryExists($tempPath);

        $file = file_get_contents($url);
        file_put_contents($tempFile, $file);

        $zip = new ZipArchive;
        $zipStatus = $zip->open($tempFile);

        if ($zipStatus === true) {

            $zip->extractTo($destinationPath);
            $zip->close();

            File::deleteDirectory($tempPath);

            return true;
        } else {
            return false;
        }
    }
}
