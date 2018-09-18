@extends('Admin.index')
@section('content')
<style>

</style>
<body>
<div class="x-body layui-anim layui-anim-up" >
    <form class="layui-form" id="textForm" name="example">
        <div class="layui-form-item">
            <label for="L_email" class="layui-form-label">
                <span class="x-red">*</span>标题
            </label>
            <div class="layui-input-inline">
                <input type="text" id="L_email" name="title"" required="" lay-verify="name"
                autocomplete="off" class="layui-input" value="{{$articel->title}}">
            </div>
            <div class="layui-form-mid layui-word-aux">
                <span class="x-red">*</span>将会成为您唯一的登入名
            </div>
        </div>
        <div class="layui-form-item">
                <label for="L_email" class="layui-form-label">
                    <span class="x-red">*</span>文章
                </label>
                <div class="layui-input-inline">
                    <!-- <textarea id="editor_id" name="content" style="width:700px;height:300px;" id="textarea">
                    &lt;strong&gt;HTML内容&lt;/strong&gt;
                    </textarea> -->
                    <textarea name="content1"  id="editor_id" style="width:1200px;height:600px;visibility:hidden;" >
                        {{$articel->content}}
                    </textarea>
                </div>
            </div>
        <div class="layui-form-item">
            <label for="L_repass" class="layui-form-label">
            </label>
            <button  class="layui-btn" lay-filter="add" lay-submit="" id="btn">
                修改文章
            </button>
            <a  class="layui-btn layui-btn-primary" lay-filter="add" lay-submit="" id="btn" href="javascript:history.back(-1)">
                返回上一页
            </a>
        </div>
    </form>
</div>
<script charset="utf-8" src="{{asset('text/kindeditor-all.js')}}"></script>
<script charset="utf-8" src="{{asset('text/lang/zh-CN.js')}}"></script>
<script>
        KindEditor.ready(function(K) {
                window.editor = K.create('textarea[name="content1"]', {
				cssPath : '{{asset("text/plugins/code/prettify.css")}}',
				uploadJson : '{{url("aadmin/articel/image")}}',
				fileManagerJson : '../php/file_manager_json.php',
				allowFileManager : true,
				afterCreate : function() {
					var self = this;
					K.ctrl(document, 13, function() {
						self.sync();
						K('form[name=example]')[0].submit();
					});
					K.ctrl(self.edit.doc, 13, function() {
						self.sync();
						K('form[name=example]')[0].submit();
					});
				}
            });
            
            $('#btn').click(function(){
                    // 同步数据后可以直接取得textarea的value
                    editor.sync();
                    $.ajax({
                        type:'PUT',
                        url:'{{url("aadmin/articel/".$articel->id)}}',
                        data:$('#textForm').serialize(),
                        dateType:'json',
                        success:function(data){
                            if(data.status == 1){
                                layer.msg(data.message, {icon: 1});
                                location.href="{{url('aadmin/articel/')}}"
                            }else{
                                layer.msg(data.message,{icon:5})
                            }
                        }
                    })
                    return false;
                })
        });
        
</script>
@endsection