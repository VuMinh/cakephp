<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
<div class='upper-right-opt' style="float:right;">
    <?php echo $this->Html->link( '+ New Book', array( 'action' => 'add' ) ); ?>
</div>
<?php
if($data==NULL){
    echo "<h2>Dada Empty</h2>";
}
else{
    echo "<table>
          <tr>
            <td>STT</td>
            <td>Title</td>
            <td>Description</td>
            <td>Action</td>
          </tr>";
           $count =1;
    foreach($data as $item){
        echo "<tr>";
        echo "<td>".$count++."</td>";
        echo "<td>".$item['Book']['title']."</td>";
        echo "<td>".$item['Book']['description']."</td>";
        echo "<td class='actions'>";
                         echo $this->Html->link( 'View', array('action' => 'view', $item['Book']['id']) );
                         echo $this->Html->link( 'Edit', array('action' => 'edit', $item['Book']['id']) );

                         //in cakephp 2.0, we won't use get request for deleting records
                         //we use post request (for security purposes)
                         echo $this->Form->postLink( 'Delete', array(
                                 'action' => 'delete',
                                 $item['Book']['id']), array(
                                     'confirm'=>'Are you sure you want to delete that user?' ) );
                     echo "</td>";
        echo "</tr>";
    }
}
?>
</body>
</html>