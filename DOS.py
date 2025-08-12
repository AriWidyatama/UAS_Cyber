import threading
import requests
import time

TARGET_URL = "http://127.0.0.1:8000/login"  # ganti dengan URL Laravel lokalmu
MAX_REQUESTS = 100  # total maksimal request yang akan dikirim
THREAD_COUNT = 5    # jumlah thread berjalan bersamaan
DELAY = 0.1         # delay antar request (detik)

counter_lock = threading.Lock()
request_counter = 0

def send_request(thread_id):
    global request_counter
    while True:
        with counter_lock:
            if request_counter >= MAX_REQUESTS:
                break
            request_counter += 1
            current_count = request_counter

        try:
            resp = requests.get(TARGET_URL)
            print(f"[Thread {thread_id}] Request #{current_count} - Status: {resp.status_code}")
        except Exception as e:
            print(f"[Thread {thread_id}] Request #{current_count} - Error: {e}")

        time.sleep(DELAY)

threads = []
for i in range(THREAD_COUNT):
    t = threading.Thread(target=send_request, args=(i+1,))
    t.start()
    threads.append(t)

for t in threads:
    t.join()

print("Simulasi DOS selesai.")
