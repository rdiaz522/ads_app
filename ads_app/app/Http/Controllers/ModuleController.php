<?php


namespace App\Http\Controllers;


abstract class ModuleController extends Controller
{

    protected string $serviceName;

    protected mixed $service;

    public function __construct()
    {
        parent::__construct();

        $serviceName = "App\\Services\\Module\\" . $this->serviceName;
        $service = resolve($serviceName);
        $this->service = $service;
    }


}
