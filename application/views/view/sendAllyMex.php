<div id="mainview">
    <h1>Vi?t tin nh?n</h1>
    <p>B?n có th? vi?t tin nh?n cho ngu?i choi khác ho?c d? ngh? m?t Hi?p u?c, trong tru?ng h?p b?n dã nghiên c?u ki lu?ng các m?u Hi?p u?c.</p>

    <div id="notice">
        <form action="<?=$this->config->item('base_url')?>actions/messages/sendAllyMex/<?=$param1?>/" method="post">
            <div id="mailRecipient">
                <span class="maillabels"><label>Destinatario:</label></span>
                <span>Messaggio Circolare</span>
            </div>
            <div id="mailSubject">
                <span class="maillabels"><label for="treaties">Oggetto:</label></span>
                <span>
                    <select name="msgType" id="treaties">
                        <option value="1" selected="selected">Nessuno</option>
                    </select>
                </span>
            </div>
            <span class="maillabels"><label for="text">L?i nh?n:</label></span><br />
            <span><textarea id="text" class="textfield" name="content" ></textarea></span><br />
            <div id="nr_chars_div" style="display:none">Cho phép  <span id="nr_chars"></span>&nbsp;  ký t?.</div>
            <div class="centerButton">
                <input type="submit" class="button" onclick="return confirmIfNeccessary(document.getElementById('treaties').value,'?? ????????')" title="G?i" value="G?i">
            </div>
        </form>
  
   </div>
    	<script type="text/javascript">
    function strLen(str) {
        var newStr = str.replace(/(\r\n)|(\n\r)|\r|\n/g,"\n");
        return newStr.length;
    }
    messagesThatNeedConfirm = new Array();
    messagesThatNeedConfirm[0] = 64;
    messagesThatNeedConfirm[1] = 70;
    messagesThatNeedConfirm[2] = 75;
    messagesThatNeedConfirm[3] = 76;
    messagesThatNeedConfirm[4] = 81;
    messagesThatNeedConfirm[5] = 87;
    messagesThatNeedConfirm[6] = 94;
    messagesThatNeedConfirm[7] = 93;
    messagesThatNeedConfirm[8] = 99;
    function confirmIfNeccessary(msgType,confirmText){
        var confirm = false;
        for (elem in messagesThatNeedConfirm) {
            if (messagesThatNeedConfirm[elem] == msgType){
                confirm = true;
            }
        }
        if (confirm == true){
            return window.confirm (confirmText);
        } else{
            return true;
        }

    };
    YAHOO.util.Event.addListener("text", "keyup", function() {
        var nr_chars = 8000-strLen(document.getElementById('text').value);
        if (nr_chars<0) {
            document.getElementById('nr_chars').innerHTML='<span style="color: #f00; font-weight: bold">' + nr_chars + '</span>';
        } else {
            document.getElementById('nr_chars').innerHTML=nr_chars;
        }
        document.getElementById('nr_chars_div').style.display='block';
    });
    </script>
</div>