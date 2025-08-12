import requests

url = "http://localhost:5000/submit-product"

i = 10

for i in range(10, 15):
    data = {
        "judul_buku": f"Judul{i}",
        "description": "Deskripsi buku palsu",
        "penulis": f"Penulis Misterius{i}",
        "tahun_terbit": "2001",
        "jumlah_buku": str(10),
        "category": "palsu",
        "status": "available"
    }

    i+= 1

    # Kirim data
    response = requests.post(url, data=data)  

    print("Status code:", response.status_code)
    print("Response body:", response.text)
    if response.status_code == 200:
        print("Data berhasil dikirim!")
    else:
        print("Gagal mengirim data.")
