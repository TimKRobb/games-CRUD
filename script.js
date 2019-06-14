$(document).ready(function(){

	$("#headerID").on("click",function(){
		$("#sortField").val("ID");
		$("form").submit();
	});

	$("#headerName").on("click",function(){
		$("#sortField").val("name");
		$("form").submit();
	});

	$("#headerYear").on("click",function(){
		$("#sortField").val("year");
		$("form").submit();
	});

	$("#headerGenre").on("click",function(){
		$("#sortField").val("genre");
		$("form").submit();
	});

});