<?php
header('Access-Control-Allow-Origin: *');

if ($_SERVER['REQUEST_METHOD'] != 'POST') { 
    header("Location: index.php" );
    die();
}

error_reporting(E_ALL && E_WARNING && E_NOTICE);
ini_set('display_errors', 0);
ini_set('log_errors', 1);

function vn_to_str ($str){
	$unicode = array(
		'a'=>'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ',
		'd'=>'đ',
		'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
		'i'=>'í|ì|ỉ|ĩ|ị',
		'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
		'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
		'y'=>'ý|ỳ|ỷ|ỹ|ỵ',
		'A'=>'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
		'D'=>'Đ',
		'E'=>'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
		'I'=>'Í|Ì|Ỉ|Ĩ|Ị',
		'O'=>'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
		'U'=>'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
		'Y'=>'Ý|Ỳ|Ỷ|Ỹ|Ỵ',
	);
	 
	foreach($unicode as $nonUnicode=>$uni){
	 
	$str = preg_replace("/($uni)/i", $nonUnicode, $str);
	 
	}
	//$str = str_replace(' ','_',$str);
	 
	return $str;
}

if (isset($_POST['school'])) {
	$school = $_POST['school'];
} else {
	$school = null;
}
if (isset($_POST['name'])) {
	$name = $_POST['name'];
} else {
	$name = null;
}
if (isset($_POST['phone'])) {
	$phone = $_POST['phone'];
} else {
	$phone = null;
}

$phoneTrimmed =  substr($phone, 1);

$curentConfig = json_decode(file_get_contents('config/config.json'), true);
$sheetID = $curentConfig['sheetID'];
$sheetNames = preg_split("/\r\n|\n|\r/", $curentConfig['sheetName']); 
foreach ($sheetNames as $sheetName) {
    $sheetName_arr = explode(":", $sheetName);
    $sheetName_value = $sheetName_arr[0];
    if (isset($sheetName_arr[1])) {
        $sheetName_display = $sheetName_arr[1];
    } else {
        $sheetName_display = $sheetName_arr[0];
    }
    if ($school == $sheetName_value) {
    	$param = '/values/'.urlencode($sheetName_value).'?key=';
    	break;
    }
}

$api_url = 'https://sheets.googleapis.com/v4/spreadsheets/';
$api_key = $curentConfig['ggToken'];
$json = file_get_contents($api_url.$sheetID.$param.$api_key);
$datas = json_decode($json)->values;

$result = [];
foreach ($datas as $index => $data) {
	if (strpos(strtolower(vn_to_str($data[(int)$curentConfig['studentname_col']-1])), strtolower(vn_to_str($name))) !== false && ($phone == $data[(int)$curentConfig['parentphone_col']-1] || $phoneTrimmed == $data[(int)$curentConfig['parentphone_col']-1])) {
		if (array_key_exists('show_index', $curentConfig)) {
			$result[0][0] = $index;
		} else {
			$result[0][0] = null;
		}
		
		$result[0][1] = $data[(int)$curentConfig['studentname_col']-1];
		$result[0][2] = $data[(int)$curentConfig['grade_col']-1];
		$result[0][3] = $data[(int)$curentConfig['parentname_col']-1];
		$result[0][4] = $data[(int)$curentConfig['parentphone_col']-1];
		$result[0][5] = $data[(int)$curentConfig['parentemail_col']-1];
		if (count($sheetNames) <=1 ) {
			$result[0][6] = null;
		} else {
			$result[0][6] = $sheetName_display;
		}
		$result[0][7] = $data[(int)$curentConfig['bib_col']-1];
		break;
	}
}
echo json_encode($result);

