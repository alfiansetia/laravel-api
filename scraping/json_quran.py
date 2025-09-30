import requests
import json

req_surah = requests.get('https://web-api.qurankemenag.net/quran-surah')
req_ayah = requests.get('https://web-api.qurankemenag.net/quran-ayah')

json_surah = req_surah.json()
json_ayah = req_ayah.json()

# Simpan JSON ke file
with open('public/json/surah.json', 'w', encoding='utf-8') as surah_file:
    json.dump(json_surah, surah_file, ensure_ascii=False, indent=4)

with open('public/json/ayah.json', 'w', encoding='utf-8') as ayah_file:
    json.dump(json_ayah, ayah_file, ensure_ascii=False, indent=4)

print("Data berhasil disimpan ke file.")
