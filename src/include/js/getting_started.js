var step_id = 0;

function NSLGS_confirmDelete(id) {
	step_id = id;
	TB_show('Delete Step', '#TB_inline?height=100&width=350&inlineId=confirmdelete', '', '../images/trans.gif');
}

function NSLGS_deleteStep() {
	window.location = 'admin_getting_started.php?task=delete&step_id='+step_id;
}

function NSLGS_editStep(id, order, title, description) {
	$('step_id').value = id;
	$('order_id').defaultValue = order;
	$('order_id').value = order;
	$('title').defaultValue = title;  
	$('title').value = title;  
	$('description').defaultValue = description;  
	$('description').value = description;

	TB_show('Edit Step', '#TB_inline?height=500&width=560&inlineId=editstep', '', '../images/trans.gif');
}

function NSLGS_addStep(){
	TB_show('Add Step', '#TB_inline?height=500&width=560&inlineId=addstep', '', '../images/trans.gif');
}