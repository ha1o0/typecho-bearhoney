<?php
error_reporting(0);
use Typecho\Common;
use Typecho\Exception;
use Typecho\Router;
use Utils\Helper;
use Widget\Options;
if(!class_exists('CSF')){
    require_once Helper::options()->pluginDir('BearHoneyCore').'/bhoptions-framework.php';
}

if (!class_exists('bhOptions')){
    require_once \Utils\Helper::options()->pluginDir('BearHoneyCore').'/bhOptions.php';
}
require_once('core/Core.php');
function themeVersion()
        {
            return '1.1.7.20240811';
        }


function themeVersionOnly()
        {
            return '1.1.7';
        }

/**解析表情**/
$emo = false;
function reEmo($comment,$type){
    global $emo;
    $options = Helper::options();
    if(!$emo){
        $opts = array(
  'http'=>array(
   'method' => 'GET',
          'header' => 'Content-type: application/json',
          'timeout' => 60,
       'Connection'=>"close"
  )
);
$context = stream_context_create($opts);

        if(General::Options('Emoji_HideDefault') == false || General::Options('Emoji_HideDefault') == ''){
        $res = json_decode(file_get_contents($options->themeUrl."/assets/plugins/emoji/emoji.json", false, $context),true);
        $emo = $res;
        }
        if(General::Options('Emoji_Diy') == true && General::Options('Emoji_DiyUrl') !== ''){
        $res2 = json_decode(file_get_contents(General::Options('Emoji_DiyUrl'), false, $context),true);
        if(General::Options('Emoji_HideDefault') == false || General::Options('Emoji_HideDefault') == ''){
        $emo = array_merge($res,$res2);
        }
        else{
        $emo = $res2;    
        }
        }
        
        
    }


    foreach ($emo as $v){
        if($v['category'] !== ''){
                if($type == 'comment'){
                $comment = str_replace($v['data'], '<img width="30" height="30" src='.$v['icon'] .''.' loading="lazy">', $comment);
                }
                elseif($type == 'reply'){
                $comment = str_replace($v['data'], '<img width="20" height="20" src='.$v['icon'] .''.' loading="lazy">', $comment);
                }
                elseif($type == 'circle'){
                $comment = str_replace($v['data'], '<img class="honeyemo" width="25" height="25" src='.$v['icon'] .''.' loading="lazy" style="vertical-align:middle">', $comment);
                }
                else{
                $comment = str_replace($v['data'], '<img width="30" height="30" src='.$v['icon'] .''.' loading="lazy">', $comment);                    
                }
        }
    }
    //当评论没有私密评论时去除私密评论识别标签
    $comment = str_replace('@私密@', '', $comment);
    return $comment;
}


$options = bhOptions::getInstance()::get_option( 'bearhoney' );

if( class_exists( 'CSF' ) ) {
    $Tyoptions = Helper::options();
    $db = \Typecho\Db::get();
  $prefix = 'bearhoney'; 
  CSF::createOptions( $prefix, array(
    'menu_title' => 'Bearhoney',
    'menu_slug'  => 'my-bearhoney',
  ) );
  CSF::createSection( $prefix, array(
    'title'       => '使用说明',
    'icon'        => 'fas fa-bolt',
    'description' => '欢迎使用BearHoney主题，本主题为<strong>日志类主题</strong>，以下是本主题的使用说明。',
    'fields'      => array(
array(
            'type'    => 'submessage',
            'style'   => 'info',
            'content' => '
<style>
.csf-notice{
    word-break:break-all;
}
</style>
<font style="font-size:15px">
        我们制作了一个使用本主题的<a href="https://www.bearnotion.ru/userWebsites.html">[站点展示列表页]</a>，若想将您的站点展示出来，请点击下方按钮申请加入，若已经加入将显示 [已加入] 标识和站点密钥SiteKey，该密钥后面将作为凭证用于修改展示的站点信息，我们也会定期检查站点，未达到条件者将被终止展示资格。</font><br>
  <span class="button button-primary csf--button" id="applyJoin" style="display:none">
            <i class="fas fa-hand-point-up"></i>
             申请加入
        </span>
<span class="button button-success csf--button" id="alreadyJoin" style="pointer-events: none;display:none">
            <i class="fas fa-check"></i>
             已加入
        </span>
    <span class="button button-success csf--button" id="alreadyJoin2" style="pointer-events: none;display:none">
            <i class="fas fa-exclamation-triangle"></i>
             已终止
        </span>    
        <span id="siteKey" style="display:none"></span>
 ',
        ),
        array(
            'type'    => 'heading',
            'content' => '使用说明',
        ),

        array(
            'type'    => 'content',
            'content' => '1、主题用户交流QQ群:561848356<br>2、主题文档中心:<a href="https://docs.whitebear.dev/">戳这里访问</a><br><font color=red>3、若主题配置保存失败请检查是否开启了防火墙，且防火墙是否拦截了请求</font><br>4、不懂的问题或本主题存在的问题可加群或在BearTalk社区中进行反馈，也可先在文档中心查询.     <br><div>
    5、
        BearTalk社区专属邀请码<br>[BearTalk社区是为使用者提供的一个讨论交流社区，您可以通过您的专属邀请码进行注册，传送门：<a href="https://www.beartalk.ru" target="_blank">戳这里</a>]
  
<style>
.invitecode{
    border: 1px solid gray;
    padding:10px;
    border-radius:5px
}
</style>
<br><br>
                <text class="invitecode">Loading...</text>

        <span class="button button-primary csf--button" id="getInviteCode" onClick="getInviteCode();">
            <i class="fas fa-sync"></i>
             获取邀请码
        </span>
        <div style="margin-top:5px;display:none" id="bindUser">您当前已绑定BearTalk社区账号：<span id="username_talk" style="border:1px dashed gray;border-radius:3px;padding:4px;line-height: 30px;"></span></div>
        <div style="margin-top:5px;display:none" id="bindUserNot">您当前还没有通过邀请码注册绑定BearTalk社区账号</div>
       
</div>     <center>  <br>
 <div class="csf-submessage csf-submessage-info">当前版本:v'.themeVersion().' / 最新版本:v<font id="version"></font></div>
<div id="versiontips" style="margin-top:10px"></div></center>


<script src="//lf3-cdn-tos.bytecdntp.com/cdn/expire-1-M/jquery/3.6.0/jquery.min.js" type="application/javascript"></script>
  <script src="//lf26-cdn-tos.bytecdntp.com/cdn/expire-1-M/layer/3.5.1/layer.min.js" type="application/javascript"></script>
<script>

$(function() {


$.post("https://upgrade.typecho.co.uk/Bearhoney/version.php",function(data,status){
switch(status)
{
case "success":
json = JSON.parse(data);
nowversion = "'.themeVersion().'";
$("#version").html(json.version);
if(json.version > nowversion){
if (/(iPhone|iPad|iPod|iOS|Android)/i.test(navigator.userAgent)) {
    $("#versiontips").html(\'<div class="csf-submessage csf-submessage-warning">检测到有新版本可以更新，请及时完成更新!<br><a href="#check" class="ui warning label">前往更新<a></div>\');
} else {
    $("#versiontips").html(\'<div class="csf-submessage csf-submessage-warning">检测到有新版本可以更新，请及时完成更新!<br><a href="#tab=在线升级" class="ui warning label">前往更新<a></div>\'); 
};

}
break;
case "error":
$("#version").html("最新版本获取失败");
break;
case "timeout":
$("#version").html("最新版本获取超时");
break;
default: $("#version").html("'.themeVersion().'");
}
    });
});
</script>',
        ),

        array(
            'type'    => 'submessage',
            'style'   => 'info',
            'content' => '在反馈本主题相关的问题时，请务必将以下内容放入您要反馈的内容中',
        ),
array(
                'type'    => 'notice',
            'style'   => 'info',
                'content' => '<ul style="margin:0 auto;"><li>BearHoney主题版本：v'.themeVersion().'[<a href="https://docs.whitebear.dev/index.php/archives/7/" target="_blank">更新日志</a>]</li><li>PHP版本：'.PHP_VERSION.'</li><li>网站服务器：'.$_SERVER['SERVER_SOFTWARE'].'</li><li>数据库：'.$db->getAdapterName().'[Version：'.$db->getVersion().']</li><li>Typecho版本：'.$Tyoptions->version.'</li><li>User Agent信息：'.$_SERVER['HTTP_USER_AGENT'].'</li></ul>',
        ),

    )
) );
  CSF::createSection( $prefix, array(
    'title'  => '基础设置',
    'icon'   => 'fas fa-rocket',
    'fields' => array(

      array(
            'id'      => 'header_choose',
            'type'    => 'radio',
            'title'   => '站点LOGO类型',
            'inline'  => true,
            'options' => array(
                'text'    => '文字LOGO',
                'image'   => '图片LOGO',
            ),
            'default' => 'text'
        ),
      array(
        'id'    => 'textlogo_text',
        'type'  => 'text',
        'title' => '站点文字LOGO',
        'default' => $Tyoptions->title,
        'after' => '请填入站点文字LOGO',
        'dependency' => array( 'header_choose', '==', 'text' ),
      ),

      array(
            'id'      => 'imagelogo',
            'title'   => '站点图片LOGO',
            'after' => '请上传站点图片LOGO',
            'type'    => 'upload',
            'dependency' => array( 'header_choose', '==', 'image' ),
        ),
     array(
            'id'      => 'imagelogo_dark',
            'title'   => '站点图片LOGO[黑暗模式]',
            'after' => '请上传黑暗模式时的站点图片LOGO',
            'type'    => 'upload',
            'dependency' => array( 'header_choose', '==', 'image' ),
        ),
     
      array(
            'id'      => 'favicon',
            'type'    => 'upload',
            'title'   => '站点Favicon图标',
        ),
        
    array(
        'id'    => 'index_text',
        'type'  => 'text',
        'title' => '站点首页格言',
        'after' => '请填入站点首页格言',
      ),
      array(

            'id'      => 'accentColor',
            'type'    => 'color',
            'title'       => '全局强调色',
            'after' => '请选择全局强调色，它将用于多个地方，不建议设置为transparent（透明色），不选则为暗黄色。'
        ),  
      
    )
  ) );
CSF::createSection( $prefix, array(
    'title'  => '顶部设置',
    'icon'   => 'fas fa-headphones',
    'fields' => array(
     
        array(
            'id'       => 'CustomizationCode',
            'type'     => 'code_editor',
            'title'    => '顶部自定义代码',
            'subtitle' => '如百度Meta验证代码，均可以放在这里',
        ),
        array(
            'id'      => 'showLogin',
            'type'    => 'switcher',
            'title'       => '是否显示登录按钮',
            'subtitle' => '可选择是否显示登录按钮，登录后将显示管理中心入口。',
            'default' => false,
        ),
        
    )
  ) );
  CSF::createSection( $prefix, array(
    'title'  => '底部设置',
    'icon'   => 'fas fa-cube',
    'fields' => array(
    array(
        'id'    => 'IcpBa',
        'type'  => 'text',
        'title' => 'ICP备案号',
        'after' => '请填写您网站的ICP备案号,若无ICP备案请为空',
      ),
      array(
        'id'    => 'PoliceBa',
        'type'  => 'text',
        'title' => '公安备案号',
        'after' => '请填写您网站的公安备案号,若无公安备案请为空',
      ),
      array(
            'id'       => 'CustomizationFooterCode',
            'type'     => 'code_editor',
            'title'    => '底部自定义代码',
            'after' => '可放置网站统计代码等<br><font color=red>谨慎填写，仅需填写代码即可！</font>需注意语法，若语法错误可能会造成前台报错甚至组件动作失效！',
        ),
    array(
            'id'       => 'CustomizationFooterJsCode',
            'type'     => 'code_editor',
            'title'    => '底部自定义JS代码',
            'after' => '可放置自定义JS代码等<br><font color=red>谨慎填写，仅需填写代码即可！</font>需注意JS语法，若语法错误可能会造成前台报错甚至组件动作失效！',
        ),
    )
  ) );
  CSF::createSection( $prefix, array(
    'title'  => '扩展中心',
    'icon'   => 'fas fa-building',
    'fields' => array(
      array(
            'type'    => 'heading',
            'content' => '扩展中心',
        ),
        array(
            'type'    => 'subheading',
            'content' => '您可以通过扩展中心安装您所需要的功能扩展',
        ),

        array(
                    'type' =>'content',
                    'content' => '
                    <style>
                    .label{cursor: pointer;}
                    </style>
                    <div class="ui secondary menu"style="margin-top:-30px;">
    <a class="active item" data-tab="first">未安装</a>
  <a class="item" data-tab="second">未启用</a>
  <a class="item" data-tab="third">已启用</a>
  <a class="item" data-tab="fourth">检测更新</a>
</div>
  <!-- ExtensionsList loading -->
			<div class="ui basic segment" id="extensionsList-Loading" style="display:none">
    <div class="ui active blue elastic loader"></div>
    
    <br>
    <br>
    <br>
    <br>
</div>
<div class="ui bottom attached active tab " data-tab="first">

                   <table class="ui celled long scrolling black table">
  <thead>
    <tr>
    <th>扩展ID</th>
      <th>扩展名称</th>
      <th>扩展描述</th>
      <th>扩展版本</th>
      <th>扩展作者</th>
      <th>状态</th>
      <th>操作</th>
    </tr>
  </thead>
  <tbody id="extensionsList" style="word-break:break-all">

  </tbody>
</table>
<div class="extensionsPage"></div>
</div>


<div class="ui bottom attached tab " data-tab="second">

  <table class="ui celled long scrolling black table">
  <thead>
    <tr>
    <th>扩展ID</th>
      <th>扩展名称</th>
      <th>扩展描述</th>
      <th>扩展版本</th>
      <th>扩展作者</th>
      <th>状态</th>
      <th>操作</th>
    </tr>
  </thead>
  <tbody id="extensionsList_noOpen" style="word-break:break-all">

  </tbody>
</table>
<div class="extensionsPage_noOpen"></div>


</div>

<div class="ui bottom attached tab " data-tab="third">

 <table class="ui celled long scrolling black table">
  <thead>
    <tr>
    <th>扩展ID</th>
      <th>扩展名称</th>
      <th>扩展描述</th>
      <th>扩展版本</th>
      <th>扩展作者</th>
      <th>状态</th>
      <th>操作</th>
    </tr>
  </thead>
  <tbody id="extensionsList_Open" style="word-break:break-all">

  </tbody>
</table>
<div class="extensionsPage_Open"></div>



</div>

<div class="ui bottom attached tab " data-tab="fourth">

  <table class="ui celled long scrolling black table">
  <thead>
    <tr>
    <th>扩展ID</th>
      <th>扩展名称</th>
      <th>扩展描述</th>
      <th>扩展作者</th>
      <th>当前版本</th>
      <th>最新版本</th>
      <th>操作</th>
    </tr>
  </thead>
  <tbody id="extensionsList_Upgrade" style="word-break:break-all">
  </tbody>
</table>
<div class="extensionsPage_Upgrade"></div>
</div>
<script src="'.Helper::options()->themeUrl.'/assets/js/bearhoney_backend.js?v=11"></script>
',
                ),
               
        
    )
  ) );
  require_once('core/Extensions.php');
  
  
  
  
CSF::createSection( $prefix, array(
    'title'       => '数据备份',
    'icon'        => 'fas fa-shield-alt',
    'description' => '本主题支持您通过以下功能对您所填写的配置信息进行备份导出，也可以对备份的数据进行导入。',
    'fields'      => array(

        array(
            'type' => 'backup',
        ),

    )
) );

?>

<?php

                $htmls = '
        <div class="ui three steps">
  <div class="step" id="check">
    <i class="tree icon"></i>
    <div class="content">
      <div class="title">检测</div>
    </div>
  </div>
  <div class="disabled step" id="upgrade">
    <i class="angle double right icon"></i>
    <div class="content">
      <div class="title">升级</div>
    </div>
  </div>
  <div class="disabled step" id="finished">
    <i class="info icon"></i>
    <div class="content">
      <div class="title">完成</div>
    </div>
  </div>
</div>
<div id="checkcon">
<div class="ui placeholder segment">
  <div class="ui icon header">
    <i class="cloud icon"></i>
    您可以通过点击以下按钮进行检测是否符合在线升级的条件
  </div>
  <div class="inline">
    <div class="ui button" id="checkbtn">检测版本</div>
  </div>

</div>
  <div id="versiontipss"></div>
</div>
<div id="upgradecon" style="display:none">
<div class="ui placeholder segment">
  <div class="ui icon header">
    <i class="cloud icon"></i>
    检测到最新版本为 v<font id="newversion"></font>，您可以通过点击以下按钮进行在线升级
  </div>
<div class="ui piled segment" style="margin-top:10px;">
  <h4 class="ui header">更新内容</h4>
  <p id="upgradelog"></p>
</div>
  <div class="inline">
    <div class="ui button" id="upgradebtn" style="margin-top:-10px;">立即更新</div>
    
  </div>
 <center><div id="pre-message" style="margin-top:20px;"></div></center>
 <center><div id="progress-message" style="margin-top:20px;"></div></center>
<progress id="progress" value="0" max="100" style="display:none;margin-top:10px;width:100%;max-width:100%;height:20px"></progress> 

</div>
</div>

<div id="finishcon" style="display:none">
<div class="ui placeholder segment">
  <div class="ui icon header">
    <i class="green check icon"></i>
    您已成功升级到最新版本，系统将在三秒后自动刷新~~~
  </div>

</div>
</div>

<script>
//检测
$("#checkbtn").on("click",function(){
$("#checkbtn").addClass("loading").attr("disabled","disabled");
    $.post("https://upgrade.typecho.co.uk/Bearhoney/version.php",function(data,status){
switch(status)
{
case "success":
json = JSON.parse(data);
nowversion = "'.themeVersion().'";
if(json.version > nowversion){
$("#versiontipss").html(\'<div class="csf-submessage csf-submessage-warning">检测到有新版本可以更新，3秒钟后自动跳转下一步!</div>\');
$("#newversion").html(json.version);
$.post("https://upgrade.typecho.co.uk/Bearhoney/upgrade_log.php",function(data,status){
$("#upgradelog").html(data);
});
setTimeout(function(){
$("#check").addClass("completed");
$("#upgrade").removeClass("disabled");
$("#checkcon").hide();
$("#upgradecon").fadeIn();
},3000);
}
if(json.version == nowversion){
$("#versiontipss").html(\'<div class="csf-submessage csf-submessage-success">当前版本为最新版本，无需更新~<a href="https://docs.whitebear.dev/index.php/archives/7/" target="_blank">查看版本更新日志</a></div>\');
$("#checkbtn").removeClass("loading").removeAttr("disabled","disabled");
}
break;
case "error":
toastr.warning("最新版本获取失败，请稍后重试");
$("#checkbtn").removeClass("loading").removeAttr("disabled","disabled");
break;
case "timeout":
toastr.warning("最新版本获取超时，请稍后重试");
$("#checkbtn").removeClass("loading").removeAttr("disabled","disabled");
break;
}
    });
});

//升级
$("#upgradebtn").on("click",function(){
$("#upgradebtn").addClass("loading").attr("disabled","disabled");
$("#upgradebtn").css("pointer-events","none");

$.ajax({
                        type: "GET",
                        url: "/index.php/bh-upgrade",
                        data: {
                            "action": "prepare-download",
                        },
                        dateType: "json",
                        success: function(json) {
                            json = JSON.parse(json);
                            if(json.code == 0){
                             layer.msg(json.message, {icon: 2});  
                             $("#upgradebtn").removeClass("loading").removeAttr("disabled","disabled");
$("#upgradebtn").css("pointer-events","auto");
                            }
                            else{
                           $("#pre-message").html("升级包大小："+json.filesize+"，预计需要三十秒，请耐心等待~");
                           $("#progress-message").html("升级进度：0%");
                           $("#progress").fadeIn();
                        let x = document.getElementById("progress");   
                        x.setAttribute("value", "1");
                        intervaldown();
                        //设置定时器定时每5秒获取一次升级进度
                        let progressx = setInterval(function(){ 
                        intervalprogress();
                        }, 5000);
                        $("#progress").one("click",function(){
                            clearInterval(progressx);
                            finishUpgrade();
                        })
                        
                        
                            }
                        },
                        error: function() {
alert("升级准备检测失败，请稍后重试");
$("#upgradebtn").removeClass("loading").removeAttr("disabled","disabled");
                        }
                    });
                    
});
function intervaldown(){
$.ajax({
                        type: "GET",
                        url: "/index.php/bh-upgrade",
                        data: {
                            "action": "download",
                        },
                        dateType: "json",
                    });
}
function intervalprogress(){
$.ajax({
                        type: "GET",
                        url: "/index.php/bh-upgrade",
                        data: {
                            "action": "getsize",
                        },
                        dateType: "json",
                        success: function(json) {
                            json = JSON.parse(json);
                           $("#progress-message").html("升级进度："+json.filesize+"%");
let x = document.getElementById("progress");   
                        x.setAttribute("value", json.filesize);
                if(json.filesize == "100"){
                
                $("#progress-message").html("正在进行数据效验，请稍后...");
                setTimeout(function(){
                   $("#progress").click();
},3000);
                }
                        },
                        error: function() {
alert("获取升级进度失败");
                        }
                    });
}
function finishUpgrade(){
$.ajax({
                        type: "GET",
                        url: "/index.php/bh-upgrade",
                        data: {
                            "action": "finish",
                        },
                        dateType: "json",
                        success: function(json) {
$("#upgrade").addClass("completed");
$("#finished").removeClass("disabled");
$("#upgradecon").hide();
$("#finishcon").fadeIn();
setTimeout(function(){
window.parent.location.reload();
},3000);
                        },
                        error: function() {
alert("升级失败");
                        }
                    });
}
</script>
        ';
        
        CSF::createSection( $prefix, array(
    'title'       => '在线升级',
    'icon'        => 'fa fa-grav',
    
    'fields'      => array(
        array(
            'type'    => 'notice',
            'style'   => 'info',
            'content' => '<strong>注意事项</strong><p> <ul><li>1、若您有开启缓存，那么在升级完成后需要清除一次缓存。</li><li>2、若出现在线升级卡顿无法升级，可能是您的服务器网络到升级节点之间存在异常，则需要手动覆盖升级或者稍等一会再试试。</li><li>3、若升级完毕后出现报错，可尝试通过手动覆盖新版本来进行修复，下载地址:<a href="https://files.bear.dance/Bearhoney/Bearhoney_v'.themeVersionOnly().'.release.zip">戳这里</a></ul></p>',
        ),
array(
                    'type' =>'content',
                    'content' => $htmls,
                ),
        

    )
) );
}
function themeConfig($form)
{

   ?>
       <?php $all = Typecho_Plugin::export();
       \Widget\Security::alloc()->to($security);?>
<?php if (!array_key_exists('BearHoneyCore', $all['activated'])) : ?>
   <div class="update-check message error"><p>检测到未开启BearHoneyCore，主题尚处于封印状态，您需要安装启用BearHoneyCore核心插件后方能解除封印！<br>当下方出现解除封印按钮时点击按钮后即可解除封印~~~
   <?php if(is_dir(Helper::options()->pluginDir('BearHoneyCore'))):?><br><br><button onclick="window.location.href='<?php $security->index('/action/plugins-edit?activate=BearHoneyCore'); ?>'"  class="btn">
解除封印</button></p>
</div>
<?php endif;?>
   <?php else:?>
<style>
.body.container{
    max-width:100%!important;
}
</style>
        <link href="https://lf3-cdn-tos.bytecdntp.com/cdn/expire-1-M/toastr.js/2.1.4/toastr.min.css" rel="stylesheet">
	<script src="https://lf9-cdn-tos.bytecdntp.com/cdn/expire-1-M/toastr.js/2.1.4/toastr.min.js"></script>
        
<?php

    $params = [
        'args'=> [
            'framework_title' => 'BearHoney v'.themeVersionOnly(),
            'footer_text' => '自豪的采用BearHoney主题!',
        ]
    ];
    CSF::setup('bearhoney', $params);
    
    ?>
       <?php endif; ?>
       <?php
       CSF::setTypechoOptionForm($form);
       ?>
              <?php if (array_key_exists('BearHoneyCore', $all['activated'])) : ?>
          <style>

        .popup{
            all:unset;
            font-size:0; overflow:hidden;
        }
        .message{
            all:unset;
            font-size:0; overflow:hidden;
        }
        .message a{
            all:unset;
            font-size:0; overflow:hidden;
        }
        .success{
            all:unset;
            font-size:0; overflow:hidden;
        }
        .success a{
            all:unset;
            font-size:0; overflow:hidden;
        }
        .message.popup.success{
            all:unset;
            font-size:0; overflow:hidden;
        }
        </style>
           <script>
           window.deactivateURL = '<?php $security->index('/action/plugins-edit?deactivate=BearHoneyCore'); ?>';
           window.activateURL = '<?php $security->index('/action/plugins-edit?activate=BearHoneyCore'); ?>';
           window.siteName = "<?php echo Helper::options()->title; ?>";
           window.siteDesc = "<?php echo Helper::options()->description; ?>";
           window.siteUrl = "<?php echo Helper::options()->siteUrl; ?>";
           window.useTheme = 'bearhoney';
           window.siteToken = '<?php echo General::md5Encode(Helper::options()->siteUrl); ?>7bae2123bear';
        </script>
<?php endif; ?>

       <?php if (!array_key_exists('BearHoneyCore', $all['activated'])) : ?>
       
    <script src="https://lf3-cdn-tos.bytecdntp.com/cdn/expire-1-M/jquery/2.0.0/jquery.min.js"></script>
    

   <script>
       $('#wpwrap').hide();
   </script>
   <?php endif; ?>
    <?php
} ?>