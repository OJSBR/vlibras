/**
 * @file cypress/tests/functional/VLibrasBlock.cy.js
 *
 * Copyright (c) 2026 OJSBR (https://ojsbr.com)
 * Distributed under the GNU GPL v3. For full terms see the file docs/COPYING.
 *
 * Functional tests: what a reader gets from the block.
 *
 * Parameters (--env): contextPath (default publicknowledge) and pagePath (a
 * reader page that shows the block; default the journal home page). The block
 * must be enabled and placed in the sidebar, and the browser must reach
 * vlibras.gov.br. Nothing is changed on the server.
 */

describe('VLibras block plugin', function() {
	const contextPath = Cypress.env('contextPath') || 'publicknowledge';
	const pagePath = Cypress.env('pagePath') || '';
	// A session cookie gets past an edge cache that serves anonymous pages.
	const visit = () => cy.visit('/index.php/' + contextPath + (pagePath ? '/' + pagePath : ''), {headers: {Cookie: 'OJSSID=cypress' + Date.now()}});

	it('Shows the block and loads the widget once, outside the sidebar', function() {
		visit();
		cy.get('.block_vlibras').should('have.length', 1);
		cy.get('.block_vlibras .title').invoke('text').should('match', /\S/).and('not.contain', '##');
		cy.get('.block_vlibras').invoke('attr', 'aria-label').should('match', /\S/).and('not.contain', '.vlibras.');
		cy.get('.block_vlibras script').should('have.length', 0);
		cy.get('script[src*="/vlibras/js/vlibras.js"]').should('have.length', 1);
		cy.get('body > [vw]').should('have.length', 1);
		cy.get('script[src="https://vlibras.gov.br/app/vlibras-plugin.js"]').should('have.length', 1);
		cy.get('body > #vlibras-access-wrapper', {timeout: 20000}).should('have.length', 1)
			.shadow().find('#vlibras-button').should('be.visible');
	});

	it('Opens the translator when the reader presses the avatar button', function() {
		visit();
		cy.get('body > #vlibras-access-wrapper', {timeout: 20000}).shadow().find('#vlibras-button').click();
		cy.get('script[src*="vlibras-plugin-app.js"]').should('have.length', 1);
	});
});
