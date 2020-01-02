@extends('admin.layouts.admin')

@section('title',"Add an Quotation") 

@section('content')
<div class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
<form action="addquotation" method="post" enctype="multipart/form-data">
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
            <label for="pronounced">Status *</label>
            <select name="pronounced" class="form-control" >
                <option  disabled>Select one</option>
                <option  value="Mr">Mr</option>
                <option  value="Mr">Ms</option>
                <option  value="Mr">Miss</option>
            </select>
        </div>
        <div class="form-group">
            <label for="gender">Salutation *</label>
            <select name="gender" class="form-control" >
                <option  disabled>Select one</option>
                <option  value="Sir">Sir</option>
                <option  value="Madam">Madam </option>
            </select>
        </div>
        <div class="form-group">
            <label for="pa_name">Date *</label>
            <input type="text" class="form-control" name="date" id="date" placeholder="Date" value="{{ old('date') }}" required>
        </div>
        <div class="form-group">
            <label for="pa_name">Patient Name *</label>
            <input type="text" class="form-control" name="pa_name" id="pa_name" placeholder="Patient Name" value="{{ old('pa_name') }}" required>
        </div>
        <div class="form-group">
            <label for="address">Address *</label>
            <textarea class="form-control" name="address" id="address" cols="30" rows="10" placeholder="Patient Address" required>{{ old('address') }}</textarea>
          </div>
        
        <div class="form-group">
            <label for="service_name">Divice *</label>
            <input type="text" class="form-control" name="divice" id="divice" placeholder="Divice" value="{{ old('divice') }}" required>
        </div>
       
        <div class="form-group">
            <label for="service_name">Diagnosis *</label>
            <input type="text" class="form-control" name="diagnosis" id="diagnosis" placeholder="Diagnosis" value="{{ old('diagnosis') }}" required>
        </div>
       
        <div class="form-group">
            <label for="service_name">Prescription *</label>
            <input type="text" class="form-control" name="prescription" id="prescription" placeholder="Prescription" value="{{ old('prescription') }}" required>
        </div>
       
        <div class="form-group">
            <label for="service_name">Warranty *</label>
            <input type="text" class="form-control" name="warranty" id="warranty" placeholder="Warranty" value="{{ old('warranty') }}" required>
        </div>
        <div class="form-group">
            <label for="service_name">Delivery date *</label>
            <input type="text" class="form-control" name="delivery" id="delivery" placeholder="Delivery date" value="{{ old('delivery') }}" required>
        </div> <div class="form-group">
            <label for="service_name">Price *</label>
            <input type="text" class="form-control" name="price" id="price" placeholder="Price" value="{{ old('price') }}" required>
        </div> <div class="form-group">
            <label for="service_name">Price validity *</label>
            <input type="text" class="form-control" name="price_v" id="price_v" placeholder="Price validity " value="{{ old('price_v') }}" required>
        </div>
         <div class="form-group">
            <label for="service_name">Payment method *</label>
            <input type="text" class="form-control" name="payment_m" id="payment_m" placeholder="Payment method" value="{{ old('payment_m') }}" required>
        </div>
        
       
        
        <input type="hidden" id="empID" name="empID" value="{{$emp}}">
        <a href="{{ route('admin.quotation') }}" class="btn btn-danger">Cancel</a>
        <a href="{{ route('admin.quotation.add') }}" class="btn btn-primary">Clear</a>
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