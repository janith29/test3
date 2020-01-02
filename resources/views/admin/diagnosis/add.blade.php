@extends('admin.layouts.admin')

@section('title',"Add an Diagnosis", "Diagnosis") 

@section('content')
@php
                
use Illuminate\Support\Facades\DB;
use App\Models\Service;

$services = Service::all();
@endphp
<div class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
<form action="adddiagnosis" method="post" enctype="multipart/form-data">
{{ csrf_field() }}
        @if (!$errors->isEmpty())
            <div class="alert alert-danger" role="alert">
                {!! $errors->first() !!}
            </div>
        @endif
        <div class="form-group">
            <label for="pa_name">Patient name</label>
            <h2> {{$patient->name}}</h2>
         </div>
        
        <div class="form-group">
            <label for="pa_service">Service type *</label>
            <select name="pa_service" class="form-control" >
                <option  disabled>Select one</option>
                <option  disabled>*****Orthosis*****</option>
                @foreach($services as $service)
                @if (($service->type)==="orthosis")
                    <option value={{$service->serviceName."(orthosis)"}}>{{$service->serviceName}}</option>
                @endif
                @endforeach 
                <option  disabled>****Prosthesis****</option>
                @foreach($services as $service)
                @if (($service->type)==="prosthesis")
                    <option value={{$service->serviceName."(prosthesis)"}}>{{$service->serviceName}}</option>
                @endif
                @endforeach 
                <option  disabled>*****Cosmetic*****</option>
                @foreach($services as $service)
                @if (($service->type)==="cosmetic")
                    <option value={{$service->serviceName."(cosmetic)"}}>{{$service->serviceName}}</option>
                @endif
                @endforeach 
                <option  disabled>*****Children******</option>
                @foreach($services as $service)
                @if (($service->type)==="children")
                    <option value={{$service->serviceName."(children)"}}>{{$service->serviceName}}</option>
                @endif
                @endforeach 
                
            </select>
        </div>
        <div class="form-group">
            <label for="pa_dr">Consultant Doctor *</label>
            <input type="text" class="form-control" name="pa_dr" id="pa_dr" placeholder="'DR.Sunil'" value="{{ old('pa_dr') }}">
        </div>
        <div class="form-group">
            <label for="pa_height">Height(cm) *</label>
            <input type="text" class="form-control" name="pa_height" id="pa_height" placeholder="eg:-180cm" value="{{ old('pa_dr') }}">
        </div>
        <div class="form-group">
            <label for="pa_weight">Weight(kg) *</label>
            <input type="text" class="form-control" name="pa_weight" id="pa_weight" placeholder="eg:-60KG" value="{{ old('pa_dr') }}">
        </div>
        <div class="form-group">
            <label for="pa_sketch">Sketch *</label>
            <input type="file" class="form-control" name="pa_sketch" id="pa_sketch"  >
        </div>
        <div class="form-group">
          <label for="pa_discription">Description *</label>
          <textarea class="form-control" name="pa_discription" id="pa_discription" cols="30" rows="10" placeholder="Patient description">{{ old('pa_discription') }}</textarea>
        </div>
        <input type="hidden" id="name" name="name" value="{{$patient->name}}">
        <input type="hidden" id="ID" name="ID" value="{{$patient->id}}">
        <a href="{{ route('admin.diagnosis.index') }}" class="btn btn-danger">Cancel</a>
         <button type="submit" class="btn btn-primary">Add</button>
      </form>
    </div>
    </div>
@endsection

@section('styles')
    @parent
    {{ Html::style(mix('assets/admin/css/users/edit.css')) }}
@endsection

@section('scripts')
    @parent
    {{ Html::script(mix('assets/admin/js/users/edit.js')) }}
@endsection