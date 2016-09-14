$(document).ready(function () {
	$('.preview').popover({
	    'trigger':'hover',
	    'html':true,
	    'content':function(){
	        return "<img src='"+$(this).data('imageUrl')+"'>";
	    }
	});
});