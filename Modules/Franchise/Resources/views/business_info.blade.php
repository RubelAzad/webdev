<dl class="dl-horizontal">
    <dt>Company Name</dt><dd>{{$franchise->name}}</dd>
    <dt>Address Line 1</dt><dd>{{$franchise->address_line_1}}</dd>
    <dt>Address Line 2</dt><dd>{{$franchise->address_line_2}}</dd>
    <dt>Address Line 3</dt><dd>{{$franchise->address_line_3}}</dd>
    <dt>City</dt><dd>{{$franchise->city}}</dd>
    <dt>County/Province</dt><dd>{{$franchise->county}}</dd>
    <dt>Postcode</dt><dd>{{$franchise->postcode}}</dd>
    <dt>Country</dt><dd>{{get_country_name($franchise->country)}}</dd>
    <dt>CH Number</dt><dd>{{$franchise->ch_number}}</dd>
    <dt>VAT Number</dt><dd>{{$franchise->vat_number}}</dd>
</dl>