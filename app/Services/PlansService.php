<?php


namespace App\Services;

use App\Models\Plan;

class PlansService extends Service
{
    public function get(){
        $this->authorize('viewAny', Plan::class);

        return paginate(new Plan);
    }

    public function create($data){
        $this->authorize('create', Plan::class);

        $rules = [
            'title' => 'required|min:3|max:255',
            'description' => 'required',
            'price' => 'required|numeric',
            'barbers_count' => 'required|numeric|min:0',
            'prepayment' => 'required|boolean',
        ];
        $this->validate($data, $rules);

        $data = collect($data)->only(array_keys($rules));
        return Plan::create($data);
    }

    public function find($plan){
        $plan = $this->findOrFail(Plan::class, $plan);

        $this->authorize('view', $plan);

        return $plan;
    }

    public function delete($plan){
        $plan = $this->findOrFail(Plan::class, $plan);

        $this->authorize('delete', $plan);

        $plan->delete();
    }
}
