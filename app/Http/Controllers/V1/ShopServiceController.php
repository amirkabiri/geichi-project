<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\ServiceResource;
use App\Models\Service;
use App\Models\Shop;
use App\Rules\ServiceTime;
use Illuminate\Http\Request;

class ShopServiceController extends Controller
{
    public function index(Shop $shop)
    {
        $this->authorize('viewAny', [Service::class, $shop]);

        return ServiceResource::collection($shop->services);
    }

    public function create(Shop $shop, Request $request)
    {
        $this->authorize('create', [Service::class, $shop]);

        $request->validate([
            'title' => 'required',
            'price' => 'required|integer',
            'time' => ['required', 'integer', new ServiceTime],
        ]);

        $data = $request->only(['title', 'price', 'time']);
        $service = $shop->services()->create($data);

        return new ServiceResource($service);
    }

    public function store(Shop $shop, Request $request)
    {
        //
    }

    public function show(Shop $shop, $id)
    {
        //
    }

    public function edit(Shop $shop, $id)
    {
        //
    }

    public function update(Shop $shop, Request $request, $id)
    {
        //
    }

    public function destroy(Shop $shop, $id)
    {
        //
    }
}
