<?php
$events = get_posts( [
    'post_type'      => 'evenement',
    'posts_per_page' => 10,
    'post_status'    => 'publish',
] );
?>
<ul <?php echo get_block_wrapper_attributes(); ?>>
    <?php if ( empty( $events ) ) : ?>
        <li class="em-card em-card--empty">
            <span><?php esc_html_e( 'Aucun évènement trouvé.', 'evenement-list' ); ?></span>
        </li>
    <?php else : ?>
        <?php foreach ( $events as $event ) :
            $thumbnail_url  = get_the_post_thumbnail_url( $event->ID, 'large' );
            $organisateur   = get_post_meta( $event->ID, 'organisateur', true );
            $event_type     = get_post_meta( $event->ID, 'event_type', true );
        ?>
            <li class="em-card">
                <a href="<?php echo esc_url( get_permalink( $event->ID ) ); ?>">
                    <?php if ( $thumbnail_url ) : ?>
                        <div class="em-card__image" style="background-image: url('<?php echo esc_url( $thumbnail_url ); ?>')"></div>
                    <?php else : ?>
                        <div class="em-card__image em-card__image--placeholder"></div>
                    <?php endif; ?>

                    <?php if ( $event_type ) : ?>
                        <span class="em-card__badge em-card__badge--<?php echo esc_attr( $event_type ); ?>">
                            <?php echo $event_type === 'free' ? esc_html__( 'Gratuit', 'evenement-list' ) : esc_html__( 'Payant', 'evenement-list' ); ?>
                        </span>
                    <?php endif; ?>

                    <div class="em-card__body">
                        <span class="em-card__title"><?php echo esc_html( $event->post_title ); ?></span>
                        <?php if ( $organisateur ) : ?>
                            <span class="em-card__organizer">
                                <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                                <?php echo esc_html( $organisateur ); ?>
                            </span>
                        <?php endif; ?>
                    </div>
                </a>
            </li>
        <?php endforeach; ?>
    <?php endif; ?>
</ul>
