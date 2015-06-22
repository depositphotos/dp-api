<?php

include 'Moo.php';

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//												Put your code below
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

$url = 'http://api.depositphotos.com/';

// You may want to use more than one user alternately
$users = [
	0 => ['api_key' => '98ef********************************6570', 'login' => 'login1', 'passw' => 'passw1' ],
	1 =>  ['api_key' =>'c826********************************28f4', 'login' => 'login2', 'passw' => 'passw2' ],
];

$user = $users[0];

$moo = new Moo($url, $user['api_key'] );
echo "--- $url ---\n";
////////////////////////////////////////////////////////////////////////////////////////////////////
//
// LOGIN

// Many actions need logged user (session), but some of them -- no.
$ret = $moo->foo('login', [ 'dp_login_user' => $user['login'], 'dp_login_password' => $user['passw'] ], Moo::GET );
if ("success" === $ret['type'])
	$moo->setSessionId( $ret['sessionid']  );
else die(print_r( $ret['error']) );

// You can set debugging on at any time
// $moo->setDebug(1 );


////////////////////////////////////////////////////////////////////////////////////////////////////
//
// GENERIC

// print_r( $moo->foo('getInfo') );
// print_r( $moo->foo('help', ['dp_by_command' => 'getMediaIAP']) );



////////////////////////////////////////////////////////////////////////////////////////////////////
//
// SEARCH
// print_r( $moo->foo('search', ['dp_search_query' =>'woman' , 'dp_search_photo'=>1, 'dp_search_vector'=>0, 'dp_search_video'=>0, 'dp_search_limit'=> 1, 'dp_search_imagesize'=>'xxxl'  ])['count'] );
// print_r( $moo->foo('search', ['dp_search_query' =>'cat' , 'dp_search_limit' => 1, 'dp_search_offset' => 0,
// 	'dp_affiliate_id' => 2,
// 	'dp_last_update_time' => '1416427076'
// ]) );
// print_r( $moo->foo('search', ['dp_search_query' =>'triangiltion' , 'dp_search_correction' => 0]) );

// $res = $moo->foo('search', ['dp_search_query' =>'car', 'dp_search_limit'=>1 ] );
// echo $res['count'].PHP_EOL;
// $res = $moo->foo('search', ['dp_search_query' =>'cat', 'dp_search_limit'=>1, 'dp_search_nudity' => 0 ] );
// echo $res['count'].PHP_EOL;
// $res = $moo->foo('search', ['dp_search_query' =>'dog', 'dp_search_limit'=>1, 'dp_search_nudity' => 1 ] );
// echo $res['count'].PHP_EOL;

print_r( $moo->foo('getCategoriesList') );

// print_r( $moo->foo('getTagCloud') );

// getChangedItems
// foreach( $moo->foo('getChangedItems', ['datetime_to' => date("Y-m-d"), 'datetime_from' => date("Y-m")."-01", 'dp_search_limit' => 10])['result'] as $item) {
// 	echo strtotime(date("Y-m")."-01").' -- '. strtotime($item['updated']).(strtotime(date("Y-m")."-01") < strtotime($item['updated']) ? 'Y':'N').PHP_EOL;
// }

// print_r( $moo->foo('getSeries', ["dp_series" => 'landingVectors']) );



////////////////////////////////////////////////////////////////////////////////////////////////////
//
// LIGHTBOX

// print_r( $moo->foo('getLightbox', ['dp_lightbox_id' => 0000000, 'dp_limit'=> 2 ,'dp_offset'=>0]) );
// RM ALL LIGHTBOXES
// $res = $moo->foo('getLightboxes', ['dp_limit' => 10, 'dp_offset' => 0] );
// if (!empty($res['lightboxes'])) foreach ($res['lightboxes'] as $lb ) {
// 	echo '--- lightox '.$lb['lightboxId'].'---'.PHP_EOL;
// 	print_r( $moo->foo('removeLightbox' , ['dp_lightbox_id' => $lb['lightboxId']]) );
// }

// print_r( $moo->foo('getLightboxes', ['dp_limit' => 10, 'dp_offset' => 0, 'dp_thumb_size' => 'thumb', 'dp_thumb_limit' => 3]) );
// print_r( $moo->foo('createLightbox', ['dp_lightbox_title' => 'LB - '.date('Y-m-d H:i:s')]) );
// print_r( $moo->foo('createLightbox', [
// 		"dp_lightbox_public"=>1,
// 		"dp_lightbox_title"=>"testb3c7fdf9",
// 		"dp_lightbox_client"=>"test client",
// 		"dp_lightbox_description"=>"test description",
// 		"dp_lightbox_keywords"=>"test",
// 		"dp_lightbox_project"=>"test",
// 		]) );
// print_r( $moo->foo('getLightboxes', ['dp_limit' => 10, 'dp_offset' => 0]) );
// print_r( $moo->foo('createLightbox', [
// 	'dp_lightbox_public' => 'yes',
// 	'dp_lightbox_title' => 'NameName',
// 	'dp_lightbox_client' => 'NameName',
// 	'dp_lightbox_description' => 'Tests lightboxxxxx',
// 	'dp_lightbox_keywords' => "12345678879659,634763568435",
// 	'dp_lightbox_project' => 'Name.Name',
// 	]) );
// print_r( $moo->foo('updateLightbox', ['dp_lightbox_id' => 00000, 'dp_lightbox_project' => 'LB-project-{[<'.date('Y-m-d H:i:s').'>]}']) );
// print_r( $moo->foo('getLightboxes', ['dp_thumb_size' => 'thumb', 'dp_limit' => 1, 'dp_offset' => 0]) );
// print_r( $moo->foo('getLightboxes', ['dp_limit' => 10, 'dp_offset' => 0]) );
// print_r( $moo->foo('addToLightbox', ["dp_lightbox_id" => 0000000, "dp_media_id" => 00000 ]) );



////////////////////////////////////////////////////////////////////////////////////////////////////
//
// GETMEDIA

// print_r( $moo->foo('getMediaDataAsUser', ['dp_media_id' => 00000]) );
// print_r( $moo->foo('getMediaData', ['dp_media_id'=>00000]) );
// print_r( $moo->foo('getMediaData', ['dp_media_id'=>00000]) );
// print_r( $moo->foo('getMediaData', ['dp_media_id' => 00000, 'dp_lang'=>'ru']) );
// print_r( $moo->foo('getMediaData', ['dp_media_id' => 00000]) );
// print_r( $moo->foo('getMedia', ['dp_media_id' => 00000, 'dp_media_license' => 'standard', 'dp_media_option' => 'xs']) );
// print_r( $moo->foo('getMedia', ['dp_media_id' => 00000, 'dp_media_option' => 'l', 'dp_media_license' => 'standard', /*'dp_force_purchase_method' => "subscription"*/]) );



////////////////////////////////////////////////////////////////////////////////
////
//// WIDGET
// print_r( $moo->foo('getWidget', ['dp_limit'=>100, 'dp_offset' => 200 ]) );
// print_r( $moo->foo('getWidgetTranslate', ['dp_lang' => 'gr']) );



////////////////////////////////////////////////////////////////////////////////
////
//// ITEM

// print_r( $moo->foo('getUploadItemUrl') );
// print_r( $moo->foo('getUploadItemUrl', ['dp_subaccount_id' => 0000000]) );
// print_r( $moo->foo('deleteItems', ['dp_item_id' => [00000000, 0000000], 'dp_check_mobile' => 'no'], moo::POST) );
// print_r( $moo->foo('updateItems', ['dp_item_id' => [
// 	0000000=>['status'=>'approved'],
// 	0000000=>['status'=>'approved']
// 	]], Moo::POST) ); //  'dp_subaccount_id' => 0000000
// print_r( $moo->foo('updateItems', ['dp_item_id'=>[22642286=> ['title'=> str_repeat('s', 201)]]], Moo::POST) );




////////////////////////////////////////////////////////////////////////////////
////
//// SUBACCOUNT

// print_r( $moo->foo('getSubscriptions', ['dp_subaccount_id' => 0000000]) );

///// createSubaccount/////
// $name = 'NameNameName';
// print_r( $moo->foo('createSubaccount', ['dp_subaccount_email' => $name.'@fcweou.esd', 'dp_subaccount_fname' => $name,
//	'dp_subaccount_username' => $name, 'dp_subaccount_password' => $name, 'dp_send_email' => 0
// ]) );

// $zz ='ololo'.rand(1000, 9999 );
// print_r( $moo->foo('updateSubaccount', ['dp_subaccount_id' => 0000000,
// 	'dp_subaccount_company' => 'qwer'.$zz,
// 	'dp_subaccount_fname'=>'ololoshkin'.$zz,
// 	'dp_subaccount_lname'=>'ololo'.$zz,
// 	'dp_subaccount_email' => 'mail'.$zz.'@asdf.com'
// ]) );
// print_r( $moo->foo('getSubaccountData', ['dp_subaccount_id' => 0000000]) ); //dp_subaccount_company' => 'qwer1234!@#$'

// print_r( $moo->foo('getSubscriptionOffers' ) );




////////////////////////////////////////////////////////////////////////////////
////
//// PURCHASE

// print_r( $moo->foo('reDownload', ['dp_license_id' => 0000000]) );
// print_r( $moo->foo('getPurchases', ['dp_limit'=>2, 'dp_offset' => 0 ]) );
// print_r( $moo->foo('getLicense', ['dp_license_id' => 20687196, 'dp_lang'=>'en']) );



////////////////////////////////////////////////////////////////////////////////
////
//// USER

//////// getUpdatedSellerTransactions //////////
//print_r( $moo->foo('getUpdatedSellerTransactions') );
//print_r( $moo->foo('getUpdatedSellerTransactions', ['dp_include_subaccounts' => 'all', 'dp_limit' => 30, 'dp_status' => 'blocked, asdf']) );
// print_r( $moo->foo('getUpdatedSellerTransactions', ['dp_include_subaccounts' => '000000']) );
//print_r( $moo->foo('getUpdatedSellerTransactions', ['dp_include_subaccounts' => '000000']) );

// print_r( $moo->foo('availableFunds', ['dp_datetime_format' => 'unix']) );

// $u = 'dgnbiwrusthyhyhyhdfg@efjvoeijqerc.com';
// $ret = $moo->foo('registerNewUser', ['dp_regist_user' => $u, 'dp_regist_email' => $u, 'dp_regist_password' => $u] );
// print_r( $ret );
// $ret = $moo->foo('loginAsUser', [ 'dp_login_user' => $u, 'dp_login_password' => $u]  );
// if ("success" === $ret['type']) $moo->setSessionId( $ret['sessionid']  );
// else die(print_r( $ret['error']) );
// print_r( $moo->foo('getUserData') );

// print_r( $moo->foo('getSubscribeLink') );
// print_r( $moo->foo('getInvoices', ["dp_offset" => 0, "dp_limit" => 5]) );




////////////////////////////////////////////////////////////////////////////////
////
//// SOCIAL

// print_r( $moo->foo('getAuthAppInfo', ['dp_social_name'=> 'facebook']) );

//// Soacial facebook login ////
// $ret = $moo->foo('loginSocial', [
// 	'dp_social_name'=> 'facebook',
// 	'dp_access_token' => 'CAA..........',
// 	] );
// print_r( $ret );
// if ('failure' !== $ret['type']) {
// 	$moo->setSessionId($ret['sessionid'] );
// 	print_r( $moo->foo('getUserData') );
// }



////////////////////////////////////////////////////////////////////////////////
////
//// LEGALS

// print_r( $moo->foo('getLegalsList', []) );
// print_r( $moo->foo('getLegalDocument', ['dp_legal_name'=> 'dmca']) );
