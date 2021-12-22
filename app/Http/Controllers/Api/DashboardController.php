<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use OwenIt\Auditing\Auditable;

class DashboardController extends Controller
{
    public function index()
    {
        return Auditable::query()->get();
    }
}