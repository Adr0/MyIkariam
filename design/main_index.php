<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
                <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		        <meta name="title" content="MyIkariam">
                <meta name="description" content="Il nuovo rivoluzionario browsergame storico">
<meta name="keywords" content="browsergame, gioco, ikariam, retro ikariam, gdr, gioco strategia">
<meta name="author" content="Alessio Siciliano">
<meta name="copyright" content="Alessio Siciliano 2012">
<meta http-equiv="Reply-to" content="nicoales@live.it">
<meta http-equiv="content-language" content="IT">
<meta http-equiv="Content-Type" content="text/html; iso-8859-2">
<meta name="ROBOTS" content="INDEX,FOLLOW">
<meta name="creation_Date" content="02/02/2012">
<meta name="revisit-after" content="15 days">

                <script type="text/javascript" src="<?=$this->config->item('script_url')?>js/jquery.min.js"></script>
                <link href="<?=$this->config->item('base_url')?>design/start.css" rel="stylesheet" type="text/css" media="screen">
    <script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-28882327-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
	</head>
    <body>
        <div class="products">
        <?=require_once('languages.php')?>
        </div>
        
            <div id="headlogo">
            </div>
            
			<br><br><br><br><br><br><br><br><br>
            <div id="header3"></div>
			<div id="main">
                <div id="wrapper">
                    <div id="links">
                        <a href="#" id="main_index" title="<?=$this->lang->line('link_login_title')?>"><?=$this->lang->line('link_login_text')?></a>
                        <a href="#" id="main_register" title="<?=$this->lang->line('link_register_title')?>"><?=$this->lang->line('link_register_text')?></a>
                        <a href="#" id="main_tour" title="<?=$this->lang->line('link_tour_title')?>"><?=$this->lang->line('link_tour_text')?></a>
                        <a href="<?=$this->config->item('forum_url')?>" target="_blank" title="Forum">Forum</a>
                    </div>
                </div>
                <div id="text">

                </div>
                <br>
            </div>
            <div id="footer"></div>
            <div id="footer2">© 2011 by Idro.</div>
        
    <div id="fuzz">
        <div class="loadbox">
            <img src="<?=$this->config->item('base_url')?>design/ajax-loader.gif">
        </div>
    </div>
    </body>
</html>


        <script>
        $(document).ready(function(){
            $("#fuzz").css("height", $(document).height());

            $("#fuzz").fadeIn();

            $('#text').load('<?=$this->config->item('base_url')?>main/page/<?=$page?>/',function(){$("#fuzz").fadeOut()});
            $("#main_index").click(function(){
                $("#fuzz").fadeIn();
                $('#text').load('<?=$this->config->item('base_url')?>main/page/index/',function(){$("#fuzz").fadeOut()});
            });
            $("#main_register").click(function(){
                $("#fuzz").fadeIn();
                $('#text').load('<?=$this->config->item('base_url')?>main/page/register/',function(){$("#fuzz").fadeOut()});
            });
            $("#main_tour").click(function(){
                $("#fuzz").fadeIn();
                $('#text').load('<?=$this->config->item('base_url')?>main/page/tour/',function(){$("#fuzz").fadeOut()});
            });
        
            $(window).bind("resize", function(){
		$("#fuzz").css("height", $(window).height());
            });
            $(window).bind("scroll", function(){
		$("#fuzz").css("height", $(window).height());
            });
            $(window).scroll(function () {
                $("#fuzz").css("height", $(window).height());
            });
        });
        </script>

