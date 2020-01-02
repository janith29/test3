@extends('admin.layouts.admin')

@section('title',"Add  finacial ") 

@section('content')
<div class="mainbox col-md-8 col-md-offset-3 col-sm-8 col-sm-offset-2">


<form action="addninvoice" method="post">
{{ csrf_field() }}
        <h3>Invoice</h3>
@if (!$errors->isEmpty())
<div class="alert alert-danger" role="alert">
{!! $errors->first() !!}
</div>
@endif

@if(Session::has('message'))
    <div class="alert alert-danger">{{ Session::get('message') }}</div>
@endif

@php
                
use Illuminate\Support\Facades\DB;
use App\Models\Service;

$services = Service::all();
@endphp
<div class="form-group">
    <label for="Service">Service type *</label>
    <select name="Service" class="form-control" >
        <option  disabled>Select one</option>
        <option  disabled>*****Orthosis*****</option>
        @foreach($services as $service)
        @if (($service->type)==="orthosis")
            <option value={{$service->id}}>{{$service->serviceName}}</option>
        @endif
        @endforeach 
        <option  disabled>****Prosthesis****</option>
        @foreach($services as $service)
        @if (($service->type)==="prosthesis")
            <option value={{$service->id}}>{{$service->serviceName}}</option>
        @endif
        @endforeach 
        <option  disabled>*****Cosmetic*****</option>
        @foreach($services as $service)
        @if (($service->type)==="cosmetic")
            <option value={{$service->id}}>{{$service->serviceName}}</option>
        @endif
        @endforeach 
        <option  disabled>*****Children******</option>
        @foreach($services as $service)
        @if (($service->type)==="children")
            <option value={{$service->id}}>{{$service->serviceName}}</option>
        @endif
        @endforeach 
        
    </select>
</div>
        <div class="form-group">
            <label for="oth_am">Amount</label>
            <input type="text" class="form-control" name="amount" id="amount" placeholder="eg:-6786000.00"value="{{ old('amount') }}" >
        </div>
        <input type="hidden" id="id" name="id" value="{{$patient->id}}">
        <a href="{{ route('admin.financial') }}" class="btn btn-danger">Cancel</a>
        <button type="submit" class="btn btn-primary">Add</button>
      </form>
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