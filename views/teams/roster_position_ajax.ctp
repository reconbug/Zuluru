<?php
if ($success) {
	$person['Person']['TeamsPerson']['position'] = $position;
} else {
	$message = $this->Session->read('Message.flash');
	$this->Session->delete('Message.flash');
	echo $this->Html->scriptBlock('alert("' . $message['message'] . '");');
}
echo $this->element('people/roster_position', array('roster' => $person['Person']['TeamsPerson'], 'division' => $team['Division']));
?>