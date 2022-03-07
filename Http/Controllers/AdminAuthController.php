<?php

namespace Modules\AdminAuth\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{
    public function auth()
    {
        return auth('admin');
    }
}
