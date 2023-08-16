<?php

function setHeader($excel_file_name){
	header("Content-type: application/octet-stream");
	header("Content-Disposition: attachment; filename=$excel_file_name");
	session_cache_limiter("must-revalidate"); 
//	header("Pragma: no-cache");
	header("Expires: 0");
}

/*	Excel uses UTF-16LE + BOM as default Unicode encoding
	This funcion will do the conversion to UTF-16LE and 
	prepend the UTF-16LE-BOM "\xFF\xFE".
*/
function setEncodding($output){
// Convert to UTF-16LE
$output = mb_convert_encoding($output, 'UTF-16LE', 'UTF-8'); 

// Prepend BOM
$output = "\xFF\xFE" . $output;

return $output;	
}
// Functions END


if(isset($_POST['Excel'])){ 
$filename = 'Report-'.date('d-m-Y');
	$body = $_POST['body'];
	$body = setEncodding($body);
   setHeader($filename . ".xls");
    echo $body;
}
?>

