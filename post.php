<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>

<div class="blog-section pb-40">
    <div class="container">
        <div class="row">
    <div class="col-lg-12 mx-auto">
        <div class="banner-content">
            <div class="post-title"><?php $this->title() ?></div>
                    
            <div class="d-flex justify-content-between align-items-center flex-wrap">
                <div class="item-meta">
                     <span class="mt-2" style="padding-right:15px;">
              <a href="<?php $this->author->permalink() ?>" class="author" title="<?php $this->author(); ?>的文章">
                <img class="w-auto" style="border-radius:100%" src="<?php echo General::getAvatar($this->author->mail); ?>" alt="" width="26" height="26">  <?php $this->author->screenName(); ?>
              </a>
            </span>
                    <span class="post-time"><i class="ri-calendar-line"></i> <?php echo General::publishTime($this->created);?></span>
                    <span class="reading-time"><i class="ri-file-text-line"></i> 预计阅读时长≈<?php General::readTime($this->cid);?>分钟</span>
                 
                </div>
                <div>
                    <!-- 第三方分享 -->
                    <div class="social-icon text-center">
                        
                              <div id="dialog-content" style="display:none;max-width:500px;">
        <h2 class="text-center" style="color:#000">微信分享二维码</h2>
        <p>
            <canvas id="wechatQrcode"></canvas>
        </p>
      </div>
      
      
                        <a onclick="return qq_click()" href="#"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="120" height="120"><path fill="currentColor" d="M17.5359 12.5144L16.8402 10.7175C16.8408 10.6968 16.8494 10.3429 16.8494 10.1604C16.8494 7.08792 15.448 4.0003 12.0012 4C8.55459 4.0003 7.15292 7.08792 7.15292 10.1604C7.15292 10.3429 7.16151 10.6968 7.16209 10.7175L6.4667 12.5144C6.27608 13.0285 6.08776 13.564 5.94988 14.0232C5.29262 16.2126 5.50559 17.1186 5.66783 17.139C6.01581 17.1823 7.02221 15.4908 7.02221 15.4908C7.02221 16.4704 7.5095 17.7487 8.56405 18.6719C8.16963 18.7976 7.68635 18.9911 7.37564 19.2284C7.09645 19.442 7.13142 19.6594 7.18158 19.7473C7.40258 20.1329 10.9713 19.9935 12.0017 19.8733C13.0319 19.9935 16.6009 20.1329 16.8216 19.7473C16.872 19.6594 16.9067 19.442 16.6275 19.2284C16.3168 18.9911 15.8333 18.7976 15.4386 18.6716C16.4928 17.7487 16.9801 16.4704 16.9801 15.4908C16.9801 15.4908 17.9868 17.1823 18.3348 17.139C18.4967 17.1186 18.7131 16.2108 18.0524 14.0232C17.9125 13.56 17.7265 13.0285 17.5359 12.5144ZM18.5574 20.7407C18.1843 21.3926 17.7237 21.6334 17.1187 21.7981C16.8792 21.8633 16.621 21.9056 16.325 21.936C15.8844 21.9814 15.3392 22.001 14.712 22C13.786 21.9985 12.693 21.9491 12.0017 21.884C11.3103 21.9491 10.2173 21.9985 9.29129 22C8.66414 22.001 8.11889 21.9814 7.67832 21.936C7.38236 21.9056 7.12409 21.8633 6.88467 21.7981C6.27994 21.6335 5.81954 21.393 5.44496 20.7393C5.15165 20.2258 5.07747 19.6406 5.20612 19.0866C4.61376 18.9546 4.20483 18.6045 3.92733 18.1757C3.77911 17.9466 3.68408 17.7127 3.61845 17.4663C3.53001 17.1344 3.49486 16.7666 3.50184 16.3601C3.51532 15.5749 3.68902 14.5984 4.03435 13.4481C4.17427 12.9821 4.3614 12.4396 4.6015 11.7926L5.15467 10.3632C5.1536 10.287 5.15292 10.2154 5.15292 10.1604C5.15292 5.6047 7.58875 2.00038 12.0013 2C16.4138 2.00038 18.8494 5.60454 18.8494 10.1604C18.8494 10.2154 18.8487 10.2869 18.8477 10.3631L19.401 11.7923L19.4112 11.8191C19.636 12.4254 19.8242 12.9722 19.967 13.445C20.3145 14.5956 20.4889 15.5735 20.5018 16.361C20.5085 16.768 20.4728 17.1365 20.3837 17.4689C20.3178 17.7148 20.2226 17.9483 20.0746 18.1768C19.7976 18.6041 19.3905 18.9532 18.7974 19.0862C18.9266 19.6411 18.8523 20.2274 18.5574 20.7407Z" fill="rgba(0,0,0,1)"></path></svg></a>
                      
    
    <a data-fancybox data-src="#dialog-content" href="#"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="120" height="120"><path fill="currentColor" d="M8.66725 11.5116C7.94997 11.5116 7.38211 10.9434 7.38211 10.2258C7.38211 9.50809 7.94997 8.93992 8.66725 8.93992C9.38454 8.93992 9.95239 9.50809 9.95239 10.2258C9.95239 10.9434 9.38454 11.5116 8.66725 11.5116ZM15.3339 11.5116C14.6166 11.5116 14.0488 10.9434 14.0488 10.2258C14.0488 9.50809 14.6166 8.93992 15.3339 8.93992C16.0512 8.93992 16.6191 9.50809 16.6191 10.2258C16.6191 10.9434 16.0512 11.5116 15.3339 11.5116ZM6.82289 19.2156L7.53841 18.7792C8.34812 18.2853 9.30697 18.0952 10.2438 18.2428C10.4553 18.2762 10.6292 18.3018 10.7634 18.3195C11.1696 18.3731 11.5828 18.4002 12.0006 18.4002C16.4213 18.4002 19.9006 15.3778 19.9006 11.8002C19.9006 8.2226 16.4213 5.2002 12.0006 5.2002C7.57986 5.2002 4.10059 8.2226 4.10059 11.8002C4.10059 13.1658 4.60024 14.4731 5.53227 15.5812C5.58056 15.6386 5.65277 15.718 5.74666 15.8157C6.54199 16.644 6.94301 17.7741 6.84765 18.9184L6.82289 19.2156ZM6.19286 21.9425C6.00989 22.0569 5.79484 22.109 5.57981 22.0911C5.02944 22.0452 4.62045 21.5619 4.66631 21.0115L4.85456 18.7523C4.90224 18.1802 4.70173 17.6151 4.30407 17.201C4.1819 17.0738 4.08111 16.963 4.0017 16.8685C2.80622 15.4472 2.10059 13.6953 2.10059 11.8002C2.10059 7.05055 6.53297 3.2002 12.0006 3.2002C17.4682 3.2002 21.9006 7.05055 21.9006 11.8002C21.9006 16.5498 17.4682 20.4002 12.0006 20.4002C11.4911 20.4002 10.9906 20.3668 10.5018 20.3023C10.3491 20.2821 10.1593 20.2542 9.93256 20.2185C9.46412 20.1447 8.9847 20.2397 8.57985 20.4866L6.19286 21.9425Z"></path></svg></a>
    
    <a onclick="return wb_click()" href="#"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path fill="currentColor" d="M4.27799 8.59201C7.05085 5.8217 10.282 4.55876 11.4966 5.77587C12.0338 6.31312 12.0848 7.23996 11.741 8.34757C11.5628 8.9052 12.2655 8.5971 12.2655 8.5971C14.5062 7.66008 16.4618 7.60407 17.1747 8.62511C17.5541 9.16746 17.5184 9.93133 17.1671 10.8149C17.0041 11.2223 17.2154 11.2859 17.5261 11.3776C18.789 11.7697 20.1945 12.7144 20.1945 14.3822C20.1945 17.1448 16.2148 20.6205 10.2311 20.6205C5.66569 20.6205 1.00098 18.4078 1.00098 14.7692C1.00098 12.8671 2.20535 10.6672 4.27799 8.59201ZM16.4108 14.3338C16.174 11.9429 13.0294 10.2954 9.38829 10.657C5.74717 11.016 2.9845 13.2465 3.2213 15.6375C3.4581 18.0309 6.60271 19.6758 10.2438 19.3168C13.885 18.9552 16.6451 16.7247 16.4108 14.3338ZM6.16221 14.4382C6.91589 12.9104 8.87395 12.0473 10.6079 12.4979C12.4005 12.9614 13.3146 14.6521 12.5838 16.2969C11.8403 17.98 9.70148 18.8763 7.88856 18.2906C6.13674 17.7254 5.39579 15.9965 6.16221 14.4382ZM8.8765 15.0162C8.31378 14.7794 7.58556 15.0238 7.23672 15.5687C6.88279 16.1162 7.0483 16.7705 7.60847 17.0252C8.17628 17.2823 8.93252 17.0379 9.2839 16.4752C9.63019 15.9074 9.44686 15.2581 8.8765 15.0162ZM10.2642 14.4382C10.0478 14.3542 9.77787 14.456 9.65056 14.6699C9.52834 14.8838 9.59709 15.1282 9.81352 15.2173C10.0325 15.309 10.3151 15.2046 10.4424 14.9856C10.5647 14.7666 10.4857 14.5197 10.2642 14.4382ZM15.9576 2.92408C17.9258 2.50649 20.0545 3.12017 21.5008 4.71918C22.947 6.31822 23.3341 8.50034 22.7204 10.4228C22.5796 10.8639 22.1036 11.1075 21.6612 10.9626C21.2181 10.8174 20.9762 10.3438 21.1188 9.90078C21.5568 8.54108 21.2806 6.98652 20.2531 5.84971C19.2244 4.71154 17.712 4.27613 16.3115 4.57404C15.8558 4.67099 15.41 4.37994 15.3109 3.92475C15.2115 3.46897 15.5018 3.02078 15.9576 2.92408ZM16.584 5.84971C17.5414 5.64601 18.5802 5.94392 19.283 6.72307C19.9858 7.50222 20.1742 8.56655 19.8737 9.49847C19.7511 9.87865 19.3409 10.089 18.9596 9.96443C18.5777 9.83967 18.3714 9.43227 18.4962 9.04779C18.6464 8.59201 18.5522 8.07258 18.2085 7.69064C17.8622 7.31125 17.3555 7.16611 16.887 7.26542C16.4949 7.35199 16.1104 7.09991 16.0263 6.71034C15.9423 6.31822 16.1917 5.93316 16.584 5.84971Z"></path></svg></a>
    

    <script type="text/javascript">
        var title=$(document.head).find("[name=title], [name=Title]").attr("content")||document.title;
        var url=window.location.href;
        var domain=window.location.origin;
        var imgurl=$("img:first").prop("data-src")||$("img:first").prop("src");
        var description=$(document.head).find("[name=description], [name=Description]").attr("content")||"";
        var source=$(document.head).find("[name=site], [name=Site]").attr("content")||document.title;
          function qq_click(){pageLink = 'http://connect.qq.com/widget/shareqq/index.html?url='+url+'&title='+title+'&source='+source+'&desc='+description+'&pics='+imgurl;socialWindow(pageLink, 570, 570);}
          function wb_click(){pageLink = 'http://service.weibo.com/share/share.php?url='+url+'&title='+title+'&pic='+imgurl+'&appkey=';socialWindow(pageLink, 570, 570);}
          function socialWindow(pageLink, width, height){var left = (screen.width - width) / 2;var top = (screen.height - height) / 2;var params = "menubar=no,toolbar=no,status=no,width=" + width + ",height=" + height + ",top=" + top + ",left=" + left;window.open(pageLink,"",params);}
        </script>
        
        

    <a class="copy-link" data-link="<?php echo $this->permalink();?>" href="#">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path fill="currentColor" d="M6.9998 6V3C6.9998 2.44772 7.44752 2 7.9998 2H19.9998C20.5521 2 20.9998 2.44772 20.9998 3V17C20.9998 17.5523 20.5521 18 19.9998 18H16.9998V20.9991C16.9998 21.5519 16.5499 22 15.993 22H4.00666C3.45059 22 3 21.5554 3 20.9991L3.0026 7.00087C3.0027 6.44811 3.45264 6 4.00942 6H6.9998ZM5.00242 8L5.00019 20H14.9998V8H5.00242ZM8.9998 6H16.9998V16H18.9998V4H8.9998V6Z"></path></svg>  
        <span class="copied">已复制文章链接到剪切板！</span>
    </a>
</div>
                                    </div>
            </div>
        </div>
    </div>
</div>

        <div class="row">
    <div class="col-lg-12 col-md-12 mx-auto">
        
        <div class="blog-full-content pb-30">
        
            
                <article class="post-full-content" id="bh-post-content">
                 

                            <?php echo Parse::ParseContent($this->content); ?>
                             
                             </article>
         
        </div>
    </div>
</div>
        <div class="row">
            <div class="col-md-12">
                <?php General::getPostAllTags($this);?>

                <div class="post-navigation-wrap">
                    <!-- 上一页 -->
 <?php echo General::thePrev($this);?>
<!-- 下一页 -->
   <?php echo General::theNext($this);?>
</div>
              

        <?php echo General::getRandomPosts($this->cid);?>
        <?php if (General::Options('comments_open')): ?>
        <?php $this->need('core/Extensions/comments/comments.php'); ?>
        <?php endif;?>
            </div>
        </div>
    </div>
</div>


<script>
$(function(){
    Fancybox.bind('[data-fancybox]', {
      groupAttr:false,
      Toolbar: {
    display: {
      left: ["infobar"],
      middle: [
        "zoomIn",
        "zoomOut",
        "toggle1to1",
        "rotateCCW",
        "rotateCW",
        "flipX",
        "flipY",
      ],
      right: ["slideshow", "thumbs", "close"],
    },
  },
  
  
});
});
    var qr = new QRious({
    element:document.getElementById('wechatQrcode'),
    size:300, 	   level:'H',	   value:'<?php echo $this->permalink;?>'
            });

</script>
<?php $this->need('footer.php'); ?>
