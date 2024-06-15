<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
date_default_timezone_set('Asia/Jakarta');
error_reporting(E_ALL);
$my_server	= "localhost";
$my_user 	= "u256116329_katedral";
$my_password= "4PPYUD2Zk!";
$my_db		= "u256116329_katedral"; 	
$domain		= $_SERVER['HTTP_HOST']; 	
$now        = date('Y-m-d H:i:s');
$dtnow      = date('Y-m-d');
if($domain=='localhost')
{
	$domain_url = 'localhost'; 
}	
else
{
	$domain_url = $domain;
}
$base_url			= 'https://'.$domain_url.'/';
$base_assets	    = 'https://'.$domain_url.'/assets/';
$base_current       = 'https://'.$domain_url.''.$_SERVER['REQUEST_URI'];
//$base_cacheapi    = 'https://lederhaus-website.vercel.app/api/revalidate';
$base_secret        = 'cms-api-secret';
$con 		        = new mysqli($my_server,$my_user,$my_password,$my_db);
// Check connection
if ($con -> connect_errno) {
  echo "Failed to connect to MySQL: " . $con -> connect_error;
}
function sanitizeFileName($filename)
{
    $special_chars = array("?", "[", "]", "/", "\\", "=", "<", ">", ":", ";", ",", "'", "\"", "&", "$", "#", "*", "(", ")", "|", "~", "`", "!", "{", "}");
    $filename      = str_replace($special_chars, '', $filename);
    $filename      = preg_replace('/[\s-]+/', '-', $filename);
    $filename      = trim($filename, '.-_');
    return $filename;
}
function curlpost($url) 
{
    $ch = curl_init(); 
    // set url 
    curl_setopt($ch, CURLOPT_URL, $url);
    // return the transfer as a string 
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
    // $output contains the output string 
    $output = curl_exec($ch); 
    // tutup curl 
    curl_close($ch);      
    // mengembalikan hasil curl
    return $output;
}

function signaturecheck($filename,$secret)
{
    $filename   = $filename;
    $secret     = $secret;

    $headers    = getallheaders();
    $timestamp  = $headers['X-Timestamp'] ?? null;
    $signature  = $headers['X-Signature'] ?? null;

    if (!$timestamp || !$signature) {
        $ressig = "1";
    }

    // validate timestamp between server not greater than 5 minutes
    $timestamp              = intval($timestamp);
    $currentTimestamp       = time();
    $timestampDifference    = abs($timestamp - $currentTimestamp);
    if ($timestampDifference > 300) {
        $ressig = "2";
    }

    // validate signature
    $calculatedSignature = hash('sha256', sprintf('%s:%s:%s', $filename, $timestamp, $secret));
    if ($signature !== $calculatedSignature) {
        $ressig = "3";
    }
    else
    {
        $ressig = "0";
    } 
    return $ressig; 
}
function changemonth_en($m)
{
    if($m==1)
    {
        $month  = "January";
    }
    elseif($m==2)
    {
        $month  = "February";
    }
    elseif($m==3)
    {
        $month  = "March";
    }
    elseif($m==4)
    {
        $month  = "April";
    }
    elseif($m==5)
    {
        $month  = "May";
    }
    elseif($m==6)
    {
        $month  = "June";
    }
    elseif($m==7)
    {
        $month  = "July";
    }
    elseif($m==8)
    {
        $month  = "August";
    }
    elseif($m==9)
    {
        $month  = "September";
    }
    elseif($m==10)
    {
        $month  = "October";
    }
    elseif($m==11)
    {
        $month  = "November";
    }
    else
    {
        $month  = "December";
    }
    return $month;
}

function changemonth_id($m)
{
    if($m==1)
    {
        $month  = "Januari";
    }
    elseif($m==2)
    {
        $month  = "Februari";
    }
    elseif($m==3)
    {
        $month  = "Maret";
    }
    elseif($m==4)
    {
        $month  = "April";
    }
    elseif($m==5)
    {
        $month  = "Mei";
    }
    elseif($m==6)
    {
        $month  = "Juni";
    }
    elseif($m==7)
    {
        $month  = "Juli";
    }
    elseif($m==8)
    {
        $month  = "Agustus";
    }
    elseif($m==9)
    {
        $month  = "September";
    }
    elseif($m==10)
    {
        $month  = "Oktober";
    }
    elseif($m==11)
    {
        $month  = "November";
    }
    else
    {
        $month  = "Desember";
    }
    return $month;
}
?>