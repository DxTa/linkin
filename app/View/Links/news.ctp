<div class='top-banner'>
  <div class='adv1'>

  </div>
</div>
<div class='page-wrap'>
  <div class='page-content border-center clearfix'>
    <div class='left-content'>
      <div class='list-links'>
        <div class='news-filter'>
          <h2>
            <a href='#'>
              <img src='/app/webroot/img/rss.png'/>
            </a>
            <a href='/links/index' >
              Hot Links
            </a>
            |
            <a href='#' class='a-active'>
              News
            </a>
          </h2>
        </div>
        <ul class='news-list'>
          <?php foreach ($links as $link): ?>
            <li id='link_<?php echo $link['Link']['id'] ?>'>
              <div class='link-item clearfix'>
                <div class='link-thumb right-set'>
                  <a href="/links/view/<?php echo  $link['Link']['id']?>" ><img src="<?php echo $link['Link']['image'] ?>" ></a>
                </div>
                <div class='link-like'>
                  <a href="/links/view/<?php echo  $link['Link']['id']?>" class='like-count'>
                      <span id="link_likes_<?php echo $link['Link']['id'] ?>"><?php echo $link['Link']['cnt_likes'] ?></span>
                  </a>
                  <?php if($current_user) : ?>
                  <a href='#' class='vote' onclick="likeCreate(<?php echo $link['Link']['id'] ?>,<?php echo $current_user['User']['id'] ?>)"  >
                  <?php else : ?>
                  <a href='#' class='vote' >
                  <?php endif ?>
                    <i></i>
                    Like
                  </a>
                </div>
                <div class='link-content'>
                  <h2>
                    <?php if($current_user) : ?>
                    <a href="<?php echo $link['Link']['url'] ?>"  target="_blank" id="<?php echo $link['Link']['id'] ?>" onclick="viewCreate(<?php echo $link['Link']['id'] ?>,<?php echo $current_user['User']['id'] ?>)"><?php echo $link['Link']['description'] ?></a>
                    <?php else : ?>
                    <a href="<?php echo $link['Link']['url'] ?>"  target="_blank" id="<?php echo $link['Link']['id'] ?>" ><?php echo $link['Link']['description'] ?></a>
                    <?php endif ?>
                  </h2>
                  <div class='link-meta'>
                    <span class='user-info'>
                      <strong>
                        <a href='/users/<?php echo $link['Owner']['id'] ?>' class='link-owner'>
                        <img src='<?php echo $link['Owner']['avatar'] ?>' >
                          <?php echo $link['Owner']['username'] ?>
                        </a>
                      </strong>
                      send
                    </span>
                    <span class='seperator'>-</span>
                    <span class='channel'>
                      <a href="<?php echo Router::url(array('controller' => 'categories', 'action' => 'view', $link['Category']['id'])) ?>"><?php echo $link['Category']['name'] ?></a>
                    </span>
                    <span class='seperator'>-</span>
                    <span class='domain'>
                      <a href="<?php echo $link['Link']['url'] ?>" target="_blank"><?php echo $this->App->getDomainFromUrl($link['Link']['url']) ?></a>
                    </span>
                  </div>
                  <div class='link-stats'>
                    <a class='timeago'>
                      <?php echo $this->Time->timeAgoInWords($link['Link']['created_at'], array('format' => 'Y-m-d H:i:s', 'end' => '+1 year'))?>
                    </a>
                      ·
                    <a class='view-count'>
                      <span id="link_views_<?php echo $link['Link']['id'] ?>"><?php echo $link['Link']['cnt_views'] ?></span>
                      Views
                    </a>
                      ·
                    <a class='comment-count' href="/links/view/<?php echo  $link['Link']['id']?>">
                      <?php echo $link['Link']['cnt_comments'] ?> Comments
                    </a>
                      ·
                    <?php echo $this->Facebook->share(Router::url(array('controller' => 'links', 'action' => 'view', $link['Link']['id'])),array('style' => 'link','label' => 'Facebook this link')); ?>
                  </div>
                </div>
              </div>

            </li>
          <?php endforeach; ?>
        </ul>

      </div>

    </div>

    <div class='right-content'>
      <div class='search-box'>
        <?php echo $this->Form->create('Search',array('controller'=>'searches','action'=>'search')) ?>
        <?php echo $this->Form->input('keyword',array('type'=>'text')) ?>
        <span class='search-btn'>
          <?php echo $this->Form->submit('search',array()) ?>
        </span>
      </div>
      <div class='divide-wrap'></div>
      <div class='bookmarklet-holder'>
      <div class='w-header'>
        <h2> Bookmarklet </h2>
      </div>
      <div class='bookmarklets-info'>
        <p> You can <b>Linkin</b> URLs by using this <b>bookmarlet</b> on your browser</p>
        <div class='bookmarklet-icons'>
      <a href="javascript:{
        var popup = document.createElement('div');
        var div_logo = document.createElement('div');
        div_logo.className += 'linkin-logo';
        im_lo = document.createElement('img');
        im_lo.src = 'http://localhost:3000/app/webroot/img/simple_logo.png';
        div_logo.appendChild(im_lo);
        popup.className += 'linkin-popup';
        var f = document.createElement('form');
        var div = document.createElement('div');
        var label;
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
        var inp_box = document.createElement('select');
        inp_box.name = 'data[Link][category_id]';
        c_names = ['The World','Sport','Weather','Bussiness','Technology', 'Science', 'Entertainment & Art', 'Learning', 'Health', 'gag'];
        var option;
        c_names.forEach(function(e,index) {
          option = document.createElement('option');
          option.innerHTML = e;
          option.value = index + 1;
          inp_box.add(option,null);
        });
        label = document.createElement('label');
        label.innerHTML = 'Channel';
        f.appendChild(label);
        f.appendChild(inp_box);
        label = document.createElement('label');
        label.innerHTML = 'Description';
        f.appendChild(label);
        f.innerHTML +=  '<textarea cols=\'20\' rows=\'10\' name=\'data[Link][description]\'></textarea><br />';
        var bt = document.createElement('input');
        bt.type = 'submit';
        im.value = 'click';
        f.appendChild(bt);
        nl = document.getElementsByTagName('img');
        var arr = [];
        for(var i = nl.length; i--; arr.unshift(nl[i]));
        arr.forEach(function(e) {
          a = /.*\.(\w+)/.exec(e.src);
          if(a && a[1] != 'gif') {
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
          }
        });
        var css = document.createElement('style');
        css.type = 'text/css';
        css.innerHTML = '
          .linkin-popup {
            position: absolute;
            top: 0px;
            height: 300px;
            width: 100%;
            background: rgba(218, 218, 218, 0.84);
            z-index: 999;
            height: 2000px;
          }
          .linkin-form {
            width: 940px;
            -webkit-animation: bounceIn 0.5s none;
            -moz-animation: bounceIn 0.5s none;
            -ms-animation: bounceIn 0.5s none;
            -o-animation: bounceIn 0.5s none;
            animation: bounceIn 0.5s none;
            filter: progid:DXImageTransform.Microsoft.Alpha(Opacity=100);
            opacity: 1;
            -webkit-transform: scale(1);
            -moz-transform: scale(1);
            -ms-transform: scale(1);
            -o-transform: scale(1);
            transform: scale(1);
            -webkit-border-radius: 3px;
            -moz-border-radius: 3px;
            -ms-border-radius: 3px;
            -o-border-radius: 3px;
            border-radius: 3px;
            -webkit-box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.33);
            -moz-box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.33);
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.33);
            filter: progid:DXImageTransform.Microsoft.Alpha(Opacity=0);
            opacity: 1;
            background: #fff;
            margin: 80px auto 0;
            padding-bottom: 20px;
            padding-top: 10px;
          }
.linkin-form .linkin-logo {
  text-align: left;
  padding-left: 23px;
  padding-bottom: 5px;
  border-bottom: 1px solid rgba(173, 173, 173, 0.61);
}
.linkin-form form {
  width: 410px;
  display: inline-block;
  text-align: left;
}
.linkin-form .link-images-holder {
margin-top: 10px;
width: 525px;
vertical-align: top;
display: inline-block;
border-left: 1px solid rgba(173, 173, 173, 0.61);
min-height: 240px;
}
.linkin-form label {
  display: inline-block;
  width: 100px;
  font-size: 18px;
  font-weight: bold;
  text-align: left;
  padding-left: 20px;
  margin-top: 20px;
}
.linkin-form select,textarea {
  width: 230px;
  margin-left: 10px;
  margin-top: 20px;
  resize: none;
}
.linkin-form textarea {
  margin-top: 20px;
  vertical-align: top;
}

.linkin-form input[type=\'submit\'] {
margin-left: 130px;
margin-top: 20px;
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
        div_h.appendChild(div_logo);
        div_h.appendChild(f);
        div_h.appendChild(div);
        popup.appendChild(div_h);
        document.body.appendChild(css);
        document.body.appendChild(popup);
      }">LinkIn</a>
        </div>

      </div>

    </div>

<div class='top-links-home'>
<div class='w-header'>
  <h2> Top Links </h2>
</div>
<div class='links-feature'>
<div class='side-links-holder'>
<?php foreach ($top_links as $link): ?>
  <div class='side-link clearfix'>
    <div class='left-set'>
      <div class='like-count'><?php echo $link['Link']['cnt_likes'] ?></div>
      <div class='mark'>LIKE</div>

    </div>
    <div class='right'>
      <table cellpadding="0" cellspacing="0" border="0"><tbody><tr>
        <td valign="top" width="30"><img width="30" height="30" class="thumb" src="<?php echo $link['Link']['image'] ?>"></td>
        <td class="title" valign="top"><a href="/links/view/<?php echo $link['Link']['id'] ?>"><?php echo $link['Link']['description'] ?></a></td>
      </tr></tbody></table>

    </div>

  </div>
<?php endforeach ?>
</div>
</div>


      </div>
  </div>
</div>






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
