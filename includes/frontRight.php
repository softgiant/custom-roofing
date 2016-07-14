<script type="text/javascript">
    $(document).ready(function(){
        $('#call_back').click(function(){
		
			var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            var user_name = $('#user_name').val();
            var user_email = $('#user_email').val();
            var user_phone = $('#user_phone').val();
            var user_comments = $('#user_comments').val();
           // var captcha = $('#captcha').val();
           // alert(user_name+'_'+user_email+'_'+user_phone+'_'+user_comments);
		   //return false;	
            if( user_name.length == 0){
                $('#user_name').addClass('error');
            }
            else{
                $('#user_name').removeClass('error');
            }
			
			if( email.length == 0){
                $('#user_email').addClass('error');
            }
            else{
                $('#user_email').removeClass('error');
            }

          /*  if( captcha.length == 0){
                $('#captcha').addClass('error');
            }
            else{
                $('#captcha').removeClass('error');
            }
            */
            if(user_name.length != 0 && user_email.length != 0 && msg.length != 0 && captcha.length != 0){
                return true;
            }
            return false;
        });

       
    });
	
	
function checkcontact_Email() {

    var email = document.getElementById('user_email');
    var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

    if (!filter.test(email.value)) {
    alert('Please provide a valid email address');
	email.value = '';
    email.focus;
    return false;
    }
}

</script>
<style>
#callback_form .error{
	border: 1px solid red !important;
}
</style>
<div class="call-back">Request a call back</div>
           <div class="callback-form">
		    <form name="callback_form" id="callback_form" method="post" action="" enctype="multipart/form-data">
              <input placeholder="Name" id="user_name" type="text">
              <input placeholder="Email" id="user_email" type="text">
              <input placeholder="Phone" id="user_phone" type="text">
              <textarea placeholder="Comments" id="user_comments"></textarea>
              <label>Please enter the below characters</label>
              <input class="verify-txt" type="text">
              <img src="images/captcha.jpg" alt="" title="">
              <input type="submit" id="call_back" value="Send">
			 </form>
           </div> <!--callback-form end here-->
           
           <div class="testi">
              <span class="quote"><i class="fa fa-quote-left"></i></span>
              <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</p>
              <span class="quote odd"><i class="fa fa-quote-right"></i></span>
              <h2>CRISTINA</h2>
              <h3>Home Owner</h3>
              <a class="more" href="happy-customeres">SEE All&nbsp; <i class="fa fa-angle-double-right"></i></a>
           </div> <!--testi-->
           
           <div class="find-us">
              <p>Find us on <span>RatedPeople.com</span></p>
              <a href="http://www.ratedpeople.com/profile/atyoung/" target="_blank"><img src="images/rated.png" alt="" title=""></a>
           </div> <!--find-us-->
           
        </div> <!--cont-sec-right end here-->