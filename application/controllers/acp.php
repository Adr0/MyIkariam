<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ACP extends CI_Controller {

	public $configValue;
	
	/**
	 * Construct function
	 */
	public function __construct()
	{
	    parent::__construct();
        
		$this->load->model('Player_Model');
		$this->Player_Model->Load_Player($this->session->userdata('id'));
		$this->load->model('Update_Model');
    	
		// Отмечаем здания в очереди на карте
        $this->Player_Model->correct_buildings();
        $this->Player_Model->Load_New_Town_Messages();
        $this->Player_Model->Load_New_User_To_Messages();
		$this->load->model('View_Model');
		
		if ($this->session->userdata('rank') != 2)
        {
            redirect('game/', 'refresh');
        }
		
		// Load language
		if ($this->session->userdata('language'))
        {
            $this->lang->load('acp', $this->session->userdata('language'));
        }
        else
        {
            $this->lang->load('acp');
        }
		
		$this->Data_Model->Load_Config(1);
		$this->configValue =& $this->Data_Model->temp_config_db[1];
	}
	
	/*
	 * Index function
	 * We see the dashboard page
	 */
	public function index()
	{
	    $this->show('acp_index');
	}	
	
	/*
	 * Show list of updates
	 */
	public function updates()
	{
	    // We must check if exist a new version
		$this->show('acp_updates');
	}
	
	public function config($id = 1)
	{
		$this->show('acp_config', $this->configValue);

	    if($_POST)
		{
		    $initial_config = array(
			            'game_name' => ($this->input->post('game_name') == $this->configValue->game_name) ? null : $this->input->post('game_name'),
			            'game_speed' => ($this->input->post('game_speed') == $this->configValue->game_speed) ? null : $this->input->post('game_speed'),
			            'admin_email' => ($this->input->post('admin_email') == $this->configValue->admin_email) ? null : $this->input->post('admin_email'),
			            'board_link' => ($this->input->post('board_url') == $this->configValue->board_link) ? null : $this->input->post('board_url'),
			            'easter_design' => ($this->input->post('easter_design') == $this->configValue->easter_design) ? null : $this->input->post('easter_design'),
			            'double_login' => ($this->input->post('double_login') == $this->configValue->double_login) ? null : $this->input->post('double_login'),
			            'standard_capacity' => ($this->input->post('standard_capacity') == $this->configValue->standard_capacity) ? null : $this->input->post('standard_capacity'),
			            'transport_capacity' => ($this->input->post('transport_capacity') == $this->configValue->transport_capacity) ? null : $this->input->post('transport_capacity'),
						'town_queue_size' => ($this->input->post('town_queue_size') == $this->configValue->town_queue_size) ? null : $this->input->post('town_queue_size'),
			            'army_queue_size' => ($this->input->post('army_queue_size') == $this->configValue->army_queue_size) ? null : $this->input->post('army_queue_size'),
			            'notes_default' => ($this->input->post('notes_default') == $this->configValue->notes_default) ? null : $this->input->post('notes_default'),
			            'notes_premium' => ($this->input->post('notes_premium') == $this->configValue->notes_premium) ? null : $this->input->post('notes_premium'),
			            'trade_route_time' => ($this->input->post('trade_route_time') == $this->configValue->trade_route_time) ? null : $this->input->post('trade_route_time'),
			);
			
			$final_config = array();
			
			// Da mettere dentro il foreach
			foreach($initial_config as $column => $value) 
			{
			    if($value != null)
				{
				    $final_config += array($column => $value);
				}
			}
			
			$this->db->where('id', $id);
            $this->db->update($this->session->userdata('universe').'_config', $final_config); 
			redirect('acp/config/', 'refresh');
		} 
	
	}
	
	public function users()
	{
	    $this->show('acp_users');
	}
	
	
	function show($location, $param1 = 0, $param2 = 0, $param3 = 0, $param4 = 0, $param5 = 0, $param6 = 0)
    {
        $this->load->view('game_index', array('page' => $location, 'param1' => $param1, 'param2' => $param2, 'param3' => $param3, 'param4' => $param4, 'param5' => $param5, 'param6' => $param6));
    }
}

/* End of file acp.php */
/* Location: ./application/controllers/acp.php */