<?php
$this->db->select('punti_diplo');
$queryy = $this->db->get_where($this->session->userdata('universe').'_users', array('id' => $this->Player_Model->user->id));
foreach ($queryy->result() as $row)
{
?>

<div class="dynamic">
    <h3 class="header">Influenza</h3>
    <div class="content">
           <p><? echo 'Hai '.$row->punti_diplo.' punti diplomazia'; ?></p>
    </div>
    <div class="footer"></div>
</div>
<?php } 
$delet = $this->db->get_where($this->session->userdata('universe').'_alliance_users', array('user_id' => $this->Player_Model->user->id));
foreach($delet->result() as $row)
{
$id_alleanza = $row->ally_id;
$this->db->select('ally_founder');
$quuery = $this->db->get_where($this->session->userdata('universe').'_alliance', array('ally_id' => $row->ally_id));
foreach ($quuery->result() as $row)
{
 if($row->ally_founder == $this->Player_Model->user->login)
  {
  
?>
<div class="dynamic">
    <h3 class="header">Funzioni</h3>
    <div class="content">
	<div class="centerButton">
            <a href="<?=$this->config->item('base_url')?>actions/embassy/deletally/" class="button">Sciogli alleanza</a>
            <br><br>
			<a href="<?=$this->config->item('base_url')?>game/editextpage/<?=$id_alleanza?>" class="button">Modifica pagina esterna</a>
		    <br><br>
			<a href="<?=$this->config->item('base_url')?>game/editintpage/<?=$id_alleanza?>" class="button">Modifica pagina interna</a>
		    <br><br>
		    <a href="<?=$this->config->item('base_url')?>game/editdati/<?=$id_alleanza?>" class="button">Modifica dati alleanza</a>
	</div></div>
    <div class="footer"></div>
</div>
<?
} else {?>
<div class="dynamic">
    <h3 class="header">Funzioni</h3>
    <div class="content">
	<div class="centerButton">
	        <a href="<?=$this->config->item('base_url')?>game/sendAllyMex/<?=$id_alleanza?>/" class="button">Manda Messaggio Circolare</a>
			<br><br>
            <a href="<?=$this->config->item('base_url')?>actions/embassy/esci/" class="button">Esci</a>		
	</div></div>
    <div class="footer"></div>
</div>
<?php
}
}
}
?>
