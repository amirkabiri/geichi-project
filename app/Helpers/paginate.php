<?php

function paginate($query){
    return $query
        ->when(request('order_by'), function ($q){
            return $q->orderBy(request('order_by'), request('order_type', 'ASC'));
        })
        ->when(request('with'), function($q){
            $relations = collect(explode(',', request('with')))
                ->map(fn($relation) => trim($relation))
                ->filter(fn($relation) => strlen($relation));

            return $q->with($relations->toArray());
        })
        ->paginate(request('per_page', 15));
}
