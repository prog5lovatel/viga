<?php

namespace App\Http\Controllers;

use App\Models\Site;
use App\Models\Unidade;
use Illuminate\Support\Facades\Cache;

abstract class SiteBaseController extends Controller
{
    protected $viewData;

    public function __construct()
    {
        $this->viewData['unidades'] = Unidade::all();

        $this->viewData['site'] = Cache::rememberForever('SiteBaseController::site', function () {
            return Site::find(1);
        });
    }
}
