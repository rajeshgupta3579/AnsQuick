jQuery(document).ready(function(){
  $("#name").attr('contenteditable','false');
}

$("#editName").click(function(){
    $("#name").attr('contenteditable','true');
    alert("nandas");
})
