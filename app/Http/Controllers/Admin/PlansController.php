<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\PlansService;
use App\View\Components\DateTimeView;
use App\View\Table\Table;
use Illuminate\Http\Request;

class PlansController extends Controller
{
    private PlansService $plansService;

    public function __construct(PlansService $plansService)
    {
        $this->plansService = $plansService;
    }

    public function index()
    {
        $plans = $this->plansService->get();

        $table = Table::create($plans)
//            ->addColumn('title')
//            ->addColumn('created_at', DateTimeView::class)
            ->addColumn('updated_at', fn($updated_at) => new DateTimeView($updated_at));

        return view('admin.table', compact('table'));
        return view('admin.plans.index', compact('plans'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        $this->plansService->delete($id);

        return back();
    }
}
