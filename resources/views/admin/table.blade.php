@extends('admin.layouts.panel')

@section('content')
    <div class="row">
        <div class="col-12">
            {!! $table->render() !!}
        </div>
    </div>
@endsection
