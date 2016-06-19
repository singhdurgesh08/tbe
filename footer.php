 <footer>
    	<div class="container">
    		
			<div class="col-md-6 flot-right">
				<ul class="footer_menu">
					<li><a href="term-service.php">Terms of Service</a></li>
                                        <li><a href="privacy.php">Privacy Policy</a></li>
                                       <!-- <li><a href="about.php">About Us</a></li>-->
                                        <li><a href="contact.php">Contact Us</a></li>
				</ul>
			</div>
			<div class="col-md-6 right-text flot-left">©2016 TBESportsGaming, LLC</div>
		</div>
    </footer>


    
	    <script>
        equalheight = function(container){

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
                 for (currentDiv = 0 ; currentDiv < rowDivs.length ; currentDiv++) {
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
               for (currentDiv = 0 ; currentDiv < rowDivs.length ; currentDiv++) {
                 rowDivs[currentDiv].height(currentTallest);
               }
             });
            }

            $(window).load(function() {
              equalheight('.home_price_title');
            });


            $(window).resize(function(){
              equalheight('.home_price_title');
            });
    </script>
</body>
</html>