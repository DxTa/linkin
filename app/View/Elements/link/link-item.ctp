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
            <a href='/users/view/<?php echo $link['Owner']['id'] ?>' class='link-owner'>
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