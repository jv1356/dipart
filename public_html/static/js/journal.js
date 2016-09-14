$(document).ready(function () {

	deleteConfirm = function (id){
		var id = "#"+id;
		var val = $(id).attr("data-value");
		var ex = val.split("-");
		var u = ex[0];
		var j = ex[1];
    	var response = confirm("Are you sure you want to delete journal?");
    	if(response == true){
    		window.location.href = "/deleteJournal/u/"+u+"/j/"+j+"/";
    	}
	}
});