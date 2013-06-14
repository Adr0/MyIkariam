<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {

	/**
	 * Construct function
	 */
	public function __construct()
	{
	    parent::__construct();
		
		if ($this->session->userdata('language'))
        {
            $this->lang->load('welcome', $this->session->userdata('language'));
        }
        else
        {
            $this->lang->load('welcome');
        }
	}
	
	function error()
    {
        $this->session->keep_flashdata('error');
        $this->load->view('main_index', array('page' => 'error'));
    }
	
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->view('main_index');
	}
	
	/**
	 * Login function
	 */
	public function login()
	{
	    $this->load->model('Player_Model');
        $this->Player_Model->User_Login();
	}
	
	/**
	 * Register function
	 */
	public function register()
    {
    
        // Переменная ошибок
        $errors = array();
     
	    // Загружаем модули
        $this->load->library('email');
        $this->load->helper('email');
        
		// Тип письма text или html
        $config['mailtype'] = 'html';
        $this->email->initialize($config);

        if (!isset($_POST['universe'])){ $errors[] = $this->lang->line('error_universe'); }
        if (!isset($_POST['name']) or (isset($_POST['name']) and (strip_tags($_POST['name']) == '' or strlen(strip_tags($_POST['name'])) < 3 or strlen(strip_tags($_POST['name'])) > 30 ))){ $errors[] = $this->lang->line('error_name_length'); }
        if (!isset($_POST['password']) or (isset($_POST['password']) and (strip_tags($_POST['password']) == '' or strlen(strip_tags($_POST['password'])) < 8 or strlen(strip_tags($_POST['password'])) > 30 ))){ $errors[] = $this->lang->line('error_password_length'); }
        if (!isset($_POST['email']) or !valid_email($_POST['email'])){ $errors[] = $this->lang->line('error_email2'); }
        if (!isset($_POST['agb']) or (isset($_POST['agb']) and !$_POST['agb'])){ $errors[] = $this->lang->line('error_order'); }
        
		// Регистрируем
        if (count($errors) == 0)
        {
            $login = strip_tags($_POST['name']);
            $password = strip_tags($_POST['password']);

            $user_query = $this->db->get_where($_POST['universe'].'_users', array('login' => $login));
          
    		// Если такого игркоа нету
            if ($user_query->num_rows == 0)
            {
                $key = random_string('alnum', 30);
                
				// Добавляем данные игрока
                $this->db->insert($_POST['universe'].'_users', array('login' => $login,'password' => md5($password),'email' => $_POST['email'], 'last_visit' => time(),'register_key' => $key));

				// Находим игрока в базе
                $user_query = $this->db->get_where($_POST['universe'].'_users', array('login' => $login));
                $user = $user_query->row();
               
			    // Se l'utente è il primo a registrarsi allora è admin
				if($user->id == '1')
				{ 
				    $data = array('rank' => '2');
                    $this->db->where('id', '1');
                    $this->db->update($_POST['universe'].'_users', $data); 
				}
				
				// Выбираем остров
                $island_query = $this->db->query('SELECT * FROM `'.$_POST['universe'].'_islands'.'` WHERE `city0`=0 or `city2`=0 or `city4`=0 or `city6`=0 or `city8`=0 or `city10`=0 or `city12`=0 or `city14`=0 ORDER BY RAND() LIMIT 1');

                if ($island_query->num_rows > 0)
                {
                    $island = $island_query->row();
                    
					// Находим позицию
                    $position = -1;
                    for ($i = 0; $i <= 15; $i++)
                    {
                        if ($i == 0 or $i == 2 or $i == 4 or $i == 6 or $i == 8 or $i == 10 or $i == 12 or $i == 14)
                        {
                            $parametr = 'city'.$i;
                            if ($island->$parametr == 0){$position = $i;break;}
                        }
                    }
                        if ($position >= 0)
                        {
                            // Добавляем город
                            $this->db->insert($_POST['universe'].'_towns', array('user' => $user->id,'island' => $island->id,'last_update' => time(), 'position' => $position));
                            // Находим город в базе
                            $town_query = $this->db->get_where($_POST['universe'].'_towns', array('user' => $user->id));
                            $town = $town_query->row();
                            // Добавляем армию
                            $this->db->insert($_POST['universe'].'_army', array('city' => $town->id));
                            // Обновляем город в остров
                            $this->db->set('city'.$position, $town->id);
                            $this->db->where(array('id' => $island->id));
                            $this->db->update($_POST['universe'].'_islands');
                            // Добавляем исследования
                            $this->db->insert($_POST['universe'].'_research', array('user' => $user->id));
                            // Notes
                            $this->db->insert($_POST['universe'].'_notes', array('user' => $user->id));
                            // Обновляем игрока
                            $this->db->set('town', $town->id);
                            $this->db->set('capital', $town->id);
                            $this->db->where(array('id' => $user->id));
                            $this->db->update($_POST['universe'].'_users');
                            //Отправляем письмо
                            if ($this->config->item('game_email'))
                            {
                                $message = '<html><body><p>'.$this->lang->line('register_email_text_1').' '.$user->login.',<br><br>'.$this->lang->line('register_email_text_2').' '.$_POST['universe'].'!<br><br>'.$this->lang->line('register_email_text_3').':<br><br><a href="'.$this->config->item('base_url').'main/validate/'.$_POST['universe'].'/'.$key.'/" target="_blank">'.$this->config->item('base_url').'main/validate/'.$_POST['universe'].'/'.$key.'</a><br><br>'.$this->lang->line('register_email_text_4').':<br>'.$this->lang->line('name').': '.$user->login.'<br>'.$this->lang->line('password').': '.$password.'<br>'.$this->lang->line('world').': '.$_POST['universe'].'<br><br>'.$this->lang->line('register_email_text_5').' ('.$this->config->item('forum_url').').<br><br>'.$this->lang->line('register_email_text_6').',<br>'.$this->lang->line('register_email_text_7').'</p></body></html>';
                                $this->email->from($this->config->item('email_from'), $this->lang->line('register_email_from'));
                                $this->email->to($_POST['email']);
                                $this->email->subject($user->login.', '.$this->lang->line('register_email_title'));
                                $this->email->message($message);
                                $this->email->send();
                            }
                            // Пишем сессию
                            //$this->Player_Model->Check_Double_Login($user, $_POST['universe']);
                            if($user->blocked_time > 0)
                            {
                                $this->Error($this->lang->line('error_blocked_text_1').' '.date("m.d.y H:i:s", $user->blocked_time).'!<br>'.$this->lang->line('error_blocked_text_2').': '.$user->blocked_why);
                            }
                            $this->session->set_userdata(array('id' => $user->id, 'universe' => $_POST['universe'], 'login' => $user->login, 'password' => md5($user->password)));
                            redirect('/game/', 'refresh');
                        }
                        else
                        {
                            $this->db->query('DELETE FROM '.$_POST['universe'].'_users where `id`="'.$user->id.'"');
                            $errors[] = $this->lang->line('error_world_text_1').' '.$_POST['universe'].' '.$this->lang->line('error_world_text_2');
                        }

                    }
                    else
                    {
                        $this->db->query('DELETE FROM '.$_POST['universe'].'_users where `id`="'.$user->id.'"');
                        $errors[] = $this->lang->line('error_world_text_1').' '.$_POST['universe'].' '.$this->lang->line('error_world_text_2');
                    }
                }
                else
                {
                    $errors[] = $this->lang->line('error_name');
                }
            }
            $this->session->set_flashdata(array('errors' => $errors));
            $this->load->view('main_index', array('page' => 'register'));
        }

        /**
         * Активация аккуанта
         * @param <string> $universe
         * @param <string> $key
         */
        function validate($universe = '', $key = '')
        {
            if ($universe == 'alpha')
            {
                $query = $this->db->get_where($universe.'_users', array('register_key' => $key, 'register_complete' => 0));
                if ($query->num_rows() == 1)
                {
                    $user = $query->row();
                    $this->db->set('register_complete', time());
                    $this->db->where(array('register_key' => $key, 'register_complete' => 0));
                    $this->db->update($universe.'_users');
                    $this->session->set_userdata(array('id' => $user->id, 'universe' => $universe, 'login' => $user->login, 'password' => md5($user->password)));
                    redirect('/game/', 'refresh');
                }
                else
                {
                    $this->session->set_flashdata(array('error' => $this->lang->line('error_activation')));
                    redirect('/main/error/', 'refresh');
                }
            }
            else
            {
                redirect('/', 'refresh');
            }
        }

        function send_password()
        {
            // Переменная ошибок
            $errors = array();
            $sended = false;
            // Загружаем модули
            $this->load->library('email');
            $this->load->helper('email');
            // Тип письма text или html
            $config['mailtype'] = 'html';
            $this->email->initialize($config);
            if (!isset($_POST['universe'])){ $errors[] = $this->lang->line('error_universe'); }
            if (!isset($_POST['email']) or !valid_email($_POST['email'])){ $errors[] = $this->lang->line('error_email2'); }
            if (count($errors) == 0)
            {
                $user_query = $this->db->get_where($_POST['universe'].'_users', array('email' => $_POST['email']));
                if ($user_query->num_rows == 0)
                {
                    $errors[] = $this->lang->line('error_email3');
                }
                else
                {
                    $user = $user_query->row();
                    $password = $key = random_key(8);
                    $this->db->set('password', md5($password));
                    $this->db->where(array('id' => $user->id));
                    $this->db->update($_POST['universe'].'_users');
                    //Отправляем письмо
                                $message = '<html><body><p>'.$this->lang->line('register_email_text_1').' '.$user->login.',<br><br>'.$this->lang->line('password_email_text_1').' ('.$_POST['universe'].'):<br><br>'.$password.'<br><br>'.$this->lang->line('password_email_text_2').' <a href="'.$this->config->item('base_url').'" target="_blank">'.$this->config->item('base_url').'</a><br><br>'.$this->lang->line('register_email_text_6').',<br>'.$this->lang->line('register_email_text_7').'</p></body></html>';
                                $this->email->from($this->config->item('email_from'), $this->lang->line('register_email_from'));
                                $this->email->to($_POST['email']);
                                $this->email->subject($this->lang->line('password_email_text_1').'!');
                                $this->email->message($message);
                                $this->email->send();
                    $sended = true;
                }
            }
            $this->session->set_flashdata(array('errors' => $errors));
            $this->session->set_flashdata(array('sended' => $sended));
            $this->load->view('main_index', array('page' => 'password', 'errors' => $errors));
        }

        function language($lang = 'english')
        {
            switch($lang)
            {
                case 'russian':
                    $this->session->set_userdata(array('language' => $lang));
                break;
                case 'italiano':
				    $this->session->set_userdata(array('language' => $lang));
				break;
				default: $this->session->set_userdata(array('language' => 'english'));
            }
            redirect($this->config->item('base_url'),'refresh');
        }
		
	public function page($page = 'index')
    {
        $errors = array();
        $this->session->set_flashdata(array('errors' => $errors));
        $this->load->view('main/'.$page);
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */