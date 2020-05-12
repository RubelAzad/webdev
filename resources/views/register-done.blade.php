@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-warning">
                <div class="panel-heading">Verification Required</div>
                <div class="panel-body">
                    <div class="col-md-4 text-center">
                        <span class="glyphicon glyphicon-exclamation-sign text-center text-warning" aria-hidden="true" style="font-size: 5em"></span>
                    </div>
                    <div class="col-md-8">
                        <p>
                            You have successfully registered your account. But your account is currently not activated! You will receive an email with a activation link in it.
                        </p>
                        <p>Please click the activation link to complete the registration process.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
