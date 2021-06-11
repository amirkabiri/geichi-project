@extends('admin.layouts.panel')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Plans</h4>
                    <div class="card-header-form">
                        <form>
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search">
                                <div class="input-group-btn">
                                    <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>
                                    <div class="custom-checkbox custom-control">
                                        <input type="checkbox" data-checkboxes="mygroup" data-checkbox-role="dad" class="custom-control-input" id="checkbox-all">
                                        <label for="checkbox-all" class="custom-control-label">&nbsp;</label>
                                    </div>
                                </th>
                                <th>Title</th>
                                <th>Price</th>
                                <th>Barbers count</th>
                                <th>Prepayment</th>
                                <th>Created at</th>
                                <th>Updated at</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($plans as $plan)
                                <tr>
                                    <td class="p-0 text-center">
                                        <div class="custom-checkbox custom-control">
                                            <input type="checkbox" data-checkboxes="mygroup" class="custom-control-input" id="checkbox-4">
                                            <label for="checkbox-4" class="custom-control-label">&nbsp;</label>
                                        </div>
                                    </td>
                                    <td>{{ $plan->title }}</td>
                                    <td>{{ $plan->price }}</td>
                                    <td>{{ $plan->barbers_count }}</td>
                                    <td>
                                        <x-boolean-view :value="$plan->prepayment"/>
                                    </td>
                                    <td>
                                        <x-date-time-view :datetime="$plan->created_at"/>
                                    </td>
                                    <td>
                                        <x-date-time-view :datetime="$plan->updated_at"/>
                                    </td>
                                    <td>
                                        <x-delete-button :action="route('admin.plans.destroy', ['plan' => $plan->id])"/>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                    <x-pagination-links :paginator="$plans"/>
                </div>
            </div>
        </div>
    </div>
@endsection
