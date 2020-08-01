@include("layout/head")
@include("layout/center")


<!-- login -->
<div class="pages section">
    <div class="container">
        <div class="pages-head">
            <h3>LOGIN</h3>
        </div>
        <div class="login">
            <div class="row">
                <form class="col s12" id="myform">
                    @csrf
                    <div class="input-field">
                        <input type="text" class="validate" name="username" placeholder="USERNAME" required>
                    </div>
                    <div class="input-field">
                        <input type="password" class="validate" name="pwd" placeholder="PASSWORD" required>
                    </div>
                    <a href=""><h6>Forgot Password ?</h6></a>
                    <a href="" id="login" class="btn button-default">LOGIN</a>
{{--                    <input type="submit" value="LOGIN" class="btn button-default">--}}
                </form>
            </div>
        </div>
    </div>
</div>
<!-- end login -->
<script src="/js/jquery-3.2.1.min.js"></script>
<script>
    $(document).ready(function(){
        $("input[name=username]").blur(function(){
            var _this=$(this);
            var username=_this.val();
           if(username==""){
               alert("请输入用户名");
               return false;
           }
        })
        $("input[name=pwd]").blur(function(){
            var _this=$(this);
            var pwd=_this.val();
            if(pwd==""){
                alert("请输入密码");
                return false;
            }
        })
        $(document).on('click','#login',function(){
            $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
            var username=$("input[name=username]").val();
            var pwd=$("input[name=pwd]").val()
            $.ajax({
                url:"/login",
                type:'post',
                data:{username:username,pwd:pwd},
                dataType:'json',
                success:function(res){
                    console.log(res);
                }
        })
            return false;
        })

        })
</script>

<script src=""></script>
<!-- loader -->
<div id="fakeLoader"></div>
<!-- end loader -->
@include("layout/footer")