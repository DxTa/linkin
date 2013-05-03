
<div class='links-manage'>
<h1> Link Manager </h1>
<table border='1'>
  <?php $index = 0  ?>
 <?php foreach ($links as $link): ?>
  <tr>
    <th>URL</th>
    <th>Image</th>
    <th>Views</th>
    <th>Likes</th>
    <th>Comments</th>
    <th>Check</th>
    <th>Delete</th>
  </tr>
  <tr>
    <td> <a href="<?php echo $link['Link']['url'] ?>"  target="_blank"  ><?php echo $link['Link']['description'] ?></a></td>
    <td> <img src="<?php echo $link['Link']['image'] ?>" style="with: 50px;height: 50px"/></td>
    <td> <?php echo $link['Link']['cnt_views'] ?></td>
    <td> <?php echo $link['Link']['cnt_likes'] ?></td>
    <td> <?php echo $link['Link']['cnt_comments'] ?></td>
    <td><?php echo $this->Html->link(__('View'), array('action' => 'view', $link['Link']['id'])); ?></td>
    <td><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $link['Link']['id']), null, __('Are you sure you want to delete # %s?', $link['Link']['id'])); ?></td>
  </tr>
<?php endforeach; ?>
</table>
</div>
