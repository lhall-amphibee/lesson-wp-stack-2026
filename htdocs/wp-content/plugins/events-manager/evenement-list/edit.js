import { __ } from '@wordpress/i18n';
import { useBlockProps } from '@wordpress/block-editor';
import { useSelect } from '@wordpress/data';
import { store as coreStore } from '@wordpress/core-data';
import './editor.scss';

export default function Edit() {
	const blockProps = useBlockProps();

	const events = useSelect( ( select ) =>
		select( coreStore ).getEntityRecords( 'postType', 'evenement', {
			per_page: 10,
			status: 'publish',
			_embed: true,
			_fields: 'id,title,link,meta,_embedded,_links',
		} )
	);

	const getThumbnail = ( event ) =>
		event?._embedded?.[ 'wp:featuredmedia' ]?.[ 0 ]?.source_url ?? null;

	const getBadgeLabel = ( type ) =>
		type === 'free' ? __( 'Gratuit', 'evenement-list' ) : __( 'Payant', 'evenement-list' );

	return (
		<ul { ...blockProps }>
			{ ! events && (
				<li className="em-card em-card--empty">
					<span>{ __( 'Chargement…', 'evenement-list' ) }</span>
				</li>
			) }
			{ events && events.length === 0 && (
				<li className="em-card em-card--empty">
					<span>{ __( 'Aucun évènement trouvé.', 'evenement-list' ) }</span>
				</li>
			) }
			{ events &&
				events.map( ( event ) => {
					const thumbnail    = getThumbnail( event );
					const organisateur = event?.meta?.organisateur ?? null;
					const eventType    = event?.meta?.event_type ?? null;

					return (
						<li key={ event.id } className="em-card">
							<a href={ event.link }>
								<div
									className={ `em-card__image${ thumbnail ? '' : ' em-card__image--placeholder' }` }
									style={ thumbnail ? { backgroundImage: `url(${ thumbnail })` } : {} }
								/>
								{ eventType && (
									<span className={ `em-card__badge em-card__badge--${ eventType }` }>
										{ getBadgeLabel( eventType ) }
									</span>
								) }
								<div className="em-card__body">
									<span className="em-card__title">
										{ event.title.rendered }
									</span>
									{ organisateur && (
										<span className="em-card__organizer">
											<svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2.5" strokeLinecap="round" strokeLinejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
											{ organisateur }
										</span>
									) }
								</div>
							</a>
						</li>
					);
				} ) }
		</ul>
	);
}
