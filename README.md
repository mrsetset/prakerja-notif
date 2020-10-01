## Auto Notifikasi 24 Hours - PHP CLI
**Fitur Notifikasi :**
- Pengumuman Lolos/Gagal Pendaftaran Gelombang
- Nomor dan Saldo Prakerja nongol
- Sertifikat nongol di dashboard
- Jadwal insentif nongol
- Perubahan setiap status pencairan insentif (Belum diproses, diproses, berhasil, gagal, etc..)
- Survey Evaluasi untuk mendapatkan insentif Rp 50.000

## Langkah 1: Buat Bot Telegram
Step ini bisa googling untuk selanjutnya mendapatkan bot token dan chat_id penerima notifikasi

## Langkah 2: Cloning repo
ketik command berikut:
- `git clone https://github.com/mrsetset/prakerja-notif.git`
- `cd prakerja-notif`

## Langkah 3: Menambah list akun
- Buka `All_akun.CSV`
- Masukan akun prakerja kamu sesuai format
- 1 baris untuk 1 akun

## Langkah 4: Setting `run.php`
- Buka dan Edit skrip `run.php`
- Perhatikan `congif` pada baris skrip paling atas
- Isi telegram bot token kamu pada tulisan **ISI DISINI**
- (Opsional) Waktu jeda defaultnya per 3 menit sekali di jam normal 6 pagi - 5 sore dan selebihnya akan diperlambat 2-3 kali, bisa juga di ubah di bagian nilai **SLEEP_IN_MINUTES**

## Langkah 5: Running 
ketik command berikut:
- `php run.php`

## Screenshoot:

![Running](https://i.imgur.com/dheEAgz.png)
![Running](https://i.imgur.com/ftk8nI8.png)
![Running](https://i.imgur.com/hrW44TV.png)
