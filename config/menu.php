<?php

use App\Http\Menu;

$menus = collect();

//----------------- Dashboard ----------------------------------------

$dashboard = new Menu(1,'Dashboard', 'dashboard','','','fa fa-tachometer');
$menus->push($dashboard);

//----------------- Dashboard ----------------------------------------

$dashboard = new Menu(2,'Accounts', '','','', 'fa fa-linode');
$dashboard->children->push(new Menu(1, 'account', 'agent/account', '', ''));
$dashboard->children->push(new Menu(2, 'Agent Commission', 'agent/agent_commission', '', ''));
$menus->push($dashboard);

//----------------- External Enquiry ----------------------------------------

$enquiry = new Menu(2,'External Enquiries', '','','', 'fa fa-comment');
$enquiry->children->push(new Menu(1, 'View All Enquiry', 'enquiry', 'view_all_enquiry', 'Modules\Enquiry\Entities\Enquiry'));
$enquiry->children->push(new Menu(4, 'View Enquiries', 'enquiry/agent', 'view_enquiries_belongs_to_agent', 'Modules\Enquiry\Entities\Enquiry'));
$enquiry->children->push(new Menu(5, 'Subjects', 'enquiry/subject', 'view_enquiry_subject', 'Modules\Enquiry\Entities\EnquirySubject'));
$menus->push($enquiry);

//----------------- Internal Enquiry ----------------------------------------

$enquiry = new Menu(2,'Internal Enquiries', '','','', 'fa fa-comment');
$enquiry->children->push(new Menu(2, 'Create Enquiry', 'enquiry/create', '', ''));
$enquiry->children->push(new Menu(3, 'Inbound', 'enquiry/inbox', '', ''));
$enquiry->children->push(new Menu(3, 'Outbound', 'enquiry/sent', '', ''));
$menus->push($enquiry);


//------------------ Pickup ---------------------------------------

$pickup = new Menu(3,'Pickup', '','','', 'fa fa-truck');
$pickup->children->push(new Menu(1, 'Agent Request', 'pickup/agent'));
$pickup->children->push(new Menu(2, 'Customer Request', 'pickup'));
$pickup->children->push(new Menu(3, 'Request History', 'pickup/history'));
$menus->push($pickup);

//------------------- Warehouse --------------------------------------

$warehouse = new Menu(4,'Warehouse', '','manage_warehouse','Modules\Warehouse\Entities\Warehouse','fa fa-cubes');
$warehouse->children->push(new Menu(1, 'Entries', 'warehouse/entries', 'view_warehouse_entries','Modules\Warehouse\Entities\Warehouse'));
$warehouse->children->push(new Menu(2, 'House Air Way Bills', 'shipment/hawb', 'view_list_of_hawb','Modules\Shipment\Entities\Shipment'));
$warehouse->children->push(new Menu(3, 'Master Air Way Bills', 'shipment/mawb','view_list_of_mawb','Modules\Shipment\Entities\Shipment'));
$menus->push($warehouse);

//------------------- Shipment --------------------------------------

$shipment = new Menu(5,'Shipment', '','','','fa fa-ship');
$shipment->children->push(new Menu(1, 'Create Shipment', 'cargo/create', 'create_shipment','Modules\Cargo\Entities\CargoPost'));
$shipment->children->push(new Menu(2, 'Draft Shipment', 'cargo/draft','create_shipment','Modules\Cargo\Entities\CargoPost'));
$shipment->children->push(new Menu(2, 'Pickup Booking', 'cargo/pickup-booking','pickup_booking_warehouse','Modules\Cargo\Entities\CargoPost'));
$shipment->children->push(new Menu(2, 'Confirmed Booking', 'cargo/confirmed-booking','view_confirmed_booking_list','Modules\Cargo\Entities\CargoPost'));
$shipment->children->push(new Menu(2, 'Pickup Assigned', 'warehouse/pickup-assigned','view_confirmed_booking_list','Modules\Cargo\Entities\CargoPost'));
$shipment->children->push(new Menu(3, 'View Shipments', 'cargo'));

$menus->push($shipment);

//------------------- Network --------------------------------------

$location = new Menu(6,'Network', '','','','fa fa-sitemap');
$location->children->push(new Menu(1, 'Franchises', 'franchise', 'view_all_franchises','Modules\Franchise\Entities\Franchise'));
$location->children->push(new Menu(2, 'Agents', 'agent','view_all_agents','Modules\Agent\Entities\Agent'));
$location->children->push(new Menu(3, 'My Agents', 'franchise/agents','view_my_agents','Modules\Franchise\Entities\Franchise'));
$location->children->push(new Menu(4, 'My Agents Amount', 'franchise/agents_amount','view_my_agents_amount','Modules\Franchise\Entities\Franchise'));
$location->children->push(new Menu(5, 'Country Coverage', 'location/countries'));
$location->children->push(new Menu(6, 'Zones', 'zone','view_zone_list','Modules\Location\Entities\Zone'));
$menus->push($location);

//------------------- Service --------------------------------------

$service = new Menu(7,'Service', '','','','fa fa-list-ul');
$service->children->push(new Menu(1, 'Services', 'service', 'view_service_list','Modules\Service\Entities\Service'));
$service->children->push(new Menu(2, 'Valuable Items', 'service/valuable', 'view_valuables_list','Modules\Service\Entities\ServiceValuable'));
$service->children->push(new Menu(3, 'Providers', 'service/provider','view_service_provider_list','Modules\Service\Entities\ServiceProvider'));

$service->children->push(new Menu(4, 'Charge Setup', 'service/charge-setup'));
$service->children->push(new Menu(5, 'Charge Setup List', 'service/charge-setup-list'));

$service->children->push(new Menu(6, 'Sharing Setup', 'service/sharing-setup'));
$service->children->push(new Menu(7, 'Sharge Setup List', 'service/share-setup-list'));

$service->children->push(new Menu(8, 'Customer Commission', 'service/customer-commission'));
$service->children->push(new Menu(9, 'Customer Commission List', 'service/customer-commission-list'));

$service->children->push(new Menu(10, 'Commission Sharing', 'service/commission-sharing'));
$service->children->push(new Menu(10, 'Commission Sharing List', 'service/commission-sharing-list'));




$menus->push($service);

//-------------------- Website -------------------------------------

$website = new Menu(9,'Website', '','manage_website','Modules\Site\Entities\Site','fa fa-globe');
$website->children->push(new Menu(1, 'Pages', 'site/page', 'manage_pages', 'Modules\Site\Entities\Site'));
$website->children->push(new Menu(2, 'Feeds', 'site/feed', 'manage_feeds', 'Modules\Site\Entities\Site'));
$website->children->push(new Menu(3, 'News', 'site/news', 'manage_news', 'Modules\Site\Entities\Site'));
$website->children->push(new Menu(4, 'Partners', 'site/partner', 'manage_partners', 'Modules\Site\Entities\Site'));
$website->children->push(new Menu(5, 'Services', 'site/service','manage_services','Modules\Site\Entities\Site'));
$website->children->push(new Menu(6, 'Slide Show', 'site/slide-show','manage_slide_shows','Modules\Site\Entities\Site'));
$website->children->push(new Menu(7, 'Support', 'site/faq','manage_faqs','Modules\Site\Entities\Site'));
$website->children->push(new Menu(8, 'Contact Us', 'site/contact','manage_faqs','Modules\Site\Entities\Site'));
$website->children->push(new Menu(9, 'General Settings', 'site/settings','manage_website','Modules\Site\Entities\Site'));
$menus->push($website);

//-------------------- Administration -------------------------------------

$settings = new Menu(9,'Administration', '','','','fa fa-cogs');
$settings->children->push(new Menu(1, 'Configuration', 'settings', 'view_settings', 'App\Setting'));
$settings->children->push(new Menu(2, 'Users', 'user/all', 'see_all_users', 'App\User'));
$settings->children->push(new Menu(3, 'Roles', 'role/all', 'see_all_roles', 'App\Role'));
$settings->children->push(new Menu(4, 'Package Types', 'settings/package-type', 'manage_package_type', 'Modules\Cargo\Entities\CargoPackageType'));
$settings->children->push(new Menu(4, 'Statuses', 'settings/status', 'manage_status', 'App\Status'));
$settings->children->push(new Menu(5, 'List of Warehouse', 'warehouse'));


$menus->push($settings);

//---------------------------------------------------------

return [
    'all' => $menus,
];