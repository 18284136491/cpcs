<?php
class tennis_match{
	static function getmatch_name($sqlwhere){
	
		global $mysqlis;
		$arr	=	array();	
		$sql	=	"select match_name from tennis_match ".$sqlwhere." group by match_name";
		$query	=	$mysqlis->query($sql);
		while($rs = $query->fetch_array()){
			$arr[]	=	$rs['match_name'];
		}
		return $arr;
	}
	
	static function getmatch_info($match_id,$point_column="match_name"){
		
		global $mysqlis;
		$sql	=	"select match_name,match_master,match_time,match_date,match_showtype,Match_CoverDate,match_guest,match_type,match_rgg,match_dxgg,$point_column  from tennis_match where match_id=$match_id limit 1"; 
		$query	=	$mysqlis->query($sql);  		
		$rs		=	$query->fetch_array();
		return $rs;
	}
}
?>