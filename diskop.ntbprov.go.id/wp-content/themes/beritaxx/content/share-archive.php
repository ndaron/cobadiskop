    <!-- SHARING -->
	<div class="share">
		<i class="fas fa-share-alt"></i>
		<a href="https://facebook.com/share.php?u=<?php echo rawurlencode( home_url($wp->request) ); ?>&amp;t=<?php the_title() ?>" target="_blank" title="<?php echo esc_html_e('Share to Facebook', 'beritaxx'); ?>">
		    <i class="fab fa-facebook-f"></i>
		</a>
		<a href="https://twitter.com/home?status=<?php the_title() ?> <?php echo rawurlencode( home_url($wp->request) ); ?>" target="_blank" title="<?php echo esc_html_e('Share to Twitter', 'beritaxx'); ?>">
			<i class="fab fa-twitter"></i>
		</a>
		<a class="web_wa" target="_blank" href="https://web.whatsapp.com/send?text=<?php the_title() ?> <?php echo rawurlencode( home_url($wp->request) ); ?>" title="<?php echo esc_html_e('Share to WhatsApp', 'beritaxx'); ?>">
			<i class="fab fa-whatsapp"></i>
		</a>
		<a class="mob_wa" target="_blank" href="https://api.whatsapp.com/send?text=<?php the_title() ?> <?php echo rawurlencode( home_url($wp->request) ); ?>" title="<?php echo esc_html_e('Share to WhatsApp', 'beritaxx'); ?>">
			<i class="fab fa-whatsapp"></i>
		</a>
		<a href="https://t.me/share/url?url=<?php echo rawurlencode( home_url($wp->request) ); ?>&text=<?php the_title() ?>" target="_blank" title="<?php echo esc_html_e('Share to Telegram', 'beritaxx'); ?>">
			<i class="fab fa-telegram-plane"></i>
		</a>
	</div>