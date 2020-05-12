@component('mail::message')
    We have received a new enquiry with following data:
    @component('mail::table')
        | Heading       | Information |
        | :------------ | :------------ |
        | Name | {{$enquiry->name}} |
        | Contact Number | {{$enquiry->phone_number}} |
        | Email | {{$enquiry->email}} |
        | Subject | {{$enquiry->subject}} |
        | Message | {{$enquiry->message}} |
        | Date and Time | {{$enquiry->created_at->format('d/m/Y : H:i')}} |
    @endcomponent
@endcomponent