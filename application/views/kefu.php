<div class="about-wrap" id="aboutWrap" style="">
    <div class="item por-r ta-c">
        <div class="about-info" id="slide">
            <div class="close">
                <i class="iconfont">&#xe6e5;</i>
            </div>
            <div class="pt-10 service">
                <i class="iconfont">&#xe6b4;</i>
            </div>
            <div>
                <span class="fs-14">联系客服</span>
            </div>
        </div>
    </div>

    <div class="about-slide d-n" id="slide1">
        <div class="about-slide-box box-contact">
        <a href="#">
                <i class="iconfont mr-5">&#xe6ae;</i>
                <span class="fs-16">联系客服咨询</span>
            </a>
        </div>
        <div class="mt-5 about-slide-box box-phone">
            <i class="iconfont mr-5">&#xe60a;</i>
            <span class="fs-15"><?php echo (get_user()['data']['bd_mobile']); ?></span>
        </div>

        

        <div class="inner-wrap">&nbsp;</div>
    </div>
</div>
<script>
		$(".close i").click(function(){
			$("#aboutWrap").hide();
		})
	$("#aboutWrap").mousemove(function(){
		$("#slide").addClass("actived");
		$("#slide1").show();
	})
		$("#aboutWrap").mouseout(function(){
		$("#slide").removeClass("actived");
		$("#slide1").hide();
	})
	
	
	
</script>