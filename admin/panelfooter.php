
	<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/chart.min.js"></script>
	<script src="js/chart-data.js"></script>
	<script src="js/easypiechart.js"></script>
	<script src="js/easypiechart-data.js"></script>
	<script src="js/bootstrap-datepicker.js"></script>
	<script src="js/bootstrap-table.js"></script>
	<script>
		!function ($) {
			$(document).on("click","ul.nav li.parent > a > span.icon", function(){		  
				$(this).find('em:first').toggleClass("glyphicon-minus");	  
			}); 
			$(".sidebar span.icon").find('em:first').addClass("glyphicon-plus");
		}(window.jQuery);

		$(window).on('resize', function () {
		  if ($(window).width() > 768) $('#sidebar-collapse').collapse('show')
		})
		$(window).on('resize', function () {
		  if ($(window).width() <= 767) $('#sidebar-collapse').collapse('hide')
		})
	</script>
		
	<script>
		$(document).ready(function(){
		    $('[data-toggle="tooltip"]').tooltip(); 
		});
	</script>

	<div id="fb-root"></div>
	<script>
		(function(d, s, id) {
		  var js, fjs = d.getElementsByTagName(s)[0];
		  if (d.getElementById(id)) return;
		  js = d.createElement(s); js.id = id;
		  js.src = "//connect.facebook.net/es_ES/sdk.js#xfbml=1&version=v2.7";
		  fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));
	</script>
</body>

<!--
	Scripts de seguridad ANTICLICK
-->
<script language="Javascript">
document.oncontextmenu = function(){return false}
</script>

<script language="Javascript">
   document.oncontextmenu = function() {
      return false
   }
   function right(e) {
      var msg = "Queda prohibido usar Click Derecho !!! ";
      if (navigator.appName == 'Netscape' && e.which == 3) {
         alert(msg); //- Si no quieres asustar a tu usuario entonces quita esta linea...
         return false;
      }
      else if (navigator.appName == 'Microsoft Internet Explorer' && event.button==2) {
         alert(msg); //- Si no quieres asustar al usuario que utiliza IE,  entonces quita esta linea...
                        //- Aunque realmente se lo merezca...
      return false;
      }
   return true;
}
document.onmousedown = right;
</script>

<!--
	bloquear teclas CTRL+u
-->
<script>
	$(document).ready(function(){
		var jun=0;
	$(document).keydown(function(e){
	if(e.keyCode== 17 ){
		jun++;
	if(jun==2){
		return false;jun=0;
	}}
	if(e.keyCode== 85 ){
		jun++;
	if(jun==2){
	return false;jun=0;
	}}
	}).keyup(function(e){
	if(jun>0){
	jun=jun-1;
	}});
	});
	document.oncontextmenu=new Function("return false");
</script>


</html>
