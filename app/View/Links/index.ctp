<table>
  <?php $index = 0  ?>
 <?php foreach ($links as $link): ?>
  <tr>
    <td> <a href="<?php echo $link['Link']['url'] ?>"  target="_blank" id="<?php echo $link['Link']['id'] ?>" onclick="viewCreate(<?php echo $link['Link']['id'] ?>,<?php echo $current_user['User']['id'] ?>)"><?php echo $link['Link']['description'] ?></a></td>
    <td> <img src="<?php echo $link['Link']['image'] ?>" style="with: 50px;height: 50px"/></td>
    <td> <a href="/links/view/<?php echo  $link['Link']['id']?>"?> <?php echo $link['Link']['cnt_comments'] ?> Comments</a>
    <td id="link_likes_<?php echo $link['Link']['id'] ?>"><?php echo $link['Link']['cnt_likes'] ?></td>
    <td id="link_views_<?php echo $link['Link']['id'] ?>"><?php echo $link['Link']['cnt_views'] ?></td>
    <?php
       if( !$this->App->search($link['likedUsers'],array('id' => $current_user['User']["id"]))) {
    ?>
    <td> <button onclick="likeCreate(<?php echo $link['Link']['id'] ?>,<?php echo $current_user['User']['id'] ?>)"> LIKE </button></td>
    <td><?php echo $this->Html->link(__('View'), array('action' => 'view', $link['Link']['id'])); ?></td>
    <?php } ?>
  </tr>
<?php endforeach; ?>
</table>


<script type="text/javascript">
var viewCreate = function(link_id,user_id) {
  data = {
    UserLinkView: {
      'link_id': link_id,
      'user_id' : user_id
    }
  };
  $.ajax({
    url:'/UserLinkViews/make',
      type:'post',
      data: {data: data},
      dataType : "json",
      success: function(response, status) {
        console.log(link_id);
        $("#link_views_"+ link_id).html(parseInt($("#link_views_" + link_id).html()) +1);
      }
  });
};

var likeCreate = function(link_id,user_id) {
  data = {
    UserLinkLike: {
      'link_id': link_id,
      'user_id' : user_id
    }
  };
  $.ajax({
    url:'/UserLinkLikes/make',
      type:'post',
      data: {data: data},
      dataType : "json",
      success: function(response, status) {
        console.log(link_id);
        $("#link_likes_"+ link_id).html(parseInt($("#link_likes_" + link_id).html()) +1);
      }
  });
}

</script>
