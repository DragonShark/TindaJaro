<script type="text/javascript">
function doAjax(url, callback(data)){
  var timer = function(){
    myTimer()
  };
  var myVar = setInterval(timer, 1000);
  function myTimer() {
    var xmlhttp = XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
        data = responseText;
      }
    }
    xmlhttp.open("GET", url, true);
    xmlhttp.send();
  }
}
</script>
