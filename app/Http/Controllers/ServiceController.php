<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::where('is_active', true)
            ->orderBy('order')
            ->paginate(12);

        return view('services.index', compact('services'));
    }

    public function show(Service $service)
    {
        if (!$service->is_active) {
            abort(404);
        }

        $relatedServices = Service::where('is_active', true)
            ->where('id', '!=', $service->id)
            ->orderBy('order')
            ->take(3)
            ->get();

        return view('services.show', compact('service', 'relatedServices'));
    }
}
