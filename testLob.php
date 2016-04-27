<?php
require 'vendor/autoload.php';

$file = file_get_contents('front.html');
$back = file_get_contents('back.html');


$lob = new \Lob\Lob('test_e17cf73fd6ce6ee1c68e9e85bae7adf0b25');

$to_address = $lob->addresses()->create(array(
  'name'          => 'Lob.com',
  'address_line1' => '185 Berry Street',
  'address_line2' => 'Suite 1510',
  'address_city'  => 'San Francisco',
  'address_state' => 'CA',
  'address_zip'   => '94107',
  'phone'         => '555-555-5555'
));

$from_address = $lob->addresses()->create(array(
  'name'          => 'The Big House',
  'address_line1' => '1201 S Main St',
  'address_line2' => '',
  'address_city'  => 'Ann Arbor',
  'address_state' => 'MI',
  'address_zip'   => '48104',
  'email'         => 'goblue@umich.edu',
  'phone'         => '734-647-2583'
));

$postcard = $lob->postcards()->create(array(
  'to'          => $to_address['id'],
  'from'        => $from_address['id'],
  'front'       => $file,
  'back'        => $back,
 // 'message'     => 'This is the name!',
  'data[name]'  => 'Harry',
  'data[line1]'    => $to_address['address_line1'],
  'data[line2]'   => $to_address['address_line2'],
  'data[city]'   => $to_address['address_city'],
  'data[zip]'   => $to_address['address_zip'],
  'data[state]' => $to_address['address_state']
));

print_r($postcard);
?>