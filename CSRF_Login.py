from flask import Flask, request, jsonify
import requests
from bs4 import BeautifulSoup

app = Flask(__name__)

# Konfigurasi Laravel endpoint
LOGIN_FORM_URL = "http://127.0.0.1:8000/"
LOGIN_URL = "http://127.0.0.1:8000/login"
FORM_URL = "http://127.0.0.1:8000/admin/bukus/create"
SUBMIT_URL = "http://127.0.0.1:8000/admin/bukus"

# Kredensial login
USERNAME = "admin"
PASSWORD = "admin123"

@app.route("/submit-product", methods=["POST"])
def submit_product():
    try:
        product_data = request.form.to_dict()

        file_obj = request.files.get("gambar")

        # 1. Buat sesi
        session = requests.Session()

        # 2. Ambil halaman login Laravel
        login_page = session.get(LOGIN_FORM_URL)
        soup_login = BeautifulSoup(login_page.text, "html.parser")
        csrf_login = soup_login.find("input", {"name": "_token"})["value"]

        # 3. Kirim form login
        login_payload = {
            "_token": csrf_login,
            "username": USERNAME,  # sesuaikan dengan field di Laravel (bisa 'email')
            "password": PASSWORD
        }
        login_resp = session.post(LOGIN_URL, data=login_payload)

        if "logout" not in login_resp.text.lower():
            return jsonify({"error": "Login gagal"}), 401

        # 4. Ambil halaman create produk untuk token CSRF baru
        create_page = session.get(FORM_URL)
        soup_form = BeautifulSoup(create_page.text, "html.parser")
        csrf_token = soup_form.find("input", {"name": "_token"})["value"]

        # 5. Tambahkan token ke data produk
        product_data["_token"] = csrf_token

        # 6. Kirim POST untuk submit produk
        files = {}
        if file_obj:
            files["gambar"] = (file_obj.filename, file_obj.stream, file_obj.mimetype)
            laravel_resp = session.post(SUBMIT_URL, data=product_data, files=files)
        else:
            laravel_resp = session.post(SUBMIT_URL, data=product_data)

        return jsonify({
            "status_code": laravel_resp.status_code,
            "message": "Success" if laravel_resp.status_code == 302 else "Failed",
            "laravel_response": laravel_resp.text
        })

    except Exception as e:
        return jsonify({"error": str(e)}), 500


if __name__ == "__main__":
    app.run(port=5000, debug=True)
