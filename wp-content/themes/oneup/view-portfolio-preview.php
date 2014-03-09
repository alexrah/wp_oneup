<?php
/**
 * The template for displaying a portfolio preview (ajax) type view
 *
 * @package WordPress
 * @subpackage Theme
 * @since 1.0
 */
?>
<?php $t =& peTheme(); ?>
<?php list($conf) = $t->template->data(); ?>
<?php $settings =& $conf->settings; ?>

<?php $content =& $t->content; ?>
<?php $project =& $t->project; ?>
<?php $media =& $t->media; ?>
<?php $w = empty($settings->width) ? "auto" : $settings->width; ?>
<?php $h = empty($settings->height) ? "auto" : $settings->height; ?>
<?php $h = $h === "auto" && $w === "auto" ? 192 : $h; ?>
<?php $gx = $settings->gx; ?>
<?php $gy = $settings->gy; ?>
<?php $portID = "portfolio-".$post->ID; ?>

<?php $filterable = $settings->filterable; ?>
<?php $flareGallery = "portfolioGallery".$conf->id; ?>


<div class="pe-ajax-portfolio">


	<div class="pe-ajax-portfolio-spinner">
		<div class="pe-spinner"></div>
	</div>
	<div class="pe-ajax-portfolio-navigation">
		<div>
			<a href="#" class="pe-prev" data-action="prev"><i class="icon-left-open"></i></a>
			<a href="#" class="pe-close" data-action="close"><i class="icon-cancel"></i></a>
			<a href="#" class="pe-next" data-action="next"><i class="icon-right-open"></i></a>
		</div>
	</div>


	<div class="pe-scroller">
		<div class="pe-scroller-slide" id="<?php echo $portID; ?>">

			<div class="peIsotope portfolio pe-no-resize">

				<?php if ($filterable): ?>
				<div class="pe-container filter">
					<div>
						<nav class="project-filter pe-menu-main">
							<ul class="pe-menu peIsotopeFilter">
								<?php $content->filter($settings->filterable,"","","<li>%s</li>"); ?>
							</ul>									
						</nav>
					</div>
				</div>
				<?php endif; ?>

				<div class="peIsotopeContainer peIsotopeGrid pe-scroller-set-width" 
					 data-cell-width="<?php echo $w; ?>" 
					 data-cell-height="<?php echo $h; ?>"
					 data-cell-gx="<?php echo $gx; ?>"
					 data-cell-gy="<?php echo $gy; ?>"
					 data-sort="<?php echo $settings->sort; ?>"
					 >
					<div class="row-fluid">
						<div class="span12">

							<?php $clayout = empty($settings->clayout) || $settings->clayout != "fixed" ? false : array(1,1); ?>
							<?php $count = 1; ?>

							<?php while ($content->looping()): ?>
							<?php $meta =& $content->meta(); ?>
							<?php $img = $content->get_origImage();  ?>

							<?php $portfolio = empty($meta->portfolio) ? false : $meta->portfolio;  ?>

							<?php $thumb = empty($meta->portfolio->image) ? $img : $meta->portfolio->image ; ?>
							<?php list($cols,$rows) = $clayout ? $clayout : (explode("x",empty($meta->portfolio->layout) ? "1x1" : $meta->portfolio->layout)); ?>
							<?php $cw = $w*$cols+$gx*($cols-1); ?>
							<?php $ch = $h*$rows+$gy*($rows-1); ?>
							<?php $cw = $cw ? $cw : 2640; ?>
							<?php $slug = esc_attr(basename(get_permalink())); ?>

							<?php $link = $content->getLink(); ?>
							
							<div class="peIsotopeItem <?php $content->filterClasses($settings->filterable); ?>">
								<?php $ptitle = empty($portfolio->ptitle) ? get_the_title() : $portfolio->ptitle;  ?>
								<span class="cell-title">
									<span>
										<a href="<?php echo $link ?>" data-slide="<?php echo $count; ?>">
											<?php echo wp_kses_post($ptitle); ?>
										</a>
									</span>
									<?php if (!empty($portfolio->pdescription)): ?>
									<span class="description"><?php echo wp_kses_post($portfolio->pdescription); ?></span>
									<?php endif; ?>
								</span>
								<div class="scalable" data-cols="<?php echo $cols; ?>" data-rows="<?php echo $rows; ?>">
									<a href="<?php echo $link; ?>" data-slide="<?php echo $count; ?>" id="<?php echo "$portID-$count"; ?>" data-slug="<?php echo $slug; ?>">
										<?php //$content->img($cw,$ch,$thumb); ?>
										<?php echo $t->image->resizedImg($thumb,$cw,$ch,$w != "auto"); ?>

									</a>
								</div>
							</div>
							
							<?php $count++; ?>
							<?php endwhile; ?>
						</div>
					</div>
				</div>
			</div>
			<!-- /Project Feed -->

		</div>

		<?php $count = 1; while ($content->looping()): ?>
		<?php $slug = esc_attr(basename(get_permalink())); ?>
		<div class="pe-scroller-slide pe-project-item pe-no-resize pe-scroller-set-width" data-slide="<?php echo $count++; ?>" data-direction="left" data-slug="<?php echo $slug; ?>" data-load="<?php the_permalink(); ?> .row-fluid.project">
		</div>
		<?php endwhile; ?>

	</div>

	<div class="pe-ajax-portfolio-navigation">
		<div>
			<a href="#" class="pe-prev" data-action="prev"><i class="icon-left-open"></i></a>
			<a href="#" class="pe-close" data-action="close"><i class="icon-cancel"></i></a>
			<a href="#" class="pe-next" data-action="next"><i class="icon-right-open"></i></a>
		</div>
	</div>

</div>

<?php if ($settings->pager === "yes"): ?>
<?php $content->pager(); ?>
<?php endif; ?>
