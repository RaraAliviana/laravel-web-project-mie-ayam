<?php

namespace App\Http\Controllers;

use App\Services\IntegrityService;

class IntegrityController extends Controller
{
    public function index(IntegrityService $service)
    {
        $data = $service->verify();

        return view('admin.integrity.index', [
            'results' => $data['results'],
            'isChainValid' => $data['isChainValid'],
        ]);
    }
}

