


$(document).ready(()=>{
    $(".usersetting").hide()
  $("#dropdown").click(()=>{
    $(".usersetting").show()
  })
  $("#hider").click(()=>{
    $(".usersetting").hide()
  })
  $("#adddep").click(()=>{
    $("#form-add-department").show()
  })
  $("#addlevel").click(()=>{
    $("#form-add-level").show()
  })
  $("#printdepartment").click(()=>{
    $("body").html($("#tab-department"))
    $("button").hide()
    $("#action").hide()
    $("a").hide()
    var x= print()
  })

  $("#print-level").click(()=>{
    $("body").html($("#tab-level"))
    $("button").hide()
    $("#action").hide()
    $("a").hide()
    var x= print()
  })
  $("#print").click(()=>{
    $("body").html($("table"))
    $("button").hide()
    $("#action").hide()
    $("a").hide()
    var x= print()
  })
   
  $("#addstudent").click(function(){
    $('.form').show()
})
$('#cancel,#cancel2').click(function(){
   $('.form,#form-add-department  ').hide()
})


$("#select").on("input",()=>{
  var department = $("#select").val()
  $.post("assignmodule_trade.php",
            {
              department:department
            },
         function(data,status){
          $(".a").empty()
          $(".a").append(data)

         })
  
})
})


$("#selecttrade").on("input",()=>{
  var trade = $("select").val()
  $.post("marks2.php",
  {
    trade:trade
  },
  function(data,status){
    $(".selectinmarks form #selectcourse").empty()
    $(".selectinmarks form #selectcourse").append(data)
})



})


