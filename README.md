# Travel World - Fixed Project

## Requirements
- XAMPP/WAMP with PHP 8+
- Apache
- Browser with internet access for Bootstrap/Font Awesome CDN

## Run
1. Copy the `VS Bootstrap` folder into `htdocs`.
2. Start Apache in XAMPP.
3. Open `http://localhost/VS%20Bootstrap/` (or rename folder to `travel-world` and use that).
4. Admin: `http://localhost/VS%20Bootstrap/admin-panel/login.php`
5. Demo credentials: `admin` / `1234`

## Data flow
All editable website content is stored in the shared `data/` directory:
- sliders.json
- packages.json
- onedaytours.json
- gallery.json
- bookings.json
- messages.json
- plans.json
- settings.json
- tourtypes.json

The public website reads these same files, so admin changes appear immediately on the frontend.

## Uploads
Uploaded images are saved to `/uploads/`.

## Important for production
The current demo login is intentionally simple. Before deployment, move authentication to a real database with password_hash/password_verify, add CSRF protection, HTTPS, rate limiting, and server-side authorization.


## Professional UI Upgrade
- Added a shared premium travel design system in `assets/css/site.css`.
- Added responsive admin styling in `assets/css/admin.css`.
- Refreshed navigation, footer, homepage hero/trust strip, and admin console.
- Existing PHP/data files and booking functionality are preserved.
