<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
<div>
<?=$this->Html->link('List book', array('action'=>'index'))?>
</div>
View: <?=$data['Book']['id']?>
<table>
<tr>
<td>id</td>
<td>Title</td>
<td>Description</td>
</tr>
<tr>
<td><?=$data['Book']['id']?></td>
<td><?=$data['Book']['title']?></td>
<td><?=$data['Book']['description']?></td>
</tr>
</table>
</body>
</html>