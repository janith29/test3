@extends('admin.layouts.admin')

@section('title',"Add  finacial ") 

@section('content')
<div class="mainbox col-md-8 col-md-offset-3 col-sm-8 col-sm-offset-2">


<form action="addother" method="post">
{{ csrf_field() }}
        <h3>other payment</h3>
@if (!$errors->isEmpty())
<div class="alert alert-danger" role="alert">
{!! $errors->first() !!}
</div>
@endif

@if(Session::has('message'))
    <div class="alert alert-danger">{{ Session::get('message') }}</div>
@endif
        <div class="form-group">
            <label for="oth_note">Note</label>
            <input type="text" class="form-control" name="oth_note" id="oth_note" placeholder="note" required>
        </div>
        <div class="form-group">
            <label for="oth_type">Payment type</label>
            <select name="oth_type" class="form-control" required>
                <option value="">Select one</option>
                <option value="income">Income</option>
                <option value="outcome">Outcome</option>
            </select>
        </div>
        <div class="form-group">
                <label for="oth_code">Payment Code</label>
                <select name="oth_code" class="form-control" required>
                    <option  value="">Select one</option>
                    <option  disabled>*****Income*****</option>
                    <option value="Do">Donation</option>
                    <option value="LOP">Loan pay</option>
                    <option value="ORI">Other</option>
                    <option  value="">*****Outcome*****</option>
                    <option value="WS">For work shop</option>
                    <option value="TR">Transporter</option>
                    <option value="CO"> Components </option>
                    <option value="PC"> Petty Cash </option>
                    <option value="BI"> Bill </option>
                    <option value="RE"> Rent </option>
                    <option value="POC"> P/O Charge </option>
                    <option value="TF"> Technivcal fee </option>
                    <option value="LO"> Loan </option>
                    <option value="OR"> Other </option>
                </select>
            </div>
        <div class="form-group">
            <label for="oth_am">Amount</label>
            <input type="text" class="form-control" name="oth_am" id="oth_am" placeholder="eg:-6786000.00" required>
        </div>
        
        <a href="{{ route('admin.financial') }}" class="btn btn-danger">Cancel</a>
        <a href="{{ route('admin.financial.add') }}" class="btn btn-primary">Clear</a>
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