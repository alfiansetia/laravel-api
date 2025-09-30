import requests
import os
import json

# Fungsi untuk mengunduh file audio
def download_audio(surah, ayah):
    # Format nomor surah dan ayah menjadi tiga digit
    surah_id = f"{surah:03}"
    ayah_id = f"{ayah:03}"
    # URL file
    url = f"https://media.qurankemenag.net/audio/Abu_Bakr_Ash-Shaatree_aac64/{surah_id}{ayah_id}.m4a"
    # Nama file lokal
    file_name = f"{surah_id}_{ayah_id}.m4a"

    try:
        print(f"Mengunduh audio Surah {surah} Ayah {ayah} dari {url}...")
        response = requests.get(url, stream=True)
        response.raise_for_status()  # Periksa jika ada kesalahan pada permintaan

        # Simpan file
        with open(file_name, "wb") as file:
            for chunk in response.iter_content(chunk_size=8192):
                file.write(chunk)

        print(f"File {file_name} berhasil diunduh.")
    except requests.exceptions.RequestException as e:
        print(f"Gagal mengunduh audio Surah {surah} Ayah {ayah}: {e}")

# Load data JSON ayah
with open("public/json/ayah.json", "r", encoding="utf-8") as f:
    json_data = json.load(f)

# Buat folder untuk menyimpan file unduhan
output_folder = "public/quran/audio"
os.makedirs(output_folder, exist_ok=True)
os.chdir(output_folder)  # Pindah ke folder output

# Iterasi data dari JSON dan unduh file
for ayah_data in json_data["data"]:
    surah_id = ayah_data["surah_id"]
    ayah_id = ayah_data["ayah"]
    download_audio(surah_id, ayah_id)
