<?php

if( ! function_exists('login_since')){
    function login_since(){
        $user = auth()->user();
        return $user->last_login ? $user->last_login->diffForHumans(\Carbon\Carbon::now(), true) : '';
    }
}

if( ! function_exists('parseFloat') ){
    function parseFloat($value) {
        return floatval(preg_replace("/[^-0-9\.]/","",$value));
    }
}

if( ! function_exists('get_settings')){
    function get_settings($key, $default = ''){
        $settings = \App\Setting::where('key', $key)->get()->first();

        if($settings){
            return $settings->value ? $settings->value : $default;
        }

        return $default;
    }
}

if( ! function_exists('update_settings')){
    function update_settings($key, $value){
        $settings = \App\Setting::where('key', $key)->get()->first();
        if( ! $settings){
            $settings = new \App\Setting;
            $settings->key = $key;
        }
        $settings->value = $value;

        if($settings->save()){
            session(['config' => \App\Setting::all()->pluck('value', 'key')]); // re-initiate the config value
            return true;
        }

        return false;
    }
}

if( ! function_exists('get_roles_for_select') ){
    function get_roles_for_select(){
        $roles = \App\Role::active()->get();

        return $roles->pluck('name', 'id')->prepend('', '');
    }
}

if( ! function_exists('get_role_id_by_name')){
    function get_role_id_by_name($name){
        if(! $name){
            return false;
        }

        $role = \App\Role::where('name', '=', $name)->get()->first();

        return $role->id;
    }
}

if( ! function_exists('get_total_weight') ){
    function get_total_weight($packages){
        $total_weight = 0;
        foreach ($packages as $package){
            if($package->length && $package->width && $package->height){
                $total_weight = $total_weight + (($package->length * $package->width * $package->height)/get_settings('mass_divider', 5000));
            }else{
                $total_weight = $total_weight + $package->weight;
            }

        }

        return $total_weight;
    }
}

if( ! function_exists('get_transport_cost') ){
    function get_transport_cost($packages, $charge){
        $total = 0;
        foreach ($packages as $package){
            $total = $total + $package->quantity;
        }

        return $total * $charge;
    }
}

if( ! function_exists('get_employee_designations_for_select') ){
    function get_employee_designations_for_select(){
        $data = \App\EmployeeDesignation::active()->get();

        return $data->pluck('name', 'id')->prepend('','');
    }
}

if( ! function_exists('get_designation_id_by_name') ){
    function get_designation_id_by_name($name){
        $data = \App\EmployeeDesignation::where('name', $name)->get()->first();

        if($data){
            return $data->id;
        }

        return '';
    }
}

if( ! function_exists('get_role_id_by_designation_id') ){
    function get_role_id_by_designation_id($designation_id){
        $designation = \App\EmployeeDesignation::find($designation_id);

        $role = \App\Role::where('name', $designation->name)->get()->first();

        return $role->id;
    }
}

if( ! function_exists('save_file_to_db')){
    function save_file_to_db(\Illuminate\http\Request $request, $path = ''){

        $hash = md5(time().auth()->id());

        Storage::put($path.$hash, file_get_contents($request->file('file')->getRealPath()));

        $file = new \App\File;

        $file->hash = $hash;
        $file->name = $request->file->getClientOriginalName();
        $file->mimetype = Storage::mimeType($path.$hash);
        $file->extension = $request->file('file')->getClientOriginalExtension();
        $file->disk = config('filesystems.default');
        $file->path = $path;

        $file->uploaded_by = auth()->id();

        if($file->save()){
            return $file->hash;
        }
    }
}


if( ! function_exists('delete_file_by_hash_temp') ){
    function delete_file_by_hash_temp($hash = ''){
        if(! $hash){
            return false;
        }
        $file = \App\File::where('hash', '=', $hash)->get()->first();

        if($file->delete()){
            return true;
        }
    }
}

if( ! function_exists('delete_file_by_hash_final') ){
    function delete_file_by_hash_final($hash = ''){
        if(! $hash){
            return false;
        }
        $file = \App\File::where('hash', '=', $hash)->get()->first();

        Storage::disk($file->disk)->delete($file->path. $hash);

        if($file->forceDelete()){
            return true;
        }
    }
}

if( ! function_exists('get_status_id_by_code')){
    function get_status_id_by_code($code = ''){
        if($code){
            $staus = \App\Status::where('sort_code', $code)->get()->first();

            if($staus){
                return $staus->id;
            }
        }

        return false;
    }
}

if( ! function_exists('build_dhl_request')){
    function build_dhl_request(){
        $xml = '<?xml version="1.0" encoding="utf-8"?>
                <req:ShipmentRequest xmlns:req="http://www.dhl.com"
                xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.dhl.com
                ship-val-global-req.xsd" schemaVersion="6.0">
                <Request>
                    <ServiceHeader>
                    <MessageTime>2015-12-01T09:30:47-05:00</MessageTime>
                    <MessageReference>ShpVal_GL_withLabelImage_____</MessageReference>
                    <SiteID>CIMGBTest</SiteID>
                <Password>DLUntOcJma</Password>
                </ServiceHeader>
                </Request>
                <RequestedPickupTime>Y</RequestedPickupTime>
                <NewShipper>N</NewShipper>
                <LanguageCode>en</LanguageCode>
                <PiecesEnabled>Y</PiecesEnabled>
                <Billing>
                <ShipperAccountNumber>420003830</ShipperAccountNumber>
                <ShippingPaymentType>S</ShippingPaymentType>
                <BillingAccountNumber>420003830</BillingAccountNumber>
                </Billing>
                <Consignee>
                <CompanyName>DHL Test</CompanyName>
                <AddressLine>Add1</AddressLine>
                <AddressLine>Add2</AddressLine>
                <AddressLine>Add3</AddressLine>
                <City>London</City>
                <Division>London</Division>
                <DivisionCode></DivisionCode>
                <PostalCode>E78AW</PostalCode>
                <CountryCode>GB</CountryCode>
                <CountryName>United Kingdom</CountryName>
                <Contact>
                <PersonName>Mrs Receiver</PersonName>
                <PhoneNumber>07434563333</PhoneNumber>
                </Contact>
                </Consignee>
                <Dutiable>
                <DeclaredValue>100.00</DeclaredValue>
                <DeclaredCurrency>USD</DeclaredCurrency>
                </Dutiable>
                <Reference>
                <ReferenceID>ShipmentReference</ReferenceID>
                </Reference>
                <ShipmentDetails>
                <NumberOfPieces>1</NumberOfPieces>
                <Pieces>
                <Piece>
                <PieceID>1</PieceID>
                <PackageType>EE</PackageType>
                <Weight>19.78</Weight>
                <DimWeight>12.2</DimWeight>
                <Width>1</Width>
                <Height>2</Height>
                <Depth>3</Depth>
                </Piece>
                </Pieces>
                <Weight>19.78</Weight>
                <WeightUnit>K</WeightUnit>
                <GlobalProductCode>P</GlobalProductCode>
                <LocalProductCode>P</LocalProductCode>
                <Date>2015-12-01</Date>
                <Contents>For testing purpose only. Please do not ship</Contents>
                <DoorTo>DD</DoorTo>
                <DimensionUnit>C</DimensionUnit>
                <InsuredAmount>100.00</InsuredAmount>
                <PackageType>EE</PackageType>
                <IsDutiable>Y</IsDutiable>
                <CurrencyCode>USD</CurrencyCode>
                </ShipmentDetails>
                <Shipper>
                    <ShipperID>420003830</ShipperID>
                    <CompanyName>DHL Test</CompanyName>
                    <AddressLine>Add1</AddressLine>
                    <AddressLine>Add2</AddressLine>
                    <City>HOUNSLOW</City>
                    <Division>GB</Division>
                    <DivisionCode>GB</DivisionCode>
                    <PostalCode>TW4 W32A</PostalCode>
                    <CountryCode>GB</CountryCode>
                    <CountryName>United Kingdom</CountryName>
                    <Contact>
                        <PersonName>Mr Sender</PersonName>
                        <PhoneNumber>0123456789</PhoneNumber>
                    </Contact>
                </Shipper>
                <SpecialService>
                <SpecialServiceType>II</SpecialServiceType>
                </SpecialService>
                <LabelImageFormat>PDF</LabelImageFormat>
                <Label>
                <HideAccount>N</HideAccount>
                <LabelTemplate>6X4_PDF</LabelTemplate>
                <Logo>Y</Logo>
                <CustomerLogo>
                <LogoImage>Base64String</LogoImage>
                <LogoImageFormat>JPG</LogoImageFormat>
                </CustomerLogo>
                <Resolution>200</Resolution>
                </Label>
                </req:ShipmentRequest>';
        return $xml;
    }
}


if( ! function_exists('get_payment_methods')){
    function get_payment_methods(){
        $data = collect();
        $data->put('cash', 'Cash');
        $data->put('card', 'Card');
//        $data->put('online', 'Online');
        $data->put('bank', 'Bank');

        return $data;
    }
}

if( ! function_exists('process_payment_with_stripe')){
    function process_payment_with_stripe($stripe_token, $amount, $ref){
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        try{
            $charge = Stripe\Charge::create([
                'amount' => $amount * 100, // convert into coins/pens,
                'currency' => 'gbp',
                'description' => $ref,
                'source' => $stripe_token,
            ]);
        } catch (\Exception $e){
            return ['err' => true, 'msg' => $e->getMessage()];
        }

        if($charge && $charge->paid){
            return ['err' => false, 'charge_id' => $charge->id];
        }
    }
}
