@extends('layouts.admin')
@section('title')
    {{ __('messages.users') }}
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title card_title_center"> {{ __('messages.users') }} </h3>       
            <a href="{{ route('users.create') }}" class="btn btn-sm btn-success"> {{ __('messages.New') }} {{
            __('messages.users') }}</a>
        </div>
        <div class="card-body">
            <form action="{{ route('users.index') }}" method="GET" class="mb-3">
                <div class="input-group">
                    <input type="text" name="search" class="form-control"
                           placeholder="{{ __('messages.Search by name or phone') }}" value="{{ request('search') }}">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit">{{ __('messages.Search') }}</button>
                    </div>
                </div>
            </form>
            <div class="clearfix"></div>

            <div id="ajax_responce_serarchDiv" class="col-md-12">
                @can('users-table')
                    @if (@isset($data) && !@empty($data) && count($data) > 0)
                        <table id="example2" class="table table-bordered table-hover">
                            <thead class="custom_thead">
                                <th>{{ __('messages.Name') }}</th>
                                <th>{{ __('messages.Phone') }}</th>
                                <th></th>
                            </thead>
                            <tbody>
                                @foreach ($data as $info)
                                    <tr>
                                        <td>{{ $info->name }}</td>
                                        <td>{{ $info->phone }}</td>
                                        <td>
                                            @can('users-edit')
                                                <a href="{{ route('users.edit', $info->id) }}" class="btn btn-sm btn-primary">
                                                    {{ __('messages.Edit') }}
                                                </a>
                                            @endcan
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <br>
                        {{ $data->appends(['search' => $searchQuery,])->links() }}
                    @else
                        <div class="alert alert-danger">
                            {{ __('messages.No_data') }}
                        </div>
                    @endif
                @endcan
            </div>
        </div>
    </div>
@endsection


