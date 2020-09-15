<script>
function firm() {  
         //利用对话框返回的值 （true 或者 false）  
       if (confirm("你确定提交吗？")) {  
             alert("点击了确定");  
         }  
        else {  
            alert("点击了取消");  
         }  
  
    }  
</script>


<!-----------按钮提示框---------->  
<input type="button" name="btn2" id="btn2" value="删除" onclick="confirm('Yes/No');firm();"/>
 
 <!-----------按钮提示框---------->   
<input type="button" name="btn2" id="btn2" value="提示" onclick="javaScript:alert('您确定要删除吗？');"/>
   
 <!-----------提交按钮---------->   
<input type="button" value="提交" onclick="javaScript:window.location.href='http://www.baidu.com';"/>  
   
 <!-----------关闭按钮---------->   
 <input type="button" value="关闭" onclick="javaScript:window.close();">  
   
 <!-----------返回并关闭连接---------->   
 <a href="#" onclick="javascript:;window.opener.location.reload();window.close()">返回</a>  javaScript:window.location.reload();//返回当前页并刷新  
   
<!-----------返回上一级页面---------->   
 <input type="button" name="button" value="< 返回" onclick="javascript:history.go(-1)"/>  

