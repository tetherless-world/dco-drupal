<!--dco-login.php-->
<div id="additional-nav-top"><?php print $additional_nav_top; ?></div>
<div class="toolbardivs">
<?php global $base_url ;?>
<a href="<?php echo $base_url ;?>/page/welcome">USING THIS SITE</a> 
</div>      
<div class="toolbardivs">
<?php global $base_url ;?>
<a href="<?php echo $base_url ;?>/users">DIRECTORY</a>
</div>

<?php
global $user ;
global $base_root;
$request = request_uri() ;
if( $request == "" || $request == "/" )
{
	$request = "/home" ;
}
$mypath = $base_root . "/?q=shib_login" . urlencode( $request ) ;
$mypathe = urlencode( $mypath ) ;
?>


	<?php if( !$logged_in ) { ?>
	    <div class="toolbardivs">
	    <a href="https://deepcarbon.net/Shibboleth.sso/Login?target=<?php echo $mypathe ;?>" >LOGIN/JOIN</a>
	    <!--
		The original code is here: PCW 20141001
	    <a href="https://deepcarbon.net/Shibboleth.sso/Login?target=https%3A%2F%2Fdeepcarbon.net%2F%3Fq%3Dshib_login%252Fuser" >LOGIN</a>
		-->
	    </div><!-- /log-in -->
	    
	<?php } else { $currentpath=$_GET['q']; ?>
	   
	    <div  class="toolbardivs">
	     <a href="https://deepcarbon.net/Shibboleth.sso/Logout" >LOGOUT</a> (<?php  print $user->name;?>)
	    </div><!-- /log-in -->
	    
       
	<?php } ?>
	
	
	
	
<!--dco-login.php done-->

