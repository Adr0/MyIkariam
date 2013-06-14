<?
$this->db->select('ally_founder');
$this->db->where('ally_id', $param2);
$query = $this->db->get($this->session->userdata('universe').'_alleanza');
$row = $query->row(); 
if($row->ally_founder == $this->Player_Model->user->login) {
?>

<div id="mainview">
	<div class="buildingDescription">
		<h1>Modifica dati Alleanza</h1>
	</div>
    <div style="text-align: center">      
		<FORM method="post" action="<?=$this->config->item('base_url')?>actions/embassy/editdati/<?=$param4?>">
		<INPUT type="TEXT" name="name" maxlength="10" size="12" value="<?=$param1?>"><br><br>
		<INPUT type="TEXT" name="tag" maxlength="4" size="12" value="<?=$param2?>"><br><br>
		<textarea rows="20" cols="20" name="descrizione"><?=$param3?></textarea>
	    <br><br>
		<INPUT type="SUBMIT" class="button" value="Invia">
	</div>
         <br>   
	</FORM>
</div>
<? } else {?>
<? echo 'non hai accesso a questa pagina. Il problema può essere nel fatto che non hai i permessi necessari o se sei founder questa non è la tua alleanza';
} ?>
