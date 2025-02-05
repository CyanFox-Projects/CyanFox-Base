<?php

namespace App\Services;

use App\Models\Setting;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class SettingsService
{
    public function getSetting(string $key, $default = null, $isLocked = false, bool $isEncrypted = false): ?string
    {
        try {
            $setting = Setting::where('key', $key)->first();

            if ($setting == null) {
                $setting = $this->setSetting($key, $default, isLocked: $isLocked, isEncrypted: $isEncrypted);
            }

            if (Str::contains($key, ['key', 'password', 'secret', 'token'])) {
                $isEncrypted = true;
            }

            if ($isEncrypted) {
                try {
                    return decrypt($setting->value);
                } catch (Exception) {
                    return $setting->value;
                }
            }

            if ($setting->value == null) {
                return config($key);
            }

            return match ($setting->value) {
                'true' => true,
                'false' => false,
                default => $setting->value,
            };
        } catch (Exception) {
            return config($key);
        }
    }

    public function setSetting(string $key, ?string $value = null, bool $isLocked = false, bool $isEncrypted = false, bool $updateIfExists = false): Setting
    {
        $setting = Setting::where('key', $key)->first();

        if (Str::contains($key, ['key', 'password', 'secret', 'token'])) {
            $isEncrypted = true;
        }

        if ($setting == null) {
            $setting = new Setting;
            $setting->key = $key;
            if ($value != null) {
                $value = ($isEncrypted) ? encrypt($value) : $value;
            } elseif (config($key) != null) {
                $value = ($isEncrypted) ? encrypt(config($key)) : config($key);
            }

            $setting->value = $value;
            $setting->is_locked = $isLocked;
            $setting->save();
        } elseif ($updateIfExists) {
            if ($setting->is_locked) {
                Log::debug('Attempted to update locked setting: '.$setting->key);

                return $setting;
            }
            $setting->value = ($isEncrypted) ? encrypt($value) : $value;
            $setting->is_locked = $isLocked;
            $setting->save();
        }

        return $setting;
    }

    public function updateSetting(string $key, ?string $value, bool $isLocked = false, bool $isEncrypted = false): Setting
    {
        $setting = Setting::where('key', $key)->first();

        if (Str::contains($key, ['key', 'password', 'secret', 'token'])) {
            $isEncrypted = true;
        }

        if ($setting != null) {
            if ($setting->is_locked) {
                Log::debug('Attempted to update locked setting: '.$setting->key);

                return $setting;
            }
            $setting->value = ($isEncrypted) ? encrypt($value) : $value;
            $setting->is_locked = $isLocked;
            $setting->save();
        } else {
            $setting = $this->setSetting($key, $value, $isLocked, $isEncrypted);
        }

        return $setting;
    }

    public function updateSettings(array $settings): void
    {
        foreach ($settings as $key => $value) {
            $this->updateSetting($key, $value);
        }
    }

    public function deleteSetting(string $key): bool
    {
        $setting = Setting::where('key', $key)->first();

        if ($setting != null) {
            return $setting->delete();
        }

        return false;
    }
}
