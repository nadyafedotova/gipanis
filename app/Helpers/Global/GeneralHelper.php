<?php

if (! function_exists('app_name')) {
    /**
     * Helper to grab the application name.
     *
     * @return mixed
     */
    function app_name()
    {
        return config('app.name');
    }
}

if (! function_exists('paginate_settings')) {
    /**
     * Access the gravatar helper.
     */
    function paginate_settings(string $key)
    {
        $paginater = config('app.paginate');
        if(!empty($paginater[$key])) {
            return $paginater[$key];
        }
        return null;
    }
}

