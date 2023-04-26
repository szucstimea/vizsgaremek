it.only("A lenyilo menu-ből kivalaszthato a Kezdolap ", () => {
    cy.visit("http://localhost/vizsgaremek_kodok/index.php")
    cy.get("#lenyilo_menu").should("contain", "Kezdőlap")
})