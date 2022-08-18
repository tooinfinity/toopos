@extends('layouts.main')


@section('content')

<div class="col-md-12">
    <div class="card card-primary">
        <div class="card-header with-border">
            <h3 class="card-title">@lang('site.editmoderator')</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">

            <form action="{{ route('moderator.update', $moderator->id) }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                {{ method_field('put') }}
                @include('partials._errors')
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>@lang('site.firstname')</label>
                            <input type="text" name="first_name" id="" class="form-control"
                                value="{{ $moderator->first_name }}">
                        </div>
                        <div class="form-group">
                            <label>@lang('site.lastname')</label>
                            <input type="text" name="last_name" id="" class="form-control"
                                value="{{ $moderator->last_name }}">
                        </div>
                        <div class="form-group">
                            <label>@lang('site.email')</label>
                            <input type="email" name="email" id="" class="form-control" value="{{ $moderator->email }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="">@lang('site.photo')</label>
                        <div class="form-group">
                            <label>@lang('site.photo')</label>
                            <input type="file" name="image" id="" class="form-control image">
                        </div>
                        <div class="form-group">
                            <img src="{{ $moderator->image_path }}" style="width:200px;"
                                class="img-circle img-thumbnail img-preview" alt="" srcset="">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="card">
                                <div class="card-header d-flex p-0">
                                    <h3 class="card-title p-3">@lang('site.moderatorpermission')</h3>
                                    @php
                                    $models =
                                    ['users','categories','products','clients','providers','sales','purchases','spendings','moneybox','generalsetting'];
                                    $maps = ['create', 'read', 'update', 'delete'];
                                    @endphp
                                    <ul class="nav nav-pills ml-auto p-2">
                                        @foreach ($models as $index=>$model)
                                        <li class="nav-item {{ $index == 0 ? 'active' :'' }}"><a
                                                class="nav-link {{ $index == 0 ? 'active' :'' }}" href="{{ $model }}"
                                                data-toggle="tab">{{ $model }}</a></li>
                                        @endforeach
                                </div><!-- /.card-header -->
                                <div class="card-body">
                                    <div class="tab-content">
                                        <!-- /.tab-pane -->
                                        @foreach ($models as $index=>$model)
                                        <div class="tab-pane  {{ $index == 0 ? 'active' :'' }}" id="{{ $model }}">
                                            @foreach ($maps as $map)
                                            <label><input type="checkbox" name="permissions[]"
                                                    {{ $moderator->hasPermission($map .'_'. $model) ? 'checked' : '' }}
                                                    value="{{ $map .'_'. $model }}">
                                                {{ $map }}</label>
                                            @endforeach
                                        </div>
                                        @endforeach

                                    </div>
                                    <!-- /.tab-content -->
                                </div><!-- /.card-body -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer form-group">
                    <button type="submit" class="btn btn-success"><i class="fas fa-user-edit"></i> @lang('site.updatemoderator')</button>
                </div>
            </form>

        </div>
        <!-- /.card-body -->

    </div>
</div>


@stop
