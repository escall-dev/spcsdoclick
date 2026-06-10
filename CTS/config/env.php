<?php
/**
 * Shared environment loader for SDO CTS.
 * Uses $_ENV first so settings work when putenv() is disabled on hosting.
 */

if (!function_exists('cts_load_env')) {
    function cts_load_env($envFile = null)
    {
        static $loaded = false;
        if ($loaded) {
            return;
        }

        $envFile = $envFile ?: dirname(__DIR__) . DIRECTORY_SEPARATOR . '.env';
        if (!is_readable($envFile)) {
            $loaded = true;
            return;
        }

        foreach (file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) as $line) {
            $line = trim($line);
            if ($line === '' || $line[0] === '#') {
                continue;
            }

            $pos = strpos($line, '=');
            if ($pos === false) {
                continue;
            }

            $key = trim(substr($line, 0, $pos));
            $val = trim(substr($line, $pos + 1));

            if ((strlen($val) >= 2 && $val[0] === '"' && substr($val, -1) === '"') ||
                (strlen($val) >= 2 && $val[0] === "'" && substr($val, -1) === "'")) {
                $val = substr($val, 1, -1);
            }

            $_ENV[$key] = $val;
            if (function_exists('putenv')) {
                @putenv("$key=$val");
            }
        }

        $loaded = true;
    }

    function cts_env($key, $default = null)
    {
        cts_load_env();

        if (array_key_exists($key, $_ENV)) {
            return $_ENV[$key];
        }

        if (array_key_exists($key, $_SERVER)) {
            return $_SERVER[$key];
        }

        $value = getenv($key);
        if ($value !== false) {
            return $value;
        }

        return $default;
    }
}
