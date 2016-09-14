$(document).ready(function () {
	var counter = 1;




	/* check if slot names are unique */
	checkNames = function (){
	 	var duplicates = {};
	 	for(i=1; i<=counter;i++){
     		/* get name */
     		var slot = 'slotName'+i;		
     		var tmpName = document.getElementById(slot).value;
     		tmpName = tmpName.trim();
     		duplicates[tmpName] = 0;
	 	}

	 	for(i=1; i<=counter;i++){
     		/* get name */
     		var slot = 'slotName'+i;		
     		var tmpName = document.getElementById(slot).value;
     		tmpName = tmpName.trim();
     		duplicates[tmpName] += 1;
     		if(duplicates[tmpName] > 1){
				document.getElementById('checkSlot'+i).innerHTML = "<font color='#F00'>&#9747;</font>";
			}
			else{
				document.getElementById('checkSlot'+i).innerHTML = "";
			}
	 	}	 	
	 }


	/* picture settings */
	$('#picture').bind('change', function() {

	 	var maxSize = 51200; //50MB = 50*1024kB
	 	var size = this.files[0].size;
	 	var type = this.files[0].type;
	 	size /= 1024;
	 	size = Math.round(size);
	 	if(size > maxSize){
			document.getElementById('fsize').textContent = "File size: "+size+" kB. File is TOO BIG!";
	 	}
	 	else{
			document.getElementById('fsize').textContent = "File size: "+size+" kB.";
		}

	 	if(type != "image/png" && type != "image/jpeg" && type != "image/gif"){
	 		document.getElementById('fsize').textContent = "File type not supported.";
	 		$("#submit").addClass("disabled");
	 		$("#submit").attr("disabled", "disabled");
	 	}else{
	 		$("#submit").removeClass("disabled");
	 		$("#submit").removeAttr("disabled");
	 	}
	});


    $("#picture").change(function () {
    	var reader = new FileReader();

	    reader.onload = function (e) {
	        // get loaded data and render thumbnail.
	        document.getElementById("image").src = e.target.result;
	    };

	    // read the image file as a data URL.
	    reader.readAsDataURL(this.files[0]);
    });

	
	/* field settings */
    $("#buynowprice").change(function () {
    	$("#buynowradio").prop("checked", true);
    });

    $("#removeAuctionTypes").click(function () {
    	$("#buynowradio").prop("checked", false);
    	$("#auctionradio").prop("checked", false);
    });


    $("#moreAuctionInfo").click(function () {
    	var content;
    	content = document.getElementById('moreAuctionInfo').textContent;
    	if(content == "More info (auction, commission,...)"){
    		document.getElementById('moreAuctionInfo').textContent = "Less info";
    	} else {
    		document.getElementById('moreAuctionInfo').textContent = "More info (auction, commission,...)";
    	}
    });

    $("#slotName1").click(function () {
    	$("#auctionradio").prop("checked", true);
    });

    $("#startPrice1").click(function () {
    	$("#auctionradio").prop("checked", true);
    });

    $("#addMoreFields").click(function () {
    	counter++;
    	var div = document.createElement('div');
    	div.className = 'row';

    	div.innerHTML = '<div class="form-group">\
							<div class="container-fluid">\
								<div class="row">\
									<div class="col-md-6">\
										&nbsp; <b>Slot '+counter+'</b>\
									</div>\
								</div>\
								<div class="row">\
									<div class="col-md-6">\
										&nbsp; Slot name:\
									</div>\
									<div class="col-md-5">\
										<input type="text" name="slotName'+counter+'" id="slotName'+counter+'" onKeyUp="checkNames()" value="" style="width:150px;">\
										<span id="checkSlot'+counter+'"></span>\
									</div>\
								</div>\
								<div class="row">\
									<div class="col-md-6">\
										&nbsp; Start price [USD]:\
									</div>\
									<div class="col-md-5">\
										<input type="number" name="startPrice'+counter+'" min="0.5" max="10000" step="0.5" style="width:150px;">\
									</div>\
								</div>\
								<div class="row">\
									<div class="col-md-6">\
										&nbsp; Minimum increment:\
									</div>\
									<div class="col-md-5">\
										<input type="number" name="minimumIncrement'+counter+'" min="0.5" max="100" step="0.5" style="width:150px;">\
									</div>\
								</div>\
								<div class="row">\
									<div class="col-md-6">\
										&nbsp; Autobuy (0: not set):\
									</div>\
									<div class="col-md-5">\
										<input type="number" name="autobuy'+counter+'" min="0" max="10000" step="0.5" value="0" style="width:150px;">\
									</div>\
								</div>\
								<div class="row">\
									<div class="col-md-6">\
										&nbsp; Duration [days]:\
									</div>\
									<div class="col-md-5">\
										<input type="number" name="duration'+counter+'" min="1" max="30" step="1" value="7" style="width:150px;">\
									</div>\
								</div>\
							</div>\
						</div>';

     	document.getElementById('auctionInfo').appendChild(div);
    });

});