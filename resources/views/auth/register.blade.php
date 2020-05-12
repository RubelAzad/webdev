@extends('nec.layouts.app')


@section('content')
    <div class="container" style="padding-top: 100px; margin-bottom: 100px">
        <div class="col-sm-12 col-md-5">
            <div class="well no-padding">

                <form role="form" method="POST" action="{{ route('register') }}" id="smart-form-register" class="form-horizontal">
                    {{ csrf_field() }}

                    <fieldset>
                        <legend style="padding-left: 20px">Register</legend>
                        <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                            <label class="col-sm-4 control-label">Full Name</label>
                            <div class="col-sm-6">
                                <input id="name" type="text" name="name" value="{{ old('name') }}" class="form-control" required autofocus>
                                @if ($errors->has('name'))
                                    <span class="help-block"><strong>{{ $errors->first('name') }}</strong></span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                            <label class="col-sm-4 control-label"> Email</label>
                            <div class="col-sm-6">
                                <input id="email" type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                                @if ($errors->has('email'))
                                    <span class="help-block"><strong>{{ $errors->first('email') }}</strong></span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                            <label class="col-sm-4 control-label">Password</label>
                            <div class="col-sm-6">
                                <input type="password" name="password" class="form-control" id="password"  required>
                                @if ($errors->has('password'))
                                    <span class="help-block"><strong>{{ $errors->first('password') }}</strong></span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-4 control-label">Confirm password</label>
                            <div class="col-sm-6">
                                <input id="password-confirm" class="form-control" type="password" name="password_confirmation" required>
                            </div>
                        </div>
                    </fieldset>

                    <fieldset>
                        <div class="form-group">
                            <div class="col-xs-offset-2 col-sm-offset-4">
                                <label class="checkbox">
                                    <input type="checkbox" name="terms" id="terms">
                                    <i></i>I agree with the <a href="#" data-toggle="modal" data-target="#myModal"> Terms and Conditions </a>
                                </label>
                            </div>
                        </div>
                    </fieldset>
                    <footer class="form-group">
                        <div class="col-sm-offset-4">
                            <button type="submit" class="btn btn-primary">Register</button>
                            <a href="{{url('login')}}" class="btn btn-danger">SIGN IN</a>
                        </div>
                    </footer>

                </form>

            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script type="text/javascript">
    runAllForms();

    // Model i agree button
    $("#i-agree").click(function(){
        $this=$("#terms");
        if($this.checked) {
            $('#myModal').modal('toggle');
        } else {
            $this.prop('checked', true);
            $('#myModal').modal('toggle');
        }
    });

    // Validation
    $(function() {
        // Validation
        $("#smart-form-register").validate({

            // Rules for form validation
            rules : {
                name : {
                    required : true
                },
                email : {
                    required : true,
                    email : true
                },
                password : {
                    required : true,
                    minlength : 3,
                    maxlength : 20
                },
                passwordConfirm : {
                    required : true,
                    minlength : 3,
                    maxlength : 20,
                    equalTo : '#password'
                },
                terms : {
                    required : true
                }
            },

            // Messages for form validation
            messages : {
                name : {
                    required : 'Please enter your full name'
                },
                email : {
                    required : 'Please enter your email address',
                    email : 'Please enter a VALID email address'
                },
                password : {
                    required : 'Please enter your password'
                },
                passwordConfirm : {
                    required : 'Please enter your password one more time',
                    equalTo : 'Please enter the same password as above'
                },
                terms : {
                    required : 'You must agree with Terms and Conditions'
                }
            },

            // Do not change code below
            errorPlacement : function(error, element) {
                error.insertAfter(element.parent());
            }
        });

    });
</script>
@endpush
