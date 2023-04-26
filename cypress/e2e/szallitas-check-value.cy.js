it.only("szallitas radio gomb ellenorzes", () => {
    cy.visit("http://localhost/vizsgaremek_kodok/index.php")
    cy.get('.szallitas1').check({ force: true },"kerek")
    cy.get('#booking-form :checked').should('be.checked').and('have.value', 'kerek')
})  