const { test, expect } = require('@playwright/test');

test('Kompletter Kaufprozess', async ({ page }) => {

    // Login-Seite öffnen
    await page.goto('http://localhost/Webforum/login.html');

    // Zugangsdaten eingeben
    await page.fill('input[name="email"]', 'max.mustermann@test.de');
    await page.fill('input[name="password"]', 'MeinPasswort123');

    // Anmelden
    await page.locator('#login-button').click();

    // Prüfen, dass Kategorien geöffnet wurden
    await expect(page).toHaveURL(/categories\.php/);

    // Shop öffnen
    await page.locator('#shop-link').click();

    // Prüfen, dass der Shop geladen wurde
    await expect(page.getByText('Boxequipment Shop')).toBeVisible();

    // Erstes Produkt in den Warenkorb
    await page.locator('button:has-text("In den Warenkorb")').first().click();

    // Warenkorb öffnen
    await page.goto('http://localhost/Webforum/cart.php');

    // Kauf abschließen
    await page.locator('#checkout-button').click();

    // Prüfen, dass success.php geöffnet wurde
    await expect(page).toHaveURL(/success\.php/);

    // Prüfen, dass Erfolgsüberschrift angezeigt wird
    await expect(
        page.locator("h1")
    ).toContainText("Vielen Dank");
});