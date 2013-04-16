<table>
 <?php foreach ($links as $link): ?>
  <tr>
    <td> <a href="<?php echo $link['Link']['url'] ?>"  target="_blank"><?php echo $link['Link']['description'] ?></a></td>
    <td> <img src="<?php echo $link['Link']['image'] ?>"/></td>
  </tr>
<?php endforeach; ?>
</table>
