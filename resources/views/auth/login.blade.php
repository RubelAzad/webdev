@extends('nec.layouts.app')


@section('content')
    <div class="container" style="padding-top: 100px; margin-bottom: 100px">
        <div class="col-xs-12 col-sm-12 col-md-5 col-lg-4">
            <div class="well no-padding">
                <form action="{{ route('login') }}" role="form" method="POST" id="login-form" class="form-horizontal">
                    {{ csrf_field() }}

                    <fieldset>
                        <legend style="padding-left: 20px">Sign In</legend>
                        <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">E-mail</label>
                            <div class="col-md-6"> </i>
                                <input id="email" type="email" name="email" value="{{ old('email') }}" class="form-control" required autofocus>
                                @if ($errors->has('email'))
                                    <span class="help-block"><strong>{{ $errors->first('email') }}</strong></span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Password</label>
                            <div class="col-md-6">
                                <input id="password" type="password" name="password" required class="form-control">
                                @if ($errors->has('password'))
                                    <span class="help-block"><strong>{{ $errors->first('password') }}</strong></span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-offset-4" style="padding-left: 15px">
                                <button type="submit" class="btn btn-primary">Sign in</button>
                                <a href="{{url('password/reset')}}" class="btn btn-warning">Reset password</a>
                                <a href="{{url('register')}}" class="btn btn-danger">Create account</a>
                            </div>
                        </div>

                    </fieldset>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script type="text/javascript">
    runAllForms();

    $(function() {
        // Validation
        $("#login-form").validate({
            // Rules for form validation
            rules : {
                email : {
                    required : true,
                    email : true
                },
                password : {
                    required : true,
                    minlength : 3,
                    maxlength : 20
                }
            },

            // Messages for form validation
            messages : {
                email : {
                    required : 'Please enter your email address',
                    email : 'Please enter a VALID email address'
                },
                password : {
                    required : 'Please enter your password'
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
