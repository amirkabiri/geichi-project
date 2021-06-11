<div class="card">
    <div class="card-header">
        <h4>List</h4>
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

                    @foreach($columns as $column)
                        <th>{{ $column['head']($column['attribute']) }}</th>
                    @endforeach

                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($paginator as $entity)
                        <tr>
                            <th>
                                <div class="custom-checkbox custom-control">
                                    <input type="checkbox" data-checkboxes="mygroup" data-checkbox-role="dad" class="custom-control-input" id="checkbox-all">
                                    <label for="checkbox-all" class="custom-control-label">&nbsp;</label>
                                </div>
                            </th>
                            @foreach($columns as $column)
                                <th>{{ $column['body']($entity->updated_at)->render() }}</th>
                            @endforeach
                            <th>
                                <x-delete-button :action="route('admin.plans.destroy', ['plan' => $entity->id])"/>
                            </th>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <x-pagination-links :paginator="$paginator"/>
    </div>
</div>
