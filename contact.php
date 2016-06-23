<?php session_start();    error_reporting(0);

if ($_SESSION['user_data']['user_name'] == '') {
    include "header.php";
    include "nav_before_login.php";
}else{
  include "login-header.php";
 include "nav.php";
}

?>
<div class="home_tab_section">
<div class="container">
<div class="row">
        <div class="col-sm12 text-center">
                <h1>Contact Us</h1>
        </div>


</div>

				
<div class="row">
        <div class="col-sm12 text-center">
                <h3>The social gaming community with the most skilled players!</h3>
        </div>


</div>
<div class="row">
        <div class="text-justify">
            <p> TBESportsGaming is an online service that facilitates competitive matches, and tournaments for players across the globe. Our goal is to help all gamers come together, and have a great time competing against other top players. We focused on simplicity and innovating creativity through the whole website to make it easier for you to navigate. We act as a social gaming community for competitive gamers to interact with one another, and with brands to reach out closer to their customers. Our service platform hosts challenge matches, free to play matches, and pay to enter tournaments. We are constantly updating and innovating our site, so stay tuned for the next big thing because we are up to something! We are also open to any suggestions feel free to contact us to help make our community better for everyone. </p>
        </div>
</div>
<div class="row">
        <div class="text-justify">
            <p> Feel free to reach out to us for any help!</p>
        </div>
</div>
    <div class="row">
        <div class="col-sm12 text-center">
            <p>Twitter- @TBESportsGaming<br>
                Instagram- @TBESportsGaming<br>
                support@tbesportsgaming.com
 </p>
        </div>
</div>
    <div class="row">
        <div class="text-justify">
            <p>Parents:
If you have concerns about the services we provide, or if you wish to find out more about if your child has registered for one of our services. We will assist you help to find out if your child has signed up for membership. If you wish to cancel your child's membership, please contact us at support@tbesportsgaming.com. If you believe that your child under 13 has gained access to our Services, please contact us at support@tbesportsgaming.com
No information should be submitted to the Services by children under 13 years of age.TBESportsGamingdoes not knowingly collect personally identifiable information from children under the age of 13. Parents we urge you to instruct your children to never provide personal information on this website or any similar.  The Children’s Online Privacy Protection Act of 1998 (“COPPA”) requires web sites that know that visitors to their site may be under the age of 13 to follow specific Federal Trade Commission rules.  In our attempt to fully comply with these rules, we would like you to know that, TBESportsGamingwill not knowingly collect or solicit any personally identifiable offline contact information or personal online contact information from children under the age of 13. 
</p>
        </div>
</div>
    
</div>
</div>
							

</div>



<?php
include "footer.php";
?>