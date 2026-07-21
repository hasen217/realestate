# Dynamic Properties for Ballari Hub

This plan outlines the steps to upgrade all the sub-pages inside the `ballarip` folder (such as Gandhi Nagar, Cowl Bazaar, Cantonment, and Vidya Nagar) so that they automatically load their properties from the database, just like the main homepage (`myproject.php`).

## User Review Required

> [!IMPORTANT]
> Since the database stores the `city` (e.g., Ballari) and `address` (e.g., Gandhi Nagar), these pages will need to search the database for properties where the city is Ballari and the address contains the specific area name (e.g., "Gandhi Nagar" or "Cowl Bazaar"). 
> Does this matching logic sound correct to you? 

## Proposed Changes

### [MODIFY] `ballarip/gandinagar.php`
- Add `<?php require_once '../db_connect.php'; ?>` to the top.
- Remove the hardcoded `<div class="card">` elements.
- Insert a PHP loop that queries the database for properties matching "Gandhi Nagar" (`SELECT * FROM properties WHERE (LOWER(city) LIKE '%gandhi nagar%' OR LOWER(address) LIKE '%gandhi nagar%') ORDER BY created_at DESC`).
- Ensure the "Book Now" links pass both the `property_title` and `property_image` to `ballariform.php`, just like the homepage does.
- Add fallback properties if no dynamic results are found.

### [MODIFY] `ballarip/cowlbazaar.php`
- Apply the same dynamic fetching logic, filtering for "Cowl Bazaar".

### [MODIFY] `ballarip/cantonment.php`
- Apply the same dynamic fetching logic, filtering for "Cantonment".

### [MODIFY] `ballarip/vidyanagar.php`
- Apply the same dynamic fetching logic, filtering for "Vidya Nagar".

## Verification Plan
1. Edit the pages to include the database fetching logic.
2. Check that the pages load without PHP errors.
3. Verify that the "Book Now" buttons on these pages correctly link to `ballariform.php` with the property details.
