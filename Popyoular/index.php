
<style>
.ui-autocomplete {
    max-height: 50px;
    overflow-y: auto;
    /* prevent horizontal scrollbar */
    overflow-x: hidden;
    /* add padding to account for vertical scrollbar */
    padding-right: 20px;
}
</style>


<script>
function showHint(str) {
    if (str.length == 0) {
        document.getElementById("txtHint").innerHTML = "";
        return;
    } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("txtHint").innerHTML = xmlhttp.responseText;
            }
        }
        xmlhttp.open("GET", "gethint.php?q=" + str, true);
        xmlhttp.send();
    }
}

function complete_txt(title) {
	document.getElementById("txtbox").value = title;
}

function getContent() {


	document.getElementById("txtHint").innerHTML="";
	document.getElementById("content").innerHTML="Loading...";
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById("content").innerHTML = xmlhttp.responseText;
        }
    }
    title = document.getElementById("txtbox").value;
    xmlhttp.open("GET", "getcontent.php?t=" + title, true);
    xmlhttp.send();
}

</script>

<p><b>Start typing a name in the input field below:</b></p>

<table class="ui-autocomplete" >
<tr><td>Title: </td><td><input style="width:300px;" id="txtbox" type="text" onkeyup="showHint(this.value)"></td>
<td><input type="button" onclick="getContent();	" value="Get Reviews" >
</td>
</tr>
<tr><td></td><td id="txtHint"></td></tr>
</table>
<p><span class="ui-autocomplete" id="content"></span></p>
</body>