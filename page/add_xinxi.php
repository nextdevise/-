<?php
	include_once("../config.php");
	$sql = "select value from config where title='xxzxauto'";
	$requ = mysqli_query($con,$sql);
	$rs = mysqli_fetch_array($requ);
	$xxat = $rs['value'];
	$bm = $_SESSION['bm'];
	if($bm == 0){
		$bm = '';
	}else{
		$bm = " and id in ($bm)";
	}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>添加信息中心资产</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" href="../lib/layui-v2.5.5/css/layui.css" media="all">
    <link rel="stylesheet" href="../css/public.css" media="all">
	<style type="text/css">
		#delimg{color:#f00;width:20px;height:20px;font-size:20px;border:1px solid #f00;border-radius:10px;}
	</style>
</head>
<body>
<div class="layuimini-container">
    <div class="layuimini-main">
	<form class="layui-form" action="" id="addxzxform" lay-filter="example">
		<div class="layui-form-item">
			<div class="layui-inline">
				<label class="layui-form-label">资产类型*</label>
				<div class="layui-input-inline">
					<select name="zclx" lay-verify="required" lay-search="" lay-filter="changeleibie">
						<?php
							$sql = "select id,name from zclx where status=1 and zcfl=1";
							$requ = mysqli_query($con,$sql);
							while($rs = mysqli_fetch_array($requ)){
								echo '<option value="'.$rs['id'].'">'.$rs['name'].'</option>';
							}
						?>
					</select>
				</div>
			</div>
			<div class="layui-inline">
				<label class="layui-form-label">资产状态*</label>
				<div class="layui-input-inline">
					<select name="zczt" lay-verify="required" lay-search="">
						<?php
							$sql = "select id,name from zhuangtai where status=1";
							$requ = mysqli_query($con,$sql);
							while($rs = mysqli_fetch_array($requ)){
								echo '<option value="'.$rs['id'].'">'.$rs['name'].'</option>';
							}
						?>
					</select>
				</div>
			</div>
			<div class="layui-inline">
				<label class="layui-form-label">财务资产名</label>
				<div class="layui-input-inline">
					<input type="text" name="cw" autocomplete="off" class="layui-input">
				</div>
			</div>
		</div>
		<div class="layui-form-item">
			<div class="layui-inline">
				<label class="layui-form-label">资产编号</label>
				<div class="layui-input-inline">
					<input type="text" name="zcbh" autocomplete="off" class="layui-input">
				</div>
			</div>
			<div class="layui-inline">
				<label class="layui-form-label">序列号*</label>
				<div class="layui-input-inline">
					<input type="text" name="xlh" lay-verify="required" autocomplete="off" class="layui-input">
				</div>
			</div>
		</div>
		<div class="layui-form-item">
			<div class="layui-inline">
				<label class="layui-form-label">保管人*</label>
				<div class="layui-input-inline">
					<input type="text" name="bgr" lay-verify="required" autocomplete="off" class="layui-input">
				</div>
			</div>
			<div class="layui-inline">
				<label class="layui-form-label">单位*</label>
				<div class="layui-input-inline">
					<select name="bm" lay-verify="required" lay-search="">
						<?php
							$sql = "select id,name from danwei where status=1 $bm";
							$requ = mysqli_query($con,$sql);
							while($rs = mysqli_fetch_array($requ)){
								echo '<option value="'.$rs['id'].'">'.$rs['name'].'</option>';
							}
						?>
					</select>
				</div>
			</div>
			<div class="layui-inline">
				<label class="layui-form-label">地址*</label>
				<div class="layui-input-inline">
					<input type="text" name="dz" lay-verify="required" autocomplete="off" class="layui-input">
				</div>
			</div>
		</div>
		<div class="layui-form-item">
		   <div class="layui-inline">
				<label class="layui-form-label">采购日期</label>
				<div class="layui-input-inline">
					<input type="text" name="cgsj" id="cgsj" value="<?php echo date("Y-m-d",time()); ?>" lay-verify="date" autocomplete="off" class="layui-input">
				</div>
			</div>
		   <div class="layui-inline">
				<label class="layui-form-label">入账日期</label>
				<div class="layui-input-inline">
					<input type="text" name="rzsj" id="rzsj" value="<?php echo date("Y-m-d",time()); ?>" lay-verify="date" autocomplete="off" class="layui-input">
				</div>
			</div>
		</div>
		<div class="layui-form-item">
			<div class="layui-inline">
				<label class="layui-form-label">质保时长</label>
				<div class="layui-input-inline">
					<input type="number" name="zbsc" value="0" lay-verify="number" autocomplete="off" class="layui-input">
				</div>
			</div>
			<div class="layui-inline">
				<label class="layui-form-label">报废年限</label>
				<div class="layui-input-inline">
					<input type="number" name="sysc" value="0" lay-verify="number" autocomplete="off" class="layui-input">
				</div>
			</div>
		</div>
		<div class="layui-form-item">
			<div class="layui-inline">
				<label class="layui-form-label">品牌*</label>
				<div class="layui-input-inline">
					<input type="text" name="pp" lay-verify="required" autocomplete="off" class="layui-input">
				</div>
			</div>
			<div class="layui-inline">
				<label class="layui-form-label">型号</label>
				<div class="layui-input-inline">
					<input type="text" name="xh" autocomplete="off" class="layui-input">
				</div>
			</div>
		</div>
		<div class="layui-form-item">
			<label class="layui-form-label">规格</label>
			<div class="layui-input-block">
				<input type="text" name="gg" autocomplete="off" class="layui-input">
			</div>
		</div>
		<div class="layui-form-item">
			<div class="layui-inline">
				<label class="layui-form-label">资产来源</label>
				<div class="layui-input-inline">
					<input type="text" name="zcly" value="自购" autocomplete="off" class="layui-input">
				</div>
			</div>
			<div class="layui-inline">
				<label class="layui-form-label">资产价值</label>
				<div class="layui-input-inline">
					<input type="text" name="zcjz" value="0.00" lay-verify="huobi" autocomplete="off" class="layui-input">
				</div>
			</div>
		</div>
		<div class="layui-form-item">
			<label class="layui-form-label">备注</label>
			<div class="layui-input-block">
				<input type="text" name="bz" autocomplete="off" class="layui-input">
			</div>
		</div>
		<div class="layui-form-item">
			<label class="layui-form-label">资产图片</label>
			<button type="button" class="layui-btn layui-btn-normal" id="upzcimg">上传图片</button>
		</div>
		<div class="layui-form-item" style="display:none;" id="imgdiv">
			<label class="layui-form-label">图片预览</label>
			<img style="width:100px;height:60px;" id="zcimg">
			<i class="layui-icon layui-icon-close" title="删除图片" id="delimg"></i>
			<!--（点击图片查看大图）-->
			<input type="hidden" name="img" id="img" autocomplete="off" class="layui-input">
		</div>
		<div class="layui-form-item" id="wlxx">
			<div class="layui-inline">
				<label class="layui-form-label">网络标识</label>
				<div class="layui-input-inline">
					<select name="wlbs" lay-verify="required" lay-search="">
						<option value="0" selected="">未分配</option>
						<option value="1">内网</option>
						<option value="2">外网</option>
					</select>
				</div>
			</div>
			<div class="layui-inline">
				<label class="layui-form-label">IP地址</label>
				<div class="layui-input-inline">
					<input type="text" name="ip" autocomplete="off" class="layui-input">
				</div>
			</div>
		</div>
		<div class="layui-form-item" id="dnpz">
			<div class="layui-inline">
				<label class="layui-form-label">显示器</label>
				<div class="layui-input-inline">
					<input type="text" name="xsq" autocomplete="off" class="layui-input">
				</div>
			</div>
			<div class="layui-inline">
				<label class="layui-form-label">硬盘(G)</label>
				<div class="layui-input-inline">
					<input type="number" name="yp" autocomplete="off" class="layui-input">
				</div>
			</div>
			<div class="layui-inline">
				<label class="layui-form-label">内存(G)</label>
				<div class="layui-input-inline">
					<input type="number" name="nc" autocomplete="off" class="layui-input">
				</div>
			</div>
		</div>
		
		
		
		<div class="layui-form-item">
			<div class="layui-input-block">
				<button class="layui-btn" lay-submit="" lay-filter="demo1">立即提交</button>
				<button type="reset" class="layui-btn layui-btn-primary">重置</button>
				<button type="button" class="layui-btn layui-btn-danger" id="drfromexcel">从Excel导入</button>
			</div>
		</div>
	</form>
    </div>
</div>

<script src="../lib/layui-v2.5.5/layui.js" charset="utf-8"></script>
<!-- 注意：如果你直接复制所有代码到本地，上述js路径需要改成你本地的 -->
<script>
    layui.use(['form', 'laydate', 'upload'], function () {
        var form = layui.form
            , layer = layui.layer
            , laydate = layui.laydate
			, upload = layui.upload
			, $ = layui.$;

        laydate.render({
            elem: '#cgsj'
        });
        laydate.render({
            elem: '#rzsj'
        });

        form.verify({
            huobi: [
                /^(([1-9]\d*)|0)(\.\d{1,2})?$/
                , '请正确输入资产价值'
            ]
        });
		
		$("#delimg").click(function(){
			var t = $("#img").val();
			t = t.replace(/\/uploads\//,"");
			console.log(t);
			$("#zcimg").attr("src","");
			$("#img").val('');
			$("#imgdiv").hide();
			$.post("../uploads/delimg.php",{mode:"deleteimage",file:t},function(res){
				console.log(res);
				
				
				
			})
		});
		
		$("#zcimg").click(function(){
			var t = $(this).attr("src");
			layer.open({
				type: 1,
				title: false,
				closeBtn: 0,
				area: '680px',
				skin: 'layui-layer-nobg',
				shadeClose: true,
				content: '<img style="display: inline-block; width: 100%; height: 100%;" src="'+t+'">'
			});
		})
		
		$("#drfromexcel").click(function(){
			var index = layer.open({
				title: '导入',
				type: 2,
				shade: 0.2,
				maxmin:true,
				shadeClose: true,
				area: ['100%', '100%'],
				content: '/page/daoru.php?zz=1',
			});
		});
		
		  var uploadInst = upload.render({
			elem: '#upzcimg'
			,url: '../upload.php'
			,done: function(res){
				//var r = JSON.stringify(res[0]);
				//console.log(r);
				if(res[0].status==1){
					//location.reload();
					$("#zcimg").attr("src","/uploads/" + res[0].file);
					$("#img").val("/uploads/" + res[0].file);
					$("#imgdiv").show();
				}else{
					layer.alert(res[0].msg);
				}
			}
			,error: function(){

			}
		  });
		

        form.on('submit(demo1)', function (data) {
			var d = JSON.stringify(data.field);
			d=d.replace(/\'/g,"’");
			$.post("../action.php?mode=addxxzxzc",{zz:1,data:d},function(result){
				console.log(result);
				var r = JSON.parse(result);
				if(r.status==1){
					var index = layer.alert('添加成功',function () {
						layer.close(index);
						$("#zcimg").attr("src","");
						$("#img").val('');
						$("#imgdiv").hide();
						<?php 
						if($xxat==0){
							echo '$("#addxzxform")[0].reset();';
							echo 'form.render();';
						}
						?>
					});
				}else{
					layer.alert(r.msg);
				}
			});
            return false;
        });
		
	  form.on('select(changeleibie)', function(data){
		console.log(data);
	  });
<?php
	if(isset($_SESSION['addlishi']) && $xxat==1){
		$d = $_SESSION['addlishi'];
		$d = json_decode($d);
		$zclx = $d->zclx;
		if(empty($zclx)){$zclx='0';}
		
		if(array_key_exists('wlbs', $d)){
			$wlbs = $d->wlbs;
		}else{
			$wlbs = 0;
		}
		if(array_key_exists('xsq', $d)){
			$xsq = $d->xsq;
		}else{
			$xsq = 0;
		}
		if(array_key_exists('yp', $d)){
			$yp = $d->yp;
		}else{
			$yp = 0;
		}
		if(array_key_exists('nc', $d)){
			$nc = $d->nc;
		}else{
			$nc = 0;
		}
		echo "form.val('example', {
				'zclx': ".$zclx."
				,'zczt': ".$d->zczt."
				,'bm': ".$d->bm."
				,'dz': '".$d->dz."'
				,'zcbh': '".$d->zcbh."'
				,'xlh': '".$d->xlh."'
				,'cgsj': '".$d->cgsj."'
				,'rzsj': '".$d->rzsj."'
				,'pp': '".$d->pp."'
				,'xh': '".$d->xh."'
				,'gg': '".$d->gg."'
				,'zcly': '".$d->zcly."'
				,'zcjz': '".$d->zcjz."'
				,'zbsc':".$d->zbsc."
				,'sysc':".$d->sysc."
				,'wlbs':".$wlbs."
				,'xsq':'".$xsq."'
				,'yp':'".$yp."'
				,'nc':'".$nc."'
			})";
	}
?>

		
    });
</script>

</body>
</html>