<?php

use Carbon\Carbon;

//define the directory seperator constatnts...
DEFINE('DS', DIRECTORY_SEPARATOR); 

//the print to screen function....
function pr($ar, $bool=false){    
    echo '<pre>';
    print_r($ar);
    echo '</pre>';
    if($bool){
        exit;
    }
}


function rdate($dt, $type){
	switch($type){
		case 'long':
			$dt = date("D, M jS, Y", strtotime($dt)); //, 'F jS, Y');
		break;
		case 'short':
			$dt = date("M d, y", strtotime($dt)); //, 'F jS, Y');
		break;
		case 'medium':
			$dt = date("D - M d, Y", strtotime($dt)); //, 'F jS, Y');
		break;
		case 'full':
			$dt = date("D, M jS, Y", strtotime($dt)); //, 'F jS, Y');
		default:
			$dt = date("F jS, Y", strtotime($dt)); //, 'F jS, Y');
	}

	if (strpos($dt, '70') !== false) {
	    return '-- -- --';
	}else{
		return $dt;
	}
}

function cleanHtml($html){
	//return $html;
	 return preg_replace('~>\s+<~', '><', $html);
}

function chkVal($v){
	$v = trim($v);
	if(!empty($v)){
		return $v;
	}else{
		return '  --- ---- ---- ---  ';
	}
}


function mkOptions($ar, $dbvar, $field){
	$st = '';
	$st .= '<select name="'.$field.'" class="form-control col-md-7 col-xs-12"><option>....</option>';
		for($i=0; $i < count($ar['vals']); $i++):
			if(strval($dbvar) == $ar['vals'][$i]):
				$st .= '<option value="'.$ar['vals'][$i].'" selected>'. $ar['name'][$i].'</option>';
			else:
				$st .= '<option value="'. $ar['vals'][$i].'">'. $ar['name'][$i] .'</option>';
			endif;
		endfor;
    $st .= '</select>';
    return $st;    
}

function addNaira($num){
	return '&#8358;'. number_format($num, 2, '.', ',');
}

function mkStars($r){
	$arr = array(
			'poor' => 1,
			'average' => 2,
			'good' => 3,
			'verygood' => 4,
			'excellent' => 5
		);
	$intx = intval($arr[strtolower($r)]);
	$st = '';
	for($i=0; $i<$intx; $i++){
		$st .= '<img src="/imgs/star.png" align="absmiddle" title="' . $r . '" width="15"/>';
	}
	$st .= '&nbsp;&nbsp';
	return $st;
}


function mkYNOptions($title, $name, $ans){
	$ar = explode(';','true;false');
	$radiooptns = ' <div class="form-group"><label>'. $title .'</label> <br/>';
	foreach($ar as $opt){
	  $el = (boolval($opt) == boolval($ans)) ? 'checked' : '';
	  //echo '<br/>state '. $opt .' = ' .  $el;
	  $radiooptns .= '<input type="radio" name="'.$name.'" value="'. $opt .'"'.$el.'> '. strval($opt) .' &nbsp;';
	}
	//exit;
    $radiooptns .= '</div>';
    return $radiooptns;

}


function elapsedTime($datetime, $full = false) {
	$now = new DateTime;
	$ago = new DateTime($datetime);
	$diff = $now->diff($ago);

	if (20 > $diff->days / 7) {
	    $diff->y = $diff->m = $diff->h = $diff->i = $diff->s = 0;
	    $diff->w = floor($diff->days / 7);
	    $diff->d = $diff->days - $diff->w * 7;
	} else {
	    $diff->w = floor($diff->d / 7);
	    $diff->d -= $diff->w * 7;
	}

	$string = array(
	    'y' => 'year',
	    'm' => 'month',
	    'w' => 'week',
	    'd' => 'day',
	);
	foreach ($string as $k => &$v) {
	    if ($diff->$k) {
	        $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
	    } else {
	        unset($string[$k]);
	    }
	}

	if (!$full) $string = array_slice($string, 0, 1);
	return $string ? implode(', ', $string) . ' ago' : 'just now';
}


function timeDiff($timestamp){
	$now = Carbon::now();
	$dt = Carbon::createFromTimeStamp(strtotime($timestamp));
	return str_replace('before', 'ago', $dt->diffForHumans($now));
}

function daysDiff($dt1, $dt2){
	$datetime1 = strtotime(date('Y-m-d', strtotime($dt1)));
	$datetime2 = strtotime(date('Y-m-d', strtotime($dt2)));

	$secs = abs($datetime2 - $datetime1);// == <seconds between the two times>
	return ceil($secs/86400);
}


function mkDiscount($v, $p){
	return addNaira(intval($v) - (intval($v)/100 * $p));
}

function mkInvoiceNum($v){
	if($v < 10){
		$num = '000000'.$v;
	}elseif($v < 100){
		$num = '00000'.$v;
	}elseif($v < 1000){
		$num = '0000'.$v;
	}elseif($v < 10000){
		$num = '000'.$v;
	}elseif($v < 100000){
		$num = '00'.$v;
	}elseif($v < 1000000){
		$num = '0'.$v;
	}else{
		$num = $v;
	}
	return '#'.$num;
}