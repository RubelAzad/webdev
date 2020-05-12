@extends('nec.layouts.page')

@push('scripts')
    <script>
        let sticky = new Sticky('#contact-form');
    </script>
@endpush

@section('breadcrumb')
    <span>Contact us</span>
@endsection

@section('heading')
    Contact us
@endsection

@section('second-heading')
    Something about us from a little bit of different perspective
@endsection

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-sm-4" data-sticky-container>
                <div id="contact-form" class="panel panel-default">
                    <div class="panel-body">
                        <div class="title-section">
                            <h1>Contact Us</h1>
                            <p>{{get_settings('contact_page_message', 'Please fill the form with your enquiry and send it to us. We aim to answer within 24 hours of receiving your query!')}}</p>
                        </div>

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        {!! Form::open([]) !!}

                        <div class="form-group">
                            {!! htmlspecialchars_decode(Form::label('name', '<span class="star">*</span>Name', ['class'=> 'control-label'])) !!}
                            {!! Form::text('name', '', ['class' => 'form-control', 'required' => 'required']) !!}
                        </div>
                        <div class="form-group">
                            {!! htmlspecialchars_decode(Form::label('phone_number', '<span class="star">*</span>Phone Number', ['class'=> 'control-label'])) !!}
                            {!! Form::text('phone_number', '', ['class' => 'form-control', 'required' => 'required']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('email', 'Email', ['class'=> 'control-label']) !!}
                            {!! Form::text('email', '', ['class' => 'form-control']) !!}
                        </div>
                        <div class="form-group">
                            {!! htmlspecialchars_decode(Form::label('subject', '<span class="star">*</span>Subject', ['class'=> 'control-label'])) !!}
                            {!! Form::text('subject', '', ['class' => 'form-control', 'required' => 'required']) !!}
                        </div>
                        <div class="form-group">
                            {!! htmlspecialchars_decode(Form::label('message', '<span class="star">*</span>Message', ['class'=> 'control-label'])) !!}
                            {!! Form::textarea('message', '', ['class' => 'form-control', 'required' => 'required', 'rows' => '3']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::checkbox('send_copy', '', false, ['id' => 'send_copy']) !!}
                            {!! Form::label('send_copy', 'Send a copy to me', ['class'=> 'control-label']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('', '', ['class'=> 'control-label']) !!}
                            {!! Form::captcha(config('captcha.attributes')) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::submit('Send', ['class' => 'btn btn-primary']) !!}
                        </div>

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Agent location around the world</h3>
                    </div>
                    <div class="panel-body">
                        @if($countries->count())
                            @foreach($countries as $country)
                                @php($franchises = get_franchises_by_country($country->iso_3166_3))
                                @php($agents = get_agents_by_country($country->iso_3166_3))
                                @if($franchises->count() || $agents->count())
                                    <fieldset>
                                        <legend>{{$country->name}}</legend>
                                        {{--<h4>Franchises in {{$country->name}}</h4>--}}
                                        {{--@foreach($franchises as $franchise)--}}
                                            {{--<address>--}}
                                                {{--<strong>{{$franchise->name}}</strong>--}}
                                                {{--{!! $franchise->address_line_1 ? '<br>' . $franchise->address_line_1 : '' !!}--}}
                                                {{--{!! $franchise->address_line_2 ? '<br>' . $franchise->address_line_2 : '' !!}--}}
                                                {{--{!! $franchise->address_line_3 ? '<br>' . $franchise->address_line_3 : '' !!}--}}
                                                {{--{!! $franchise->county ? '<br>' . $franchise->county : '' !!}--}}
                                                {{--{!! $franchise->postcode ? '<br>' . $franchise->postcode : '' !!}--}}
                                                {{--<br>Contact Person: {{$franchise->contact_person}}--}}
                                                {{--<br>Contact Number: {{$franchise->phone_number}} {{$franchise->ev_phone_number}}--}}
                                                {{--<br>Email: {{$franchise->email}}--}}
                                                {{--<br>Type: Franchise--}}
                                            {{--</address>--}}
                                        {{--@endforeach--}}
                                        {{--<h4>Agents in {{$country->name}}</h4>--}}
                                        @foreach($agents as $agent)
                                            @if($agent->visible_website)
                                            <address style="color: #000000">
                                                <strong>{{$agent->name}}</strong>
                                                {!! $agent->address_line_1 ? '<br>' . $agent->address_line_1 : '' !!}
                                                {!! $agent->address_line_2 ? '<br>' . $agent->address_line_2 : '' !!}
                                                {!! $agent->address_line_3 ? '<br>' . $agent->address_line_3 : '' !!}
                                                {!! $agent->county ? '<br>' . $agent->county : '' !!}
                                                {!! $agent->postcode ? '<br>' . $agent->postcode : '' !!}
                                                <br>Contact Person: {{$agent->contact_person}}
                                                <br>Contact Number: {{$agent->phone_number}} or {{$agent->ev_phone_number}}
                                                <br>Email: {{$agent->email}}
                                            </address>
                                            @endif
                                        @endforeach
                                    </fieldset>
                                @endif
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection