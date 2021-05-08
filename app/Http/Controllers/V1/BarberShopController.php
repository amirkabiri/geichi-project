<?php

namespace App\Http\Controllers\V1;

use App\Http\Resources\ShopResource;
use App\Models\Shop;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BarberShopController extends Controller
{
    public function index(Request $request){
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
        })->limit($limit)->get();

        return ShopResource::collection($shops);
    }

    public function show(Shop $shop){
        return new ShopResource($shop);
    }
}
