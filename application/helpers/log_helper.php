<?php date_default_timezone_set('Asia/Kolkata');
	
	function add_log_entry($user_id,$log_type,$page_name,$table_name,$key_name,$autoid) {
		$log_desc='';
		$CI=& get_instance();
		if($log_type!=3) {   // for add or update(except delete)
           	$temp ='';
        	$query=$CI->db->query("select *  from $table_name where $key_name = '$autoid' ");
        	$data['record'] = $query->result();
			
			if ($log_type==4) {
				$log_desc="Image(s) uploaded";
			}				
			else {
				foreach ($data['record'] as $key => $value) {
					foreach ($value as $k => $val) {	
	        			$temp = $temp ."|".$k.':'.$val;  // get key value for log desc
	        			 $log_desc = $temp;
					}
				}
        		//$log_desc = $fieldlist;        		
			}
                }	
		else {
			$log_desc=$table_name.$key_name.$autoid;
		}	
		$data=array(
			'user_id' => $user_id,
			'log_type'=>$log_type,
			'page_name'=>$page_name,
			'table_name'=>$table_name,
			'log_desc'=>$log_desc,
			'log_date'=>date('Y-m-d h:i:sa')
		);
		$CI->db->insert('log_activity', $data);		
		return true;
	}
	
	// function add_notification($insert_id,$user_id,$msg,$redirect_url)
	// {
	// 	$CI=& get_instance();
		
	// 	$data = array(
	// 	'ref_id' => $insert_id,
	// 	'user_id' => $user_id,
	// 	'message'  => $msg,
	// 	'msg_date'  => date('Y-m-d H:i:s'),
	// 	'redirect_url'  => $redirect_url,
	//       );
	//       $CI->db->insert('notification', $data);	
	// 	return true;
	// }

if (!function_exists('add_notification_in_master')) {
	function add_notification_in_master($insert_id, $user_id, $msg, $redirect_url, $created_by = null)
	{
		$CI = &get_instance();

		if ($created_by === null && isset($CI->session)) {
			$created_by = $CI->session->userdata('user_id');
		}

		$data = array(
			'ref_id' => $insert_id,
			'company_id' => function_exists('get_current_company_id') ? (int) get_current_company_id() : null,
			'user_id' => $user_id,
			'message' => $msg,
			'msg_date' => date('Y-m-d H:i:s'),
			'redirect_url' => $redirect_url,
			'created_by' => $created_by,
		);

		if (isset($CI->db)) {
			$CI->db->insert('notification', $data);
		}

		return true;
	}
	}

	if (!function_exists('notify_event')) {
		function notify_event($event_key, $ref_id, $message, $redirect_url, $page, array $options = array())
		{
			$CI = &get_instance();
			$CI->load->model('Setup_model');
			$created_by = (int) $CI->session->userdata('user_id');
			$company_id = function_exists('get_current_company_id') ? (int) get_current_company_id() : null;
			$details = isset($options['details']) ? (string) $options['details'] : null;

			if (isset($options['recipient_ids']) && is_array($options['recipient_ids'])) {
				$recipients = $options['recipient_ids'];
			} elseif (!empty($options['super_admin_only'])) {
				$recipients = $CI->Setup_model->get_super_admin_users();
			} else {
				$recipients = $CI->Setup_model->get_users_for_notification($page);
			}

			foreach (array_unique(array_map('intval', $recipients)) as $user_id) {
				if ($user_id <= 0) {
					continue;
				}
				$CI->db->insert('notification', array(
					'ref_id' => (int) $ref_id,
					'company_id' => $company_id,
					'user_id' => $user_id,
					'event_key' => $event_key,
					'message' => $message,
					'details' => $details,
					'msg_date' => date('Y-m-d H:i:s'),
					'redirect_url' => $redirect_url,
					'created_by' => $created_by,
				));
			}

			return count($recipients);
		}
	}

	?>
