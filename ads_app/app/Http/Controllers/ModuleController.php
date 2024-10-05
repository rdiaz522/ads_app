<?php


namespace App\Http\Controllers;


use App\Services\Module\UserService;

abstract class ModuleController extends Controller
{

    /**
     * @var Service
     */
    public $service;

    public function __construct($service)
    {
        parent::__construct();
        $this->service = $service;
    }
}
