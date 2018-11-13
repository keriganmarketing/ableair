<nav class="navbar navbar-toggleable-md">
    <div class="navbar-collapse collapse navbar-toggleable-md" id="collapsingNavbar">
		<?php
		wp_nav_menu(array(
			'theme_location' => 'primary',
			'container_class' => 'navbar-collapse',
			'container_id' => 'navbarNavDropdown',
			'menu_class' => 'navbar-nav justify-content-end',
			'fallback_cb' => '__return_false',
			'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
			'depth' => 2,
			'walker' => new wp_bootstrap_navwalker()
		));
		?>
    </div>
    <button class="navbar-toggler hidden-sm-up" type="button" data-toggle="collapse"
            data-target="#collapsingNavbar">
        &#9776; MENU
    </button>
</nav>
