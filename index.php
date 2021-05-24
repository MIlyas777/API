<?php
include_once("koneksi.php");
$db = new koneksiDB();
$koneksi = $db ->getKoneksi();
$request = $_SERVER['REQUEST_METHOD'];
$uri_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri_segment = explode('/', $uri_path);

switch($request){
    case 'GET' :
        if(!empty($uri_segment[4])){
            $id = intval($uri_segment[4]);
                get mahasiswa($id);
        }else{
                get_mahasiswa();
        }
        break;
    default:
    header("HTTP/1.0 405 Method tidak terdaftar");
    break; 
    
    case 'POST':
        insert_mahasiswa();
        break;

    case 'PUT':
        $id = intval($uri_segment[4]);
        update_mahasiswa($id);
        break;

    case 'DELETE':
        $id = intval($)

}

function get_mahasiwa(){
    global $koneksi;
    $query="SELECT * FROM TB_mahasiswa";
    $respon = array();
    $result = mysqli_query($koneksi,$query);
    $i = 0;
    while($row=mysqli_fetch_array($result)){
        $respon[] = $row;
    }
    header('Content-Type: application/json');
    echo json_encode($respon);
}

function get_mahasiswa($id=""){
    global $koneksi;
    $query= "SELECT * FROM tb_mahasiswa";
    if(!empty($id)){
        $query .="WHERE id='".$id."' LIMIT 1";
    }
    $respon = array();
    $result = mysqli_query($koneksi,$query);
    $i = 0;
    if($result){
        $respon['kode'] = 1;
        $respon['status'] ="sukses";
        while($row=mysqli_fetch_array($result)){
            $respon['data'][$i]['NIM'] = $row['id'];
            $respon['data'][$i]['Nama'] = $row['nama'];
            $respon['data'][$i]['Angkatan'] = $row['email'];
            $respon['data'][$i]['Semester'] = $row['jabatan']
            $respon['data'][$i]['Ipk'] = $row['gaji'];
            $i++;
        }
    }else{
        $respon['kode'] = 0;
        $respon['status'] = "gagal";
    }
    header('Content-Type:application/json');
    echo json_encode($respon);
}

function insert_mahasiswa(){
    global $koneksi;
    $data = json_decode(file_get_contents('php://input'),true);
    $NIM= $data['NIM']
    $Nama = $data['Nama'];
    $Angkatan = $data['angkatan'];
    $Semester = $data['semester'];
    $IPK = $data['IPK'];

    $query = "INSERT INTO tb_mahasiswa set NIM='".$NIM."' ,Nama= ''.$Nama."',Angkatan= '".$Angkatan."',Semester='".
        $Semester."',IPK='".$IPK."';
    if(mysqli_query($koneksi,$query)){
        $respon =[
            'kode'=>1,
            'status' =>'Data Mahasiswa Berhasil Ditambah'
        ];
    }else{
        $respon = [
            'kode' =>0,
            'status' =>'Data Mahasiswa Gagal Ditambah'
        ];
    }
    header('Content-Type:application/json');
    echo json_encode($respon);
}

function update_Mahasiswa($id){
    global $koneksi;
    $data = json_decode(file_get_contents('php://input'),true);
    $NIM= $data['NIM']
    $Nama = $data['Nama'];
    $Angkatan = $data['angkatan'];
    $Semester = $data['semester'];
    $IPK = $data['IPK'];

    $query ="UPDATE tb_mahasiswa set NIM='".$NIM."' ,Nama= ''.$Nama."',Angkatan= '".$Angkatan."',Semester='".
    $Semester."',IPK='".$IPK." WHERE id+".$id;
    if(mysqli_query($koneksi, $query)){
        $respon = [
            'kode' => 1,
            'status' => 'Data Mahasiswa Berhasil Diupdate'
        ];
    }
    header('Content-Type:application/json');
    echo json_encode($respon);

    function delete_Mahasiswa($id){
        global $koneksi;
        $query = "DELETE FROM 'tb_mahasiswa' WHERE id='".$id."'";
        if(mysqli_query($koneksi,$query)){
            $respon = [
                'kode' => 1,
                'status' => 'Data mahasiswa Berhasil Dihapus'
            ];
        }else{
            $respon =[
                'kode' => 0,
                'status' => 'Data mahasiswa gagal Dihapus'                
            ]
        }
        header('Content-Type:application/json');
        echo json_encode($respon);        
    }
}