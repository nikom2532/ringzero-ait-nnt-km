// JavaScript Document

var DIALOG_MESSAGE = "Are you sure you want to delete this ?";
$(document).ready(function() {
	$(".box .box-toggle").bind('click', function(){boxToggle(this);return false;});
	$(".remove-btn").bind('click', function(){messageRemove(this);return false;});
	
		$('a#confirm').live('click', function(e){
			e.preventDefault();

			var href		= $(this).attr('href');
			var removemsg	= $(this).attr('title');

			if (confirm(removemsg || DIALOG_MESSAGE))
			{
				$(this).trigger('click-confirmed');

				if ($.data(this, 'stop-click')){
					$.data(this, 'stop-click', false);
					return;
				}

				//submits it whether uniform likes it or not
				window.location.replace(href);
			}
		});
	
	$(':submit#confirm').live('click', function(){

			var removemsg = $(this).attr('title');

			if (confirm(removemsg || DIALOG_MESSAGE))
			{
				return true;
			}
			else
			{
				return false;
			}
		});
		
	// Check all checkboxes in container table or grid
	$(".check-all").live('click', function () {
		var check_all		= $(this),
			all_checkbox	= $(this).is('.grid-check-all')
				? $(this).parents(".list-items").find(".grid input[type='checkbox']")
				: $(this).parents("table").find("tbody input[type='checkbox']");

		all_checkbox.each(function () {
			if (check_all.is(":checked") && ! $(this).is(':checked'))
			{
				$(this).click();
			}
			else if ( ! check_all.is(":checked") && $(this).is(':checked'))
			{
				$(this).click();
			}
		});

		// Update uniform if enabled
		//$.uniform && $.uniform.update();
	});
		
});

function boxToggle(that) {
	content_box = $(that).parent().parent().parent().find(".box-content");
	box = $(content_box).parent();
	if($(content_box).css("display") == "none") {
		$(content_box).slideDown(200, function(){
			$(box).removeClass("closed").addClass("open");
		});
	}
	else {
		$(content_box).slideUp(200, function(){
			$(box).removeClass("open").addClass("closed");
		});
	}
}

function messageRemove(that) {
	$(that).parent().slideUp(200);
}

function checkNumeric(obj)
{
        if ( isNaN(obj.value) )
        {
            alert('กรุณากรอกตัวเลขเท่านั้น');
            obj.value = obj.value.substr(0, (obj.value.length) - 1);
            return false;
			
        }
 }
 
 function check_char(nChar)
{
	var num=nChar.length;
	var digit;
	
	for(var i=0;i<num;i++)
		{
			digit = nChar.charAt(i);
				if( (digit >= "a" && digit <= "z") || (digit >="0" && digit <="9") || (digit >="A" && digit <="Z") || (digit =="_"))
				{
					return true;
				}
					else{return false;}
				}
}


