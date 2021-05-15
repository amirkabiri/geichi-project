<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\ApplyResource;
use App\Models\Apply;
use App\Models\Shop;
use Illuminate\Http\Request;

class ApplyController extends Controller
{
    public function index(Shop $shop)
    {
        $this->authorize('viewAny', [Apply::class, $shop]);

        return Apply::paginate();
    }

    public function store(Shop $shop, Request $request)
    {
        $this->authorize('create', [Apply::class, $shop]);

        $apply = Apply::create([
            'barber_id' => auth()->id(),
            'shop_id' => $shop->id,
            'description' => $request->description,
        ]);

        return new ApplyResource($apply);
    }

    public function show(Shop $shop, Apply $apply)
    {
        $this->authorize('view', [$apply, $shop]);

        return new ApplyResource($apply);
    }

    public function update(Shop $shop, Apply $apply, Request $request)
    {
        $this->authorize('update', [$apply, $shop]);

    }

    public function destroy(Shop $shop, Apply $apply)
    {
        $this->authorize('delete', [$apply, $shop]);

    }
}
