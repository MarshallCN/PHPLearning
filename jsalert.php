<script>
function firm() {  
         //���öԻ��򷵻ص�ֵ ��true ���� false��  
       if (confirm("��ȷ���ύ��")) {  
             alert("�����ȷ��");  
         }  
        else {  
            alert("�����ȡ��");  
         }  
  
    }  
</script>


<!-----------��ť��ʾ��---------->  
<input type="button" name="btn2" id="btn2" value="ɾ��" onclick="confirm('Yes/No');firm();"/>
 
 <!-----------��ť��ʾ��---------->   
<input type="button" name="btn2" id="btn2" value="��ʾ" onclick="javaScript:alert('��ȷ��Ҫɾ����');"/>
   
 <!-----------�ύ��ť---------->   
<input type="button" value="�ύ" onclick="javaScript:window.location.href='http://www.baidu.com';"/>  
   
 <!-----------�رհ�ť---------->   
 <input type="button" value="�ر�" onclick="javaScript:window.close();">  
   
 <!-----------���ز��ر�����---------->   
 <a href="#" onclick="javascript:;window.opener.location.reload();window.close()">����</a>  javaScript:window.location.reload();//���ص�ǰҳ��ˢ��  
   
<!-----------������һ��ҳ��---------->   
 <input type="button" name="button" value="< ����" onclick="javascript:history.go(-1)"/>  

