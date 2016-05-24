$(function() {
    function doLogin() {
        var username = $("input[name='username']").val();
        var password = $("input[name='password']").val();

        if(!(/^1[3|4|5|7|8][0-9]\d{4,8}$/.test(username))){
            alert('请输入正确的手机号!');
            return false;
        }

        if($.trim(password) == '') {
            alert('密码不能为空!');
            return false;
        }

        $.ajax({
            type: 'POST',
            url: '/index.php/login/dologin' ,
            data:  {'username': username, 'password': password},
            dataType: 'json',
            success: function(data) {
                if(data.return_code == 0) {
                    location.href = '/index.php/Goods/index';
                } else {
                    alert(data.return_msg);
                }
            }
        });
    }

    $('.login-btn').click(function() {
        doLogin();
    });

    $("input[name='username'],input[name='password']").bind('keypress',function(event){
        if(event.keyCode == "13")
        {
            doLogin();
        }
    });
});