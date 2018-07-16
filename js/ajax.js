function getFormData(id){
  var fd = new FormData();
  fd.append("verify_it",1);
  fd.append("id",id);

  return fd;
}


function issue(id){
  try{
    var xhttp = new XMLHttpRequest();
  }catch(e){
    console.log(e);
  }
  var fd = getFormData(id);
  xhttp.open("POST","ajaxphp.php?verify_it=true");
  xhttp.send(fd);
  xhttp.onreadystatechange = function(){
    if(this.readyState==4 && this.status==200){
      if(this.responseText == "Card Issued"){
        document.getElementById("success-alert").style.display = "block";
      }
      else if(this.responseText == "Card Already Issued"){
        document.getElementById("warning-alert").style.display = "block";
      }
    }
  }
}
