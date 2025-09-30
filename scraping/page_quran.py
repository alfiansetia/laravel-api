import requests
import os

# Fungsi untuk mengunduh file
def download_file(page):
    # Format nomor halaman menjadi tiga digit
    formatted_page = f"{page:03}"
    # URL file
    url = f"https://media.qurankemenag.net/khat2/QK_{formatted_page}.webp"
    # Nama file lokal
    file_name = f"QK_{formatted_page}.webp"

    try:
        print(f"Mengunduh halaman {formatted_page} dari {url}...")
        response = requests.get(url, stream=True)
        response.raise_for_status()  # Periksa jika ada kesalahan pada permintaan

        # Simpan file
        with open(file_name, "wb") as file:
            for chunk in response.iter_content(chunk_size=8192):
                file.write(chunk)

        print(f"File {file_name} berhasil diunduh.")
    except requests.exceptions.RequestException as e:
        print(f"Gagal mengunduh halaman {formatted_page}: {e}")

# Buat folder untuk menyimpan file unduhan
output_folder = "downloaded_pages"
os.makedirs(output_folder, exist_ok=True)
os.chdir(output_folder)  # Pindah ke folder output

# Unduh file dari halaman 001 hingga 604
for page in range(1, 605):
    download_file(page)
