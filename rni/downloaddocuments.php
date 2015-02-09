<? 
	ob_start();
	session_start();

	require_once("includes/common.php");
	require_once("includes/modules/controller/class.MainController.php");
	$objController 	= new MainController();


	switch($_REQUEST["op"])	{
		case "Downloaddoc":
			//$filename = "resources/documents/org".$_REQUEST["docIdent"];			
			$rs_url = $objController->DownLoad_document($_REQUEST);
			list($url,$docOriginalName) = explode("||",$rs_url);
			break;
	}	
	$filename = $url;

	ob_end_clean();
	// required for IE, otherwise Content-disposition is ignored
	if(ini_get('zlib.output_compression'))
	  ini_set('zlib.output_compression', 'Off');
	
	// addition by Jorg Weske
	$file_extension = strtolower(substr(strrchr($filename,"."),1));
	
	
	if( $filename == "" ) 
	{
	  echo "ERROR: download file NOT SPECIFIED. USE force-download.php?file=filepath</body></html>";
	  exit;
	} elseif ( ! file_exists( $filename ) ) 
	{
	  echo "ERROR: File not found. USE force-download.php?file=filepath</body></html>";
	  exit;
	};
	switch( $file_extension )
	{
	  case "pdf": $ctype="application/pdf"; break;
	  case "exe": $ctype="application/octet-stream"; break;
	  case "zip": $ctype="application/zip"; break;
	  case "doc": $ctype="application/msword"; break;
	  case "xls": $ctype="application/vnd.ms-excel"; break;
	  case "ppt": $ctype="application/vnd.ms-powerpoint"; break;
	  case "gif": $ctype="image/gif"; break;
	  case "png": $ctype="image/png"; break;
	  case "jpeg":$ctype="image/jpg"; break;
	  case "jpg": $ctype="image/jpg"; break;
	  
	  case "mp3": $ctype="audio/mpeg"; break;
      case "wav": $ctype="audio/x-wav"; break;
      case "mpeg":
      case "mpg":
      case "mpe": $ctype="video/mpeg"; break;
      case "mov": $ctype="video/quicktime"; break;
      case "avi": $ctype="video/x-msvideo"; break;
	  default: $ctype="application/force-download";
	}
	header("Pragma: public"); // required
	header("Expires: 0");
	header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
	header("Cache-Control: private",false); // required for certain browsers 
	header("Content-Type: $ctype");
	// change, added quotes to allow spaces in filenames, by Rajkumar Singh
	header("Content-Disposition: attachment; filename=\"".$docOriginalName."\";" );
	header("Content-Transfer-Encoding: binary");
	header("Content-Length: ".filesize($filename));
	readfile("$filename");
	exit();


?>