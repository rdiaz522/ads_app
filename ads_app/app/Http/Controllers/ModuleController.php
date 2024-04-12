<?php


namespace App\Http\Controllers;


abstract class ModuleController extends Controller
{
    protected $repo;
    protected $object;

    public function __construct()
    {
        parent::__construct();

    }
}
