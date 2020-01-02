@extends('admin.layouts.admin')
@section('title', "Question Management")
@section('content')    
    <div id="myModal" class="modal fade in" style="display: block; margin-top: 160px; margin-left: 100px;">
        <div class="modal-dialog modal-confirm">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="icon-box">
                        <i class="fa fa-trash"></i>
                    </div>				
                    <h4 class="modal-title">
                        Are you sure?
                    </h4>	
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <p>
                        {{ "Other Pay record with id ". $financialOtherPay->id . " will be permanently deleted!" }}
                    </p>
                </div>
                <div class="modal-footer">
                    <form action="destroy" method="post">
                        <a href="{{ URL::previous() }}" class="btn btn-primary">Cancel</a>
                        {{ csrf_field() }}
                        <input type="hidden" id="id" name="id" value="{{ $financialOtherPay->id }}">
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection