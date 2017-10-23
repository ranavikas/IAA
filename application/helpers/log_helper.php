<?php

function log_audit($data)
{
	$CI =& get_instance();
        $CI->db->insert('audit',$data); 
}


function log_email($data)
{
	$CI =& get_instance();
    $CI->db->insert('email_log',$data); 
	$insert_id = $CI->db->insert_id();
	$num_inserts = $CI->db->affected_rows();
	
}

function get_page_id($pagename){	
        $CI =& get_instance();
		$CI->db->where('page_name',$pagename);
                $query 	= $CI->db->get('pages');
		$result = $query->row();
        return $result;
	}
                                                                   // 0-1-2       2-0-1
 function convertdateformat($oldDate){ //conver date formate from mm-dd-yyyy to yyyy-mm-dd
 
	if(is_null($oldDate) || $oldDate == '0000-00-00' || $oldDate == '' || $oldDate == null)
		return null;
	else
	{
        $arr = explode('/', $oldDate);
		

		if(strlen($arr[0]) < 4)
			$newDate = $arr[2].'-'.$arr[0].'-'.$arr[1];
		else
			$newDate = $oldDate;
		
        return $newDate;
	}
     
 }       
                                                                    //0-1-2       1-2-0
  function reversedateformat($oldDate){ //conver date formate from yyyy-mm-dd to mm-dd-yyyy
 
        $arr = explode('-', $oldDate);
        $newDate = $arr[1].'/'.$arr[2].'/'.$arr[0];
        return $newDate;
 }      

function nullformatdate($oldDate)
{
	if($oldDate == '0000-00-00' || $oldDate == '')
		$oldDate = NULL;

	
	return $oldDate;
}	


function RemoveFromArray($array, $key)
{
	if($array[$key] == '0000-00-00' ||  $array[$key] == null)
		unset($array[$key]);
	
	return $array;

}



function stateArray()
{

 $code = array('AL'=>'Alabama' , 'AK' =>'Alaska' , 'AZ'=>'Arizona' , 'AR'=>'Arkansas' , 'CA'=>'California' , 'CO'=>'Colorado' , 'CT'=>'Connecticut' , 'DE'=>'Delaware' , 'DC'=>'District Of Columbia' , 'FL'=>'Florida' , 'GA'=>'Georgia' , 'HI'=>'Hawaii','ID'=>'Idaho' , 'IL'=>'Illinois' ,'IN'=>'Indiana' , 'IA'=>'Iowa' , 'KS'=>'Kansas' , 'KY'=>'Kentucky' , 'LA'=>'Louisiana' , 'ME'=>'Maine' , 'MD'=>'Maryland' , 'MA'=>'Massachusetts' , 'MI'=>'Michigan' , 'MN'=>'Minnesota' , 'MS'=>'Mississippi' , 'MO'=>'Missouri' , 'MT'=>'Montana',
                'NE'=>'Nebraska' ,'NV'=>'Nevada' , 'NH'=>'New Hampshire' , 'NJ'=>'New Jersey' , 'NM'=>'New Mexico' , 'NY'=>'New York' , 'NC'=>'North Carolina' , 'ND'=>'North Dakota' ,
     'OH'=>'Ohio' , 'OK'=>'Oklahoma' , 'OR'=>'Oregon' , 'PA'=>'Pennsylvania' , 'RI'=>'Rhode Island' , 'SC'=>'South Carolina' , 'SD'=>'South Dakota' , 'TN'=>'Tennessee' , 'TX'=>'Texas',
                'UT'=>'Utah' , 'VT'=>'Vermont' , 'VA'=>'Virginia' , 'WA'=>'Washington' , 'WV'=>'West Virginia' , 'WI'=>'Wisconsin' , 'WY'=>'Wyoming');
 
    return $code;
}

?>				