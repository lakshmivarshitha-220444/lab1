$(document).ready(function(){

// hover effect on buttons
$("button").hover(function(){
$(this).toggleClass("btn-danger");
});

// show alert when resume clicked
$("#resumeBtn").click(function(){
alert("Resume download will start soon!");
});

// modal dynamic content
$(".viewProject").click(function(){
$(".modal-body").text("Detailed information about the selected project.");
});

});