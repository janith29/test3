@extends('admin.layouts.admin')

@section('title',"Store", "Store") 

@section('content')
<div class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
<form action="updatequotation" method="post">
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
        <label for="pa_name">Date *</label>
        <input type="text" class="form-control" name="date" id="date" placeholder="Date" value="{{  $Quotation->date  }}" required>
    </div>
    <div class="form-group">
        <label for="pa_name">Patient Name *</label>
        <input type="text" class="form-control" name="pa_name" id="pa_name" placeholder="Patient Name" value="{{ $Quotation->name }}" required>
    </div>
    <div class="form-group">
        <label for="address">Address *</label>
        <textarea class="form-control" name="address" id="address" cols="30" rows="10" placeholder="Patient Address" required>{{  $Quotation->address }}</textarea>
      </div>
    
    <div class="form-group">
        <label for="service_name">Divice *</label>
        <input type="text" class="form-control" name="divice" id="divice" placeholder="Divice" value="{{ $Quotation->divice}}" required>
    </div>
   
    <div class="form-group">
        <label for="service_name">Diagnosis *</label>
        <input type="text" class="form-control" name="diagnosis" id="diagnosis" placeholder="Diagnosis" value="{{ $Quotation->diagnosis }}" required>
    </div>
   
    <div class="form-group">
        <label for="service_name">Prescription *</label>
        <input type="text" class="form-control" name="prescription" id="prescription" placeholder="Prescription" value="{{ $Quotation->prescription }}" required>
    </div>
   
    <div class="form-group">
        <label for="service_name">Warranty *</label>
        <input type="text" class="form-control" name="warranty" id="warranty" placeholder="Warranty" value="{{ $Quotation->warranty }}" required>
    </div>
    <div class="form-group">
        <label for="service_name">Delivery date *</label>
        <input type="text" class="form-control" name="delivery" id="delivery" placeholder="Delivery date" value="{{ $Quotation->deliverydate }}" required>
    </div> <div class="form-group">
        <label for="service_name">Price *</label>
        <input type="text" class="form-control" name="price" id="price" placeholder="Price" value="{{ $Quotation->price }}" required>
    </div> <div class="form-group">
        <label for="service_name">Price validity *</label>
        <input type="text" class="form-control" name="price_v" id="price_v" placeholder="Price validity " value="{{ $Quotation->pricevalidity }}" required>
    </div>
     <div class="form-group">
        <label for="service_name">Payment method *</label>
        <input type="text" class="form-control" name="payment_m" id="payment_m" placeholder="Payment method" value="{{ $Quotation->paymentmethod  }}" required>
    </div>
    
        <input type="hidden" id="id" name="id" value="{{ $Quotation->id }}">
        <input type="hidden" id="uid" name="uid" value="{{$emp}}">
        <a href="{{ route('admin.services') }}" class="btn btn-danger">Cancel</a>
        <button type="submit" class="btn btn-primary">Update</button>
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