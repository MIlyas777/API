<?php
class koneksiDB{
    function getKoneksi(){
        $host = "localhost";
        $username = "root";
        $pass = "";
        $db = "universitas";
        $konek = mysql_connect($host,$username,$pass,$db) or die ("koneksi gagal" mysqli_connect_error());
            (mysqli_connect_error());
        if(mysqli_connect_errno()){
            exit();
        }
        return $konek;
    }
}