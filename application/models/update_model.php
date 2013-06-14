<?php
/**
 * Модель обновления
 */
class Update_Model extends CI_Model
{

    /**
     * Инициализация
     */
    function __construct()
    {
        parent::__construct();
        $this->Update_Player($this->session->userdata('id'));
    }

    /**
     * Обновление игрока
     * @param <int> $id
     */
    function Update_Player($id)
    {
       // Получаем данные игрока
       $this->Player_Model->Load_Player($id);

       if(isset($id) and ($id > 0))
       {
           // Обнуляем очки
           $this->Player_Model->user->points_peoples = 0;
           
           $this->Update_Towns();
           $this->Update_Islands();
           $this->Update_Missions();
           $this->Update_Trade_Routes();
           $this->Update_Missions();
          
           
           // Последнее посещение
           $this->db->set('last_visit', time());
           // Обновляем золото
           if ($this->Player_Model->user->gold < 0) { $this->Player_Model->user->gold = 0; }
           $this->db->set('gold', $this->Player_Model->user->gold);
           // Обновляем сухогрузы
           $this->db->set('transports', $this->Player_Model->user->transports);
           // Обновляем премиумы
           if ($this->Player_Model->user->premium_account < time()){ $this->Player_Model->user->premium_account = 0; }
           if ($this->Player_Model->user->premium_wood < time()){ $this->Player_Model->user->premium_wood = 0; }
           if ($this->Player_Model->user->premium_wine < time()){ $this->Player_Model->user->premium_wine = 0; }
           if ($this->Player_Model->user->premium_marble < time()){ $this->Player_Model->user->premium_marble = 0; }
           if ($this->Player_Model->user->premium_crystal < time()){ $this->Player_Model->user->premium_crystal = 0; }
           if ($this->Player_Model->user->premium_sulfur < time()){ $this->Player_Model->user->premium_sulfur = 0; }
           if ($this->Player_Model->user->premium_capacity < time()){ $this->Player_Model->user->premium_capacity = 0; }
           $this->db->set('premium_account', $this->Player_Model->user->premium_account);
           $this->db->set('premium_wood', $this->Player_Model->user->premium_wood);
           $this->db->set('premium_wine', $this->Player_Model->user->premium_wine);
           $this->db->set('premium_marble', $this->Player_Model->user->premium_marble);
           $this->db->set('premium_crystal', $this->Player_Model->user->premium_crystal);
           $this->db->set('premium_sulfur', $this->Player_Model->user->premium_sulfur);
           $this->db->set('premium_capacity', $this->Player_Model->user->premium_capacity);
           //  Обучение
           $this->db->set('tutorial', $this->Player_Model->user->tutorial);
           // Очки
           $this->Player_Model->user->points_gold = $this->Player_Model->user->gold;
           $this->db->set('points', $this->Player_Model->user->points_buildings + $this->Player_Model->user->points_peoples + ($this->Player_Model->user->points_research*6) + $this->Player_Model->user->points_army + $this->Player_Model->user->points_transports);
           $this->db->set('points_buildings', $this->Player_Model->user->points_buildings);
           $this->db->set('points_levels', $this->Player_Model->user->points_levels);
           $this->db->set('points_peoples', $this->Player_Model->user->points_peoples);
           $this->db->set('points_army', $this->Player_Model->user->points_army);
           $this->db->set('points_gold', $this->Player_Model->user->points_gold);

           $this->db->where(array('id' => $id));
           $this->db->update($this->session->userdata('universe').'_users');
           // Обновляем баллы науки
           $this->db->set('points', $this->Player_Model->research->points);
           $this->db->where(array('user' => $id));
           $this->db->update($this->session->userdata('universe').'_research');

           $this->Player_Model->now_town = $this->Player_Model->towns[$this->Player_Model->town_id];
           $this->Player_Model->now_island = $this->Player_Model->islands[$this->Player_Model->island_id];
       }
    }

    function Update_Towns()
    {
           $towns_messages = array();
           // Пробегаемся по городам
           foreach($this->Player_Model->towns as $town)
           {
               $i = $town->id;
               $elapsed = time() - $this->Player_Model->towns[$i]->last_update;
               $this->db->set('last_update', time());
               // Вычитаем виноград за вино
               $wine_need = $this->Data_Model->wine_by_tavern_level($this->Player_Model->towns[$i]->tavern_wine);
               $this->Player_Model->towns[$i]->wine = $this->Player_Model->towns[$i]->wine - (($wine_need/3600)*$elapsed);
               if ($this->Player_Model->towns[$i]->wine < 0){ $this->Player_Model->towns[$i]->wine = 0; $this->Player_Model->towns[$i]->tavern_wine = 0; }
               // Прирост жителей
               if ($this->Player_Model->peoples[$i] < $this->Player_Model->max_peoples[$i])
               {
                   $this->Player_Model->towns[$i]->peoples = $this->Player_Model->towns[$i]->peoples + ((($this->Player_Model->good[$i]/50)/3600)*$elapsed);
                   $this->Player_Model->peoples[$i] = $this->Player_Model->towns[$i]->peoples + $this->Player_Model->towns[$i]->scientists + $this->Player_Model->towns[$i]->workers + $this->Player_Model->towns[$i]->tradegood;
               }
               $this->Player_Model->user->points_peoples = $this->Player_Model->user->points_peoples + floor($this->Player_Model->towns[$i]->peoples + $this->Player_Model->towns[$i]->workers + $this->Player_Model->towns[$i]->tradegood + $this->Player_Model->towns[$i]->scientists);
               if ($this->Player_Model->towns[$i]->peoples < 0){ $this->Player_Model->towns[$i]->peoples = 0; }
               if ($this->Player_Model->peoples[$i] > $this->Player_Model->max_peoples[$i])
               {
                   $this->Player_Model->towns[$i]->peoples = $this->Player_Model->max_peoples[$i] - ($this->Player_Model->peoples[$i] - $this->Player_Model->towns[$i]->peoples);
                   $this->Player_Model->peoples[$i] = $this->Player_Model->towns[$i]->peoples + $this->Player_Model->towns[$i]->scientists + $this->Player_Model->towns[$i]->workers + $this->Player_Model->towns[$i]->tradegood;
               }
               // Прирост золота
               $this->Player_Model->user->gold = $this->Player_Model->user->gold + (($this->Player_Model->saldo[$i]/3600)*$elapsed);
               // Прирост дерева
               $resource_add = ($this->Player_Model->resource_production_bonus[$this->Player_Model->towns[$i]->id]*$elapsed);
               // Хижина лесничего
               if ($this->Player_Model->levels[$this->Player_Model->towns[$i]->id][16] > 0)
               {
                   $resource_add = $resource_add + ($resource_add/100)*$this->Player_Model->levels[$this->Player_Model->towns[$i]->id][16]*2;
               }
               $this->Player_Model->towns[$i]->wood = $this->Player_Model->towns[$i]->wood + $resource_add;
               
               // Прирост другого ресурса
               $tradegood_add = ($this->Player_Model->tradegood_production_bonus[$this->Player_Model->towns[$i]->id]*$elapsed);
               switch($this->Player_Model->islands[$town->island]->trade_resource)
               {
                   case 1:
                       if ($this->Player_Model->levels[$this->Player_Model->towns[$i]->id][19] > 0)
                       {
                           $tradegood_add = $tradegood_add + ($tradegood_add/100)*$this->Player_Model->levels[$this->Player_Model->towns[$i]->id][19]*2;
                       }
                       $this->Player_Model->towns[$i]->wine = $this->Player_Model->towns[$i]->wine + $tradegood_add*(1-$this->Player_Model->corruption[$i])*($this->Player_Model->plus_wine);
                   break;
                   case 2:
                       if ($this->Player_Model->levels[$this->Player_Model->towns[$i]->id][17] > 0)
                       {
                           $tradegood_add = $tradegood_add + ($tradegood_add/100)*$this->Player_Model->levels[$this->Player_Model->towns[$i]->id][17]*2;
                       }
                       $this->Player_Model->towns[$i]->marble = $this->Player_Model->towns[$i]->marble + $tradegood_add*(1-$this->Player_Model->corruption[$i])*($this->Player_Model->plus_marble);
                   break;
                   case 3:
                       if ($this->Player_Model->levels[$this->Player_Model->towns[$i]->id][18] > 0)
                       {
                           $tradegood_add = $tradegood_add + ($tradegood_add/100)*$this->Player_Model->levels[$this->Player_Model->towns[$i]->id][18]*2;
                       }
                       $this->Player_Model->towns[$i]->crystal = $this->Player_Model->towns[$i]->crystal + $tradegood_add*(1-$this->Player_Model->corruption[$i])*($this->Player_Model->plus_crystal);
                   break;
                   case 4:
                       if ($this->Player_Model->levels[$this->Player_Model->towns[$i]->id][20] > 0)
                       {
                           $tradegood_add = $tradegood_add + ($tradegood_add/100)*$this->Player_Model->levels[$this->Player_Model->towns[$i]->id][20]*2;
                       }
                       $this->Player_Model->towns[$i]->sulfur = $this->Player_Model->towns[$i]->sulfur + $tradegood_add*(1-$this->Player_Model->corruption[$i])*($this->Player_Model->plus_sulfur);
                   break;
               }
               // Проверяем не вышли ли мы за пределы вместимости
               if ($this->Player_Model->towns[$i]->wood > $this->Player_Model->capacity[$i]) {$this->Player_Model->towns[$i]->wood = $this->Player_Model->capacity[$i];}
               if ($this->Player_Model->towns[$i]->wine > $this->Player_Model->capacity[$i]) {$this->Player_Model->towns[$i]->wine = $this->Player_Model->capacity[$i];}
               if ($this->Player_Model->towns[$i]->marble > $this->Player_Model->capacity[$i]) {$this->Player_Model->towns[$i]->marble = $this->Player_Model->capacity[$i];}
               if ($this->Player_Model->towns[$i]->crystal > $this->Player_Model->capacity[$i]) {$this->Player_Model->towns[$i]->crystal = $this->Player_Model->capacity[$i];}
               if ($this->Player_Model->towns[$i]->sulfur > $this->Player_Model->capacity[$i]) {$this->Player_Model->towns[$i]->sulfur = $this->Player_Model->capacity[$i];}
               // Баллы науки
               $add_points = $this->Player_Model->towns[$i]->scientists * $this->Player_Model->plus_research;
               $this->Player_Model->research->points = $this->Player_Model->research->points + (($add_points/3600)*$elapsed);
               // Строим здания в городах
               if ($this->Player_Model->towns[$i]->build_line != '')
               {
                   // Псевдо постройки
                   $buildings = $this->Data_Model->load_build_line($this->Player_Model->towns[$i]->build_line);
                   // Псевдо очередь
                   $while_line = $this->Player_Model->towns[$i]->build_line;
                   // Счетчик цикла
                   $step = 0;
                   while (SizeOf($buildings) > 0)
                   {
                       // Переменные
                       $level_text = 'pos'.floor($buildings[0]['position']).'_level';
                       $type_text = 'pos'.floor($buildings[0]['position']).'_type';
                       $level = $this->Player_Model->towns[$i]->$level_text;
                       $type = $this->Player_Model->towns[$i]->$type_text;
                       $cost = $this->Data_Model->building_cost($buildings[0]['type'], $level, $this->Player_Model->research, $this->Player_Model->levels[$i]);
                       if (SizeOf($buildings) > 1)
                       {
                           $new_cost = $this->Data_Model->building_cost($buildings[1]['type'], $level, $this->Player_Model->research, $this->Player_Model->levels[$i]);
                           // Стоимость постройки
                           $wood = $this->Player_Model->towns[$i]->wood - $new_cost['wood'];
                           $wine = $this->Player_Model->towns[$i]->wine - $new_cost['wine'];
                           $marble = $this->Player_Model->towns[$i]->marble - $new_cost['marble'];
                           $crystal = $this->Player_Model->towns[$i]->crystal - $new_cost['crystal'];
                           $sulfur = $this->Player_Model->towns[$i]->sulfur - $new_cost['sulfur'];
                       }
                       // Если время строить
                       if (($this->Player_Model->towns[$i]->build_start + $cost['time']) <= time())
                       {
                           if (($step == 0) or ($step > 0 and $wood >= 0 and $marble >= 0 and $wine >= 0 and $crystal >= 0 and $sulfur >= 0))
                           {
                                    $points = ($cost['wood'] + $cost['wine'] + $cost['marble'] + $cost['crystal'] + $cost['sulfur'])*0.01;
                                    $this->Player_Model->user->points_buildings = $this->Player_Model->user->points_buildings + $points;
                                    $this->Player_Model->user->points_levels = $this->Player_Model->user->points_levels + 1;
                                    // Увеличиваем уровень
                                    $this->Player_Model->towns[$i]->$level_text = $this->Player_Model->towns[$i]->$level_text + 1;
                                    $this->Player_Model->towns[$i]->$type_text = $buildings[0]['type'];
                                    // пишем в БД
                                    $this->db->set($level_text, $this->Player_Model->towns[$i]->$level_text);
                                    $this->db->set($type_text, $this->Player_Model->towns[$i]->$type_text);
                                    // Отправляем сообщение
                                    $message = ($this->Player_Model->towns[$i]->$level_text == 1) ? 'Строительство "<a href="'.$this->config->item('base_url').'game/city/'.$i.'/'.$this->Data_Model->building_class_by_type($buildings[0]['type']).'/'.$buildings[0]['position'].'/">'.$this->Data_Model->building_name_by_type($buildings[0]['type']).'</a>" завершено!' : 'Уровень здания "<a href="'.$this->config->item('base_url').'game/city/'.$i.'/'.$this->Data_Model->building_class_by_type($buildings[0]['type']).'/'.$buildings[0]['position'].'/">'.$this->Data_Model->building_name_by_type($buildings[0]['type']).'</a>" увеличен до '.$this->Player_Model->towns[$i]->$level_text.'!';
                                    $town_message = array(
                                        'user' => $this->Player_Model->user->id,
                                        'town' => $i,
                                        'date' => $this->Player_Model->towns[$i]->build_start + $cost['time'],
                                        'text' => $message
                                    );
                                    $towns_messages[] = $town_message;

                                    // Если не первое здание в очереди
                                    if ($step > 0 and SizeOf($buildings) > 1 and ($cost['wood'] > 0 or $cost['wine'] > 0 or $cost['marble'] > 0 or $cost['crystal'] > 0 or $cost['sulfur'] > 0))
                                    {
                                        $this->Player_Model->towns[$i]->wood = $wood;
                                        $this->Player_Model->towns[$i]->wine = $wine;
                                        $this->Player_Model->towns[$i]->marble = $marble;
                                        $this->Player_Model->towns[$i]->crystal = $crystal;
                                        $this->Player_Model->towns[$i]->sulfur = $sulfur;
                                    }
                                    // Если есть очередь
                                    if (SizeOf($buildings) > 1)
                                    {
                                        // уменьшаем настоящую очередь
                                        if ($buildings[0]['position'] < 10)
                                        {
                                            $this->Player_Model->towns[$i]->build_line = ($buildings[0]['type'] < 10) ? substr($this->Player_Model->towns[$i]->build_line, 4) : substr($this->Player_Model->towns[$i]->build_line, 5);
                                        }
                                        else
                                        {
                                            $this->Player_Model->towns[$i]->build_line = ($buildings[0]['type'] < 10) ? substr($this->Player_Model->towns[$i]->build_line, 5) : substr($this->Player_Model->towns[$i]->build_line, 6);
                                        }
                                        $this->Player_Model->towns[$i]->build_start = $this->Player_Model->towns[$i]->build_start + $cost['time'];
                                        if ($step > 0)
                                        {
                                            // и псевдо очередь
                                            if ($buildings[0]['position'] < 10)
                                            {
                                                $while_line = ($buildings[0]['type'] < 10) ? substr($while_line, 4) : substr($while_line, 5);
                                            }
                                            else
                                            {
                                                $while_line = ($buildings[0]['type'] < 10) ? substr($while_line, 5) : substr($while_line, 6);
                                            }
                                            $buildings = $this->Data_Model->load_build_line($this->Player_Model->towns[$i]->build_line);
                                        }
                                    }
                                    else
                                    {
                                        // Обнуляем очередь
                                        $this->Player_Model->towns[$i]->build_line = '';
                                        $this->Player_Model->towns[$i]->build_start = 0;
                                        $buildings = array();
                                        break;
                                    }
                           }
                           else
                           {
                               // Если ресурсов не хватает уменьшаем настоящую и псевдо очереди
                               if ($buildings[0]['position'] < 10)
                               {
                                   $this->Player_Model->towns[$i]->build_line = ($buildings[0]['type'] < 10) ? substr($this->Player_Model->towns[$i]->build_line, 4) : substr($this->Player_Model->towns[$i]->build_line, 5);
                                   $while_line = ($buildings[0]['type'] < 10) ? substr($while_line, 4) : substr($while_line, 5);
                               }
                               else
                               {
                                   $this->Player_Model->towns[$i]->build_line = ($buildings[0]['type'] < 10) ? substr($this->Player_Model->towns[$i]->build_line, 5) : substr($this->Player_Model->towns[$i]->build_line, 6);
                                   $while_line = ($buildings[0]['type'] < 10) ? substr($while_line, 5) : substr($while_line, 6);
                               }
                           }
                       }
                       else
                       {
                           // Если еще не время строить уменьшаем псевдо очередь построек
                           if ($buildings[0]['position'] < 10)
                           {
                               $while_line = ($buildings[0]['type'] < 10) ? substr($while_line, 4) : substr($while_line, 5);
                           }
                           else
                           {
                               $while_line = ($buildings[0]['type'] < 10) ? substr($while_line, 5) : substr($while_line, 6);
                           }
                           $buildings = $this->Data_Model->load_build_line($while_line);
                           break;
                       }
                       // Снова загружаем псевдо постройки
                       $buildings = $this->Data_Model->load_build_line($while_line);
                       // Счетчик цикла
                       $step++;

                   }
                        // Проверка данных, чтобы не писать в БД лишнего
                        if (strlen($this->Player_Model->towns[$i]->build_line) < 3){ $this->Player_Model->towns[$i]->build_line = ''; }
                        if ($this->Player_Model->towns[$i]->build_line == ''){ $this->Player_Model->towns[$i]->build_start = 0; }
                        $this->Player_Model->build_line[$i] = $this->Data_Model->load_build_line($this->Player_Model->towns[$i]->build_line);
                        // Пишем в БД очередь
                        $this->db->set('build_line', $this->Player_Model->towns[$i]->build_line);
                        $this->db->set('build_start', $this->Player_Model->towns[$i]->build_start);
               }
               // Баллы действий
               $actions = $this->Data_Model->action_points_by_level($this->Player_Model->towns[$i]->pos0_level) - $this->Player_Model->my_fleets[$i];
               $this->db->set('actions', $actions);
               // Обновляем в БД ресурсы города
               $this->db->set('peoples', $this->Player_Model->towns[$i]->peoples);
               $this->db->set('wood', $this->Player_Model->towns[$i]->wood);
               $this->db->set('wine', $this->Player_Model->towns[$i]->wine);
               $this->db->set('marble', $this->Player_Model->towns[$i]->marble);
               $this->db->set('crystal', $this->Player_Model->towns[$i]->crystal);
               $this->db->set('sulfur', $this->Player_Model->towns[$i]->sulfur);
               // Вино в таверне
               $this->db->set('tavern_wine', $this->Player_Model->towns[$i]->tavern_wine);

               $this->db->where(array('id' => $i));
               $this->db->update($this->session->userdata('universe').'_towns');

               // Строим армию в городах
               for ($army_type = 0; $army_type < 2; $army_type++)
               {
                   $army_type_line = ($army_type == 0) ? 'army_line' : 'ships_line';
                   $army_type_start = ($army_type == 0) ? 'army_start' : 'ships_start';

                   if ($this->Player_Model->armys[$i]->$army_type_line != '')
                   {
                       // Загружаем очередь армии
                       $army_line = $this->Player_Model->armys[$i]->$army_type_line;
                       $army = $this->Data_Model->load_army_line($this->Player_Model->armys[$i]->$army_type_line);
                       $army_start = $this->Player_Model->armys[$i]->$army_type_start;

                       while (SizeOf($army) > 0)
                       {

                           // Переменные
                           $cost = $this->Data_Model->army_cost_by_type($army[0]['type'], $this->Player_Model->research, $this->Player_Model->levels[$i]);
                           $ELAPSED_ARMY = time() - $army_start;
                           $count = floor($ELAPSED_ARMY/$cost['time']);
                           $class = $this->Data_Model->army_class_by_type($army[0]['type']);
                           // Если построен хотя бы один
                           if ($count >= $army[0]['count'])
                           {
                               // Если построены все
                               $this->Player_Model->armys[$i]->$class = $this->Player_Model->armys[$i]->$class + $army[0]['count'];
                               if($army[0]['count'] < 10)
                               {
                                   $army_line = ($army[0]['type'] < 10) ? substr($army_line, 4) : substr($army_line, 5);
                               }
                               else
                               {
                                   $army_line = ($army[0]['type'] < 10) ? substr($army_line, 5) : substr($army_line, 6);
                               }
                               $army = $this->Data_Model->load_army_line($army_line);
                               $army_start = $army_start + ($army[0]['count']*$cost['time']);
                           }
                           else
                           {
                               // Если построена часть
                               $this->Player_Model->armys[$i]->$class = $this->Player_Model->armys[$i]->$class + $count;
                               $army[0]['count'] = $army[0]['count'] - $count;
                               if($army[0]['count'] < 10)
                               {
                                   $army_line = ($army[0]['type'] < 10) ? substr($army_line, 4) : substr($army_line, 5);
                               }
                               else
                               {
                                   $army_line = ($army[0]['type'] < 10) ? substr($army_line, 5) : substr($army_line, 6);
                               }
                               $army_line = ($army_line != '') ? $army[0]['type'].','.$army[0]['count'].';'.$army_line : $army[0]['type'].','.$army[0]['count'] ;
                               $army_start = $army_start + ($count*$cost['time']);
                               break;
                           }
                           // Проверка данных, чтобы не писать в БД лишнего
                           if ($army_line == ''){ $army_start = 0; }
                           if ($army_line == 0){ $army_line = ''; }
                       }
                            // Обновляем армию в базу
                            for ($a = 1; $a <= 14; $a++)
                            {
                                $class = $this->Data_Model->army_class_by_type($a);
                                $this->db->set($class, $this->Player_Model->armys[$i]->$class);
                            }
                            // Обновляем армию в базу
                            for ($a = 16; $a <= 22; $a++)
                            {
                                $class = $this->Data_Model->army_class_by_type($a);
                                $this->db->set($class, $this->Player_Model->armys[$i]->$class);
                            }
                            // Обновляем очередь армии
                            $this->Player_Model->armys[$i]->$army_type_line = $army_line;
                            $this->Player_Model->armys[$i]->$army_type_start = $army_start;
                            $this->db->set($army_type_line, $army_line);
                            $this->db->set($army_type_start, $army_start);

                            $this->db->where(array('city' => $i));
                            $this->db->update($this->session->userdata('universe').'_army');
                   }
               }
               // Тренируем шпионов
               if($this->Player_Model->towns[$i]->spyes_start > 0)
               {
                   $safehouse_position = $this->Data_Model->get_position(14, $this->Player_Model->towns[$i]);
                   $safehouse_text = 'pos'.$safehouse_position.'_level';
                   $safehouse_level = $this->Player_Model->towns[$i]->$safehouse_text;
                   $spy_time = $this->Data_Model->spyes_time_by_level($safehouse_level);
                   if (time() >= ($this->Player_Model->towns[$i]->spyes_start+$spy_time))
                   {
                       $this->Player_Model->towns[$i]->spyes++;
                       $this->Player_Model->towns[$i]->spyes_start = 0;
                       $this->db->set('spyes', $this->Player_Model->towns[$i]->spyes);
                       $this->db->set('spyes_start', 0);
                       $this->db->where(array('id' => $i));
                       $this->db->update($this->session->userdata('universe').'_towns');
                   }
               }
               // Вычисляем золото за армию
               $ARMY_GOLD = 0;
               for ($a = 1; $a <= 22; $a ++)
               {
                   $class = $this->Data_Model->army_class_by_type($a);
                   $cost = $this->Data_Model->army_cost_by_type($a, $this->Player_Model->research, $this->Player_Model->levels[$i]);
                   $ARMY_GOLD = $ARMY_GOLD + ((($cost['gold'] * $this->Player_Model->armys[$i]->$class)/3600)*$elapsed);
               }
               $this->Player_Model->user->gold = $this->Player_Model->user->gold - $ARMY_GOLD;

               $this->Update_Spyes($town->id);
           }
           $this->Send_Messages($towns_messages);
    }

    function Update_Islands()
    {
           $towns_messages = array();
           // Пробегаемся по островам
           foreach ($this->Player_Model->islands as $island)
           {
               for ($is = 0; $is <= 1; $is++)
               {
                   $res_level = ($is == 0) ? 'wood_level' : 'trade_level';
                   $res_count = ($is == 0) ? 'wood_count' : 'trade_count';
                   $res_start = ($is == 0) ? 'wood_start' : 'trade_start';
                   $res_name = ($is == 0) ? 'Лесопилка' : $this->Data_Model->island_building_by_resource($island->trade_resource);
                   // Цены для улучшения леса
                   $cost = $this->Data_Model->island_cost($is,$island->$res_level);
                   $need_wood = $cost['wood'] - $island->$res_count;
                   $need_wood = ($need_wood < 0) ? 0 : $need_wood;
                   if ($island->$res_start > 0)
                   {
                       $time_start = $island->$res_start;
                       $elapsed_wood = time() - $island->$res_start;
                       if ($elapsed_wood >= $cost['time'])
                       {
                           $this->Player_Model->islands[$island->id]->$res_level = $island->$res_level + 1;
                           $this->Player_Model->islands[$island->id]->$res_start = 0;
                           $this->db->set($res_level, $this->Player_Model->islands[$island->id]->$res_level);
                           $this->db->set($res_start, 0);
                           $this->db->where(array('id' => $this->Player_Model->islands[$island->id]->id));
                           $this->db->update($this->session->userdata('universe').'_islands');
                           // Отправляем сообщения
                           $users_sended = array();
                           // Склонения
                           switch($island->trade_resource)
                           {
                               case 1: $word = 'расширились'; break;
                               case 2: $word = 'расширился'; break;
                               default: $word = 'расширилась'; break;
                           }
                           $text = '<b>'.$res_name.'</b> расширилась на острове <a href="'.$this->config->item('base_url').'game/island/'.$island->id.'/">'.$island->name.' ('.$island->x.':'.$island->y.')</a>!';
                           for ($i = 0; $i <= 15; $i++)
                           {
                               $town_text = 'city'.$i;
                               if ($this->Player_Model->islands[$island->id]->$town_text > 0)
                               {
                                   $this->Data_Model->Load_Town($this->Player_Model->islands[$island->id]->$town_text);
                                   $town = $this->Data_Model->temp_towns_db[$this->Player_Model->islands[$island->id]->$town_text];
                                   if (!isset($users_sended[$town->user]))
                                   {
                                       $users_sended[$town->user] = TRUE;
                                       $town_message = array(
                                           'user' => $town->user,
                                           'town' => $town->id,
                                           'date' => ($time_start + $cost['time']),
                                           'text' => $text
                                       );
                                       $towns_messages[] = $town_message;
                                   }
                               }
                           }
                       }
                   }else{
                       // Если дерева достаточно
                       if ($need_wood == 0)
                       {
                           $this->Player_Model->islands[$island->id]->$res_start = time();
                           $this->Player_Model->islands[$island->id]->$res_count = $island->$res_count - $cost['wood'];
                           $this->db->set($res_start, $this->Player_Model->islands[$island->id]->$res_start);
                           $this->db->set($res_count, $this->Player_Model->islands[$island->id]->$res_count);
                           $this->db->where(array('id' => $this->Player_Model->islands[$island->id]->id));
                           $this->db->update($this->session->userdata('universe').'_islands');
                       }
                   }
               }
           }
           $this->Send_Messages($towns_messages);
    }

    function Update_Missions()
    {
        $towns_messages = array();
        $next_loading = 0;
           foreach($this->Player_Model->missions as $mission)
           {
               $all_resources = $mission->wood + $mission->marble + $mission->wine + $mission->crystal + $mission->sulfur + $mission->peoples;
               require('mission_data.php');
               
			   // Если миссия не началась, значит мы грузим товары в порту
               if ($mission->mission_start == 0 and $mission->user == $this->Player_Model->user->id)
               {  
                   if ($next_loading > 0 and $mission->loading_from_start < $next_loading)
                   {
                       $mission->loading_from_start = $next_loading;
                   }
                   $elapsed_mission = time() - $mission->loading_from_start - $loading_time;
                   //$this->db->set('loading_from_start', $mission->loading_from_start);
                   // Если загрузили
                   if ($elapsed_mission >= 0)
                   {
                       if ($next_loading == 0)
                       {
                           $this->Player_Model->missions[$mission->id]->mission_start = $mission->loading_from_start + $loading_time;
                           $this->db->set('mission_start', $mission->loading_from_start + $loading_time);
                       }
                       $this->db->set('loading_from_start', $mission->loading_from_start);
                       $this->db->where(array('id' => $mission->id));
                       $this->db->update($this->session->userdata('universe').'_missions');
                   }
                   $next_loading = $mission->loading_from_start + $loading_time;
               }
               elseif($mission->mission_start > 0)
               {
                   // Если не возвращаемся
                   if ($mission->return_start == 0)
                   {
                       if ($mission->loading_to_start == 0)
                       {
                           if ($mission->mission_type == 1 or $mission->mission_type == 2 or $mission->mission_type == 4)
                           {
                               // При колонизации и транспортировке грузить в чужом городе ничего не надо
                               $mission->loading_to_start = $mission->mission_start + $time;
                           }
                           elseif($mission->mission_type == 3 and $mission_end <= 0)
                           {
                               $gold = 0;
                               $start_gold = $mission->gold;
                               if ($mission->trade_wood_count > 0 and $trade_town->branch_trade_wood_type == 1 and $trade_town->branch_trade_wood_cost <= $mission->trade_wood_cost)
                               {
                                   $mission->trade_wood_count = ($trade_town->branch_trade_wood_count >= $mission->trade_wood_count) ? $mission->trade_wood_count : $trade_town->branch_trade_wood_count;
                                   $gold = $gold + $mission->trade_wood_count*$trade_town->branch_trade_wood_cost;
                                   $mission->gold = $mission->gold - $mission->trade_wood_count*$trade_town->branch_trade_wood_cost;
                               }
                               if ($mission->trade_wine_count > 0 and $trade_town->branch_trade_wine_type == 1 and $trade_town->branch_trade_wine_cost <= $mission->trade_wine_cost)
                               {
                                   $mission->trade_wine_count = ($trade_town->branch_trade_wine_count >= $mission->trade_wine_count) ? $mission->trade_wine_count : $trade_town->branch_trade_wine_count;
                                   $gold = $gold + $mission->trade_wine_count*$trade_town->branch_trade_wine_cost;
                                   $mission->gold = $mission->gold - $mission->trade_wine_count*$trade_town->branch_trade_wine_cost;
                               }
                               if ($mission->trade_marble_count > 0 and $trade_town->branch_trade_marble_type == 1 and $trade_town->branch_trade_marble_cost <= $mission->trade_marble_cost)
                               {
                                   $mission->trade_marble_count = ($trade_town->branch_trade_marble_count >= $mission->trade_marble_count) ? $mission->trade_marble_count : $trade_town->branch_trade_marble_count;
                                   $gold = $gold + $mission->trade_marble_count*$trade_town->branch_trade_marble_cost;
                                   $mission->gold = $mission->gold - $mission->trade_marble_count*$trade_town->branch_trade_marble_cost;
                               }
                               if ($mission->trade_crystal_count > 0 and $trade_town->branch_trade_crystal_type == 1 and $trade_town->branch_trade_crystal_cost <= $mission->trade_crystal_cost)
                               {
                                   $mission->trade_crystal_count = ($trade_town->branch_trade_crystal_count >= $mission->trade_crystal_count) ? $mission->trade_crystal_count : $trade_town->branch_trade_crystal_count;
                                   $gold = $gold + $mission->trade_crystal_count*$trade_town->branch_trade_crystal_cost;
                                   $mission->gold = $mission->gold - $mission->trade_crystal_count*$trade_town->branch_trade_crystal_cost;
                               }
                               if ($mission->trade_sulfur_count > 0 and $trade_town->branch_trade_sulfur_type == 1 and $trade_town->branch_trade_sulfur_cost <= $mission->trade_sulfur_cost)
                               {
                                   $mission->trade_sulfur_count = ($trade_town->branch_trade_sulfur_count >= $mission->trade_sulfur_count) ? $mission->trade_sulfur_count : $trade_town->branch_trade_sulfur_count;
                                   $gold = $gold + $mission->trade_sulfur_count*$trade_town->branch_trade_sulfur_cost;
                                   $mission->gold = $mission->gold - $mission->trade_sulfur_count*$trade_town->branch_trade_sulfur_cost;
                               }
                               if ($gold > 0)
                               {
                                   // При покупке - погрузка в порту чужого города
                                   $text = '';
                                   if ($mission->trade_wood_count > 0){ $text .= '<li class="wood"><span class="textLabel">Стройматериалы: </span>'.($mission->trade_wood_count).'</li> по цене:<li class="gold"><span class="textLabel">Золото: </span>'.$trade_town->branch_trade_wood_cost.'</li><br>';}
                                   if ($mission->trade_wine_count > 0){$text .= '<li class="wine"><span class="textLabel">Виноград: </span>'.($mission->trade_wine_count).'</li> по цене:<li class="gold"><span class="textLabel">Золото: </span>'.$trade_town->branch_trade_wine_cost.'</li><br>';}
                                   if ($mission->trade_marble_count > 0){$text .= '<li class="marble"><span class="textLabel">Мрамор: </span>'.($mission->trade_marble_count).'</li> по цене:<li class="gold"><span class="textLabel">Золото: </span>'.$trade_town->branch_trade_marble_cost.'</li><br>';}
                                   if ($mission->trade_crystal_count > 0){$text .= '<li class="glass"><span class="textLabel">Хрусталь: </span>'.($mission->trade_crystal_count).'</li> по цене:<li class="gold"><span class="textLabel">Золото: </span>'.$trade_town->branch_trade_crystal_cost.'</li><br>';}
                                   if ($mission->trade_sulfur_count > 0){$text .= '<li class="sulfur"><span class="textLabel">Сера: </span>'.($mission->trade_sulfur_count).'</li> по цене:<li class="gold"><span class="textLabel">Золото: </span>'.$trade_town->branch_trade_sulfur_cost.'</li><br>';}
                                   $text .= '</ul>';
                                   // Сообщение отправителю
                                   $text_from = 'Ваш торговый флот из <a href="'.$this->config->item('base_url').'game/island/'.$this->Data_Model->temp_towns_db[$mission->from]->island.'/'.$mission->from.'/">'.$this->CI->Data_Model->temp_towns_db[$mission->from]->name.'</a> прибыл в <a href="'.$this->config->item('base_url').'game/island/'.$this->Data_Model->temp_towns_db[$mission->to]->island.'/'.$mission->to.'/">'.$this->CI->Data_Model->temp_towns_db[$mission->to]->name.'</a> и сейчас погружает: <ul class="resources">'.$text;
                                   $town_from_message = array(
                                       'user' => $mission->user,
                                       'town' => $mission->from,
                                       'date' => $mission->mission_start + $time,
                                       'text' => $text_from
                                   );
                                   if ($mission->user != $trade_town->user)
                                   {
                                       // Сообщение получателю
                                       $text_to = 'Торговый флот из <a href="'.$this->config->item('base_url').'game/island/'.$this->Data_Model->temp_towns_db[$mission->from]->island.'/'.$mission->from.'/">'.$this->CI->Data_Model->temp_towns_db[$mission->from]->name.'</a> прибыл в ваш город <a href="'.$this->config->item('base_url').'game/island/'.$this->Data_Model->temp_towns_db[$mission->to]->island.'/'.$mission->to.'/">'.$this->CI->Data_Model->temp_towns_db[$mission->to]->name.'</a> и сейчас погружает: <ul class="resources">'.$text;
                                       $town_to_message = array(
                                           'user' => $trade_town->user,
                                           'town' => $mission->to,
                                           'date' => $mission->mission_start + $time,
                                           'text' => $text_to
                                       );
                                       $towns_messages[] = $town_to_message;
                                   }
                                   $towns_messages[] = $town_from_message;
                                   // Ресурсы
                                   $mission->wood = $mission->trade_wood_count;
                                   $mission->wine = $mission->trade_wine_count;
                                   $mission->marble = $mission->trade_marble_count;
                                   $mission->crystal = $mission->trade_crystal_count;
                                   $mission->sulfur = $mission->trade_sulfur_count;
                                   // Обновляем миссию
                                   $this->db->set('loading_to_start', $mission->mission_start + $time);
                                   $this->db->set('wood', $mission->trade_wood_count);
                                   $this->db->set('wine', $mission->trade_wine_count);
                                   $this->db->set('marble', $mission->trade_marble_count);
                                   $this->db->set('crystal', $mission->trade_crystal_count);
                                   $this->db->set('sulfur', $mission->trade_sulfur_count);
                                   $this->db->set('gold', $mission->gold);
                                   $this->db->set('trade_wood_count', 0);
                                   $this->db->set('trade_wine_count', 0);
                                   $this->db->set('trade_marble_count', 0);
                                   $this->db->set('trade_crystal_count', 0);
                                   $this->db->set('trade_sulfur_count', 0);
                                   $this->db->where(array('id' => $mission->id));
                                   $this->db->update($this->session->userdata('universe').'_missions');
                                   // обновляем чужой город
                                   $this->db->set('branch_trade_wood_count', $trade_town->branch_trade_wood_count - $mission->trade_wood_count);
                                   $this->db->set('branch_trade_wine_count', $trade_town->branch_trade_wine_count - $mission->trade_wine_count);
                                   $this->db->set('branch_trade_marble_count', $trade_town->branch_trade_marble_count - $mission->trade_marble_count);
                                   $this->db->set('branch_trade_crystal_count', $trade_town->branch_trade_crystal_count - $mission->trade_crystal_count);
                                   $this->db->set('branch_trade_sulfur_count', $trade_town->branch_trade_sulfur_count - $mission->trade_sulfur_count);
                                   $this->db->where(array('id' => $mission->to));
                                   $this->db->update($this->session->userdata('universe').'_towns');
                                   // Обновляем игрока
                                   $user = $this->Data_Model->temp_users_db[$trade_town->user];
                                   $this->db->set('gold', $user->gold + $gold);
                                   $this->db->where(array('id' => $user->id));
                                   $this->db->update($this->session->userdata('universe').'_users');
                               }
                               else
                               {
                                   $text = 'Ваш торговый флот ушел из <a href="'.$this->config->item('base_url').'game/island/'.$this->Data_Model->temp_towns_db[$mission->to]->island.'/'.$mission->from.'/">'.$this->CI->Data_Model->temp_towns_db[$mission->to]->name.'</a> пустым и теперь возвращается в <a href="'.$this->config->item('base_url').'game/island/'.$this->Data_Model->temp_towns_db[$mission->from]->island.'/'.$mission->to.'/">'.$this->CI->Data_Model->temp_towns_db[$mission->from]->name.'</a>.';
                                   $town_message = array(
                                       'user' => $mission->user,
                                       'town' => $mission->from,
                                       'date' => $mission->mission_start + $time,
                                       'text' => $text
                                   );
                                   $towns_messages[] = $town_message;
                                   $mission->loading_to_start = $mission->mission_start + $time;
                                   $loading_end = 0;
                               }
                           }
                       }
                       if ($mission->loading_to_start > 0 and $loading_end <= 0)
                       {
                           if($mission->mission_type == 1)
                           {
                               // Колонизация
                               $this->CI->Data_Model->temp_towns_db[$mission->to]->pos0_level = 1;
                               $this->db->set('pos0_level', 1);
                               $this->db->set('wood', $mission->wood-1000);
                               $this->db->set('wine', $mission->wine);
                               $this->db->set('marble', $mission->marble);
                               $this->db->set('crystal', $mission->crystal);
                               $this->db->set('sulfur', $mission->sulfur);
                               $this->db->set('last_update', $mission->mission_start + $time);
                               $this->db->where(array('id' => $mission->to));
                               $this->db->update($this->session->userdata('universe').'_towns');
                               // Добавляем армию
                               $this->db->insert($this->session->userdata('universe').'_army', array('city' => $mission->to));
                               // Сообщение
                               $text = 'Мы основали новый город (<a href="'.$this->config->item('base_url').'game/island/'.$this->Data_Model->temp_towns_db[$mission->to]->island.'/'.$mission->to.'/">'.$this->CI->Data_Model->temp_towns_db[$mission->to]->name.'</a>). Ваш торговый флот выгрузил: <ul class="resources">';
                               $text .= '<li class="wood"><span class="textLabel">Стройматериалы: </span>'.($mission->wood-1000).'</li>';
                               if ($mission->wine > 0){$text .= '<li class="wine"><span class="textLabel">Виноград: </span>'.($mission->wine).'</li>';}
                               if ($mission->marble > 0){$text .= '<li class="marble"><span class="textLabel">Мрамор: </span>'.($mission->marble).'</li>';}
                               if ($mission->crystal > 0){$text .= '<li class="glass"><span class="textLabel">Хрусталь: </span>'.($mission->crystal).'</li>';}
                               if ($mission->sulfur > 0){$text .= '<li class="sulfur"><span class="textLabel">Сера: </span>'.($mission->sulfur).'</li>';}
                               $text .= '</ul>';
                               $town_message = array(
                                            'user' => $mission->user,
                                            'town' => $mission->from,
                                            'date' => $mission->mission_start + $time + $loading_time,
                                            'text' => $text
                                        );
                               $towns_messages[] = $town_message;
                               // возвращаем сухогрузы
                               $this->db->query('UPDATE '.$this->session->userdata('universe').'_users set `transports`=`transports`+'.$mission->ship_transport.' WHERE `id`='.$mission->id);
                               if($mission->user == $this->Player_Model->user->id)
                               {
                                   $this->Player_Model->user->transports =  $this->Player_Model->user->transports + $mission->ship_transport;

                               }
                               $this->db->query('DELETE FROM '.$this->session->userdata('universe').'_missions where `id`="'.$mission->id.'"');
                               unset($this->Player_Model->missions[$mission->id]);
                           }
                           elseif($mission->mission_type == 2)
                           {
                                   // Транспортировка и покупка
                                   $this->db->set('wood', $this->CI->Data_Model->temp_towns_db[$mission->to]->wood + $mission->wood);
                                   $this->db->set('wine', $this->CI->Data_Model->temp_towns_db[$mission->to]->wine + $mission->wine);
                                   $this->db->set('marble', $this->CI->Data_Model->temp_towns_db[$mission->to]->marble + $mission->marble);
                                   $this->db->set('crystal', $this->CI->Data_Model->temp_towns_db[$mission->to]->crystal + $mission->crystal);
                                   $this->db->set('sulfur', $this->CI->Data_Model->temp_towns_db[$mission->to]->sulfur + $mission->sulfur);
                                   $this->db->set('last_update', $mission->mission_start + $time);
                                   $this->db->where(array('id' => $mission->to));
                                   $this->db->update($this->session->userdata('universe').'_towns');
                                   // Сообщение
                                   $text = '';
                                   if ($mission->wood > 0){ $text .= '<li class="wood"><span class="textLabel">Стройматериалы: </span>'.($mission->wood).'</li>';}
                                   if ($mission->wine > 0){$text .= '<li class="wine"><span class="textLabel">Виноград: </span>'.($mission->wine).'</li>';}
                                   if ($mission->marble > 0){$text .= '<li class="marble"><span class="textLabel">Мрамор: </span>'.($mission->marble).'</li>';}
                                   if ($mission->crystal > 0){$text .= '<li class="glass"><span class="textLabel">Хрусталь: </span>'.($mission->crystal).'</li>';}
                                   if ($mission->sulfur > 0){$text .= '<li class="sulfur"><span class="textLabel">Сера: </span>'.($mission->sulfur).'</li>';}
                                   $text .= '</ul>';
                                   $text_from = 'Ваш торговый флот из <a href="'.$this->config->item('base_url').'game/island/'.$this->Data_Model->temp_towns_db[$mission->from]->island.'/'.$mission->from.'/">'.$this->CI->Data_Model->temp_towns_db[$mission->from]->name.'</a> прибыл в <a href="'.$this->config->item('base_url').'game/island/'.$this->Data_Model->temp_towns_db[$mission->to]->island.'/'.$mission->to.'/">'.$this->CI->Data_Model->temp_towns_db[$mission->to]->name.'</a> и привез следующие товары: <ul class="resources">'.$text;
                                   if ($mission->user != $trade_town->user)
                                   {        
                                       $text_to = 'Торговый флот из <a href="'.$this->config->item('base_url').'game/island/'.$this->Data_Model->temp_towns_db[$mission->from]->island.'/'.$mission->from.'/">'.$this->CI->Data_Model->temp_towns_db[$mission->from]->name.'</a> прибыл в ваш город <a href="'.$this->config->item('base_url').'game/island/'.$this->Data_Model->temp_towns_db[$mission->to]->island.'/'.$mission->to.'/">'.$this->CI->Data_Model->temp_towns_db[$mission->to]->name.'</a> и привез следующие товары: <ul class="resources">'.$text;
                                       $town_to_message = array(
                                                'user' => $trade_town->user,
                                                'town' => $mission->to,
                                                'date' => $mission->mission_start + $time,
                                                'text' => $text_to
                                            );
                                       $towns_messages[] = $town_to_message;
                                   }
                                   $town_from_message = array(
                                                'user' => $mission->user,
                                                'town' => $mission->from,
                                                'date' => $mission->mission_start + $time,
                                                'text' => $text_from
                                            );
                                   $towns_messages[] = $town_from_message;

                               if ($this->CI->Data_Model->temp_towns_db[$mission->to]->user == $mission->user)
                               {
                                   $this->db->query('UPDATE '.$this->session->userdata('universe').'_users set `transports`=`transports`+'.$mission->ship_transport.' WHERE `id`='.$mission->id);
                                   if($mission->user == $this->Player_Model->user->id)
                                   {
                                       $this->Player_Model->user->transports =  $this->Player_Model->user->transports + $mission->ship_transport;

                                   }
                                   $this->db->query('DELETE FROM '.$this->session->userdata('universe').'_missions where `id`="'.$mission->id.'"');
                               }
                               else
                               {
                                   if($mission->return_start == 0)
                                   {
                                            $this->db->set('return_start', $mission->mission_start + $time + $loading_time);
                                            $this->db->set('loading_to_start', $mission->mission_start + $time + $loading_time);
                                            $this->db->set('percent', 1);
                                            $this->db->set('wood', 0);
                                            $this->db->set('wine', 0);
                                            $this->db->set('marble', 0);
                                            $this->db->set('crystal', 0);
                                            $this->db->set('sulfur', 0);
                                        
                                        $this->db->where(array('id' => $mission->id));
                                        $this->db->update($this->session->userdata('universe').'_missions');
                                   }
                               }
                               unset($this->Player_Model->missions[$mission->id]);
                           }
                           elseif($mission->mission_type == 3 and $mission->loading_to_start > 0)
                           {
                               if($mission->return_start == 0)
                               {
                                   $this->db->set('return_start', $mission->mission_start + $time + $loading_time);
                                   $this->db->set('loading_to_start', $mission->mission_start + $time + $loading_time);
                                   $this->db->set('percent', 1);
                                   $this->db->where(array('id' => $mission->id));
                                   $this->db->update($this->session->userdata('universe').'_missions');
                               }
                           }
                           elseif($mission->mission_type == 4)
                           {
                               $gold = 0;
                               if ($mission->wood > 0 and $trade_town->branch_trade_wood_type == 0 and $mission->trade_wood_cost >= $trade_town->branch_trade_wood_cost)
                               {
                                   $wood = ($mission->wood > $trade_town->branch_trade_wood_count) ? $trade_town->branch_trade_wood_count : $mission->wood;
                                   $mission->gold = $mission->wood*$mission->trade_wood_cost;
                               }
                               else
                               {
                                   $wood = 0;
                               }
                               if ($mission->wine > 0 and $trade_town->branch_trade_wine_type == 0 and $mission->trade_wine_cost >= $trade_town->branch_trade_wine_cost)
                               {
                                   $wine = ($mission->wine > $trade_town->branch_trade_wine_count) ? $trade_town->branch_trade_wine_count : $mission->wine;
                                   $mission->gold = $mission->wine*$mission->trade_wine_cost;
                               }
                               else
                               {
                                   $wine = 0;
                               }
                               if ($mission->marble > 0 and $trade_town->branch_trade_marble_type == 0 and $mission->trade_marble_cost >= $trade_town->branch_trade_marble_cost)
                               {
                                   $marble = ($mission->marble > $trade_town->branch_trade_marble_count) ? $trade_town->branch_trade_marble_count : $mission->marble;
                                   $mission->gold = $mission->marble*$mission->trade_marble_cost;
                               }
                               else
                               {
                                   $marble = 0;
                               }
                               if ($mission->crystal > 0 and $trade_town->branch_trade_crystal_type == 0 and $mission->trade_crystal_cost >= $trade_town->branch_trade_crystal_cost)
                               {
                                   $crystal = ($mission->crystal > $trade_town->branch_trade_crystal_count) ? $trade_town->branch_trade_crystal_count : $mission->crystal;
                                   $mission->gold = $mission->crystal*$mission->trade_crystal_cost;
                               }
                               else
                               {
                                   $crystal = 0;
                               }
                               if ($mission->sulfur > 0 and $trade_town->branch_trade_sulfur_type == 0 and $mission->trade_sulfur_cost >= $trade_town->branch_trade_sulfur_cost)
                               {
                                   $sulfur = ($mission->sulfur > $trade_town->branch_trade_sulfur_count) ? $trade_town->branch_trade_sulfur_count : $mission->sulfur;
                                   $mission->gold = $mission->sulfur*$mission->trade_sulfur_cost;
                               }
                               else
                               {
                                   $sulfur = 0;
                               }
                               if ($wood > 0 or $wine > 0 or $crystal > 0 or $marble > 0 or $sulfur > 0)
                               {
                                   $text = '';
                                   if ($wood > 0){ $text .= '<li class="wood"><span class="textLabel">Стройматериалы: </span>'.($wood).'</li> по цене:<li class="gold"><span class="textLabel">Золото: </span>'.$trade_town->branch_trade_wood_cost.'</li><br>';}
                                   if ($wine > 0){$text .= '<li class="wine"><span class="textLabel">Виноград: </span>'.($wine).'</li> по цене:<li class="gold"><span class="textLabel">Золото: </span>'.$trade_town->branch_trade_wine_cost.'</li><br>';}
                                   if ($crystal > 0){$text .= '<li class="marble"><span class="textLabel">Мрамор: </span>'.($marble).'</li> по цене:<li class="gold"><span class="textLabel">Золото: </span>'.$trade_town->branch_trade_marble_cost.'</li><br>';}
                                   if ($marble > 0){$text .= '<li class="glass"><span class="textLabel">Хрусталь: </span>'.($crystal).'</li> по цене:<li class="gold"><span class="textLabel">Золото: </span>'.$trade_town->branch_trade_crystal_cost.'</li><br>';}
                                   if ($sulfur > 0){$text .= '<li class="sulfur"><span class="textLabel">Сера: </span>'.($sulfur).'</li> по цене:<li class="gold"><span class="textLabel">Золото: </span>'.$trade_town->branch_trade_sulfur_cost.'</li><br>';}
                                   $text .= '</ul>';
                                   // Сообщение отправителю
                                   $text_from = 'Ваш торговый флот из <a href="'.$this->config->item('base_url').'game/island/'.$this->Data_Model->temp_towns_db[$mission->from]->island.'/'.$mission->from.'/">'.$this->CI->Data_Model->temp_towns_db[$mission->from]->name.'</a> прибыл в <a href="'.$this->config->item('base_url').'game/island/'.$this->Data_Model->temp_towns_db[$mission->to]->island.'/'.$mission->to.'/">'.$this->CI->Data_Model->temp_towns_db[$mission->to]->name.'</a> и выгрузил: <ul class="resources">'.$text;
                                   $town_from_message = array(
                                       'user' => $mission->user,
                                       'town' => $mission->from,
                                       'date' => $mission->mission_start + $time,
                                       'text' => $text_from
                                   );
                                   if ($mission->user != $trade_town->user)
                                   {
                                       // Сообщение получателю
                                       $text_to = 'Торговый флот из <a href="'.$this->config->item('base_url').'game/island/'.$this->Data_Model->temp_towns_db[$mission->from]->island.'/'.$mission->from.'/">'.$this->CI->Data_Model->temp_towns_db[$mission->from]->name.'</a> прибыл в ваш город <a href="'.$this->config->item('base_url').'game/island/'.$this->Data_Model->temp_towns_db[$mission->to]->island.'/'.$mission->to.'/">'.$this->CI->Data_Model->temp_towns_db[$mission->to]->name.'</a> и выгрузил: <ul class="resources">'.$text;
                                       $town_to_message = array(
                                           'user' => $trade_town->user,
                                           'town' => $mission->to,
                                           'date' => $mission->mission_start + $time,
                                           'text' => $text_to
                                       );
                                       $towns_messages[] = $town_to_message;
                                   }
                                   $towns_messages[] = $town_from_message;
                                   // Ресурсы
                                   $mission->wood = $mission->wood - $wood;
                                   $mission->wine = $mission->wine - $wine;
                                   $mission->marble = $mission->marble - $marble;
                                   $mission->crystal = $mission->crystal - $crystal;
                                   $mission->sulfur = $mission->sulfur - $sulfur;
                                   // Обновляем миссию
                                   $this->db->set('return_start', $mission->mission_start + $time + $loading_time);
                                   $this->db->set('loading_to_start', $mission->mission_start + $time + $loading_time);
                                   $this->db->set('percent', 1);
                                   $this->db->set('wood', $mission->wood);
                                   $this->db->set('wine', $mission->wine);
                                   $this->db->set('marble', $mission->marble);
                                   $this->db->set('crystal', $mission->crystal);
                                   $this->db->set('sulfur', $mission->sulfur);
                                   $this->db->set('gold', $mission->gold);
                                   $this->db->where(array('id' => $mission->id));
                                   $this->db->update($this->session->userdata('universe').'_missions');
                                   // обновляем чужой город
                                   $this->db->set('branch_trade_wood_count', $trade_town->branch_trade_wood_count - $wood);
                                   $this->db->set('branch_trade_wine_count', $trade_town->branch_trade_wine_count - $wine);
                                   $this->db->set('branch_trade_marble_count', $trade_town->branch_trade_marble_count - $marble);
                                   $this->db->set('branch_trade_crystal_count', $trade_town->branch_trade_crystal_count - $crystal);
                                   $this->db->set('branch_trade_sulfur_count', $trade_town->branch_trade_sulfur_count - $sulfur);
                                   $this->db->set('wood', $trade_town->wood + $wood);
                                   $this->db->set('wine', $trade_town->wine + $wine);
                                   $this->db->set('marble', $trade_town->marble + $marble);
                                   $this->db->set('crystal', $trade_town->crystal + $crystal);
                                   $this->db->set('sulfur', $trade_town->sulfur + $sulfur);
                                   $this->db->where(array('id' => $mission->to));
                                   $this->db->update($this->session->userdata('universe').'_towns');
                                   
                               }
                           }
                       }
                   }
                   else
                   {
                       if ($return_end <= 0 or ($loading_end == 0 and $this->CI->Data_Model->temp_towns_db[$mission->to]->user == $mission->user))
                       {
                           // Время вышло, значит вернулись
                           if ($mission->mission_type == 1)
                           {
                               // Если колонизация, то удаляем данные о колонии
                               $this->db->set('city'.$this->CI->Data_Model->temp_towns_db[$mission->to]->position, 0);
                               $this->db->where(array('id' => $this->CI->Data_Model->temp_towns_db[$mission->to]->island));
                               $this->db->update($this->session->userdata('universe').'_islands');
                               $this->db->query('DELETE FROM '.$this->session->userdata('universe').'_towns where `id`="'.$mission->to.'"');
                           }
                           if ($mission->wood > 0 or $mission->wine > 0 or $mission->marble > 0 or $mission->crystal > 0 or $mission->sulfur > 0 or $mission->peoples > 0 or $mission->gold > 0)
                           {
                               // Возвращаем ресурсы
                               if($mission->user == $this->Player_Model->user->id)
                               {
                                   $this->Player_Model->towns[$mission->from]->wood = $this->Player_Model->towns[$mission->from]->wood +  $mission->wood;
                                   $this->Player_Model->towns[$mission->from]->wine = $this->Player_Model->towns[$mission->from]->wine +  $mission->wine;
                                   $this->Player_Model->towns[$mission->from]->marble = $this->Player_Model->towns[$mission->from]->marble +  $mission->marble;
                                   $this->Player_Model->towns[$mission->from]->crystal = $this->Player_Model->towns[$mission->from]->crystal +  $mission->crystal;
                                   $this->Player_Model->towns[$mission->from]->sulfur = $this->Player_Model->towns[$mission->from]->sulfur +  $mission->sulfur;
                                   $this->Player_Model->towns[$mission->from]->peoples = $this->Player_Model->towns[$mission->from]->peoples +  $mission->peoples;
                                   $this->Player_Model->user->gold = $this->Player_Model->user->gold + $mission->gold;
                               }
                               $this->db->query('UPDATE '.$this->session->userdata('universe').'_towns SET `wood`=`wood`+'.$mission->wood.',`wine`=`wine`+'.$mission->wine.',`marble`=`marble`+'.$mission->marble.',`crystal`=`crystal`+'.$mission->crystal.',`sulfur`=`sulfur`+'.$mission->sulfur.',`peoples`=`peoples`+'.$mission->peoples.' WHERE `id`='.$mission->from);
                               $this->db->query('UPDATE '.$this->session->userdata('universe').'_users SET `gold`=`gold`+'.$mission->gold.' WHERE `id`='.$mission->user);

                               // Отправляем сообщение
                               $text = 'Ваш торговый флот из <a href="'.$this->config->item('base_url').'game/island/'.$this->Data_Model->temp_towns_db[$mission->from]->island.'/'.$mission->from.'/">'.$this->CI->Data_Model->temp_towns_db[$mission->from]->name.'</a> вернулся';
                               if ($mission->gold > 0 or $mission->wood > 0 or $mission->wine > 0 or $mission->marble > 0 or $mission->crystal > 0 or $mission->sulfur > 0)
                               {
                                   $text .= ' и выгрузил следующие товары: <ul class="resources">';
                                   if ($mission->gold > 0){ $text .= '<li class="gold"><span class="textLabel">Золото: </span>'.($mission->gold).'</li>';}
                                   if ($mission->wood > 0){ $text .= '<li class="wood"><span class="textLabel">Стройматериалы: </span>'.($mission->wood).'</li>';}
                                   if ($mission->wine > 0){$text .= '<li class="wine"><span class="textLabel">Виноград: </span>'.($mission->wine).'</li>';}
                                   if ($mission->marble > 0){$text .= '<li class="marble"><span class="textLabel">Мрамор: </span>'.($mission->marble).'</li>';}
                                   if ($mission->crystal > 0){$text .= '<li class="glass"><span class="textLabel">Хрусталь: </span>'.($mission->crystal).'</li>';}
                                   if ($mission->sulfur > 0){$text .= '<li class="sulfur"><span class="textLabel">Сера: </span>'.($mission->sulfur).'</li>';}
                                   $text .= '</ul>';
                               }
                               else $text .= '.';
                               $town_message = array(
                                   'user' => $mission->user,
                                   'town' => $mission->from,
                                   'date' => $mission->return_start + $time,
                                   'text' => $text
                               );
                               $towns_messages[] = $town_message;
                            }
                            // возвращаем сухогрузы
                            $this->db->query('UPDATE '.$this->session->userdata('universe').'_users set `transports`=`transports`+'.$mission->ship_transport.', `gold`=`gold`+'.$mission->gold.' WHERE `id`='.$mission->id);
                            if($mission->user == $this->Player_Model->user->id)
                            {
                                $this->Player_Model->user->transports =  $this->Player_Model->user->transports + $mission->ship_transport;
                            }
                            $this->db->query('DELETE FROM '.$this->session->userdata('universe').'_missions where `id`="'.$mission->id.'"');
                            
                            unset($this->Player_Model->missions[$mission->id]);
                       }
                   }
               }
           }

           $this->Send_Messages($towns_messages);
    }

    function Send_Messages($towns_messages)
    {
           // Отправляем сообщения
           if (SizeOf($towns_messages) > 0)
           foreach($towns_messages as $message_data)
           {
               $this->db->insert($this->session->userdata('universe').'_town_messages', $message_data);
           }
    }

    function Send_Spyes_Messages($spyes_messages)
    {
           // Отправляем сообщения
           if (SizeOf($spyes_messages) > 0)
           foreach($spyes_messages as $message_data)
           {
               $this->db->insert($this->session->userdata('universe').'_spy_messages', $message_data);
           }
    }

    function Update_Trade_Routes()
    {
        $towns_messages = array();
        foreach($this->Player_Model->trade_routes as $route)
        {
            while(time() >= $route->update_time)
            {
                $resource_name = $this->Data_Model->resource_class_by_type($route->send_resource);
                if ($this->Player_Model->towns[$route->from]->$resource_name >= $route->send_count)
                {
                    $transports = ceil($route->send_count/$this->config->item('transport_capacity'));
                    if ($this->Player_Model->user->transports >= $transports and $this->Player_Model->towns[$route->from]->actions > 0)
                    {
                        // Вычитаем ресурсы и баллы
                        $this->Player_Model->towns[$route->from]->$resource_name = $this->Player_Model->towns[$route->from]->$resource_name - $route->send_count;
                         $this->Player_Model->towns[$route->from]->actions =  $this->Player_Model->towns[$route->from]->actions - 1;
                        $this->db->set($resource_name, $this->Player_Model->towns[$route->from]->$resource_name);
                        $this->db->set('actions', $this->Player_Model->towns[$route->from]->actions);
                        $this->db->where(array('id' => $route->from));
                        $this->db->update($this->session->userdata('universe').'_towns');
                        // Вычитаем сухогрузы
                        $this->Player_Model->user->transports = $this->Player_Model->user->transports - $transports;
                        $this->db->set('transports', $this->Player_Model->user->transports);
                        $this->db->where(array('id' => $this->Player_Model->user->id));
                        $this->db->update($this->session->userdata('universe').'_users');
                        // Добавляем миссию
                        $this->db->insert($this->session->userdata('universe').'_missions', array('user' => $route->user, 'from' => $route->from, 'to' => $route->to, 'loading_from_start' => $route->update_time, 'mission_type' => 2, $resource_name => $route->send_count, 'ship_transport' => $transports));
                        $text = 'Стартовала торговая миссия по маршруту до '.$this->Player_Model->towns[$route->from]->name.'.';
                        $town_message = array(
                                   'user' => $route->user,
                                   'town' => $route->from,
                                   'date' => $route->update_time,
                                   'text' => $text
                               );
                        $towns_messages[] = $town_message;
                    }
                }
                $route->update_time = $route->update_time + 86400;
            }
            
            $this->db->set('update_time', $route->update_time);
            $this->db->where(array('id' => $route->id));
            $this->db->update($this->session->userdata('universe').'_trade_routes');
        }
        $this->Send_Messages($towns_messages);
    }

    function Update_Spyes($town_id)
    {
        $spyes_messages = array();
        foreach($this->Player_Model->spyes[$town_id] as $spy)
        {
            if($spy->mission_type > 0)
            {
                $this->Data_Model->Load_Town($spy->to);
                $town = $this->Data_Model->temp_towns_db[$spy->to];
                $this->Data_Model->Load_Island($town->island);
                $island = $this->Data_Model->temp_islands_db[$town->island];
                $x1 = $this->Player_Model->islands[$this->Player_Model->towns[$town_id]->island]->x;
                $x2 = $island->x;
                $y1 = $this->Player_Model->islands[$this->Player_Model->towns[$town_id]->island]->y;
                $y2 = $island->y;
                $time = $this->Data_Model->spy_time_by_coords($x1,$x2,$y1,$y2);
                $to_position = $this->Data_Model->get_position(14, $town);
                $to_text = 'pos'.$to_position.'_level';
                $to_level = ($to_position > 0) ? $town->$to_text : 0;
                $risk = ($spy->mission_type == 2) ? 0 :$this->Data_Model->spy_risk_by_mission($spy->mission_type)+$spy->risk+(5*$town->spyes)+(2*$to_level)-(2*$town->pos0_level)-(2*$this->Player_Model->levels[$town_id][14]);
                if ($spy->mission_type == 1)
                {
                    $risk = ($risk < 5) ? 5 : $risk;
                }
                else
                {
                    $risk = ($risk < 0) ? 0 : $risk;
                }
                if (($time+$spy->mission_start) <= time())
                {
                    $chance = rand(0, 100);
                    if ($chance >= $risk)
                    {
                        switch($spy->mission_type)
                        {
                            case 1:
                                $spyes_messages[] = array(
                                    'user' => $spy->user,
                                    'spy' => $spy->id,
                                    'from' => $spy->from,
                                    'to' => $spy->to,
                                    'mission' => $spy->mission_type,
                                    'date' => $spy->mission_start + $time,
                                    'desc' => 'Ваш шпион прибыл в '.$town->name.'.',
                                    'text' => 'Ваш шпион прибыл в '.$town->name.'.'
                                );
                                $this->Player_Model->spyes[$town_id][$spy->id]->mission_type = 0;
                                $this->Player_Model->spyes[$town_id][$spy->id]->mission_start = 0;
                                $this->Player_Model->spyes[$town_id][$spy->id]->risk = $risk;
                                $this->db->set('mission_type', $this->Player_Model->spyes[$town_id][$spy->id]->mission_type);
                                $this->db->set('mission_start', $this->Player_Model->spyes[$town_id][$spy->id]->mission_start);
                                $this->db->set('risk', $this->Player_Model->spyes[$town_id][$spy->id]->risk);
                                $this->db->where(array('id' => $spy->id));
                                $this->db->update($this->session->userdata('universe').'_spyes');
                            break;
                            case 2:
                                $spyes_messages[] = array(
                                    'user' => $spy->user,
                                    'spy' => $spy->id,
                                    'from' => $spy->from,
                                    'to' => $spy->to,
                                    'mission' => $spy->mission_type,
                                    'date' => $spy->mission_start + $time,
                                    'desc' => 'Доклад о возвращении из '.$town->name.'.',
                                    'text' => 'Шпион вернулся.'
                                );
                                $this->Player_Model->towns[$town_id]->spyes++;
                                $this->db->set('spyes', $this->Player_Model->towns[$town_id]->spyes);
                                $this->db->where(array('id' => $town_id));
                                $this->db->update($this->session->userdata('universe').'_towns');
                                $this->db->delete($this->session->userdata('universe').'_spyes', array('id' => $spy->id));
                                unset($this->Player_Model->spyes[$town_id][$spy->id]);
                            break;
                        }
                    }
                    else
                    {
                        $chance = rand(0, 2);
                        if($chance == 0)
                        {
                            $chance = (100-$risk) < 0 ? 0 : 100-$risk;
                            $spyes_messages[] = array(
                                'user' => $spy->user,
                                'spy' => $spy->id,
                                'from' => $spy->from,
                                'to' => $spy->to,
                                'mission' => 0,
                                'date' => $spy->mission_start + $time,
                                'desc' => 'Ваш шпион не выходит на связь.',
                                'text' => 'Ваш шпион не выходит на связь. Возможно, его раскрыли. Шанс на удачу: '.$chance.' %.'
                            );
                            $this->db->delete($this->session->userdata('universe').'_spyes', array('id' => $spy->id));
                            unset($this->Player_Model->spyes[$town_id][$spy->id]);
                        }
                        else
                        {
                            $spyes_messages[] = array(
                                'user' => $spy->user,
                                'spy' => $spy->id,
                                'from' => $spy->from,
                                'to' => $spy->to,
                                'mission' => 0,
                                'date' => $spy->mission_start + $time,
                                'desc' => 'Задание отменено...',
                                'text' => 'Шпион был обнаружен, но сумел вовремя скрыться. Он возвращается домой...'
                                );
                                $this->Player_Model->spyes[$town_id][$spy->id]->mission_type = 2;
                                $this->db->set('mission_type', $this->Player_Model->spyes[$town_id][$spy->id]->mission_type);
                                $this->db->set('mission_start', $spy->mission_start + $time);
                                $this->db->where(array('id' => $spy->id));
                                $this->db->update($this->session->userdata('universe').'_spyes');
                        }
                    }
                }
            }
        }
        $this->Send_Spyes_Messages($spyes_messages);
    }
}

/* End of file update_model.php */
/* Location: ./system/application/models/update_model.php */