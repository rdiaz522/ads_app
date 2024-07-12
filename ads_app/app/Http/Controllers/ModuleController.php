<?php


namespace App\Http\Controllers;


abstract class ModuleController extends Controller
{
    protected $serviceName;

    protected $service;

    public function __construct()
    {
        parent::__construct();

        $serviceName = "App\\Services\\Module\\" . $this->serviceName;
        $service = resolve($serviceName);
        $this->service = $service;
    }
}
