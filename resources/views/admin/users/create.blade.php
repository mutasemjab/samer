@extends('layouts.admin')
@section('title')
{{ __('messages.users') }}
@endsection


@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title card_title_center"> {{ __('messages.Add_New') }}  {{ __('messages.users') }} </h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">


            <form action="{{ route('users.store') }}" method="post" enctype='multipart/form-data'>
                <div class="row">
                    @csrf

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>  {{ __('messages.Name') }} </label>
                            <input name="name" id="name" class="form-control" value="{{ old('name') }}">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>


              
                    <div class="col-md-6">
                        <div class="form-group">
                            <label> {{ __('messages.Password') }} </label>
                            <input name="password" id="password" class="form-control" value="{{ old('password') }}">
                            @error('password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label> {{ __('messages.Phone') }}</label>
                            <input name="phone" id="notes" class="form-control" value="{{ old('phone') }}">
                            @error('phone')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>


                    <div class="col-md-6">
                        <div class="form-group">
                            <label> {{ __('messages.Address') }}</label>
                            <input name="address" id="address" class="form-control" value="{{ old('address') }}">
                            @error('address')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                

                    <div class="col-md-6">
                        <div class="form-group">
                            <label> {{ __('messages.medical_history') }}</label>
                            <input name="medical_history" id="medical_history" class="form-control" value="{{ old('medical_history') }}">
                            @error('medical_history')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label> {{ __('messages.allergies') }}</label>
                            <input name="allergies" id="allergies" class="form-control" value="{{ old('allergies') }}">
                            @error('allergies')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>


                    <div class="col-md-6">
                        <div class="form-group">
                            <label> {{ __('messages.Activate') }}</label>
                            <select name="activate" id="activate" class="form-control">
                                <option value=""> select</option>
                                <option @if (old('activate') == 1 || old('activate') == '') selected="selected" @endif value="1"> activate
                                </option>
                                <option @if (old('activate') == 2 and old('activate') != '') selected="selected" @endif value="2">
                                    disactivate</option>
                            </select>
                            @error('activate')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>


                    <div class="col-md-12">
                        <div class="form-group text-center">
                            <button id="do_add_item_cardd" type="submit" class="btn btn-primary btn-sm"> {{ __('messages.Submit') }}</button>
                            <a href="{{ route('users.index') }}" class="btn btn-sm btn-danger">{{ __('messages.Cancel') }}</a>

                        </div>
                    </div>

                </div>
            </form>



        </div>




    </div>
    </div>
@endsection


@section('script')
    <script src="{{ asset('assets/admin/js/users.js') }}"></script>


<script>
    function previewImage() {
      var preview = document.getElementById('image-preview');
      var input = document.getElementById('Item_img');
      var file = input.files[0];
      if (file) {
      preview.style.display = "block";
      var reader = new FileReader();
      reader.onload = function() {
        preview.src = reader.result;
      }
      reader.readAsDataURL(file);
    }else{
        preview.style.display = "none";
    }
    }
</script>

@endsection
