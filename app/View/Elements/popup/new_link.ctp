<div class='newLink-form-holder'>
  <div class="popup-header-title">
    <span>New Link</span>
  </div>
  <div class="popup-content-wrapper">
    <div class="thumb-preview" id="newLink-thumb-preview">
      <div>
        <img src="http://linkhay.com/templates/images/new_version/link/post/no-thumb.png" class="mrk-thumb-preview">
      </div>
    </div>
    <div class='newLink-form'>
      <?php
      $c = ClassRegistry::init('Category');
      $c_result = $c->query("select id, name from categories");
      $c_array = array_combine(Set::extract('/categories/id', $c_result), Set::extract('/categories/name', $c_result));
      echo  $this->Form->create('Link',array('action'=>'make','type'=>'file'));
      echo $this->Form->input('owner_id',array('value'=> $current_user['User']['id'],'type'=>'hidden'));
      echo $this->Form->input('url',array('type'=>'text', 'div' => array('class' => 'urlInputDiv')));
      echo "<div class=\"category-selector\">";
      echo $this->Form->label('Category');
      echo $this->Form->select('category_id',$c_array);
      echo "</div>";
      echo $this->Form->label('description');
      echo $this->Form->textarea('description',array('rows' => 5));
      echo $this->Form->input('image', array('label' => 'Remote URL', 'type' => 'hidden'));
      echo $this->Form->submit('Linkin');
      ?>
    </div>
    <div id="responseSuccess"></div>
  </div>
</div>

<script type="text/javascript">

var changeURL = function(e) {
  var src = $(e).attr("src");
  $("#responseSuccess img").removeClass("chosen");
  $(e).addClass('chosen');
  $("#LinkImage").val(src);
  $("#newLink-thumb-preview > div > img").attr('src',src);
}

var checkLink = function(data) {
  $.ajax({
    url:'/links/loadimg',
      type:'post',
      data: {data: data},
      dataType : "json",
      success: function(response, status) {
        // Response was a success
        if (response.success === true) {
          response.data.forEach(function(e,index){
            $("#responseSuccess").append("<img src='" + e +"'" + " onclick=\"changeURL(this)\"  />" );
          });
        }
      }
  });
}

$('#LinkUrl').bind('change', function () {
  var element = this;
  setTimeout(function () {
    var text = $(element).val();
    if(/http:\/\/([a-z1-9]+)\.(.*)/.exec(text) != null)
      checkLink(text);
  }, 100);
});


</script>


