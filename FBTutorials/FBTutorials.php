<html>
	<head>
		<title>Facebook Integration</title>
	</head>
	<body>
		<script>
	      window.fbAsyncInit = function()
						       {
						       		FB.init({appId   : '529434107108789',
									         xfbml   : true,
									         version : 'v2.1'
										     status  : true,
										     cookie  : true
						        			});
						       };
	
	      (function(d, s, id)
	       {
	         var js, fjs = d.getElementsByTagName(s)[0];
	         if (d.getElementById(id))
		     {return;}

	         js = d.createElement(s);
	         js.id = id;
	         js.src = "//connect.facebook.net/en_US/sdk.js";
	         fjs.parentNode.insertBefore(js, fjs);
	       }(document, 'script', 'facebook-jssdk'));
	    </script>
		
		<div class="fb-like fb_iframe_widget" data-href="https://developers.facebook.com/docs/plugins/"
							 data-layout="standard"
							 data-action="like"
							 data-show-faces="true"
							 data-share="true"
							 data-colorscheme="light"
							 >
				Some content here
		</div>


	</body>
</html>