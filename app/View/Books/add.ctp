<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
<h3>Create new item</h3>
<div class="upper-right-opt">
<?php echo $this->Html->link('List Book', array('action'=>'index'))?>
</div>

<div>
<?php
    echo $this->Form->create('Book');
    echo $this->Form->input('title');
     echo $this->Form->input('isbn');
    echo $this->Form->input('description');
    echo $this->Form->end('Submit');
?>
</div>
</body>
</html>