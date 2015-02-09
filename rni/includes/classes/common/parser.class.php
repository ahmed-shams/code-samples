<?php
class template_parser {
	//protected $constant_array,$caption_array;
	//public $smarty_captions;
	var $constant_array;
	var $caption_array;
	var $smarty_captions;
	
	function __construct() {
		$this->constant_array=array();
		$this->caption_array=array();  
		$this->smarty_captions=array();
	}  
	
	function structure_template($file_string) {
		$buffer="";
		$file=fopen($file_string,"r");
		if($file) {
			while(!feof($file)) {
				$line=fgets($file);
				$result=preg_replace("/>\s*</",">\n<",$line);
				$buffer=$buffer.$result;
			}
			fclose($file);
		}
		$file=fopen($file_string,"w");
		fseek($file,0,SEEK_SET);
		fwrite($file,$buffer,strlen($buffer)); 
		fclose($file);
	}

	function create_resource_file($tpl_file) {
		$buffer=""; 
		$file_string=preg_replace("/.tpl/",".txt",$tpl_file);
		echo $file_string;
		$file=fopen($file_string,"w+");
		if($file) {
			for($i=0;$i<count($this->constant_array);$i++) {
				$write_string=$this->constant_array[$i].",".$this->caption_array[$i]."\r\n";
				fseek($file,0,SEEK_CUR);
				fwrite($file,$write_string,strlen($write_string));
			}
			fclose($file);
		} else {
			echo "Could not open file for write";
		}	
	}
	
	function parse_resource_file($tpl_file){	
		global $global_config;	
		$tmp_array=array();
		$file_string=preg_replace("/.tpl/",".txt",$tpl_file);
		$file=fopen($tpl_file,"r");
		if($file){		
			while(!feof($file)){
				$line=fgets($file);
					if(trim($line)!="") {
					$tmp_array=explode(',',trim($line));
					$smarty_var=substr($tmp_array[0],2,-1);
					if($_SESSION["LanguageCode"]==2) {
						$val=trim($tmp_array[2]);
					} else {
						$val=trim($tmp_array[1]);
					}		  
					$this->smarty_captions[$smarty_var]=$val;   
				}	 
			}
		}
	}
} 
?>