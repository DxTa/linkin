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
            <a href='#' class='a-active'>
              Hot Links
            </a>
            |
            <a href='#'>
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
                  <a href='#' class='vote' onclick="likeCreate(<?php echo $link['Link']['id'] ?>,<?php echo $current_user['User']['id'] ?>)"  >
                    <i></i>
                    Like
                  </a>
                </div>
                <div class='link-content'>
                  <h2>
                    <a href="<?php echo $link['Link']['url'] ?>"  target="_blank" id="<?php echo $link['Link']['id'] ?>" onclick="viewCreate(<?php echo $link['Link']['id'] ?>,<?php echo $current_user['User']['id'] ?>)"><?php echo $link['Link']['description'] ?></a>
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
                      <a href='#'>Education</a>
                    </span>
                    <span class='seperator'>-</span>
                    <span class='domain'>
                      <a href='#'>kenh14.vn</a>
                    </span>
                  </div>
                  <div class='link-stats'>
                    <a class='timeago'>
                      1 hours ago
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
        <input type='text' />
        <span class='search-btn'>
          <input type='submit' value='search'/>
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
