<div id="mainview">
  <div class="buildingDescription">
    <h1><?=$this->lang->line('agora')?></h1>
  </div>
  <div class="contentBoxMessage">    
    <p class="warning">Su questa agorà non ci sono ancora messaggi. Creando un nuovo messaggio potrai metterti in contatto con i vicini della tua città.</p> 

<?
$querry = $this->db->get_where($this->session->userdata('universe').'_agora', array('isola' => $this->Player_Model->island_id)); 
$this->db->order_by("id", "desc"); 
foreach ($querry->result() as $row)
{
?>
  <div class="contentBoxMessage">
	<div class="contentBox01h">
	<h3 class="header"><span class="textLabel"><? echo $row->autore; ?></span></h3>
	<div class="content"><p>
	<? echo $row->contenuto; ?>
	</p></div>
	<div class="footer"></div>
	</div>
	</div>
	<br>
<?}

?>
</div>
  <FORM method="post" action="<?=$this->config->item('base_url')?>actions/agora/">
   <div style="padding-left: 180px;"><TEXTAREA cols=50 rows=4 WRAP="physical" name="commento"></textarea></div>
   <div style="padding-left: 320px;"><INPUT type="SUBMIT" class="button" value="Invia"></div>
  </FORM>
	  
    <div class="pageBrowser">
        <a href='?view=islandBoard&id=622&page=0'><img src='<?=$this->config->item('style_url')?>skin/img/resource/btn_min.gif'></a> 
		<span class="currentPage">1</span> 
		<a href='?view=islandBoard&id=622&page=0'><img src='<?=$this->config->item('style_url')?>skin/img/resource/btn_max.gif'></a>
	</div>

        
     
</div>