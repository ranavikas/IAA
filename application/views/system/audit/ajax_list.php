<?php 
$filtered_records = $table_data[0];
foreach ($table_data[1] as $audit){

	
	$table_data['aaData'][]			=	array(
											'Page'=>$audit['page_name'],
											'Action'=>$audit['action'],
											'User'=>$audit['username'],
											'Timestamp'=>$audit['action_ts'],
										);		
}
$table_data['iTotalRecords']			=	$total_data;
$table_data['iTotalDisplayRecords']		=	$total_data;
echo json_encode($table_data);die;
?>