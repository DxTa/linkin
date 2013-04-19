<?php
echo  $this->Form->create('Link',array('action'=>'make','type'=>'file'));
echo $this->Form->inpput('owner_id',array('value'=> $current_user['id'],'type'=>'hidden'));
echo $this->Form->input('url',array('type'=>'text'));
echo $this->Form->input('description',array('type'=>'text'));
echo $this->Form->input('image', array('label' => 'Remote URL'));
echo $this->Form->submit('Make',array('class' => 'btn'));
?>
<a href="/links/index">Go Index</a>
<div id="responseSuccess"></div>

<script type="text/javascript">
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
            $("#responseSuccess").append("<img src='" + e +"'/>" );
          });
        }
      }
  });
}

$('#LinkUrl').bind('paste', function () {
  var element = this;
  setTimeout(function () {
    var text = $(element).val();
    if(/http:\/\/([a-z1-9]+)\.(.*)/.exec(text) != null)
      checkLink(text);
  }, 100);
});


</script>


