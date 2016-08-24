<?php
$signature_options = signature_get_options('signature_wp');


$font1 = "'". $signature_options['body-font']['font-family'] ."', sans-serif";
if ($signature_options['body-font']['font-family'] == 'Designova Sinkin Sans Regular Premium') {
	$font1 = "'designova_ss_regular', sans-serif";
}
if ($signature_options['body-font']['font-family'] == 'Designova Halis Grotesque Regular Premium') {
	$font1 = "'designova_hgr_regular', sans-serif";
}

$font2 = "'". $signature_options['heading-font']['font-family'] ."', sans-serif";

$font3 = "'". $signature_options['alter-body-font']['font-family'] ."', sans-serif";
if ($signature_options['alter-body-font']['font-family'] == 'Designova Sinkin Sans Regular Premium') {
	$font3 = "'designova_ss_regular', sans-serif";
}
if ($signature_options['alter-body-font']['font-family'] == 'Designova Halis Grotesque Regular Premium') {
	$font3 = "'designova_hgr_regular', sans-serif";
}

$font4 = "'". $signature_options['alter-heading-font']['font-family'] ."', sans-serif";
if ($signature_options['alter-heading-font']['font-family'] == 'Designova Sinkin Sans Regular Premium') {
	$font4 = "'designova_ss_regular', sans-serif";
}
if ($signature_options['alter-heading-font']['font-family'] == 'Designova Halis Grotesque Regular Premium') {
	$font4 = "'designova_hgr_regular', sans-serif";
}

$font3xblack = "'". $signature_options['xblack-font']['font-family'] ."', sans-serif";
if ($signature_options['xblack-font']['font-family'] == 'Designova Sinkin Sans Extra Black Premium') {
	$font3xblack = "'designova_ss_xblack', sans-serif";
}

$font3black = "'". $signature_options['black-font']['font-family'] ."', sans-serif";
if ($signature_options['black-font']['font-family'] == 'Designova Sinkin Sans Black Premium') {
	$font3black = "'designova_ss_black', sans-serif";
}
if ($signature_options['black-font']['font-family'] == 'Designova Halis Grotesque Black Premium') {
	$font3black = "'designova_hgr_black', sans-serif";
}

$font3bold = "'". $signature_options['bold-font']['font-family'] ."', sans-serif";
if ($signature_options['bold-font']['font-family'] == 'Designova Sinkin Sans Bold Premium') {
	$font3bold = "'designova_ss_bold', sans-serif";
}
if ($signature_options['bold-font']['font-family'] == 'Designova Halis Grotesque Bold Premium') {
	$font3bold = "'designova_hgr_bold', sans-serif";
}

$font3light = "'". $signature_options['light-font']['font-family'] ."', sans-serif";
if ($signature_options['light-font']['font-family'] == 'Designova Sinkin Sans Light Premium') {
	$font3light = "'designova_ss_light', sans-serif";
}
if ($signature_options['light-font']['font-family'] == 'Designova Halis Grotesque Light Premium') {
	$font3light = "'designova_hgr_light', sans-serif";
}

$font3xlight = "'". $signature_options['xlight-font']['font-family'] ."', sans-serif";
if ($signature_options['xlight-font']['font-family'] == 'Designova Sinkin Sans Extra Light Premium') {
	$font3xlight = "'designova_ss_xlight', sans-serif";
}

$font3thin = "'". $signature_options['thin-font']['font-family'] ."', sans-serif";
if ($signature_options['thin-font']['font-family'] == 'Designova Sinkin Sans Thin Premium') {
	$font3thin = "'designova_ss_thin', sans-serif";
}
if ($signature_options['thin-font']['font-family'] == 'Designova Halis Grotesque Thin Premium') {
	$font3thin = "'designova_hgr_thin', sans-serif";
}



$signature_font_scheme = '
.font1, .font1{
	font-family: '.$font1.';
}
.font2{
	font-family: '.$font2.';
}
.font3{
	font-family: '.$font3.';
}
.font4{
	font-family: '.$font4.';
}
.font3xblack{
	font-family: '.$font3xblack.';
}
.font3black{
	font-family: '.$font3black.';
}
.font3bold{
	font-family: '.$font3bold.';
}
.font3light{
	font-family: '.$font3light.';
}
.font3xlight{
	font-family: '.$font3xlight.';
}
.font3thin{
	font-family: '.$font3thin.';
}
.btn-signature{
	font-family: '.$font1.';
}
.btn-signature-gozzo{
	font-family: '.$font1.' !important;
}
body, p{
	font-size: '.$signature_options['default-font-size'].'px;
    line-height: '.$signature_options['default-line-height'].'px;
    letter-spacing: '.$signature_options['default-letter-spacing'].'px;
	font-family: '.$font1.';
}
.woocommerce ul.products li.product h3{
	font-family: '.$font2.';
}
.woocommerce ul.products li.product .price {
	font-family: '.$font4.';
}';



?>