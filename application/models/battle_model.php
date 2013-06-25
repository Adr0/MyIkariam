<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Battle Model.
 *
 * A class to combat a battle between two troops (attacker, and defender).
 * Assuming that the battle takes no survivors for the loser, and whoever has the highest points will win.
 *
 * @author:	HossamZee and XxidroxX.
 * @date:	25/06/2013.
 *
 * TODO: aggiunere come punti al difensore anche il livello delle mura, fare in modo di sistemare l'errore che si crea se il difensore non ha soldati
 *
 */

class Battle_Model extends CI_Model
{
	/** 
	 * Battle system version
	 * @author: XxidroxX.
	 */
	const ENGINE_VERSION = '0.0.1 Alpha 2';
	
	/**
	 * Points for each unit, it reflects the effect of the unit into other.
	 * @author:	HossamZee.
	 */
	public $unitPoints = array();//make it private and use a function to get it
	
	/**
	 * Icons for each unit, it represents a small image for a unit.
	 * @author:	HossamZee.
	 */
	private $unitIcons = array();
	
	/**
	 * A variable to hold attacker troops.
	 * @author:	HossamZee.
	 */
	public $attackerTroops = array();//make it private and use a function to get it
	
	/**
	 * A variable to hold attacker troops (before the battle).
	 * @author:	HossamZee.
	 */
	public $previousAttackerTroops = array();//make it private and use a function to get it
	
	/**
	 * A variable to hold defender troops.
	 * @author:	HossamZee.
	 */
	public $defenderTroops = array(); //make it private and use a function to get it
	
	/**
	 * A variable to hold defender troops (before the battle).
	 * @author:	HossamZee.
	 */
	private $previousDefenderTroops = array();

	/**
	 * A variable to hold attacker points = Segma[1..N] (unitCount * unitPoint).
	 * @author:	HossamZee.
	 */
	private $attackerPoints = null; //era 0
	
	/**
	 * A variable to hold defender points = Segma[1..N] (unitCount * unitPoint).
	 * @author:	HossamZee.
	 */
	private $defenderPoints = null; //era 0
	
	/**
	 * A variable to know the effect of attacker on defender.
	 * @author:	HossamZee.
	 */
	private $attackerToDefender = 0;
	
	/**
	 * A variable to know the effect of defender on attacker.
	 * @author:	HossamZee.
	 */
	private $defenderToAttacker = 0;
	
	/**
	 * Object of the mission
	 * @author: XxidroxX.
	 */
	public $mission, $result, $defender, $wall = null;
	public $data1, $data2, $data3, $barbarian, $warehouses_levels = array();
	
	/**
	 * Construct function
	 * @author: XxidroxX.
	 */
	public function __construct()
	{
	    parent::__construct();
		
		// Load all army points
		for($i = 1; $i <= 15; $i++)
		{
		    $hp = $this->Data_Model->army_cost_by_type($i, $this->Player_Model->research, $this->Player_Model->levels[$this->Player_Model->user->town]);
			$this->unitPoints += array($this->Data_Model->army_class_by_type($i) => $hp['health']);
			$this->unitIcons += array($this->Data_Model->army_class_by_type($i) => base_url().'design/skin/characters/military/x40_y40/y40_'.$this->Data_Model->army_class_by_type($i).'_faceleft.gif');
		}
	}
	
	/**
	 * Load the current mission
	 * @author: XxidroxX.
	 */
	public function Load_Mission($mission)
	{
	    $this->mission = $mission;
	}
	
	/**
	 * Set the attacker troops to start the battle.
	 * @author:	HossamZee.
	 */
	public function setAttackerTroops($attackerTroops)
	{
		$this->attackerTroops = $attackerTroops;
		$this->previousAttackerTroops = $attackerTroops;
	}
	
	/**
	 * Set the defender troops to start the battle.
	 * @author:	HossamZee.
	 */
	public function setDefenderTroops($defenderTroops, $wall, $warehouse, $trade_town)
	{
		$this->defenderTroops = $defenderTroops;
		$this->previousDefenderTroops = $defenderTroops;
		$this->wall = $wall;
		$this->defender = $trade_town;
		$this->warehouses_levels = $warehouse;
	}
	
	/**
	 * Set barbarian defender
	 * @author: XxidroxX
	 */
	public function setBarbarianTroops($barbarianArray)
    {
        $this->barbarian = $barbarianArray;
		$this->previousDefenderTroops['barbarian'] = $this->barbarian['troops'];
	}
	
	/**
	 * Get the attacker troops.
	 * @author:	HossamZee.
	 */
	public function getAttackerTroops()
	{
		return $this->attackerTroops;
	}
	
	/**
	 * Get the defender troops.
	 * @author:	HossamZee.
	 */
	public function getDefenderTroops()
	{
		return $this->defenderTroops;
	}
	
	/**
	 * Calculate the points of troops by applying the formula:
	 * points = Segma[1..N] (unitCount * unitPoint).
	 * @author:	HossamZee.
	 */
	private function calculatePoints($troops)
	{
		$points = 0;
		
		if($this->barbarian['troops'] == 0)
		{
		    foreach ($troops as $unit => $unitPoints)
		    {
			    $points += $this->unitPoints[$unit] * $unitPoints;
		    }
		    //Considero lo mura
		    if($this->wall)
	     	{
		        $points += $this->wall * 5;
		    }
		    if($points == 0) { $points = 1; }
		}
		else
		{
		    $points += $this->barbarian['troops'] * $this->unitPoints['barbarian'] + $this->barbarian['wall'];
		}
		return $points;
	}

	/**
	 * Battle takes place.
	 * @author:	HossamZee.
	 */
	public function battle()
	{	
		$this->attackerPoints = $this->calculatePoints($this->attackerTroops);
		if($this->barbarian['troops'] > 0)
		    $this->defenderPoints = $this->calculatePoints($this->barbarian['troops']);
		else
    		$this->defenderPoints = $this->calculatePoints($this->defenderTroops);

		$attackerRate = $this->attackerPoints/$this->defenderPoints;
		$defenderRate = $this->defenderPoints/$this->attackerPoints;
		
		if ($attackerRate >= 1)
		{
			$defenderRate = $defenderRate/$attackerRate;
		}

		if ($defenderRate >= 1)
		{
			$attackerRate = $attackerRate/$defenderRate;
		}

		if($attackerRate > $defenderRate) // Ha vinto l'attaccante?
		    $this->result = 'win';
		elseif($attackerRate < $defenderRate) // Vince il difensore
		    $this->result = 'lose';
		else
		    $this->result = 'draw'; //Pareggio
			
		$this->calculateAttackerTroopsAfter($defenderRate);
		$this->calculateDefenderTroopsAfter($attackerRate); 
		
		if($this->result == 'win')
		{
		    if($this->barbarian['troops'] > 0)
		        $this->calculateStealResourceFromBarbarianVillage();
		    else
                $this->calculateStealResource();
		}
	}
	
	/*
     * Calculate the resource that the attacker can take from barbarian village.
	 * @author: XxidroxX.
	 */
	public function calculateStealResourceFromBarbarianVillage()
	{
	    // Calcoliamo il numero massimo di risorse che può rubare
		$sres = $Sumcapacity = $this->mission->ship_transport * getConfig('transport_capacity');
        if($sres < 0) $sres = 0;
		
		$stolen_res = 0;
		
		// Tolgo le risorse dalla città
		for($i = 1; $i <= 5; $i++)
        {
            if($i == 5)
			    $class = 'wood';
			else 
			    $class = $this->Data_Model->resource_class_by_type($i);
            				
			if($stolen_res >= $sres) break;
			
			$stolen_res += $this->barbarian[$class];
			$this->data2[$class] = $stolen_res;
	    }
		$where_id = "id = '".$this->mission->id."'"; 
		
		if($this->data2)  
		    $this->db->query($this->db->update_string($this->session->userdata('universe').'_missions', $this->data2, $where_id));
		
		if($this->result == 'win')
		{
		    $this->db->set('barbarian_village', $this->barbarian['level'] + 1);
            $this->db->where('id', $this->barbarian['island']);
            $this->db->update($this->session->userdata('universe').'_islands');
		}

	}
	
	/**
	 * Calculate the resource that the attacker can take
	 * @author: XxidroxX.
	 */
	public function calculateStealResource()
	{
	    // Calcoliamo il numero massimo di risorse che può rubare
		$Sumcapacity = $this->mission->ship_transport * getConfig('transport_capacity');
		
		// Ora però dobbiamo vedere il difensore quante risorse ha nascosto nel nascondiglio
		if($this->warehouses_levels)
		{
			$warehouses = 0;
			foreach($this->warehouses_levels as $name => $level)
			{
			    $warehouses += $level; 
			}
			$resource_hidden = $warehouses * 300; // TODO: we must move this rate in acp
		}
		else 
		    $resource_hidden = 300; // TODO: we must move this rate in acp
				
        $sres = $Sumcapacity - $resource_hidden; // Risorse che posso rubare
        if($sres < 0) $sres = 0;
		
		$stolen_res = 0;
		
		// Tolgo le risorse dalla città
		for($i = 1; $i <= 5; $i++)
        {
            if($i == 5)
			    $class = 'wood';
			else 
			    $class = $this->Data_Model->resource_class_by_type($i);
            				
			if($stolen_res >= $sres) break;
			
			if($this->defender->$class - $Sumcapacity > 0)
			{
				$res_in_town = floor($this->defender->$class - $Sumcapacity);
				$stolen_res += $Sumcapacity;
				$this->data1[$class] = $res_in_town; // Towns
				$this->data2[$class] = $sres; //Missions
		    }
			else 
			{ 
			    if($this->defender->$class - $resource_hidden > 0)
				{
				    $this->data1[$class] = floor($this->defender->$class - $resource_hidden); //Towns
			        $this->data2[$class] = floor($this->defender->$class - $resource_hidden); //Missions
				}
			}
	    }
        unset($this->defender);
        $where1 = "id = '".$this->mission->to."'"; 
		$where2 = "id = '".$this->mission->id."'"; 
		
		if($this->data1) $this->db->query($this->db->update_string($this->session->userdata('universe').'_towns', $this->data1, $where1));
		if($this->data1) $this->db->query($this->db->update_string($this->session->userdata('universe').'_missions', $this->data2, $where2));
	}
	
	/**
	 * Calculate the casualties for attacker after battle.
	 * @author:	HossamZee.
	 */
	private function calculateAttackerTroopsAfter($rate)
	{
		foreach ($this->attackerTroops as $unit => $unitPoints)
		{
			$points = $this->unitPoints[$unit] * $unitPoints;
			$this->attackerTroops[$unit] = round(($points-($points*$rate))/$this->unitPoints[$unit]);
			
			if ($this->attackerTroops[$unit] < 0)
			{
				$this->attackerTroops[$unit] = 0;
			}
		}
	}
	
	/**
	 * Calculate the casualties for defender after battle.
	 * @author:	HossamZee.
	 */
	private function calculateDefenderTroopsAfter($rate)
	{
		if(empty($this->barbarian))
		{
		    foreach ($this->defenderTroops as $unit => $unitPoints)
		    {
			    $points = $this->unitPoints[$unit] * $unitPoints;
			    $this->defenderTroops[$unit] = round(($points-($points*$rate))/$this->unitPoints[$unit]);
			
			    if ($this->defenderTroops[$unit] < 0)
			    {
				    $this->defenderTroops[$unit] = 0;
			    }
		    }  
		}
		else
		{
		    $points = $this->unitPoints['barbarian'] * $this->barbarian['troops'];
			$this->defenderTroops['barbarian'] = round(($points-($points*$rate))/$this->unitPoints['barbarian']);
			
			if ($this->defenderTroops['barbarian'] < 0)
			{
			    $this->defenderTroops['barbarian'] = 0;
			}
		}
	}
	
	/**
     * Represent the troops as in HTML table.
     * @author:    HossamZee.
     */
    private function representTroops($troops, $barbarian = false)
    {
        $html = "<table border='1' style='border-collapse: collapse;' cellpadding='4'>";
        $html .= "<tr>";
        
        if($barbarian == FALSE and !isset($troops['barbarian']))
		{
    		foreach ($this->unitIcons as $name => $icon)
            {
                $html .= "<td><img src='".$icon."' /></td>";
            }
		}
		else
		{
		    $html .= "<td><img src='".$this->unitIcons['barbarian']."' /></td>";
			$html .= "<td><img src='".base_url()."design/skin/buildings/x40_y40/wall.gif' /></td>";
		}
        
        $html .= "</tr><tr>";
        
        if($barbarian == FALSE and !isset($troops['barbarian']))
		{
		    foreach ($this->unitIcons as $name => $unit)
            {
                $count = isset($troops[$name]) ? (int) $troops[$name] : 0;
                $html .= "<td>$count</td>";
            }
		}
		else
		{
		    $html .= "<td>".$troops['barbarian']."</td>";
		    $html .= "<td>".$this->barbarian['wall']."</td";
		}
		
        
		$html .= "</tr>";
        $html .= "</table>";
        
        return $html;
    }

	/**
	 * Represent the stolen resource
	 * @author: XxidroxX.
	 */
	private function representStolenResources()
	{
	    $html = "<table border='1' style='border-collapse: collapse;' cellpadding='4'>";
        $html .= "<tr>";
        
		if(isset($this->data2))
		{
		    foreach ($this->data2 as $name => $icon)
            {
		        $html .= "<td><img src='".base_url()."design/skin/resources/icon_".$name.".gif'/></td>";
            }
		}
        
        $html .= "</tr><tr>";
        
	    if(isset($this->data2))
		{
		    foreach ($this->data2 as $resource => $value)
            {
                $count = isset($this->data2[$resource]) ? (int) $this->data2[$resource] : 0;
		        $html .= "<td>$count</td>";
            }
		}
        
		$html .= "</tr>";
        $html .= "</table>";
        
        return $html;
	}
	
    /**
     * Represent the whole battle as in HTML.
     * @author:    HossamZee.
     */
    public function representBattle()
    {    
        $html  = "<h3>Attacker troops (before)</h3>";
        $html .= $this->representTroops($this->previousAttackerTroops, false);
        
        $html .= "<h3>Defender troops (before)</h3>";
        $html .= $this->representTroops($this->previousDefenderTroops, true);

        $html .= "<h3>Attacker troops (after)</h3>";
        $html .= $this->representTroops($this->attackerTroops, false);
        
        $html .= "<h3>Defender troops (after)</h3>";
        $html .= $this->representTroops($this->defenderTroops, true);
		
		if($this->result == 'win')
		{    
		    $html .= "<h3>Risorse rubate:</h3>";
		    $html .= $this->representStolenResources();
		}
		return $html;
    }
}