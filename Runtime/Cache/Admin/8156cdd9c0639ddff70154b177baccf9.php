<?php if (!defined('THINK_PATH')) exit();?>
  <!DOCTYPE html>
<html lang="zh-cn">
<head>
  <title>芝麻乐众筹管理后台</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="/Public/css/pintuer.css">
  <script src="/Public/js/jquery-1.8.3.min.js"></script>
  <script src="/Public/js/pintuer.js"></script>
  <script src="/Public/js/respond.js"></script>
  <script src="/Public/lib/layer/layer.js"></script>
</head>
<body style="background:#fafafa;">
	<!-- 导航 -->

<div class="container-layout  bg-white border-bottom margin-bottom">
  <div class="container padding-big-top padding-big-bottom">
    <div class="x12">
      <div class="x2 ">
        <a href="javascript:void(0)">
          <span class=" text-red" style="font-size: 32px;">芝麻乐</span><span class="text-gray padding-left">众筹管理后台</span>
        </a>
      </div>
		<div class="x5  text-right float-right">			  
			 <div class="navbar-text navbar-right hidden-s">
			 <span class="padding-right"> 欢迎登录 <?php echo session('admin_username');?> ( <?php echo ($group_name); ?>  ) </span>	
			 <a href="javascript:void(0)" onclick="my_edit()" class="button button-small icon-cog bg-blue"> 设置</a>
			  <a href="/" target="_blank"  class="button button-small icon-link bg-blue"> 访问网站</a>
			 <button type="button" id="loginout" class="button button-small icon-power-off bg-blue"> 退出系统</button></div>
		</div>
      </div>
    </div>
  </div>
<script>
	function my_edit(id){	
		layer.open({
			type: 2,
			area: ['700px', '360px'],
			fix: true, //不固定
			maxmin: true,
			title:'用户设置',
			content: '/index.php/Admin/Auth/my_edit'
		});
	}
</script>
 <div class="container">
	<div class="border x12">
    <div class="x2 bg-white border-right">	
	<div class="x12" style="min-height:800px">
	<div class="x12 border-bottom padding-bottom">
		<?php if(is_array($menu)): $i = 0; $__LIST__ = $menu;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><a href="<?php echo U($vo['name']);?>" class="button  padding-top padding-big-left border-none radius-none padding-bottom x12 <?php if('/index.php/Admin/News/index.html' == '/'.$vo['name'].'.html'): ?>bg-sub<?php endif; ?>"> <?php echo ($vo["title"]); ?> <span class="float-right icon-angle-right"></span></a>
		<?php if(is_array($vo["sub_menu"])): $i = 0; $__LIST__ = $vo["sub_menu"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><a href="<?php echo U($v['name']);?>" class="padding-large-left button x12  border-none radius-none <?php if('/index.php/Admin/News/index.html' == '/'.$v['name'].'.html'): ?>bg-sub<?php endif; ?>"><span class="padding-left"><?php echo ($v["title"]); ?><span class="float-right icon-angle-right"></span></span></a><?php endforeach; endif; else: echo "" ;endif; endforeach; endif; else: echo "" ;endif; ?>
	</div>
	<div class="clearfix"></div>
		<div class="padding text-center text-small text-gray">
			<a href="" class=" text-gray padding-right">帮助中心</a>|
			<a href="" class="text-gray padding-left">联系我们</a>
			<span class="text-gray padding-top x12">ZmlCMS 版权所有</span>
		</div> 
	</div>
            
    </div>
    <div class="x10 bg-white" style="min-height:680px;">
<script>

  $(function(){
    $('#loginout').click(function(){
      layer.confirm('确定要退出吗？', {icon: 3},function(){
        parent.layer.msg('退出成功!', {
          shift: 2,
          time: 1000,
          shade: [0.1,'#000'],
          end: function(){
            window.location.href = '<?php echo U('/Admin/Public/logout');?>';
          }
        });
      });
     });
  });

  //全局配置
layer.config({
    extend: [
        'extend/layer.ext.js' 
    ]
});
</script>
 
    <div class="x12 padding-top padding border-bottom">
		<h3 class="x3">新闻管理</h3>
		<a href="<?php echo U('/Admin/News/news_add');?>" class="float-right bg-sub button icon-plus" type="button" onclick="node_add()"> 添加新闻</a>
      </div>
      <div class="x12 padding">
        <table class="table table-bordered table-hover">
          <tbody>
            <tr>
             <th>新闻标题</th><th>所属分类</th><th>创建时间</th><th>操作</th>
            </tr>

            <?php if(is_array($lists)): $i = 0; $__LIST__ = $lists;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr id="tr<?php echo ($vo["id"]); ?>" class="height">
             
              <td><?php echo ($vo["title"]); ?></td>
              <td><?php echo ($vo["cname"]); ?></td>
              <td><?php echo (date("Y-m-d H:i",$vo["time"])); ?></td>
              <td>
                <button class="del button button-small bg-sub" sid="<?php echo ($vo["id"]); ?>" sname="<?php echo ($vo["title"]); ?>">删除</button>
                <a href="/index.php/Admin/News/news_edit/id/<?php echo ($vo["id"]); ?>" class=" button button-small bg-sub" >编辑</a>

              </td>
            </tr><?php endforeach; endif; else: echo "" ;endif; ?>

          </tbody>
        </table>
		<div class="margin-big-top">
          <ul class="pagination pagination-group">
            <?php echo ($page); ?>
          </ul>
        </div>
        </div>

        


      </div>
    </div>
  	<!-- 底部 -->
    
  </div>
<script type="text/javascript">
$(function(){
    //删除
    $('.del').click(function(){
        var sid = $(this).attr('sid');
        layer.confirm('确定要删除 "'+ $(this).attr('sname') +'" 吗？', {icon: 3},function(){
            $.ajax({
                type: 'POST',
                url: '<?php echo U('/Admin/News/news_del');?>',
                data:{
                    id:sid
                },
                dataType: "json",
                beforeSend: function() {
                  layer.closeAll();
                  layer.load(2,{shade: [0.1,'#000']});
                },
                success: function(data){
                  layer.closeAll();
                    if (data.status == 1) {
                        
                        layer.msg(data.info, {
                            shift: 2,
                            time: 1000,
                            shade: [0.1,'#000'],
                            end: function(){
                                $("#tr"+sid).remove();
                            }
                        });
                    }else{
                        layer.alert(data.info,{icon: 5});
                    }
                }
            });
        });
    });


});

</script>
</body>
</html>