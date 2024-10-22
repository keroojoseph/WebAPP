<?php

namespace App\Libs;

class Language
{
    private $dictionary = [];

    public function load($path)
    {
        $defaultLanguage = APP_DEFAULT_LANGUAGE;

        if (isset($_SESSION['lang']))
        {
            $defaultLanguage = $_SESSION['lang'];
        }

        $languageFileToLoad = LANGUAGES_PATH . $defaultLanguage. DS . str_replace('.', DS, $path) . ".lang.php";

        if (file_exists($languageFileToLoad)) {
            require $languageFileToLoad;

            if (is_array($_) && !empty($_)) {
                foreach ($_ as $key => $value) {
                    $this->dictionary[$key] = $value;
                }
            }
        } else {
            trigger_error("Language file not found", E_USER_ERROR);
        }
    }

    /**
     * @return mixed
     */
    public function getDictionary()
    {
        return $this->dictionary;
    }
}