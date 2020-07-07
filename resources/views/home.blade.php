@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>


                @if(Session::has('success'))
                    {{ Session::get('success') }}
                @endif

                @if(Session::has('error'))
                    {{ Session::get('error') }}
                @endif

                <form action="{{route('admin_file_upload')}}" method="post" enctype="multipart/form-data"  >
                    @csrf  
                    <div class="form-group">
                        <input type="file" name="file" class="form-control" >
                    </div>
                    @error('file')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror                             
                    <div class="form-group">
                        <input type="submit" value="Upload" class="btn btn-primary py-3 px-5">
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection
