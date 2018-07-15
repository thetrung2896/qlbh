<?php
//Cấu hình cơ sở dữ liệu MYSQL
$db_type='mysql';
$db_charset='utf8';
$db_host='127.0.0.1';
$db_username='root';
$db_password='';
$database='ntt_bil';
//Kết nối với CSDL
$connect = mysqli_connect ("$db_host","$db_username","$db_password","$database") or die ("Vui lòng kiểm tra cấu hình cơ sở dữ liệu!");
	mysql_query("SET NAMES utf8");





?>