@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-success">
                <div class="panel-heading">Registration Completed</div>
                <div class="panel-body">
                    <div class="col-md-4 text-center">
                        <span class="glyphicon glyphicon-ok text-center text-success" aria-hidden="true" style="font-size: 5em"></span>
                    </div>
                    <div class="col-md-8">
                        <p>
                            You have successfully registered and verified your account.
                        </p>
                        <p>Now you can login to your account.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
