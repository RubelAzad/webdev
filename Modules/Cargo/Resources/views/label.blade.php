@extends('layouts.invoice')

@section('content')
    <div class="container">
        <table class="table table-bordered" style="width: 35%">
            <tr>
                <td width="10%" class="text-right">From:</td>
                <td>
                    @if($sender = $post->sender)
                        {{$sender->name}}
                        <br>{{$sender->contact_person}} {{$sender->phone_number}}
                        <br>{{$sender->address_line_1}}
                        {!! $sender->address_line_2 ? '<br>' . $sender->address_line_2 : '' !!}
                        {!! $sender->address_line_3 ? '<br>' . $sender->address_line_3 : '' !!}
                        <br>{{$sender->postcode}} {{$sender->city}}
                        {!! $sender->county ? '<br>' . $sender->county : '' !!}
                        <br>{{get_country_name($sender->country)}}
                    @endif
                </td>
            </tr>
            <tr>
                <td width="10%" class="text-right">To:</td>
                <td>
                    @if($receiver = $post->receiver)
                        {{$receiver->name}}
                        <br>{{$receiver->contact_person}} {{$receiver->phone_number}}
                        <br>{{$receiver->address_line_1}}
                        {!! $receiver->address_line_2 ? '<br>' . $receiver->address_line_2 : '' !!}
                        {!! $receiver->address_line_3 ? '<br>' . $receiver->address_line_3 : '' !!}
                        <br>{{$receiver->postcode}} {{$receiver->city}}
                        {!! $receiver->county ? '<br>' . $receiver->county : '' !!}
                        <br>{{get_country_name($receiver->country)}}
                    @endif
                </td>
            </tr>
            <tr>
                <td colspan="2"><img src="{{$barcode}}"></td>
            </tr>
            <tr>
                <td class="center" colspan="2"><img src="{{$qrCode}}"></td>
            </tr>
        </table>

    </div>
@stop
