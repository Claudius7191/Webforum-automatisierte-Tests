// @ts-check
const { defineConfig } = require('@playwright/test');

module.exports = defineConfig({

  testDir: './e2e',

  use: {
    baseURL: process.env.BASE_URL || 'http://localhost/Webforum',
    headless: true
  }

});