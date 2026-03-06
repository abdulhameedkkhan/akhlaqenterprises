"""Read Excel and output contents as CSV-like text."""
import sys
try:
    import openpyxl
except ImportError:
    import subprocess
    subprocess.check_call([sys.executable, "-m", "pip", "install", "openpyxl", "-q"])
    import openpyxl

path = r"c:\Users\hp\Downloads\ae-products-with-categories.xlsx"
wb = openpyxl.load_workbook(path, read_only=True, data_only=True)
ws = wb.active
print("Sheet name:", ws.title)
print("--- ROWS (list of lists) ---")
rows = []
for row in ws.iter_rows(values_only=True):
    rows.append(list(row))
    print(row)
print("--- TOTAL ROWS:", len(rows))
wb.close()
