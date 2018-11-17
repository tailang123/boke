@extends('Admin.index')
@section('content')
<body class="layui-anim layui-anim-up">
<div class="x-nav">
    <span class="layui-breadcrumb">
    <a href="">首页</a>
    <a href="">演示</a>
    <a>
        <cite>导航元素</cite></a>
    </span>
    <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right" href="javascript:location.replace(location.href);" title="刷新">
    <i class="layui-icon" style="line-height:30px">ဂ</i></a>
</div>
<div class="x-body">
    <div class="layui-row">
    <form class="layui-form layui-col-md12 x-so">
        <input class="layui-input" placeholder="开始日" name="start" id="start">
        <input class="layui-input" placeholder="截止日" name="end" id="end">
        <input type="text" name="username"  placeholder="请输入用户名" autocomplete="off" class="layui-input">
        <button class="layui-btn"  lay-submit="" lay-filter="sreach"><i class="layui-icon">&#xe615;</i></button>
    </form>
    </div>
    <xblock>
    <button class="layui-btn layui-btn-danger"  id="delbtn"><i class="layui-icon"></i>批量删除</button>
    <!-- <button class="layui-btn" onclick="x_admin_show('添加用户','{{url('aadmin/user/create')}}',600,400)"><i class="layui-icon"></i>添加</button> -->
    <span class="x-right" style="line-height:40px">共有数据：{{$count}} 条</span>
    </xblock>
    <table class="layui-table">
    <thead>
        <tr>
        <th>
            <div class="layui-unselect header layui-form-checkbox"  lay-skin="primary" ><i class="layui-icon" ">&#xe605;</i></div>
        </th>
        <th>ID</th>
        <th>用户名</th>
        <th>登录次数</th>
        <th>加入时间</th>
        <th>修改时间</th>
        <th>操作</th></tr>
    </thead>
    <tbody>
        @foreach( $ip as $ips)
        <tr>
        <td>
            <div class="layui-unselect layui-form-checkbox checked" lay-skin="primary" data-id='2' attr-id="{{$ips->id}}"><i class="layui-icon">&#xe605;</i></div>
        </td>
        <td>{{$ips->id}}</td>
        <td>{{$ips->ip}}</td>
        <td>{{$ips->created_at}}</td>
        <td>{{$ips->updated_at}}</td>
        <td class="td-status">
            <span class="layui-btn layui-btn-normal layui-btn-mini">已启用</span></td>
        <td class="td-manage">
            <a onclick="member_stop(this,'10001')" href="javascript:;"  title="启用">
            <i class="layui-icon">&#xe601;</i>
            </a>
            <!-- <a title="编辑"  onclick="x_admin_show('编辑','{{url('aadmin/user/'.$ips->id.'/edit')}}',600,400)" href="javascript:;">
            <i class="layui-icon">&#xe642;</i>
            </a> -->
            
            <a title="删除" class="del" attr_id="{{$ips->id}}" href="javascript:;">
            <i class="layui-icon">&#xe640;</i>
            </a>
        </td>
        </tr>
        @endforeach
    </tbody>
    </table>
    <div class="page">
    <div>
        <!-- <a class="prev" href="">&lt;&lt;</a>
        <a class="num" href="">1</a>
        <span class="current">2</span>
        <a class="num" href="">3</a>
        <a class="num" href="">489</a>
        <a class="next" href="">&gt;&gt;</a> -->
        {{ $ip->links() }}
    </div>
    </div>

</div>
<script>
    
    $('#delbtn').click(function(){
        var a = $('.layui-form-checked');
        var arr = new Array();
        a.each(function(i){
            arr[i] = $(this).attr('attr-id');
        })
        var id = arr.join(',');
        layer.confirm('确认删除吗',function(){
            $.ajax({
                type:'POST',
                url:'{{url("aadmin/user/destroy")}}',
                data:{id:id},
                dataType:'json',
                success:function(data){
                    console.log(data);
                    if(data.status == 1){
                        layer.msg('删除成功',{icon:1})
                    }else{
                        layer.msg('删除失败',{icon:5})
                    }
                }
            })
        })
    })

    /*用户-停用*/
    function member_stop(obj,id){
        layer.confirm('确认要停用吗？',function(index){

            if($(obj).attr('title')=='启用'){

            //发异步把用户状态进行更改
            $(obj).attr('title','停用')
            $(obj).find('i').html('&#xe62f;');

            $(obj).parents("tr").find(".td-status").find('span').addClass('layui-btn-disabled').html('已停用');
            layer.msg('已停用!',{icon: 5,time:1000});

            }else{
            $(obj).attr('title','启用')
            $(obj).find('i').html('&#xe601;');

            $(obj).parents("tr").find(".td-status").find('span').removeClass('layui-btn-disabled').html('已启用');
            layer.msg('已启用!',{icon: 5,time:1000});
            }
            
        });
    }

    /*用户-删除*/
    // function member_del(obj,id){
    //     layer.confirm('确认要删除吗？',function(index){
    //         //发异步删除数据
    //         $(obj).parents("tr").remove();
    //         layer.msg('已删除!',{icon:1,time:1000});
    //     });
    // }

    $('.del').click(function(){
        var id = $(this).attr('attr_id');
        layer.confirm('确认删除吗',function(){
            $.ajax({
                type:'DELETE',
                data:{id:id},
                url:'{{url("aadmin/user")."/"}}'+id,
                dataType:'JSON',
                success:function(data){
                    if(data.status == 1){
                        layer.msg(data.msg,{icon:1});
                    }else{
                        layer.msg(data.msg,{icon:5});
                    }
                }
            })
        })
        return false;
    });

    // function delAll (argument) {

    // var data = tableCheck.getData();

    // layer.confirm('确认要删除吗？'+data,function(index){
    //     //捉到所有被选中的，发异步进行删除
    //     layer.msg('删除成功', {icon: 1});
    // });
    // }
</script>
</body>
@endsection