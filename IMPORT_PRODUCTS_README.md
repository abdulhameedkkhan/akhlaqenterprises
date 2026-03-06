# Import Products from Excel/CSV

## Option A: Using CSV (recommended if PHP zip is disabled)

1. Open `ae-products-with-categories.xlsx` in Excel or LibreOffice.
2. **File → Save As** → choose **CSV (Comma delimited) (*.csv)**. Save (e.g. as `ae-products-with-categories.csv`).
3. Run from project root:
   ```bash
   php artisan products:import-excel "c:\Users\hp\Downloads\ae-products-with-categories.csv"
   ```
   (Use the actual path where you saved the CSV.)

## Option B: Using Excel directly (requires PHP ext-zip)

If your PHP has the **zip** extension enabled (e.g. in Laragon):

```bash
php artisan products:import-excel "c:\Users\hp\Downloads\ae-products-with-categories.xlsx"
```

## File format

- First row must be **headers**.
- Required columns (names are case-insensitive):
  - **Category** (or "Categories", "Category Name")
  - **Product** (or "Products", "Product Name", "Name", "Item")

Example:

| Category   | Product        |
|-----------|----------------|
| Fish      | Indian Mackerel|
| Shrimp    | Black Tiger    |

## Behaviour

- **Existing products** (same name) are **skipped**.
- **New categories** are created if they don’t exist.
- **New products** are created with:
  - Auto-generated description
  - **Image = null** (you can add images later in admin).
