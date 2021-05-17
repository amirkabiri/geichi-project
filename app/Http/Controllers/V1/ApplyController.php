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

        return $shop->applies()->paginate();
    }

    public function store(Shop $shop, Request $request)
    {
        $this->authorize('create', [Apply::class, $shop]);

        $apply = $shop->applies()->save(new Apply([
            'barber_id' => auth()->id(),
            'description' => $request->description,
        ]));

        return new ApplyResource($apply);
    }

    public function show(Shop $shop, Apply $apply)
    {
        if($shop->id !== $apply->shop_id) abort(404);

        $this->authorize('view', [$apply, $shop]);

        return new ApplyResource($apply);
    }

    public function update(Shop $shop, Apply $apply, Request $request)
    {
        if($shop->id !== $apply->shop_id) abort(404);

        $this->authorize('update', [$apply, $shop]);

        $request->validate([
            'description' => 'required'
        ]);

        $apply->update($request->only('description'));

        return new ApplyResource($apply);
    }

    public function status(Shop $shop, Apply $apply, $status){
        if($shop->id !== $apply->shop_id) abort(404);
        if($apply->status !== 'pending') abort(404);

        $this->authorize('changeStatus', [$apply, $shop]);

        if($apply->barber->isEmployed()){
            $apply->status = 'denied';
            $apply->save();
            abort(404);
        }

        $apply->status = ['accept' => 'accepted', 'deny' => 'denied'][$status];
        $apply->save();
        return new ApplyResource($apply);
    }

    public function destroy(Shop $shop, Apply $apply)
    {
        if($shop->id !== $apply->shop_id) abort(404);

        $this->authorize('delete', [$apply, $shop]);

        $apply->delete();
    }
}
