from flask import Flask, request, jsonify
import requests
from bs4 import BeautifulSoup

app = Flask(__name__)

# Konfigurasi Laravel endpoint
FORM_URL = "http://127.0.0.1:8000/bukus/create"
SUBMIT_URL = "http://127.0.0.1:8000/bukus"

@app.route("/submit-product", methods=["POST"])
def submit_product():
    try:
        # Ambil data yang dikirim dari form
        product_data = request.form.to_dict()

        # 1. Buat sesi
        session = requests.Session()

        # 2. Ambil halaman form Laravel untuk ambil CSRF token + cookie
        resp = session.get(FORM_URL)
        soup = BeautifulSoup(resp.text, "html.parser")
        csrf_token = soup.find("input", {"name": "_token"})["value"]

        # 3. Tambahkan token ke data
        product_data["_token"] = csrf_token

        # 4. Kirim data ke Laravel
        laravel_resp = session.post(SUBMIT_URL, data=product_data)

        # 5. Kembalikan respon Laravel ke client
        return jsonify({
            "status_code": laravel_resp.status_code,
            "message": "Success" if laravel_resp.status_code == 200 else "Failed",
            "laravel_response": laravel_resp.text
        })

    except Exception as e:
        return jsonify({"error": str(e)}), 500

if __name__ == "__main__":
    app.run(port=5000, debug=True)
