import './index.scss';
import { addFilter } from '@wordpress/hooks';
import { __ } from '@wordpress/i18n';

const SsecOverviewPage = () => {
    return (
        <div className="ssec-overview-page">
            <h1>{ __( 'SSEC Overview', 'ssec' ) }</h1>
            <p>{ __( 'Welcome to the SSEC admin overview page.', 'ssec' ) }</p>
        </div>
    );
};

addFilter( 'woocommerce_admin_pages_list', 'admin-overview', ( pages ) => {
	pages.push( {
		container: SsecOverviewPage,
		path: '/ssec-admin-overview',
		breadcrumbs: [ __( 'SSEC Overview', 'ssec' ) ],
        navArgs: {
            id: 'ssec-admin-overview',
        }
    } );

	return pages;
} );