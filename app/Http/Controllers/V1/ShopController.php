<?php

namespace App\Http\Controllers\V1;

use App\Http\Resources\ShopResource;
use App\Models\Invoice;
use App\Models\Plan;
use App\Models\Shop;
use App\Rules\LatLocation;
use App\Rules\LngLocation;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ShopController extends Controller
{
    public function index(Request $request){
        $this->authorize('viewAny', Shop::class);

        $request->validate([
            'threshold' => 'numeric',
            'lat' => 'numeric',
            'lng' => 'numeric',
            'limit' => 'int|min:1'
        ]);

        $limit = $request->get('limit', 20);
        $threshold = $request->get('threshold', 5);

        $shops = Shop::when($request->lat, function($q, $lat) use ($threshold) {
            return $q->where('lat', '<', $lat + $threshold)
                ->where('lat', '>', $lat - $threshold);
        })->when($request->lng, function($q, $lng) use ($threshold) {
            return $q->where('lng', '<', $lng + $threshold)
                ->where('lng', '>', $lng - $threshold);
        })->where('expire_at', '>', now())->limit($limit)->get();

        return ShopResource::collection($shops);
    }

    public function show(Shop $shop){
        $this->authorize('view', $shop);

        return new ShopResource($shop);
    }

    public function store(Request $request){
        $this->authorize('create', Shop::class);

        // todo create shop
        $request->validate([
            'plan_id' => 'required|exists:plans,id',
            'lat' => ['required', new LatLocation],
            'lng' => ['required', new LngLocation],
            'prepayment_amount' => 'numeric|max:5000',
        ]);

        $data = [
            'plan_id' => $request->plan_id,
            'owner_id' => auth()->id(),
            'lat' => $request->lat,
            'lng' => $request->lng,
        ];
        if($request->has('prepayment_amount')) $data['prepayment_amount'] = $request->prepayment_amount;

        $shop = Shop::create($data);
        $plan = Plan::find($request->plan_id);
        $shop->invoices()->save(
            new Invoice(['amount' => $plan->price])
        );

        return new ShopResource($shop);
    }

    public function update(Shop $shop, Request $request){
        $this->authorize('update', $shop);

        $request->validate([
            'prepayment_amount' => 'numeric|max:5000',
        ]);

        $shop->update($request->only('lat', 'lng', 'prepayment_amount'));

        return new ShopResource($shop);
    }

    public function destroy(Shop $shop){
        $this->authorize('delete', $shop);

        $shop->delete();
    }
}
