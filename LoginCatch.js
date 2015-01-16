<script language = "javascript" TYPE = "text/javascript">
    var Request = false;
    if (window.XMLHttpRequest)
      {
      Request = new XMLHttpRequest();
      } 
      else if (window.ActiveXObject)
      {
      Request = new ActiveXObject("Microsoft.XMLHTTP");
      }
      function TellStory(url){
        if(Request){
          Request.open("GET",url);
          Request.onreadystatechange = function()
          {
            if (Request.readyState == 4 && Request.status == 200){
              ModifyDOM(Request.responseText)
              UpdateInterface(url)
            }
          }
          Request.send(null);
        }
      }
      function ModifyDOM(storyText){
        var newText = document.createTextNode(storyText);
        var newLine = document.createElement("p");
        document.getElementById('trgtP').appendChild(newLine);
        document.getElementById('trgtP').appendChild(newText);
      }
      function UpdateInterface(selection) {
        if (selection == "data/Part1.txt")appForm.Button1.disabled = "disabled";
        if (selection == "data/Part2.txt")appForm.Button2.disabled = "disabled";
        if (selection == "data/Part3.txt")appForm.Button3.disabled = "disabled";
        if (selection == "data/Part4.txt")appForm.Button4.disabled = "disabled";
      }
 </script>