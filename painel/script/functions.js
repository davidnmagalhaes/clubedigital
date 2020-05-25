function highlightEdit(editableObj) {
	$(editableObj).css("background","rgba(253, 253, 253, 0)");
} 

function saveInlineEdit(editableObj,column,id) {
	// no change change made then return false
	if($(editableObj).attr('data-old_value') === editableObj.innerHTML)
	return false;
	// send ajax to update value
	$(editableObj).css("background","rgba(253, 253, 253, 0) url(loader.gif) no-repeat right");
	$.ajax({
		url: "saveInlineEdit.php",
		cache: false,
		data:'column='+column+'&value='+editableObj.innerHTML+'&id='+id,
		success: function(response)  {
			console.log(response);
			// set updated value as old value
			$(editableObj).attr('data-old_value',editableObj.innerHTML);
			$(editableObj).css("background","rgba(253, 253, 253, 0)");			
		}          
   });
}