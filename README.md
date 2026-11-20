# Length Unit Converter
 
A small PHP web app that converts a length value into seven units at once: kilometers, meters, decimeters, centimeters, millimeters, inches and feet. Enter a number, pick the unit it is expressed in, and get a full conversion table. The UI includes lightweight CSS/JS animations.
 
<!-- Add a screenshot here, e.g. ![Screenshot](docs/screenshot.png) -->
 
## Features
 
- Converts between 7 length units in a single request (metric + imperial)
- Results table with all units, name and symbol
- Highlights the row of the unit you entered
- Animated UI: page-load sequence, staggered table rows, count-up results, button ripple, focus/hover effects, input "shake" on invalid values
- Respects `prefers-reduced-motion`
- No database, no framework, no dependencies
## Supported units
 
| Unit       | Symbol |
|------------|--------|
| Kilometer  | Km     |
| Meter      | M      |
| Decimeter  | Dm     |
| Centimeter | Cm     |
| Millimeter | Mm     |
| Inch       | "      |
| Foot       | Ft     |
 
## Tech stack
 
- **PHP** (server-side conversion logic, tested pattern: plain `$_POST` handling)
- **HTML5** and **CSS3** (layout and theme in `stl.css`)
- **Vanilla JavaScript** (animations and client-side validation only)
## Project structure
 
```
.
├── index.html      # Entry form (value + unit)
├── calculate.php   # Form + conversion logic + results table
├── stl.css         # Main stylesheet (colors, layout)
└── logo.png        # Header icon (see note below)
```
 
> `calculate.php` currently references its icon as `Zrzut ekranu 2023-11-19 111439.png`, while `index.html` uses `logo.png`. Use the same file in both places if you want a consistent header.
 
## Getting started
 
### Requirements
 
- PHP 7.4 or newer (CLI or any web server with PHP support, e.g. Apache, Nginx + PHP-FPM, XAMPP)
### Run locally
 
```bash
git clone https://github.com/<your-username>/<your-repo>.git
cd <your-repo>
php -S localhost:8000
```
 
Then open <http://localhost:8000/index.html> in your browser.
 
### Deploy
 
Copy all project files to a PHP-enabled web server directory (for example `htdocs/` or `/var/www/html/`). No build step or configuration is needed.
 
## How it works
 
1. `index.html` shows a form with a numeric field (`value`) and a unit selector (`unit`) and sends them via `POST` to `calculate.php`.
2. `calculate.php` reads `$_POST["value"]` (cast to `float`) and `$_POST["unit"]`, then computes the value in every unit using fixed conversion factors.
3. The page renders the results table. JavaScript then animates the numbers from 0 to their final value. The server-rendered value is restored at the end of the animation, so the displayed result is always exactly what PHP computed.
### Conversion factors
 
Conversions are done directly from the selected unit, using these factors:
 
| From → To   | Factor used                          |
|-------------|--------------------------------------|
| km → m / dm / cm / mm | × 1000 / 10 000 / 100 000 / 1 000 000 |
| km → in / ft | × 39 370.08 / × 3 280.84            |
| m → in / ft | × 39.37 / × 3.28                     |
| dm → in / ft | × 3.94 / ÷ 3.048                    |
| cm → in / ft | ÷ 2.54 / ÷ 30.48                    |
| mm → in / ft | ÷ 25.4 / ÷ 304.8                    |
| in → m / cm / mm | × 0.0254 / × 2.54 / × 25.4     |
| ft → m / cm / mm | × 0.3048 / × 30.48 / × 304.8   |
 
## Known limitations
 
- Some metric → imperial factors are rounded (for example meter → foot uses `3.28`, the exact value is about `3.28084`; decimeter → inch uses `3.94`, exact is about `3.937`). Results for those pairs are approximate.
- Results are printed without rounding or number formatting, so some values show many decimal places.
- The form is not pre-filled after submitting (it resets to `1` and the first unit).
- Opening `calculate.php` directly (without submitting the form) shows all zeros.
- Client-side validation rejects empty and non-positive values; the server does not validate beyond the `float` cast.
## Ideas for improvement
 
- Keep the entered value and selected unit after submission
- Round/format results (e.g. `number_format` or a fixed number of significant digits)
- Use exact conversion factors based on the meter (1 in = 0.0254 m, 1 ft = 0.3048 m) and derive every unit from one base value to remove duplicated logic
- Add more units (miles, yards, nautical miles)
- Allow negative values, if relevant for the use case
## Contributing
 
Issues and pull requests are welcome. For larger changes, please open an issue first to discuss what you would like to change.
 
## License
 
No license has been specified yet. Add a `LICENSE` file (for example MIT) before publishing if you want others to be able to reuse the code.
