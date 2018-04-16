<ul>
<li>Login as User: <?php echo $current_user['username']?></li>
<li><a href="<?php echo $this->webroot.'users/logout';?>">Logout</a></li>
</ul>
<?php
if($data==NULL){
 echo "<h2>Dada Empty</h2>";
}
else{
 echo "<table>
 <tr>
   <td>id</td>
   <td>Name</td>
   <td>Username</td>
   <td>Email</td>
 </tr>";
 $count =1;
 foreach($data as $item){
   echo "<tr>";
   echo "<td>".$count++."</td>";
   echo "<td>".$item['User']['name']."</td>";
   echo "<td>".$item['User']['username']."</td>";
   echo "<td>".$item['User']['email']."</td>";
   echo "</tr>";
 }
}
?>