<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package airco
 */

?>

	</div><!-- #content -->


</div><!-- #page -->
<div id="footer-container">
    <div id="bot" class="mx-auto">
        <nav class="navbar navbar-toggleable-md">
			<?php
			wp_nav_menu([
				'theme_location' => 'primary',
				'container_class' => 'footer-nav text-center mx-auto',
				'container_id' => '',
				'menu_class' => 'nav navbar-nav justify-content-center',
				'fallback_cb' => '__return_false',
				'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
				'depth' => 2,
				'walker' => new wp_bootstrap_navwalker()
			]);
			?>
        </nav>
    </div>
    <div id="botbot">
        <p class="text-center copyright">&copy;<?php echo date('Y'); ?> Able Heating & Air </p>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js" ></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Zebra_datepicker/1.9.4/javascript/zebra_datepicker.js" ></script>

<script>
    $(document).ready(function(){
        $('.carousel').carousel();
    });
</script>
<script>
    //ROTATE TESTIMONIALS
    (function() {
        var quotes = $(".quotes");
        var quoteIndex = -1;
        function showNextQuote() {
            ++quoteIndex;
            quotes.eq(quoteIndex % quotes.length)
                .fadeIn(100)
                .delay(20000)
                .fadeOut(100, showNextQuote);
        }
        showNextQuote();
    })();

</script>
<script>
    (function($){
        $(document).ready(function() {
            // assuming the controls you want to attach the plugin to
            // have the "datepicker" class set
            $('input.datepicker').Zebra_DatePicker({
                show_icon: 'FALSE',
                first_day_of_week: '0',
                format: 'M j, Y'
            });
        });
    })(jQuery);

</script>
<script>
    function stickFooter(){

        var bodyHeight = $('#page').height(),
            windowHeight = $(window).height();

        if ( bodyHeight < windowHeight ) {
            $('#footer-container').addClass("stuck");
            $('#footer-container').removeClass("unstuck");
        }else{
            $('#footer-container').removeClass("stuck");
            $('#footer-container').addClass("unstuck");
        }

        //console.log(windowHeight);
        //console.log(bodyHeight);

    }

    $(window).scroll(function() {


        stickFooter();

    });

    $(window).load(function() {

        stickFooter();
    });


</script>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-93357349-1', 'auto');
  ga('send', 'pageview');

</script>
<?php wp_footer(); ?>
</body>
</html>
