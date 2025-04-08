@extends('layouts.admin')
@section('title')
    {{ __('messages.Edit') }} {{ __('messages.services') }}
@endsection



@section('contentheaderlink')
    <a href="{{ route('services.index') }}"> {{ __('messages.services') }} </a>
@endsection

@section('contentheaderactive')
    {{ __('messages.Edit') }}
@endsection


@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title card_title_center"> {{ __('messages.Edit') }} {{ __('messages.services') }} </h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">




                <form action="{{ route('services.update', $service['id']) }}" method="POST" enctype='multipart/form-data'>
                    <div class="row">
                    @csrf
                    @method('PUT')

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{ __('messages.Name') }}</label>
                            <input name="name" id="name" class="form-control"
                                value="{{ old('name', $service['name']) }}">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>


                    <div class="col-md-6">
                        <div class="form-group">
                            <label> {{ __('messages.price') }}</label>
                            <input name="price" id="price" class="form-control"
                                value="{{ old('price', $service['price']) }}" />
                            @error('price')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                   

                    <div class="col-md-12">
                        <div class="form-group text-center">
                            <button id="do_add_item_cardd" type="submit" class="btn btn-primary btn-sm"> {{ __('messages.Update') }}</button>
                            <a href="{{ route('services.index') }}" class="btn btn-sm btn-danger">{{ __('messages.Cancel') }}</a>

                        </div>
                    </div>


            </div>

            </form>

        </div>




    </div>
    </div>
@endsection



