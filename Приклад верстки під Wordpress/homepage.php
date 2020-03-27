<?php /* Template Name: Home Page */ ?>
<?php get_header(); ?>

<?php
		if ( have_posts() ) {

			// Load posts loop.
			while ( have_posts() ) {
                the_post();
                ?>

         <section class="bestill-bord">
             <style>
                 section.bestill-bord
                 {
                    background: url(<?php the_field('s1_image'); ?>) no-repeat top;
                 }
             </style>
            <h1><?php the_field('s1_text'); ?></h1>
        
        </section>

    <section class="main-content">
        <div class="block">
            <div class="left-side pink"><h2><?php the_field('block_1_1'); ?></h2></div>
            <div class="right-side dark-grey"><h2><?php the_field('block_1_2'); ?></h2></div>
        </div>
        <div class="block">
            <div class="left-side block-image meet"></div>
            <div class="right-side block-image cibulia"></div>
        </div>
        <div class="block dark-grey block-3">
            <div class="left-side"><h2>BESTILL<br>GAVEKORT</h2></div>
            <div class="right-side">
                <p>Ønsker du å gi bort en<br>bbq-opplevelse hos oss?</p>
                <p>Vi selger gavekart<br>restaurant@kol.no</p>
            </div>
        </div>
        <div class="block coctail">
            <img src="<?php echo get_template_directory_uri()?>/img/coctail.jpg" alt="Coctail">
            <p>Vi har et stort utvalg alkoholfrie drinker</p>
        </div>
        <div class="block cubes">
            <div class="left-side"><h2>ÅPENT :<h2></div>
            <div class="right-side"><p>TirS-fredag: kl.11.00<br>Lørdag: kl.12.00<br>Søndag: kl.14.00<br>Mandager Stengt</p></div>
        </div>

        <div class="block">
            <div class="left-side block-image club"></div>
            <div class="right-side block-image korobka"></div>
        </div>
    </section>



<?php
            }

		} else {

			// If no content, include the "No posts found" template.
			echo '404';

		}
        ?>
        

   

<? get_footer(); ?>