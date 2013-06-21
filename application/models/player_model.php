<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Player_Model extends CI_Model {

	/**
	 * We must start all array and object of all game
	 */
	public $reports, $missions, $user, $towns, $now_island, $research, $notes, $islands = null;
	public $wall, $fleets, $reports_count, $spyes, $ways, $research_advisor, $army_gold_need, $all_transports, $resource_production, $tradegood_production_bonus, $plus_sulfur, $tradegood_production, $resource_production_bonus, $plus_wood, $saldo, $corruption, $missions_loading, $units_count, $peoples_gold, $max_peoples, $good, $plus, $minus, $army_line, $ships_line, $my_fleets, $town_id, $already_build, $armys, $build_line, $garisson_limit, $capacity, $warehouses_levels, $warehouses, $scientists, $capital_id, $levels, $peoples, $now_town = 0;
	
	/**
	 * Construct function
	 */
	public function __construct()
	{
	    parent::__construct();
		
	}
	
	/**
	 * Loading all item of player..
	 */
	public function Load_Player($id = 0)
	{
	    if($id > 0)
		{
		    // Creo l'oggetto dell'utente e lo applico al "$this->user" che da ora contiene i valori della tabella users
			$this->Data_Model->Load_User($id);
			$this->user =& $this->Data_Model->temp_user_db[$id];
			
			// come prima carichiamo i valori delle ricerche dell'utente
			$this->Data_Model->Load_Research($id);
			$this->research =& $this->Data_Model->temp_research_db[$id];
			
            $this->missions_loading = 0;
            $this->all_transports = $this->user->transports;
                
			// премиум прирост
            $this->plus_wood = 1;
            $this->plus_marble = 1;
            $this->plus_wine = 1;
            $this->plus_crystal = 1;
            $this->plus_sulfur = 1;
            $this->plus_capacity = 1;
            $this->research_advisor = false;
				
			// Battle Reports
			$this->db->from($this->session->userdata('universe').'_reports');
            $this->db->where('attacker =', $this->Player_Model->user->id);
            $this->db->or_where('defender =', $this->Player_Model->user->id); 
            $this->reports = $this->db->get();
			$this->reports_count = count($this->reports);
			
			//Potrei caricare le note scritte dall'utente
			$notes_query = $this->db->get_where($this->session->userdata('universe').'_notes', array('user' => $id));
            $this->notes = $notes_query->row();  
			
			//Ricaviamo la città attuale in cui si trova l'utente e la capitale del suo impero
			$this->town_id = $this->user->town;
            $this->capital_id = $this->user->capital;
				
			// Очки
            $this->user->points_army = 0;
            $this->Load_Ways();
                
            // Всего ученых
            $this->scientists = 0;
			 
			// TODO: dobbiamo aggiungere il modo per ricavare soldi, popolazione e altro dalla città dell'utente, ma forse si può spostare
			$towns_query = $this->db->get_where($this->session->userdata('universe').'_towns', array('user' => $id));
            foreach ($towns_query->result() as $town)
            {
                $this->warehouses_levels[$town->id] = array();
                if ($town->pos0_level == 0)
				{ 
				    continue; 
				}
                
				$this->capacity[$town->id] = getConfig('standard_capacity');
                
				// Уровни зданий
                for ($i = 1; $i <=26; $i++)
                {
                    $this->levels[$town->id][$i] = 0;
                }
                
				$this->armys[$town->id] = array();
                $this->warehouses[$town->id] = 0;
                $this->army_gold_need[$town->id] = 0;
                $this->corruption[$town->id] = 0;
                $this->units_count[$town->id] = 0;
                $this->spyes[$town->id] = array();
                
				// Carichiamo la città
                $this->Data_Model->Load_Town($town->id);
				$this->Data_Model->temp_towns_db[$town->id] = $town;
                $this->towns[$town->id] =& $this->Data_Model->temp_towns_db[$town->id];
                
				// Carichiamo l'isola
                $this->Data_Model->Load_Island($town->island);
                $this->islands[$town->island] =& $this->Data_Model->temp_islands_db[$town->island];
                
				// Carichiamo l'esercito
                $this->Data_Model->Load_Army($town->id);
                $this->armys[$town->id] =& $this->Data_Model->temp_army_db[$town->id];
				
                // Carichiamo le persone
                $this->peoples[$town->id] = $town->peoples + $town->scientists + $town->workers + $town->tradegood;
                
				// Carichiamo gli scienziati
                $this->scientists = $this->scientists + $town->scientists;
                     				
				// Creiamo tutti gli edifici, poi controlleremo chi è già stato costruito
                for ($i = 0; $i <= 26; $i++)
                {
                    $this->already_build[$town->id][$i] = false;
                }
                
				// Semplice calcolo della capacità
                for ($i = 0; $i <= 14; $i++)
                {
                    $pos_type = 'pos'.$i.'_type';
					$pos_level = 'pos'.$i.'_level';
                    if ($town->$pos_type == 6)
					{
    					$this->capacity[$town->id] = $this->capacity[$town->id] + ($town->$pos_level*8000);
						$this->warehouses[$town->id]++; 
						$this->warehouses_levels[$town->id][] = $town->$pos_level; 
					}
                    elseif ($town->$pos_type == 7)
					{
    					$this->wall[$town->id] = $town->$pos_level;	
					}
					
					// Se l'edificio è costruito allora esiste
                    if ($town->$pos_level > 0)
					{
    					$this->already_build[$town->id][$town->$pos_type] = true;
					}
                    $this->levels[$town->id][$town->$pos_type] = $town->$pos_level;
                }
                
				// Строящиеся здания
                $this->build_line[$town->id] = $this->Data_Model->load_build_line($town->build_line);
                
				// Limite guarnigione
                $this->garisson_limit[$town->id] = 350 + (($town->pos0_level + $town->pos14_level) * 50);

				// Calcoliamo il saldo, l'oro per gli scienziati e altre cose relative
				// TODO: differenziare i vari saldi, quello totale da quello parziale
                $this->saldo[$town->id] = $town->peoples*90; // Questo è il saldo prodotto dai cittadini
                $this->scientists_gold_need = ($this->research->res3_13 > 0) ? 3 : 6;
                $this->saldo[$town->id] = $this->saldo[$town->id] - $town->scientists*$this->scientists_gold_need;
                $this->peoples_gold[$town->id] = $this->saldo[$town->id];

				// Sottrarre al saldo il costo dei soldati
                for ($a = 1; $a <= 22; $a ++)
                {
                    $class = $this->Data_Model->army_class_by_type($a);
                    if ($this->armys[$town->id]->$class > 0)
                    {
                        $cost = $this->Data_Model->army_cost_by_type($a, $this->research, $this->levels[$town->id]);
                        $this->saldo[$town->id] = $this->saldo[$town->id] - ($cost['gold']*$this->armys[$town->id]->$class);
                        $this->army_gold_need[$town->id] = $this->army_gold_need[$town->id] + ($cost['gold']*$this->armys[$town->id]->$class);
                        $this->user->points_army = $this->user->points_army + ($cost['wood']+$cost['wine']+$cost['crystal']+$cost['sulfur'])*0.7;      
                        $this->units_count[$town->id] = ($a <= 14) ? $this->units_count[$town->id] + $this->armys[$town->id]->$class : $this->units_count[$town->id];
                    }
                }
                    
			    // Persone massime
                $this->max_peoples[$town->id] = $this->Data_Model->peoples_by_level($town->pos0_level);

				// Уровень счастья
                $this->good[$town->id] = 0;
                $this->plus[$town->id]['base'] = 1200;
                $this->minus[$town->id]['peoples'] = $town->peoples + $town->scientists + $town->workers + $town->tradegood;
                $this->plus[$town->id]['capital'] = 0;
                $this->plus[$town->id]['research'] = 0;

				// Исследования
                if ($this->research->res3_1 > 0 and $this->capital_id == $town->id)
                {
                    $this->max_peoples[$town->id] = $this->max_peoples[$town->id] + 50;
                    $this->good[$town->id] = $this->good[$town->id] + 50;
                    $this->plus[$town->id]['capital'] = $this->plus[$town->id]['capital'] + 50;
                }
                
				if ($this->research->res2_8 > 0)
                {
                    $this->good[$town->id] = $this->good[$town->id] + 25;
                    $this->plus[$town->id]['research'] = $this->plus[$town->id]['research'] + 250;
                }
                
				if ($this->research->res2_14 > 0 and $this->capital_id == $town->id)
                {
                    $this->max_peoples[$town->id] = $this->max_peoples[$town->id] + 200;
                    $this->good[$town->id] = $this->good[$town->id] + 200;
                    $this->plus[$town->id]['capital'] = $this->plus[$town->id]['capital'] + 200;
                }
                
				if ($this->research->res2_15 > 0)
                {
                    $this->max_peoples[$town->id] = $this->max_peoples[$town->id] + (22*$this->research->res2_15);
                    $this->good[$town->id] = $this->good[$town->id] + (15*$this->research->res2_15);
                    $this->plus[$town->id]['research'] = $this->plus[$town->id]['research'] + (15*$this->research->res2_15);
                }
                        
    		    $this->plus[$town->id]['tavern'] = $this->levels[$town->id][8];
                $this->plus[$town->id]['wine'] = $town->tavern_wine*60;
                $this->good[$town->id] = ($this->plus[$town->id]['base'] + $this->plus[$town->id]['capital'] + $this->plus[$town->id]['research'] + $this->plus[$town->id]['tavern'] + $this->plus[$town->id]['wine']) - ($this->minus[$town->id]['peoples']);
                    
	    		// Очереди армии и флота
                $this->army_line[$town->id] = $this->Data_Model->load_army_line($this->armys[$town->id]->army_line);
                $this->ships_line[$town->id] = $this->Data_Model->load_army_line($this->armys[$town->id]->ships_line);
                $this->my_fleets[$town->id] = 0;

		    	// Spie
                    $this->Data_Model->Load_Spyes($town->id);
                    if (isset($this->Data_Model->temp_spyes_db[$town->id]))
                    {
                        $this->spyes[$town->id] =& $this->Data_Model->temp_spyes_db[$town->id];
                    }
					else 
					    $this->spyes[$town->id] = array();
					
            }
			
			$this->plus_research = 1;
            
			// Бумага - на 2% больше баллов
            if ($this->research->res3_2 > 0){$this->plus_research = $this->plus_research + 0.2;}
            
			// Чернила - на 4% больше баллов
            if ($this->research->res3_5 > 0){$this->plus_research = $this->plus_research + 0.4;}

			// Механическая ручка - на 8% больше баллов
            if ($this->research->res3_11 > 0){$this->plus_research = $this->plus_research + 0.8;}

			// Будущее Науки - на 2% больше баллов за уровень
            if ($this->research->res3_16 > 0){$this->plus_research = $this->plus_research + (0.9*$this->research->res3_16);}

			// Премиум прирост
                    if ($this->user->premium_wood > 0){$this->plus_wood = 1.2;}
                    if ($this->user->premium_wine > 0){$this->plus_wine = 1.2;}
                    if ($this->user->premium_marble > 0){$this->plus_marble = 1.2;}
                    if ($this->user->premium_crystal > 0){$this->plus_crystal = 1.2;}
                    if ($this->user->premium_sulfur > 0){$this->plus_sulfur = 1.2;}
                    if ($this->user->premium_capacity > 0){$this->plus_capacity = 2;}

                    // Вычисляем коррупцию и производство
                    foreach($this->towns as $town)
                    {
                        $colonys = SizeOf($this->towns) - 1;
                        if ($colonys > 0)
                        {
                            $this->corruption[$town->id] = (1 - ($this->levels[$town->id][10] + $this->levels[$town->id][15] + 1) / ($colonys + 1));
                            if ($this->corruption[$town->id] > 0)
                            {
                                $this->good[$town->id] = $this->good[$town->id] - (($town->peoples + $this->good[$town->id]) * $this->corruption[$town->id] );
                            }
                        }
                        // Производство
                        $resource_level = $this->islands[$town->island]->wood_level;
                        $tradegood_level = $this->islands[$town->island]->trade_level;
                        $resource_cost = $this->Data_Model->island_cost(0, $resource_level);
                        $tradegood_cost = $this->Data_Model->island_cost(1, $tradegood_level);
                        if ($town->workers > $resource_cost['workers'])
                        {
                            $this->resource_production[$town->id] = ($resource_cost['workers']/10)*(2-$this->corruption[$town->id])*($this->plus_wood);
                            $this->resource_production[$town->id] = $this->resource_production[$town->id] + (($town->workers-$resource_cost['workers'])*100)*(2-$this->corruption[$town->id])*($this->plus_wood);
                        }
                        else
                        {
                            $this->resource_production[$town->id] = ($town->workers/3)*(1-$this->corruption[$town->id]);
                        }
                        $this->resource_production_bonus[$town->id] = $this->resource_production[$town->id]*($this->plus_wood);
                        $plus_name = 'plus_'.$this->Data_Model->resource_class_by_type($this->islands[$town->island]->trade_resource);
                        if ($town->tradegood > $tradegood_cost['workers'])
                        {
                            $this->tradegood_production[$town->id] = ($tradegood_cost['workers']/10)*(2-$this->corruption[$town->id]);
                            $this->tradegood_production[$town->id] = $this->tradegood_production[$town->id] + (($town->tradegood-$tradegood_cost['workers'])*0.25/3600)*(1-$this->corruption[$town->id]);
                        }
                        else
                        {
                            $this->tradegood_production[$town->id] = ($town->tradegood/3)*(1-$this->corruption[$town->id]);
                        }
                        $this->tradegood_production_bonus[$town->id] = $this->tradegood_production[$town->id]*($this->$plus_name);
                    }

                // Загружаем миссии
                $this->Data_Model->Load_Missions($this->user->id, $this->towns);
                $this->missions =& $this->Data_Model->temp_missions_db[$id];
                $this->fleets = 0;
                if (SizeOf($this->missions) > 0)
				{
                    foreach($this->missions as $mission)
                    {
                        if ($mission->mission_start == 0){ $this->missions_loading++; }
                        if ($mission->user == $this->user->id)
                        {
                            $this->all_transports = $this->all_transports + $mission->ship_transport;
                            $this->fleets++;
                            $this->my_fleets[$mission->from]++;
                        }
                        elseif($mission->return_start == 0)
                        {
                            $this->fleets++;
                        }
                        $this->Data_Model->Load_Town($mission->to);
                        $this->Data_Model->Load_Town($mission->from);
					    $this->Data_Model->Load_User($this->Data_Model->temp_towns_db[$mission->to]->user);
                        $this->Data_Model->Load_User($this->Data_Model->temp_towns_db[$mission->from]->user);
                        $this->Data_Model->Load_Island($this->Data_Model->temp_towns_db[$mission->to]->island);
                        $this->Data_Model->Load_Island($this->Data_Model->temp_towns_db[$mission->from]->island);
                    }
                }
				$this->Data_Model->Load_Trade_Routes($this->user->id);
                if (isset($this->Data_Model->temp_trade_routes_db[$this->user->id]))
                {
                    $this->trade_routes =& $this->Data_Model->temp_trade_routes_db[$this->user->id];
                }
                    else $this->trade_routes = array();
                $this->island_id = $this->towns[$this->town_id]->island;
                $this->now_town = $this->towns[$this->town_id];
                $this->now_island = $this->islands[$this->island_id];
		}
    }
	
	// Login function
	public function User_Login()
    {
        if (isset($_POST['name']) & isset($_POST['password']))
        {
            $query = $this->db->get_where($_POST['universe'].'_users', array('login' => $_POST['name'], 'password' => md5($_POST['password'])));
            if ($query->num_rows() > 0)
            {
                $user = $query->row();
				$this->Check_Double_Login($user, $_POST['universe']);
                if($user->blocked_time > 0 and $user->blocked_time > time())
                {
                    $this->Error('Ваш аккаунт заблокирован до '.date("m.d.y H:i:s", $user->blocked_time).'!<br>Причина: '.$user->blocked_why);
                }
                else
                {
                    $user->blocked_time = 0;
                    $user-> blocked_why = '';
                    $this->db->set('blocked_time', $user->blocked_time);
                    $this->db->set('blocked_why', $user->blocked_why);
                    $this->db->where(array('id' => $user->id));
                    $this->db->update($_POST['universe'].'_users');
                }
                $this->session->set_userdata(array('id' => $user->id, 'rank' => $user->rank, 'universe' => $_POST['universe'], 'login' => $_POST['name'], 'password' => md5($_POST['password'])));
                redirect('/game/', 'refresh');
            }
            else
            {
                $this->Error('Неверные логин или пароль.');
            }
        }
    }
	
	function Check_Double_Login($user, $universe)
    {
		if (getConfig('double_login') == '1' and ($user->blocked_time == 0) and ($this->session->userdata('id') > 0) and ($user->id != $this->session->userdata('id')) and ($this->session->userdata('universe') == $universe))
        {
            $this->db->insert($universe.'_double_login', array('account_from' => $this->session->userdata('id'),'account_to' => $user->id,'login_time' => time(), 'ip_address' => $_SERVER['REMOTE_ADDR']));
            $user->double_login++;
            $user->blocked_time = ($user->double_login < 5) ? time()+3600 : time()+(3600*30);
            $user->blocked_why = ($user->double_login < 5) ? 'Подозрение в мультоводстве!' : 'Мультоводство!';
            $this->db->set('double_login', $user->double_login);
            $this->db->set('blocked_time', $user->blocked_time);
            $this->db->set('blocked_why', $user->blocked_why);
            $this->db->where(array('id' => $user->id));
            $this->db->update($universe.'_users');
            if ($user->double_login < 5)
            {
                $this->db->set('blocked_time', $user->blocked_time);
                $this->db->set('blocked_why', $user->blocked_why);
                $this->db->where(array('id' => $this->session->userdata('id')));
                $this->db->update($universe.'_users');
            }
        }
    }
	
	/**
	 * Funzione che controlla le costruzioni
	 */
	function correct_buildings()
    {
        $this->now_town = $this->towns[$this->town_id];
        $this->build_line[$this->town_id] = $this->Data_Model->load_build_line($this->now_town->build_line);
        if (SizeOf($this->build_line[$this->town_id]) > 0)
        for ($i = 0; $i < sizeof($this->build_line[$this->town_id]); $i++)
        {
            $pos_type = 'pos'.$this->build_line[$this->town_id][$i]['position'].'_type';
            $pos_level = 'pos'.$this->build_line[$this->town_id][$i]['position'].'_level';
            if ($this->now_town->$pos_type == 0 and $this->build_line[$this->town_id][$i]['type'] > 0)
            {
                $this->already_build[$this->town_id][$this->build_line[$this->town_id][$i]['type']] = true;
                $this->now_town->$pos_type = $this->build_line[$this->town_id][$i]['type'];
            }
        }
    }
	
	function Load_Town_Messages()
    {
        // Загрузка сообщений
        $this->towns_messages = array();
            $town_messages = $this->db->query('SELECT * FROM `'.$this->session->userdata('universe').'_town_messages` WHERE `user`='.$this->session->userdata('id').' and `date`>'.(time()-604800).' ORDER BY date DESC');
            if ($town_messages->num_rows() > 0)
                foreach ($town_messages->result() as $row)
                    $this->towns_messages[] = $row;
    }
	
    function Load_User_Messages()
    {
        $this->to_user_messages = array();
        $this->from_user_messages = array();
            $user_messages = $this->db->query('SELECT * FROM `'.$this->session->userdata('universe').'_user_messages` WHERE `to`='.$this->session->userdata('id').' and `date`>'.(time()-604800).' and `deleted_to`=0 and `archived_to`=0 ORDER BY date DESC');
            if ($user_messages->num_rows() > 0)
                foreach ($user_messages->result() as $row)
                {
                    $this->to_user_messages[$row->id] = $row;
                    if ($row->checked_to == 0){ $this->new_user_messages++; }
                }
        $user_messages = $this->db->query('SELECT * FROM `'.$this->session->userdata('universe').'_user_messages` WHERE `from`='.$this->session->userdata('id').' and `date`>'.(time()-604800).' and `deleted_from`=0 and `archived_from`=0 ORDER BY date DESC');
            if ($user_messages->num_rows() > 0)
                foreach ($user_messages->result() as $row)
                    $this->from_user_messages[$row->id] = $row;
    }
	
	function Load_New_Town_Messages()
    {
        $town_messages = $this->db->get_where($this->session->userdata('universe').'_town_messages', array('user' => $this->session->userdata('id'), 'checked' => 0));
        $this->new_towns_messages = $town_messages->num_rows;
    }
	
	function Load_New_User_To_Messages()
    {
        $this->new_user_messages = 0;
        $user_messages = $this->db->query('SELECT * FROM `'.$this->session->userdata('universe').'_user_messages` WHERE `to`='.$this->session->userdata('id').' and `date`>'.(time()-604800).' and `checked_to`=0 ORDER BY date DESC');
        $this->new_user_messages = $user_messages->num_rows;
    }
	
	function Load_Ways()
    {
        for($i = 1; $i <= 14; $i++){
            $parametr = 'res1_'.$i;
        
	    	if ($this->research->$parametr == 0)
			{
			    $this->ways[1] = $this->Data_Model->get_research(1,$i,$this->research);
				break;
			}
		}
        
		if ($this->research->res1_14 > 0){
		    $this->ways[1] = $this->Data_Model->get_research(1,14,$this->research);
		}
        
		if(isset($this->ways[1]) and $this->ways[1]['points'] <= $this->research->points and $this->research->way1_checked == 0)
		{
		    $this->research_advisor = true;
		}
        
		for($i = 1; $i <= 15; $i++){
            $parametr = 'res2_'.$i;
        
            if ($this->research->$parametr == 0)
			{
			    $this->ways[2] = $this->Data_Model->get_research(2,$i,$this->research);
			    break;
			}
		}
        
		if ($this->research->res2_15 > 0)
		{
		    $this->ways[2] = $this->Data_Model->get_research(2,15,$this->research);
		}
        
		if(isset($this->ways[2]) and $this->ways[2]['points'] <= $this->research->points and $this->research->way2_checked == 0)
		{
		    $this->research_advisor = true;
		}
        
		for($i = 1; $i <= 16; $i++){
            $parametr = 'res3_'.$i;
        
    		if ($this->research->$parametr == 0)
			{
			    $this->ways[3] = $this->Data_Model->get_research(3,$i,$this->research);
				break;
			}
		}
        
		if ($this->research->res3_16 > 0)
		{
		    $this->ways[3] = $this->Data_Model->get_research(3,16,$this->research);
		}
        
		if(isset($this->ways[3]) and $this->ways[3]['points'] <= $this->research->points and $this->research->way3_checked == 0)
		{
		    $this->research_advisor = true;
		}
        
		for($i = 1; $i <= 14; $i++)
        {
            $parametr = 'res4_'.$i;
            if ($this->research->$parametr == 0)
			{
			    $this->ways[4] = $this->Data_Model->get_research(4,$i,$this->research);
				break;
			}
		}
        
		if ($this->research->res4_14 > 0)
		{
		    $this->ways[4] = $this->Data_Model->get_research(4,14,$this->research);
		}
        if(isset($this->ways[4]) and $this->ways[4]['points'] <= $this->research->points and $this->research->way4_checked == 0)
		{
		    $this->research_advisor = true;
		}

    }
	
	function Error($error = '')
    {
        $this->session->set_flashdata(array('error' => $error));
        redirect($this->config->item('base_url').'main/error/', 'refresh');
    }
}
