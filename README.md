# CopyClean – Website

This repository contains the static marketing website for **CopyClean**, a lightweight macOS menubar app that always pastes plain text. No formatting. No noise. Just clean text.

The website is built with **Bootstrap 5**, minimal JavaScript and optimized for fast loading and simple maintenance.

## Features

- Fully static website (HTML, CSS, JS)
- Bootstrap 5 via CDN
- Optional use of Apple SF Symbols 7 (see license section)
- Lightweight custom styles (inline or styles.css)
- Prepared sections for:
  - Hero + App Store CTA
  - Features
  - FAQ
  - Support / Contact

## Usage

Simply clone the repository and open `index.html` in your browser.

```bash
git clone https://github.com/<username>/<repo>.git
cd <repo>
open index.html
```

## Folder Structure

```
/assets
  /css
    styles.css
  /js
  /img
index.html
```

## Development

The project is intentionally simple:

- Bootstrap 5 is loaded via CDN  
- Custom styles can be placed inline or inside `assets/css/styles.css`  
- No build tools required  

You can extend the project with any stack (Vite, SCSS, etc.) later if needed.

## SF Symbols 7 License

Apple allows using **SF Symbols** on websites and in marketing material **as long as:**

1. The symbols are **not modified** except for size, color, and weight.
2. They are used in connection with **Apple platforms or apps running on Apple platforms**.

This website promotes a **macOS app**, therefore **SF Symbols 7 usage is permitted**.

Ref: Apple SF Symbols License – “Permitted Uses”.

## License

This website is provided under the MIT License unless otherwise stated.
