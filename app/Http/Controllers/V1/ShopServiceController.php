<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\NaiveResource;
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

    public function store(Shop $shop, Request $request)
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

    public function show(Shop $shop, Service $service)
    {
        if($shop->id !== $service->shop_id) abort(404);

        $this->authorize('view', [$service, $shop]);

        return new ServiceResource($service);
    }

    public function update(Shop $shop, Service $service, Request $request)
    {
        if($shop->id !== $service->shop_id) abort(404);

        $this->authorize('update', [$service, $shop]);

        $request->validate([
            'price' => 'integer',
            'time' => ['integer', new ServiceTime],
        ]);

        $service->update($request->only(['title', 'price', 'time']));

        return new ServiceResource($service);
    }

    public function destroy(Shop $shop, Service $service)
    {
        if($shop->id !== $service->shop_id) abort(404);

        $this->authorize('delete', [$service, $shop]);

        $service->delete();
    }

    public function serve(Shop $shop, Service $service, $action)
    {
        if($shop->id !== $service->shop_id) abort(404);

        // this authorization has a problem which owner could not select any service to serve.
        // FIXME set shop_id even for owner of shop
        // to this problem been solved
        // TODO should this policy be in ShopPolicy or ServicePolicy?
        $this->authorize('serveService', $shop);

        $user = auth()->user();
        $services = $user->services();

        switch ($action){
            case 'attach':
                $services->syncWithoutDetaching([$service->id]);
                break;

            case 'detach':
                $services->detach([$service->id]);
                break;
        }

        return ServiceResource::collection($services->get());
    }
}
