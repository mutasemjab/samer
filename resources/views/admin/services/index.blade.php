@extends('layouts.admin')
@section('title')
    {{ __('messages.services') }}
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title card_title_center"> {{ __('messages.services') }} </h3>       
            <a href="{{ route('services.create') }}" class="btn btn-sm btn-success"> {{ __('messages.New') }} {{
            __('messages.services') }}</a>
        </div>
        <div class="card-body">

            <div class="clearfix"></div>

            <div id="ajax_responce_serarchDiv" class="col-md-12">
                @can('services-table')
                    @if (@isset($data) && !@empty($data) && count($data) > 0)
                        <table id="example2" class="table table-bordered table-hover">
                            <thead class="custom_thead">
                                <th>{{ __('messages.Name') }}</th>
                                <th>{{ __('messages.price') }}</th>
                                <th></th>
                            </thead>
                            <tbody>
                                @foreach ($data as $info)
                                    <tr>
                                        <td>{{ $info->name }}</td>
                                        <td>{{ $info->price }}</td>
                                        <td>
                                            @can('services-edit')
                                                <a href="{{ route('services.edit', $info->id) }}" class="btn btn-sm btn-primary">
                                                    {{ __('messages.Edit') }}
                                                </a>
                                            @endcan
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <br>
                        {{ $data->links() }}
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


