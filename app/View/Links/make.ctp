

<a href="javascript:{
  var f = document.createElement('form');
  var div = document.createElement('div');
  div.className += 'link-images-holder';
  var div_h = document.createElement('div');
  div_h.className += 'linkin-form';
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
    img.className +='linkin-img';
    img.onclick = function() {
      nl_c = document.getElementsByClassName('linkin-img-chosen');
      arr = [];
      for(var i = nl_c.length; i--; arr.unshift(nl_c[i]));
      arr.forEach(function(e) {
        e.className = 'linkin-img';
      });

      this.className += ' linkin-img-chosen';
      f.appendChild(im);
      im.value = this.src;

    };
    div.appendChild(img);
  });
  var css = document.createElement('style');
  css.type = 'text/css';
  css.innerHTML = '
    .linkin-form {
      position: absolute;
      top: 0px;
      height: 300px;
      width: 100%;
      background: #DADADA;
      z-index: 999;
    }
    .linkin-img {
      width: 50px;
      height: 50px;
      margin: 5px;
      border: 2px solid white;
    }
    .linkin-img-chosen {
      border: 2px solid red;
    }
  ';
  div_h.appendChild(f);
  div_h.appendChild(div);
  document.body.appendChild(css);
  document.body.appendChild(div_h);
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


