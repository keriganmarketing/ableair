<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package airco
 */

get_header(); ?>

    <div class="container-fluid">
        <div id="primary" class="content-area">
            <div class="row">
                <?php get_template_part('template-parts/content', 'carousel'); ?>
                <main id="main" class="site-main">
                    <div class="main-message col-md-5 justify-content-end">
                        <div class="main-message-inner">
                            <?php
                            while (have_posts()) : the_post();

                                get_template_part('template-parts/content', 'homepage');

                            endwhile; // End of the loop.
                            ?>
                            <div class="cta">
                                <a href="/book-now/" class="btn book-btn">Schedule a system checkup</a>
                            </div>
                        </div>
                    </div>
                </main><!-- #main -->
            </div>
            <div id="services" class="pad-anchor"></div>
            <div class="row">
                <div class="col-md-5 gray-bg">
                    <div class="float-md-right space-out-5">
                        <h2>
                            <strong>OUR</strong>
                            <br>
                            SERVICES
                        </h2>
                    </div>
                </div>
                <div class="col-md-7">
                    <?php
                    $args = array('post_type' => 'services', 'posts_per_page' => -1);
                    $loop = new WP_Query($args);
                    $marginTopClass = 'margin-top-2';
                    $loopCounter = 0;
                    while ($loop->have_posts()) : $loop->the_post();
                        if ($loopCounter > 0) {
                            $marginTopClass = 'margin-top-1';
                        }
                        $link = get_permalink();
                        $post = get_the_ID();
                        echo '<a href="' . $link . '"><h2 class="' . $marginTopClass . ' margin-left-2 underline-black">';
                        the_title();
                        echo '</h2></a>';
                        echo '<div class="service-content">';
                        echo get_post_meta($post, 'home_page_content_home_page_content', true);
                        echo '</div>';
                        $loopCounter++;
                    endwhile;
                    ?>
                </div>
            </div>
            <div class="fake-hr"></div>
            <div id="reviews" class="pad-anchor"></div>
            <div id="testimonials-section">
                <div class="container text-center no-gutter">
                    <h2 class="customer-service-heading">We Pride Ourselves on Great Customer Service</h2>
                    <div class="row justify-content-center align-items-center">
                        <?php
                        $args = array(
                            'numberposts' => -1,
                            'offset' => 0,
                            'category' => 0,
                            'orderby' => 'menu_order',
                            'order' => 'ASC',
                            'post_type' => 'testimonial',
                            'post_status' => 'publish',
                            'suppress_filters' => true
                        );

                        $featured_testimonials = get_posts($args);

                        foreach ($featured_testimonials as $testimonial) {
                            $testimonial_id = $testimonial->ID;
                            $link = get_the_permalink();
                            $copy = $testimonial->post_content;
                            $author = get_post_meta($testimonial_id, 'author_info_name', true);
                            $company = get_post_meta($testimonial_id, 'author_info_company', true);
                            ?>
                            <div class="quotes col">
                                <p class="quote-content"><?php echo $copy; ?></p>
                                <p class="quote-author"><?php echo $author; ?></p>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <div id="about" class="pad-anchor"></div>
            <div class="row map-bg">
                <div class="col-md-5">
                    <div id="about-us">
                        <div class="float-md-right space-out-5">
                            <h2>
                                ABOUT US!
                            </h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <?php
                    $about_us_copy = get_field('about_us_copy', 4);
                    echo $about_us_copy; ?>
                </div>
            </div>
            <div id="contact" class="pad-anchor"></div>
            <div class="row">

                <div class="col-md-4 col-xl-5 gray-bg">
                    <div id="keep-in-touch">
                        <div class="float-md-right space-out-5">
                            <h2>
                                <strong>GET</strong>
                                <br>
                                IN TOUCH
                            </h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-5">
                    <div class="contact-section">
                    <?php
                    $address = get_field('address', 4);
                    $email = get_field('email', 4);
                    $phone = get_field('phone', 4);
                    ?>
                    <div class="row">
                        <div class="col-md-6 contact-left">
                            <span class="our-address"><strong>OUR</strong> ADDRESS</span>
                            <p><?php echo $address; ?></p>
                            <strong>Email:</strong> <a href="mailto:<?php echo $email . '">' . $email; ?></a><br>
                            <strong>Phone</strong>: <a href="<?php echo 'tel:'. $phone . '">' .$phone; ?></a></p>
                        </div>
                        <div class="col-md-6 contact-right">
                       
                        <div class="fb-page" data-href="https://www.facebook.com/Able-Heating-and-Air-522525607826252" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="false">
                            <blockquote cite="https://www.facebook.com/Able-Heating-and-Air-522525607826252" class="fb-xfbml-parse-ignore">
                            <a href="https://www.facebook.com/Able-Heating-and-Air-522525607826252">Able Heating and Air</a>
                            </blockquote>
                        </div>

                        </div>
                    </div></div>
                    <div class="row">
                        
                        <div id="map" class="col p-0" style="height:250px;" >
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3299.521392646795!2d-84.51152418440498!3d34.2097030805634!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x3fbec67703b89c18!2sAtlanta+Air+Company!5e0!3m2!1sen!2sus!4v1542136248067" frameborder="0" style="border:0" allowfullscreen></iframe>
                        </div>

                    </div>
                </div>
            </div>
        </div><!-- #primary -->
    </div>
<?php

get_footer();
