var hash={ 
'qq.com': 'http://mail.qq.com', 
'gmail.com': 'http://mail.google.com', 
'sina.com': 'http://mail.sina.com.cn', 
'163.com': 'http://mail.163.com', 
'126.com': 'http://mail.126.com', 
'yeah.net': 'http://www.yeah.net/', 
'sohu.com': 'http://mail.sohu.com/', 
'tom.com': 'http://mail.tom.com/', 
'sogou.com': 'http://mail.sogou.com/', 
'139.com': 'http://mail.10086.cn/', 
'hotmail.com': 'http://www.hotmail.com', 
'live.com': 'http://login.live.com/', 
'live.cn': 'http://login.live.cn/', 
'live.com.cn': 'http://login.live.com.cn', 
'189.com': 'http://webmail16.189.cn/webmail/', 
'yahoo.com.cn': 'http://mail.cn.yahoo.com/', 
'yahoo.cn': 'http://mail.cn.yahoo.com/', 
'eyou.com': 'http://www.eyou.com/', 
'21cn.com': 'http://mail.21cn.com/', 
'188.com': 'http://www.188.com/', 
'foxmail.coom': 'http://www.foxmail.com' 
}; 

$(function(){ 

var url = $("#email").text().split('@')[1]; 
for (var j in hash){ 
$("#toemail").attr("href", hash[url]); 
}  
}) 


function ajaxSendEmail()
{
    
    data="&realname="+$("#realname").text()+"&email="+$("#email").text();
    url =window.location.pathname+"?r=user/email";
    $.ajax({
        type:"POST",
        url:url,
        data:data,
        success:function(data){
            alert(data);
        }

})
}
$(function(){
    
    $("#submitemail").click(function(){
   // alert("tet");
      data='&realname='+$('#realname').val()+"&email="+$("#email").val();
      url =window.location.pathname+"?r=user/changeemail";
      $.ajax({
        type:"POST",
        url:url,
        data:data,
        success:function(data){
            $("#newemail").html($("#email").val());
            var url = $("#email").val().split('@')[1]; 
            for (var j in hash){ 
            $("#checkemail").attr("href", hash[url]); 
            }
            $("#checkemail").show();  
            $("#emailform").hide();
            alert(data);
        }

});
return false;
});

    
});

