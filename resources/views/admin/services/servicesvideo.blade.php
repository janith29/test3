@extends('admin.layouts.admin')

@section('title',"Add an Service video for $services->serviceName ", "Diagnosis") 

@section('content')
<div class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
<form action="addvideoservice" method="post" enctype="multipart/form-data">
{{ csrf_field() }}

        @if (!$errors->isEmpty())
            <div class="alert alert-danger" role="alert">
                {!! $errors->first() !!}
            </div>
        @endif
        @php
    
        use Illuminate\Support\Facades\DB;
        $email=auth()->user()->email;
        
        $IDs = DB::table('employees')->where('email', $email)->get();
        $emp = 0;
                foreach($IDs as $ID)
                {
                    $emp=$ID->id;
                    
                }
        
        @endphp
        @if(Session::has('message'))
            <div class="alert alert-danger">{{ Session::get('message') }}</div>
        @endif
        <div class="form-group">
            <label for="service_name">Service Name *</label>
        <h3>{{$services->serviceName}}</h3>
        </div>

        <div class="form-group">
            <label for="embed">Video embed Name *</label>
            <input type="text" class="form-control" name="embed" id="embed" placeholder="link embed" value="{{ old('embed') }}" required>
        </div>
        
        <input type="hidden" id="empID" name="empID" value="{{$emp}}">
        <input type="hidden" id="serviceID" name="serviceID" value="{{$services->id}}">
        <a href="{{ route('admin.services') }}" class="btn btn-danger">Cancel</a>
        <a href="{{  route('admin.servicesphoto',[$services->id]) }}" class="btn btn-primary">Clear</a>
        <button type="submit" class="btn btn-primary">Add</button>
      </form>
    </div>
    <script>
             function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#blah')
                        .attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection

@section('styles')
    @parent
    {{ Html::style(mix('assets/admin/css/users/edit.css')) }}
@endsection

@section('scripts')
    @parent
    {{ Html::script(mix('assets/admin/js/users/edit.js')) }}
@endsection