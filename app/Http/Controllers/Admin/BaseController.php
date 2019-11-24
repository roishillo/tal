<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * Class BaseController
 * -- For sharing methods and properties with admin module
 * -- Admin controllers should extend this controller
 * @package App\Http\Controllers\Admin
 */
class BaseController extends Controller
{
    /**
     * Holder for the request object
     *
     * @var Request
     */
    protected $request;
    /***
     * BaseController constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }
}
