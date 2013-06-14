<?
$this->db->select('ally_founder');
$this->db->where('ally_id', $param2);
$query = $this->db->get($this->session->userdata('universe').'_alleanza');
$row = $query->row(); 
if($row->ally_founder == $this->Player_Model->user->login) {
?>

<div id="mainview">
	<div class="buildingDescription">
		<h1>Edit Pagina Esterna dell'alleanza</h1>
	</div>
        <div class="contentBox01h">
		<h3 class="header"><span class="textLabel">Pagina Esterna</span></h3>
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
        echo formatBBCode($param1); 
		?>
		</div><div class="footer"></div>
		</div>
		<br><br>
		<FORM method="post" action="<?=$this->config->item('base_url')?>actions/embassy/editextpage/<?=$param2?>">
		<TEXTAREA cols=90 rows=100 WRAP="physical" name="editextpage">
		<?
		echo $param1;
		?>
		
		</textarea>
	    <br><br>
		
		<div style="text-align: center"><INPUT type="SUBMIT" class="button" value="Invia"></div>
         <br>   
	</FORM>
</div>
<? } else {?>
<? echo 'non hai accesso a questa pagina. Il problema può essere nel fatto che non hai i permessi necessari o se sei founder questa non è la tua alleanza';
} ?>