<?php
$id=$_GET['id'];

include_once("../config.php");

$sql = "select username,juese,bm from user where id=$id";
$requ = mysqli_query($con,$sql);
$rs = mysqli_fetch_array($requ);
$n = $rs['username'];
$j = $rs['juese'];
$qxbm = $rs['bm'];
mysqli_free_result($requ);
$sql = "select id,name from juese where status=1";
$requ = mysqli_query($con,$sql);

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>编辑用户</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" href="../lib/layui-v2.5.5/css/layui.css" media="all">
    <link rel="stylesheet" href="../css/public.css" media="all">
	<script src="/js/lay-module/xm-select.js" charset="utf-8"></script>
    <style>
        body {
            background-color: #ffffff;
        }
    </style>
</head>
<body>
<div class="layui-form layuimini-form">
    <div class="layui-form-item">
        <label class="layui-form-label required">名称</label>
        <div class="layui-input-block">
            <input type="text" name="username" lay-verify="required" lay-reqtext="名称不能为空" placeholder="请输入名称" value="<?php echo $n; ?>" class="layui-input">
        </div>
    </div>
	<div class="layui-form-item">
		<label class="layui-form-label">选择角色</label>
		<div class="layui-input-block">
			<select name="juse">
				<?php 
					while($rs = mysqli_fetch_array($requ)){
						if($rs['id']==$j){$xz = 'selected=""';}else{$xz = '';}
						echo '<option value="'.$rs['id'].'" '.$xz.'>'.$rs['name'].'</option>';
					}
				?>
			</select>
		</div>
	</div>
	<div class="layui-form-item">
		<label class="layui-form-label">权限部门</label>
		<div class="layui-input-block">
			<div id="qxbm"></div>
		</div>
	</div>
    <div class="layui-form-item">
        <div class="layui-input-block">
            <button class="layui-btn" lay-submit lay-filter="saveBtn">确认保存</button>
        </div>
    </div>
</div>
<script src="../lib/layui-v2.5.5/layui.js" charset="utf-8"></script>
<script>
	var qxbm = xmSelect.render({
		el: '#qxbm', 
		data: [
				{name:'全局',value:'0' <?php if($qxbm ==0){echo ', selected: true';} ?>},
				<?php
					$qx = explode(",", $qxbm);
					$sql = "select id,name from danwei where status=1";
					$requ = mysqli_query($con,$sql);
					while($rs = mysqli_fetch_array($requ)){
						$n = $rs['name'];
						$d = $rs['id'];
						if(in_array($d, $qx)){
							$ss = ', selected: true';
						}else{
							$ss = '';
						}
						echo "{name:'$n', value:'$d' $ss},";
					}
				?>
		],
   })


    layui.use(['form'], function () {
        var form = layui.form,
            layer = layui.layer,
            $ = layui.$;

        //监听提交
        form.on('submit(saveBtn)', function (data) {
			
		var selectArr = qxbm.getValue('valueStr');
		if(selectArr == ''){
			layer.msg("请选择权限");
			return false;
		}
		console.log(selectArr);
		//alert(JSON.stringify(selectArr, null, 2));
		var tarra = selectArr.split(',');    //字符串转数组
		if(tarra.includes('0')){
			selectArr=0;
		}
			
			$.post("../action.php?mode=edityonghu",{id:<?php echo $id; ?>,name:data.field.username,js:data.field.juse,qxbm:selectArr},function(res){
				var r = JSON.parse(res);
				if(r.status==1){
					var index = layer.alert('修改成功', {
						title: '信息'
					}, function () {
						// 关闭弹出层
						layer.close(index);
						var iframeIndex = parent.layer.getFrameIndex(window.name);
						parent.layer.close(iframeIndex);
						//parent.location.reload();  
						parent.layui.table.reload('currentTableId', {
							url: '../action.php?mode=getuserlist'
						});
					});
				}else{
					layer.msg(r.msg);
				}
			});
            return false;
        });

    });
</script>
</body>
</html>