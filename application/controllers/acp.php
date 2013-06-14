<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ACP extends CI_Controller {

	/**
	 * Construct function
	 */
	public function __construct()
	{
	    parent::__construct();
        
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
	}
}

/* End of file acp.php */
/* Location: ./application/controllers/acp.php */