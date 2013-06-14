<div id="mainview">
	<div class="buildingDescription">
		<h1>Alleanza <? echo $param2; ?> [<? echo $param1;?>]</h1>
		<p><? echo $param4;?></p>
	</div>
    <?
	  $this->db->select('*');
      $this->db->where('ally_id', $param5);
	  $query1 = $this->db->get($this->session->userdata('universe').'_alliance_users');
	  if ($query1->num_rows() > 0)
      { 
	  $row = $query1->row_array();
	  $rs = $this->db->query('SELECT SUM(points) AS somma FROM `'.$this->session->userdata('universe').'_users` WHERE id='.$row['user_id'].'');
	  }
// PHP 4 syntax
$row = $rs->row_array();
//echo $row->points;

// PHP 5 syntax
//$query2->row()->points;	 
     echo number_format($row['somma']);	 
	
	?>
	<div class="contentBox01h">
		<h3 class="header"><span class="textLabel">Alleanza</span></h3>
		<div class="content">
			<table cellpadding="0" cellpadding="0" id="allyinfo">
            <tr>
            	<td><? echo $param1;?></td><td><? echo $param2;?></td>
			</tr>
			<tr>
            	<td>Data fondazione:</td><td>non disponibile</td>
			</tr>
			<tr>
            	<td>Membri:</td><td>
				<?
				$this->db->select('user_id');
				$this->db->where('ally_id', $param5);
				$query = $this->db->get($this->session->userdata('universe').'_alleanza_utenti');
				echo $query->num_rows();
				?>
				</td>
			</tr>
			<tr>
            	<td>Descrizione breve:</td><td><? echo $param4;?></td>
			</tr>
			<tr>
            	<td>Collocazione:</td><td>non disponibile ( <?=$param6?> )</td>
			</tr>
			<tr><td>Pagina dell`alleanza:</td><td>non disponibile</td>
            </table>
		</div>
		<div class="footer"></div>
	</div>
            <div class="contentBox01h">
                <h3 class="header"><span class="textLabel">Accordi con tua ally(non disponibile)</span></h3>
                <div class="content">
                non disponibile
				</div>
                <div class="footer"></div>
            </div>
	<div class="contentBox01h" id="internalPage">
		<h3 class="header"><span class="textLabel">Pagina esterna dell`alleanza</span></h3>
		<div class="content">
        <?
		function formatBBCode($text){ 
        $text = eregi_replace("\[i\]","<i>", $text);        
		$text = eregi_replace("\[/i\]","</i>", $text); 
        $text = eregi_replace("\[b\]","<b>", $text); 
        $text = eregi_replace("\[/b\]","</b>", $text); 
        $text = eregi_replace("\[code\]","<pre>", $text); 
        $text = eregi_replace("\[/code\]","</pre>", $text); 
        $text = eregi_replace("\[img\]","<img src=\"", $text);
		$text = eregi_replace("\[/img\]","\">", $text);
		return $text; 
        } 
        echo formatBBCode($param3); 
		
		?>
		</div>
		<div class="footer"></div>
	</div>
</div>
