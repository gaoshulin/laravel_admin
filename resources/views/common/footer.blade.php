<!-- 尾部 -->
<div class="footer"></div>
<footer class="layui-bg-cyan">
    <div class="layui-container">
        <div class="layui-row">
            <p>本站部分内容来源于网络，若侵犯到您的利益，请联系站长删除！谢谢！Powered By
                <a href="http://wpa.qq.com/msgrd?v=3&uin=1453811292&site=qq&menu=yes" target="_blank" title="XzcBlogTemplate">1453811292@qq.com</a>
            </p>
        </div>
    </div>
</footer>
</body>
<script src="{{ asset('static/layui/layui.all.js') }}"></script>
<script>
    layui.carousel.render({
        elem: '#carousel'
        , width: '100%' //设置容器宽度
        , arrow: 'always' //始终显示箭头
        //,anim: 'updown' //切换动画方式
    });
    layui.laypage.render({
        elem: 'pages' //注意，这里的 test1 是 ID，不用加 # 号
        , count: 123 //数据总数，从服务端得到
    });
</script>
</html>