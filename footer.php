<footer id="footer_div">
    <div class="container">

        <div class="col-md-6 flot-right">
            <ul class="footer_menu">
                <li><a href="term-service">Terms of Service</a></li>
                <li><a href="privacy">Privacy Policy</a></li>
                <li><a href="contact">Contact Us</a></li>
            </ul>
        </div>
        <div class="col-md-6 right-text flot-left">©2016 TBESportsGaming, LLC</div>
    </div>
</footer>

<style>
    #footer_div {
        text-align: center;
        width: 100%;
    }
</style>
<!--Start of Tawk.to Script-->
<script type="text/javascript">
    var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
    (function(){
        var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
        s1.async=true;
        s1.src='https://embed.tawk.to/57838e621ca3e686763cca2e/default';
        s1.charset='UTF-8';
        s1.setAttribute('crossorigin','*');
        s0.parentNode.insertBefore(s1,s0);
    })();
</script>
<!--End of Tawk.to Script-->




<script>
    equalheight = function(container) {

        var currentTallest = 0,
                currentRowStart = 0,
                rowDivs = new Array(),
                $el,
                topPosition = 0;
        $(container).each(function() {

            $el = $(this);
            $($el).height('auto')
            topPostion = $el.position().top;

            if (currentRowStart != topPostion) {
                for (currentDiv = 0; currentDiv < rowDivs.length; currentDiv++) {
                    rowDivs[currentDiv].height(currentTallest);
                }
                rowDivs.length = 0; // empty the array
                currentRowStart = topPostion;
                currentTallest = $el.height();
                rowDivs.push($el);
            } else {
                rowDivs.push($el);
                currentTallest = (currentTallest < $el.height()) ? ($el.height()) : (currentTallest);
            }
            for (currentDiv = 0; currentDiv < rowDivs.length; currentDiv++) {
                rowDivs[currentDiv].height(currentTallest);
            }
        });
    }

    $(window).load(function() {
        equalheight('.home_price_title');
    });


    $(window).resize(function() {
        equalheight('.home_price_title');
    });
    $(window).bind("load", function() {


        var footerHeight = 0,
                footerTop = 0,
                $footer = $("#footer_div");

        positionFooter();

        function positionFooter() {

            footerHeight = $footer.height();
            footerTop = ($(window).scrollTop() + $(window).height() - footerHeight);
            footerTop = footerTop - 25 + "px";
           if (($(document.body).height() + footerHeight) < $(window).height()) {
                $footer.css({
                    position: "absolute"
                }).stop().animate({
                    top: footerTop
                })
            } else {
                $footer.css({
                    position: "static"
                })
            }

        }


        $(window)
                .scroll(positionFooter)
                .resize(positionFooter);



    });
</script>
</body>
</html>