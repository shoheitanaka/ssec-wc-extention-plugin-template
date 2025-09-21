import './index.scss';
import { __ } from '@wordpress/i18n';
import { render } from '@wordpress/element';

const SsecOverviewPage = () => {
    return (
        <div className="ssec-admin-layout">
            <div className="ssec-admin__header">
                <div className="ssec-admin__header-wrapper">
                    <h1>{ __( 'SSEC Overview', 'plugin-name' ) }</h1>
                </div>
            </div>
            <div className="ssec-admin__content">
                <p>{ __( 'Welcome to the SSEC admin overview page.', 'plugin-name' ) }</p>
            </div>
        </div>
    );
};

document.addEventListener('DOMContentLoaded', () => {
    const root = document.querySelector('#root');
    if (root) {
        render(<SsecOverviewPage />, root);
    }
});
