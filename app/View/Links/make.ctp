

<a href="javascript:{
  var f = document.createElement('form');
  var div = document.createElement('div');
  div.className += 'link-images-holder';
  f.method = 'post';
  f.action = 'http://localhost:3000/links/make';
  f.enctype = 'multipart/form-data';
  f.character_set = 'utf-8';
  var u = document.createElement('input');
  u.type = 'hidden';
  u.name = 'data[Link][url]';
  u.value = document.URL;
  var im = document.createElement('input');
  im.type = 'hidden';
  im.name = 'data[Link][image]';
  im.value = 'ee';
  f.appendChild(u);
  f.innerHTML +=  '<input type=\'text\' name=\'data[Link][description]\'/><br />';
  var bt = document.createElement('input');
  bt.type = 'submit';
  im.value = 'click';
  f.appendChild(bt);
  nl = document.getElementsByTagName('img');
  var arr = [];
  for(var i = nl.length; i--; arr.unshift(nl[i]));
  arr.forEach(function(e) {
    window.im = im;
    img = document.createElement('img');
    img.src = e.src;
    img.onclick = function() {
      console.log(this.src);
      f.appendChild(im);
      im.value = this.src;
    };
    div.appendChild(img);
  });
  document.getElementsByTagName('body')[0].appendChild(f);
  document.getElementsByTagName('body')[0].appendChild(div);
}">ALO</a>

<?php
echo  $this->Form->create('Link',array('action'=>'make','type'=>'file'));
echo $this->Form->inpput('owner_id',array('value'=> $current_user['User']['id'],'type'=>'hidden'));
echo $this->Form->input('url',array('type'=>'text'));
echo $this->Form->input('description',array('type'=>'text'));
echo $this->Form->input('image', array('label' => 'Remote URL'));
echo $this->Form->submit('Make',array('class' => 'btn'));
?>
<a href="/links/index">Go Index</a>
<div id="responseSuccess"></div>

<script type="text/javascript">

var changeURL = function(e) {
  var src = $(e).attr("src");
  $("#responseSuccess img").removeClass("chosen");
  $(e).addClass('chosen');
  $("#LinkImage").val(src);
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

$('#LinkUrl').bind('paste', function () {
  var element = this;
  setTimeout(function () {
    var text = $(element).val();
    if(/http:\/\/([a-z1-9]+)\.(.*)/.exec(text) != null)
      checkLink(text);
  }, 100);
});


</script>


