<?php


namespace App\Repositories;


class RepoCaller
{
    CONST REPO_CLASS_PATH = "App\\Repositories\\Module\\";


    public static function initializeModel($repoName)
    {
        $name = self::repoFormatName($repoName);
        $repoName = self::REPO_CLASS_PATH . $name;

        if (!class_exists($repoName)) {
            return null;
        }

        return new $repoName();
    }

    protected static function repoFormatName($name)
    {
        return str_replace(' ', '', $name);
    }
}
