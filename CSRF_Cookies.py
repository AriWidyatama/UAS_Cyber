from flask import Flask, request, jsonify
import requests
from bs4 import BeautifulSoup

app = Flask(__name__)

# Laravel URLs
FORM_URL = "http://127.0.0.1:8000/admin/bukus/create"
SUBMIT_URL = "http://127.0.0.1:8000/admin/bukus"

# Cookie Laravel (ambil dari browser yang sudah login)
COOKIES = {
    'laravel_session': 'eyJpdiI6Ikc2ei9XSktXM0JRWTFuRXd0YlFlT2c9PSIsInZhbHVlIjoiMVZ5VzlCT3RnQXdPeFBRSHZtMDNlN2I1Q0ZNaXY4c25nMFRDS2I2WC9IRWZuNWYxemoxNzg4REtmeGF0ZzdFSEwrZUxML2R2QSs4WXRwcW5aQXVFSW5ScnI0MnE0ZjZrc0dtMVhZR29Ga1V1Y3dEWTlnbGZPOXU4aUpOVjQxdGciLCJtYWMiOiI1MWM5MzM2YzBmNDU5ODU4NmNhZjVkNDNhMGQ5OWVmMTk1ZjhjYWRiOWVlMGY5MzY0YTY3MzljM2Y3YjNlNWNiIiwidGFnIjoiIn0%3D'
}

@app.route("/submit-product", methods=["POST"])
def submit_product():
    try:
        product_data = request.form.to_dict()

        # 1. Pakai session dengan cookie
        session = requests.Session()
        session.cookies.update(COOKIES)

        # 2. Ambil halaman create untuk ambil CSRF token
        create_page = session.get(FORM_URL)
        soup_form = BeautifulSoup(create_page.text, "html.parser")
        csrf_token = soup_form.find("input", {"name": "_token"})["value"]

        # 3. Tambahkan token ke data produk
        product_data["_token"] = csrf_token

        # 4. Kirim POST ke Laravel
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
