<table id="Questions" class="sortable">
<thead>
	<tr>
		<th>Question</th>
		<th>Required</th>
		<th>Actions</th>
	</tr>
</thead>
<tbody>
<?php $i = 0; ?>
<?php
foreach ($questionnaire['Question'] as $question) {
	++$i;
	echo $this->element('questionnaire/edit_question', compact('question', 'i'));
}
?>

</tbody>
</table>

<div id="AddQuestionDiv" title="Add Question">
<p><?php __('Type part of the question you want'); ?></p>
<?php
	echo $this->Form->input ('Add.question', array(
			'type' => 'text',
			'autocomplete' => 'off',
			'label' => false,
			'size' => 50,
	));
?>
</div>

<div class="actions">
	<ul>
		<li><?php
		echo $this->Html->link('Add an existing question to this questionnaire', '#', array(
				'onclick' => 'return addQuestion();'
		));
		?></li>
	</ul>
</div>
<div id="temp_update" style="display: none;"></div>

<?php
// Make the table sortable
$this->ZuluruHtml->script (array('jquery.tableSort', 'jquery.autocomplete', 'questionnaire'), array('inline' => false));
$add_question_url = $this->Html->url (array('controller' => 'questionnaires', 'action' => 'add_question'));
$auto_complete_url = $this->Html->url (array('controller' => 'questions', 'action' => 'autocomplete'));
$this->Js->buffer ("
	var last_index = $i;
	$('.sortable').tableSort(tableReorder);

	$('#AddQuestionDiv').dialog({
		autoOpen: false,
		buttons: { 'Cancel': function() { $(this).dialog('close'); } },
		modal: true,
		resizable: false,
		width: 500
	});

	$('#AddQuestion').autocomplete('$auto_complete_url',
	{
		mustMatch: true,
		width: 470,
		scroll: true
	}).result(function(event, data, formatted)
	{
		if (data !== undefined)
		{
			addQuestionFinish('$add_question_url', data, ++last_index);
			$('#AddQuestionDiv').dialog('close');
		}
	});
");
?>
