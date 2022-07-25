function change_login(){
    var a = document.getElementById("login");
    var b = document.getElementById("exit");
    var c = document.getElementById("back");    
    a.style.display = "block";
    b.style.display = "block";
    c.style.display = "block";
}
function exit(){
    var a = document.getElementById("login");
    var b = document.getElementById("exit");
    var c = document.getElementById("back");
    a.style.display = "none";
    b.style.display = "none";
    c.style.display = "none";
}
$(document).ready(function() {
    $(window).scroll(function(event) {
       var pos_body = $('html,body').scrollTop();
       // console.log(pos_body);
       if(pos_body>300){
          $('.header').addClass('hieuung-menu');
       }
       else {
          $('.header').removeClass('hieuung-menu');
       }
    });
 });
 function alertmessage(){
    var a = document.getElementById("alert-message");
    a.style.display = "none";
 }
 function content1(){
    var a = document.getElementById("content1");
    var b = document.getElementById("content2");
    var c = document.getElementById("content3");
    a.style.opacity = 1;
    a.style.visibility = "visible"
    b.style.opacity = 0;
    b.style.visibility = "hidden";
    c.style.opacity = 0;
    c.style.visibility = "hidden";

 }
 function content2(){
   var a = document.getElementById("content1");
   var b = document.getElementById("content2");
   var c = document.getElementById("content3");
   a.style.opacity = 0;
   a.style.visibility = "hidden";
   b.style.opacity = 1;
   b.style.visibility = "visible";
   c.style.opacity = 0;
   c.style.visibility = "hidden";

}
function content3(){
   var a = document.getElementById("content1");
   var b = document.getElementById("content2");
   var c = document.getElementById("content3");
   a.style.opacity = 0;
   a.style.visibility = "hidden";
   b.style.opacity = 0;
   b.style.visibility = "hidden";
   c.style.opacity = 1;
   c.style.visibility = "visible";

}
// $(document).ready(function(){
//      $(document).on('click','#buttonsl2',function(){
//      $('#soluong').val(parseInt($("#soluong").val()) + 1);
//          if ($('#soluong').val() == $('.abc').val()) {
//          $('#soluong').val(1);
//       }
//    });
//     $(document).on('click','#buttonsl1',function(){
//       $('#soluong').val(parseInt($('#soluong').val()) - 1 );
//          if ($('#soluong').val() == 0) {
//            $('#soluong').val(1);
//         }
//        });
// });
function plus(dem){
   var count = document.getElementsByClassName('count');
   var tmp= 0;
   var key = document.getElementsByClassName("abc");
   for(var i = 0; i < count.length; i++){
      if(i == dem){
         tmp = parseInt(count[i].value) + 1;
         count[i].value = tmp;
         if(parseInt(count[i].value) > parseInt(key[i].value)){
            count[i].value = key[i].value;
         }
      }
   }
}
function minus(dem){
   var count = document.getElementsByClassName("count");
   for(var i = 0; i < count.length; i++){
      if(i == dem){
         tmp = parseInt(count[i].value) - 1;
         count[i].value = tmp;
         if(parseInt(count[i].value) <= 0){
            count[i].value = '1';
         }
      }
   }
}