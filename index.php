<?php ?>
<!doctype html>
<html <? language_attributes(); ?>>
	<head>
		<meta charset="<? bloginfo( 'charset' ); ?>" />
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<link rel="stylesheet" href="https://unpkg.com/mvp.css" />
		<style>
			body { font-size: calc(0.25vmin + 1rem); font-size: clamp(0.9rem, 0.5vw + 1rem, 2.2rem); text-align: center; }
			body > hr { margin: 0.5rem 0; }
			body > header { font-size: 1.25em; }
			body > footer { font-size: 0.85em; }
			h1, h2, h3, h4, h5, h6 { margin: 0.5rem 0; line-height: 1.2; }
			main { text-align: left; }
			img { max-width: 100%; }
			article { padding: 2rem; }
			article + article { margin-top: 3rem; }
			article:nth-child(even) { background-color: var(--color-bg-secondary); }
			article > * + * { margin-top: 1em; margin-bottom: 0; }
			article header, div header, main header { padding: 0; text-align: left; }
			article footer, div footer, main footer { padding: 2rem 0 0; font-size: 0.9em; }
			nav { flex-direction: column; width: 100%; margin-top: 5rem; margin-bottom: 2rem; }
			nav + nav { margin-top: 2rem; }
			nav h1, nav h2, nav h3, nav h4, nav h5, nav h6 { flex-basis: 100%; margin-bottom: 0; }
			.screen-reader-text {
				position: absolute;
				clip: rect(1px, 1px, 1px, 1px);
				clip-path: inset(50%);
				width: 1px;
				height: 1px;
				overflow: hidden;
				padding: 0;
				border: 0;
				white-space: nowrap;
			}
		</style>

		<? wp_head(); ?>
	</head>

	<body <? body_class(); ?>>
		<p class="screen-reader-text"><a href="#content">Skip to main content</a></p>

		<header>
			<? if (is_front_page()): ?><h1><? endif; ?>

			<strong>
				<a href="<? echo esc_url( home_url() ); ?>" rel="home">
					
					<? echo wp_get_attachment_image(get_theme_mod( 'custom_logo' ), 'medium'); ?>
					<span <? if (has_custom_logo()) { ?>class="screen-reader-text"<? } ?>>
						<? bloginfo( 'name' ); ?>
					</span>
				</a>
			</strong>

			<? if (is_front_page()): ?></h1><? endif; ?>

			<? if ($tagline = get_bloginfo( 'description' )): ?>
			<p><strong><? echo $tagline; ?></strong></p>
			<? endif; ?>
		</header>

		<? if ($menus = wp_get_nav_menus()): ?>
		<details>
			<summary>Menu</summary>
			<? foreach ($menus as $menu): if ($menu->count > 0): ?>
				<nav aria-labelledby="menu-<? echo $menu->slug ?>-label">
					<h2 id="menu-<? echo $menu->slug ?>-label">
						<? echo $menu->name ?>
					</h2>
					<?
					wp_nav_menu(
						array(
							'menu' => $menu,
							'menu_id' => '',
							'menu_class' => '',
							'container' => '',
							'container_id' => '',
							'container_class' => ''
							)
						);
					?>
				</nav>
			<? endif; endforeach; ?>
		</details>
		<? endif; ?>

		<hr />

		<main id="content">
			<? if (is_archive()): ?>
				<header>
				<?
					the_archive_title( '<h1>', '</h1>' );
					the_archive_description( '<p>', '</p>' );
				?>
				</header>
				<hr />
			<? endif; ?>
			
			<? if ( have_posts() ): ?>
				<? while ( have_posts() ): the_post(); ?>
					<article>
						<? if (!is_front_page()): ?>
							<header>
								<? if (is_singular() && !is_front_page()): ?>
								<? the_title( '<h1>', '</h1>' ); ?>
								<? else: ?>
								<? the_title( '<h2><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>
								<? endif; ?>

								<? if (get_post_type() === 'post'): ?>
								<time datetime="<? echo get_the_date('c'); ?>">
									<? echo get_the_date(); ?>
								</time>
								<? endif; ?>
							</header>
						<? endif; ?>

						<? if (has_post_thumbnail()): ?>
						<figure>
							<? if (is_singular()): ?>
								<? the_post_thumbnail('full'); ?>
							<? else: ?>
								<? the_post_thumbnail('large'); ?>
							<? endif; ?>

							<figcaption><? the_post_thumbnail_caption(); ?></figcaption>
						</figure>
						<? endif; ?>

						<? if (is_singular()): ?>
							<? the_content(); ?>
						<? else: ?>
							<? the_excerpt(); ?>
						<? endif; ?>

						<footer>
							Published: 
							<time datetime="<? echo get_the_date('c'); ?>">
								<strong><? echo get_the_date('F j, Y, g:i a'); ?></strong>
							</time>
							<? if ( get_the_terms($post->ID, 'category') || get_the_terms($post->ID, 'post_tag') ): ?>
							<div>
								<? the_terms( $post->ID, 'category', 'Categories: ', ', ' ); ?>
							</div>
							<div>
								<? the_terms( $post->ID, 'post_tag', 'Tags: ', ', ' ); ?>
							</div>
							<? endif; ?>
						</footer>
					</article>
				<? endwhile; ?>
			<? endif; ?>

			<? if (
					$pagination = get_the_posts_pagination( array(
					'mid_size' => 2,
					'prev_text' => __( '<span class="aria-hidden">&laquo;</span> Newer Posts' ),
					'next_text' => __( 'Older Posts <span class="aria-hidden">&raquo;</span>' ),
					'type' => 'list',
					'before_page_number' => '<span class="screen-reader-text">Page </span>'
					)) 
				): ?>
				<hr />

				<?
					echo $pagination;
				?>
			<? endif; ?>
		</main>

		<hr />
		
		<footer>
			<small>&copy; <? echo date( 'Y' ); ?> <? echo get_bloginfo( 'name' ); ?></small>
		</footer>

		<? wp_footer(); ?>
	</body>
</html>