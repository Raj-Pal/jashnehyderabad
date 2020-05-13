<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	function pr($var){
		echo "<pre>";
		print_r($var);
		echo "</pre>";
	}

	
	

	function setPaginationConfig($base_url,$total_rows,$c_page,$per_page=20){
		$config['base_url'] = $base_url;
		$config['total_rows'] = $total_rows;
		$page = ($c_page) ? $c_page : 0;
		$config['per_page'] = $per_page;
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li><a>';
		$config['cur_tag_close'] = '</a></li>';
		$config['cur_page'] = $c_page;
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['first_link'] = '<<';
		$config['last_link'] = '>>';
		$config['cur_tag_open'] = '<li> <a class="pagiCurrent" >';
		$config['cur_tag_close'] = '</a></li>';
		return $config;
	}

	
	

	
	
	function imgResize($inFile, $outFile="", $width=100, $height=100){
		$CI =& get_instance();
		$config['image_library'] = 'gd2';
		$config['source_image'] = $inFile;
		$config['new_image'] = $outFile;
		$config['thumb_marker'] = '';
		$config['create_thumb'] = TRUE;
		$config['maintain_ratio'] = FALSE;
		$config['width'] = $width;
		$config['height'] = $height;
		$CI->image_lib->initialize($config);
		$CI->image_lib->resize();
    } 
	
	function randomPasword($length){
		$smallAlphabets = range('a','z');
		$capsAlphabets = range('A','Z');
		$numbers = range('1','9');
		$additional_characters = array('_','-');
		$final_array = array_merge($smallAlphabets,$numbers,$additional_characters,$capsAlphabets);
		$password = '';
		while($length--) {
		  $key = array_rand($final_array);
		  $password .= $final_array[$key];
		}
		return $password;
	}
	
	function create_unique_slug($string, $table)
	{		
		$CI =& get_instance();
		$slug = url_title($string);
		$slug = strtolower($slug);
		$i = 0;
		$params = array ();
		$params['slug'] = $slug;
		while ($CI->db->where($params)->get($table)->num_rows()) {
			if (!preg_match ('/-{1}[0-9]+$/', $slug )) {
				$slug .= '-' . ++$i;
			} else {
				$slug = preg_replace ('/[0-9]+$/', ++$i, $slug );
			}
			$params ['slug'] = $slug;
			}
		return $slug;
  	} 
  	
function dateDiffTime($date2=null,$date1=null){
$diff = abs(strtotime($date2) - strtotime($date1)); 

$years   = floor($diff / (365*60*60*24)); 
$months  = floor(($diff - $years * 365*60*60*24) / (30*60*60*24)); 
$days    = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));

$hours   = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24)/ (60*60)); 

$minuts  = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24 - $hours*60*60)/ 60); 

$seconds = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24 - $hours*60*60 - $minuts*60)); 

//printf("%d years, %d months, %d days, %d hours, %d minuts\n, %d seconds\n", $years, $months, $days, $hours, $minuts, $seconds);
	
	$str = '';
	if($years > 0){
		$str = $years.' Years , ';
	}
	if($months > 0){
		$str .= $months.' Months, ';
	}
	if($days > 0){
		$str .= $days.' days, ';
	}
	if($hours > 0){
		$str .= $hours.' hours, ';
	}
	if($minuts > 0){
		$str .= $minuts.' minuts, ';
	}
	if($seconds > 0){
		$str .= $seconds.' seconds ';
	}
	
	return $str;
}
  	
	