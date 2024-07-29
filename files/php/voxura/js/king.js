setInterval(function(){
	if($("#loaddiv").length){
		$("#loaddiv").load(location.href+" #loaddiv>*","");
	}
},5000);


$(function() {
	$( "#datepicker1" ).datepicker();
	$( "#datepicker2" ).datepicker();
});

$(document).ready(function(){
		setInterval(function(){
			$(".pisca").css({"visibility":'hidden'});
			setTimeout(function(){
				$(".pisca").css({"visibility":"visible"});
			},300);
		},1000)
})

$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip(); 
});

$(document).ready(function(){
    $('[data-toggle="popover"]').popover(); 
});

$(function() {
        $('#ms').change(function() {
        }).multipleSelect({
            width: '18%',
	    selectAll: true
        });
});

function confirmDel() {
	if(confirm("Deseja Realmente Excluir esse Registro?")) {
		return true;
	} else {
		return false;
	} 
}

