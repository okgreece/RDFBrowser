/**
 * @file        基于jQuery的图片懒加载插件
 * @author      龙泉 <yangtuan2009@126.com>
 * @version     1.1.0
 */
(function(){

    /**
     * 图片懒加载的实现函数
     * @param {Object} options 配置对象
     * @param {string} options.selector 懒加载图片的选择器查询字符串。
     * @param {string} options.src 懒加载图片的真实url的保存属性。
     * @param {string} params.effect 用来指定加载图片时的效果，默认为"none"——即无效果，另外"fadeIn"——表示淡入效果。
     * @param {number} params.threshold 设置一个阀值，用来指定可以提前加载多少范围之外的图片。默认为0——不提前加载。
     * @param {number} params.timeout 懒加载行为响应的延迟时间，默认为0——表示不做延迟处理。
     * @param {boolean} params.viewport 是否仅加载可视窗口之内的图片，默认为false——表示将加载可视窗口内以及位于之前的所有图片。
     */
    function LazyLoad(options)
    {
        //参数匹配
        var $win = $(window),
            opt = $.extend({
                selector: "img[data-src]",
                src: "data-src",
                effect: "none",
                threshold: 0,
                timeout: 0,
                viewport: false
            }, options),
            src = opt.src,
            threshold = opt.threshold,
            eventName = "scroll resize",
            timerID, goLoadImg;

        //初始化处理
        this.init = function() {

            removeEvent();
            bindEvent();
            goLoadImg();
        };

        //执行单次图片加载
        goLoadImg = opt.timeout === 0 ? loadImg : function(){
            clearTimeout(timerID);
            timerID = setTimeout(loadImg, opt.timeout);
        };

        //图片加载的处理函数
        function loadImg()
        {
            // console.info("loadImg start!");
            var elements = $(opt.selector),
                i = 0,
                len = elements.length,
                scrollTop = $win.scrollTop(),
                viewHeight = $win.height(),
                didLazy = 0;

            //循环图片列表，当图片位于显示窗口时则将其加载
            //每加载一张图片，则将该图片从elements数组中移除
            for(; i < len; i++){
                checkImg(elements.eq(i));
            }

            //解除事件绑定
            len === 0 && removeEvent();

            // 检测图片的加载
            function checkImg($ele)
            {
                var offsetTop = $ele.offset().top;
                var imgSrc = $ele.attr(src);
                var cando = offsetTop <= scrollTop + viewHeight + threshold;
                var oImage;

                cando = cando && (!opt.viewport || offsetTop + $ele.height() + threshold >= scrollTop);

                if(cando){

                    didLazy += 1;  // 标识执行了图片加载的次数

                    // 仅当图片加载完成，才执行src属性的替换
                    oImage = new Image();

                    oImage.onload = function() {

                        $ele.attr("src", imgSrc).removeAttr(src);
                        opt.effect === "fadeIn" && $ele.css("opacity", 0).animate({opacity: 1});
                        doLazyAgain();
                    };

                    oImage.onerror = function() {

                        $ele.attr("src", imgSrc).removeAttr(src);
                        doLazyAgain();
                    };

                    oImage.src = imgSrc;
                }
            }

            // 图片加载完成后，还需要再一次执行验证
            // 避免图片自适应宽高时，导致图片未加载的异常情况
            function doLazyAgain()
            {
                didLazy--;

                if(didLazy <= 0) {
                    setTimeout(loadImg, 400);
                }
            }
        }

        // ===============================================================
        // 由于使用jQuery（测试项目使用的是1.7.2）的绑定scroll事件
        // 可能导致滑动滚动条时不会触发事件处理的情况
        // 所以使用如下的原生绑定进行代替

        // 绑定事件处理
        function bindEvent()
        {
            if(document.addEventListener) {

                window.addEventListener('scroll', goLoadImg);
                window.addEventListener('resize', goLoadImg);

            }else{

                window.attachEvent('onscroll', goLoadImg);
                window.attachEvent('onresize', goLoadImg);
            }
        }

        // 解除事件处理
        function removeEvent()
        {
            if(document.addEventListener) {

                window.removeEventListener('scroll', goLoadImg);
                window.removeEventListener('resize', goLoadImg);

            }else{

                window.detachEvent('onscroll', goLoadImg);
                window.detachEvent('onresize', goLoadImg);
            }
        }
    }

    //对外提供接口调用
    $.imgLazy = function(options){

        var obj = new LazyLoad(options);
        $.imgLazy = obj.init;
        obj.init();
    };

})();