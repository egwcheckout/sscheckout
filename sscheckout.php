<?php                                                                   
// This PHP file would be called by a page via AJAX.
// The AJAX data would include:
//	- trackingId
//	- Data about the lead (email, name, etc)
//	- lead id if _setResponseCallback shows a lead is already being tracked
//	- something telling the script to do a createLead or an updateLead

// SharpSpring API keys
$accountID = '';
$secretKey = '';  

// Some logic would go here to determine if we are updating a lead or creating a lead (depending on _setResponseCallback as determined by on-page JS)                                                                   
$method = 'createLeads';
$method2 = 'updateLeads';

// This stuff would be populated from the parameters provided by AJAX
$params = array(
	'objects' => array (
		array( 
			'Product1'		=> false,
			'Product2'		=> false,
			'emailAddress'	=> 'jose@pixelsupply.co'
		)
	)
);
$requestID = session_id();                                                      
$data = array(                                                                                
	'method' => $method,                                                                      
	'params' => $params,                                                                      
	'id' => $requestID,                                                                       
);   
$data2 = array(                                                                                
	'method' => $method,                                                                      
	'params' => $params,                                                                      
	'id' => $requestID,                                                                       
);                                                                                            
$queryString = http_build_query(array('accountID' => $accountID, 'secretKey' => $secretKey)); 
$url = "http://api.sharpspring.com/pubapi/v1/?$queryString";                             
$data = json_encode($data);                                                                   
$ch = curl_init($url);                                                                        
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                              
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);                                                  
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                               
curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                   
	'Content-Type: application/json',                                                         
	'Content-Length: ' . strlen($data)                                                        
));                                                                                           
$result_json = curl_exec($ch);                                                                     
curl_close($ch);


	
echo $result_json;
	
?>