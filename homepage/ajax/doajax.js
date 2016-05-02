function doAjax(url, id){
  alert("xmlhttp.responseText");
  var timer = function(){
    myTimer()
  };
  var myVar = setInterval(timer, 1000);
  function myTimer() {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
      document.getElementById(id).innerHTML = xmlhttp.responseText;
      }
    }
    xmlhttp.open("GET", url, true);
    xmlhttp.send();
  }
}
