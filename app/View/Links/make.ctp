<?php
echo  $this->Form->create('Link',array('action'=>'make','type'=>'file'));
echo $this->Form->inpput('owner_id',array('value'=> $current_user['User']['id'],'type'=>'hidden'));
echo $this->Form->input('url',array('type'=>'text'));
echo $this->Form->input('description',array('type'=>'text'));
echo $this->Form->input('image', array('label' => 'Remote URL'));
echo $this->Form->submit('Make',array('class' => 'btn'));
?>

<input type="text" name="imgURL" id="test-input"/>

<input type='button' value= "TEST" onclick= "checkhang()"/>

<div id="responseSuccess"></div>

<script type="text/javascript">
var checkhang = function() {
  data = $('#test-input').val();

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
</script>


