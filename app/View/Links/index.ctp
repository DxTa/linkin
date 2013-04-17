<table>
 <?php foreach ($links as $link): ?>
  <tr>
    <td> <a href="<?php echo $link['Link']['url'] ?>"  target="_blank" id="<?php echo $link['Link']['id'] ?>" onclick="viewCreate(<?php echo $link['Link']['id'] ?>,<?php echo $current_user['id'] ?>)"><?php echo $link['Link']['description'] ?></a></td>
    <td> <img src="<?php echo $link['Link']['image'] ?>" style="with: 50px;height: 50px"/></td>
    <td> <button onclick="likeCreate(<?php echo $link['Link']['id'] ?>,<?php echo $current_user['id'] ?>)"> LIKE </button></td>
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
      }
  });
}

</script>
