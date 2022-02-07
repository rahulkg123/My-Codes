<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if(!function_exists('title')){

	function title()
	{
		$CI =& get_instance();
		echo $CI->template->title;
	}
}

if(!function_exists('content')){

	function content()
	{
		$CI =& get_instance();
		foreach($CI->template->content as $view)
		{
			echo $view;
		}
	}
}


if(!function_exists('show_company')){

	function show_company()
	{
		echo "Orbit";
	}
}
if(!function_exists('software')){

	function software()
	{
		return "Big Bull";
	}
}
if(!function_exists('show_user')){

	function show_user()
	{
		$CI =& get_instance();
		if($CI->session->userdata('user_type') && $CI->session->userdata('user_type') == 1){
			echo "Administrator";
		}
		else{
			echo ucwords($CI->session->userdata('user_name'));
		}
	}
}

if(!function_exists('top_menu')){

	function top_menu()
	{
		$CI =& get_instance();
		$CI->load->view('menus/top_menu');
	}
}

if(!function_exists('page_heading')){

	function page_heading()
	{
		$CI =& get_instance();
		echo "<b>".$CI->template->page_heading."</b>";
	}
}

if(!function_exists('go_back')){

	function go_back()
	{
		$CI =& get_instance();
		if(!empty($CI->template->go_back))
		{
			echo '<a href="'.base_url($CI->template->go_back).'"><i title="'.lang('go-back').'" class="glyphicon glyphicon-hand-left pull-right size-20"></i></a>';
		}
	}
}

if ( !function_exists('scripts')){

	function scripts()
	{
		$CI =& get_instance();
		foreach($CI->template->script as $script){
			echo '<script language="javascript" src="'.$script.'" ></script>';
		}
	}	
}

if(!function_exists('numberFormat')){

	function numberFormat($value = 0,$decimal = 2){
		return number_format($value,$decimal);
	}
}

if(!function_exists('dateFormat')){

	function dateFormat($date){
		if(!empty($date) && $date != "0000-00-00"){
			return date("d-m-Y",strtotime($date));
		}
		return "";
	}
}

if(!function_exists('cdateFormat')){

	function cdateFormat($date){
		return date("m/d/Y",strtotime($date));
	}
}

if(!function_exists('stringFormat')){

	function stringFormat($str,$length = 25){
		if(strlen($str) > $length){
			return '<p title="'.$str.'">'.substr($str,0,$length)."...".'</p>';
		}
		return $str;
	}
}
if(!function_exists('companyWebsite')){
	function companyWebsite()
	{
		return '#';
	}
}
if(!function_exists('map_record_to_object')){
    // Map record set to array of object(s)
    function map_record_to_object($object,$result,$singleton=false) {
        if (!is_array($result)) {
            return $object;
        }
        $array_of_object = array();
        $reflect = new  ReflectionObject($object);
        $properties = $reflect->getProperties(ReflectionProperty::IS_PUBLIC + ReflectionProperty::IS_PROTECTED);
        foreach ($result as $row){
        
            $clone_object = clone  $object;
            foreach ($properties as $prop) {
                $key = $prop->getName();
                if (isset($row->$key)) {
                
                    $clone_object->$key = $row->$key;
                }
            }
            if ($singleton){
                $array_of_object = $clone_object;
            }
            else {
                $array_of_object[] = $clone_object;
            }
            $clone_object = NULL; 
        }
        return $array_of_object;
	}
}
	if(!function_exists('custom_mail')){
		// Map record set to array of object(s)
		function custom_mail($data) {
			$CI =& get_instance();
			$CI->load->library('Phpmailer_library');
			$mail = $CI->phpmailer_library->load();
			$mail->isSMTP();     
			$mail->Hostname = $CI->config->item('host_name');                       // Set mailer to use SMTP
			$mail->Host = $CI->config->item('host');           // Specify main and backup SMTP servers
			$mail->SMTPAuth = true;                     // Enable SMTP authentication
			$mail->Username = $CI->config->item('base_email');         // SMTP username
			$mail->Password = $CI->config->item('base_email_pwd'); // SMTP password
			//$mail->Port = 25; 
			$mail->SMTPSecure = 'ssl';                  // Enable TLS encryption, `ssl` also accepted
			$mail->Port = 465;                          // TCP port to connect to
			$mail->setFrom($CI->config->item('admin_email'), 'Big Bull');
			$mail->addAddress($data['email']);   // Add a recipient
			//$mail->addAttachment($data['path'],$data['filename']);
			$mail->isHTML(true);
			$mail->Subject = $data['subject'];
			$mail->Body=$data['body'];
			
			if(!$mail->send()) {
				return  true;
				//$this->session->set_flashdata('d','Mail could not be sent, <br> Mailer Error : '.$mail->ErrorInfo);
				//unlink($path);
				//redirect('vehexp');
			}else{
				return false;
				//$this->session->set_flashdata('s','Mail has been sent');
				//unlink($path);
				//redirect('vehexp');
			}
		}
	}
	if(!function_exists('table_attributes')){
		function table_attributes($tableid)
		{
			$template = array(
							'table_open'            => '<table class="table  table-sm table-bordered table-condensed table-striped table-hover" id="'.$tableid.'"  width="100%" cellspacing="0">',
					
							'thead_open'            => '<thead>',
							'thead_close'           => '</thead>',
					
							'heading_row_start'     => '<tr>',
							'heading_row_end'       => '</tr>',
							'heading_cell_start'    => '<th>',
							'heading_cell_end'      => '</th>',
					
							'tbody_open'            => '<tbody>',
							'tbody_close'           => '</tbody>',
					
							'row_start'             => '<tr>',
							'row_end'               => '</tr>',
							'cell_start'            => '<td>',
							'cell_end'              => '</td>',
					
							'row_alt_start'         => '<tr>',
							'row_alt_end'           => '</tr>',
							'cell_alt_start'        => '<td>',
							'cell_alt_end'          => '</td>',
					
							'table_close'           => '</table>'
					);
				return $template;
		}
	}
