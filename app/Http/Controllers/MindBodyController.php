<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Traits\MBTrait;
use App\Http\Traits\UtilsTrait;
use App\Http\Traits\FieldsTrait;

class MindBodyController extends Controller
{
    public function __construct()
    {
        ini_set('max_execution_time', 28800);
    }
}
