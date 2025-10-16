## Konfigurasi di komputer kalian
Paling pertama kalian lakukan adalah hapus folder testpos yang ada di folder kode/kodingan kalian. **(kalau bisa, backup bagian migration dan modelnya ditempat lain terlebih dahulu. Agar kalian tidak mikir ulang migration dan modelnya nanti)**
Jika sudah dihapus, kalian buka VSCode kalian dan buka terminal baru. **Pastikan terminal kalian berada di folder Kode (misalnya PS D:/KODE>).** 

> [!NOTE]
> Jika kalian berada di selain folder kodingan (misalnya D:/KODE), ke tab File diatas kiri, trus pilih New Window. Kalo udah kebuka lagi vscodenya, klik Open Folder habis itu pergi ke folder kodingannya (misalnya D:/KODE). Kalau sudah berada di folder kode, pencet Select Folder. Setelah itu kalian bikin terminal baru dan lanjut ke step selanjutnya.

Masukkan kode dibawah ini di terminal tersebut:

```sh
git clone https://github.com/aliikhwanh12/testpos.git
```

Setelah itu, projek/folder 'testpos' akan otomatis ditambahkan di folder KODE. Sekarang kalian masukkan kode dibawah ini pada terminal :

```sh
cd testpos
```
```sh
composer install
```

Kalau sudah terinstall, sekarang buka terminal baru lagi tapi **Command Prompt** bukan powershell. **Pastikan command prompt kalian berada di folder Kode (misalnya D:/KODE>).** 

> [!NOTE]
> Kedepannya, Powershell itu untuk menjalankan perintah php (misalnya php artisan serve, php artisan make:controller, dll)  sedangkan Command Prompt untuk menjalankan npm (npm install, npm run dev, dll).

Masukkan kode dibawah ini pada Command Prompt:
```cmd
cd testpos
```
```cmd
npm install
```

Kalau sudah terinstall, kita balik lagi ke Powershell sebelumnya. Masukkan kode berikut :

```sh
cp .env.example .env
```

```sh
php artisan key:generate
```
Jika sudah ter-generate, sekarang buka file **.env** di folder **testpos**. Pastikan bagian DB itu seperti dibawah ini:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=kasir
DB_USERNAME=root
DB_PASSWORD=
DB_COLLATION=utf8mb4_unicode_ci
```
Jika sudah disinkronkan, sekarang kalian tambah migration dan model di folder testpos sebelumnya. Caranya kalian buka Powershell sebelumnya, lalu masukkan kode seperti dibawah ini **(PASTIKAN URUTANNYA BENAR DARI KIRI KE KANAN DI GAMBAR ERD YANG SAYA KASIH DI PPT)** :

```sh
php artisan make:model KategoriProduk -mc
php artisan make:model Produk -mc
php artisan make:model Penjualan -mc
php artisan make:model OrderJual -mc

```
Setelah itu, kalian masukkan migration dan model kalian di folder sebelumnya. 
**PASTIKAN HAPUS 's' NYA DI TIAP NAMA TABEL (Misalnya table 'penjualans' jadi 'penjualan')**
**TIAP FOREIGN KEY PAKE $table->foreignId()->constrained()->onDelete('cascade');**
Jika sudah diisi migrationnya, sekarang kalian nyalakan XAMMP lalu pergi ke localhost/phpmyadmin. Setelah itu kita akan buat database baru yang namanya **'kasir'**. Jangan lupa pilih utf8mb4_unicode_ci bukan general di samping input nama databasenya. 
Jika sudah dibuat database 'kasir' ya, balik lagi ke vscode tadi.
Buka powershell sebelumnya lalu jalankan perintah :

```sh
php artisan migrate:fresh

```
Jika sudah berhasil, masukkan kode dibawah di Powershell :

```sh
php artisan serve

```
Sedangkan di terminal Command prompt :

```sh
npm run dev
```

Nah sekarang harusnya websitenya sudah berjalan. Buka URL yang diberikan (127.0.0.1:8000).


## Tugas
### Coba bikin fitur untuk menambahkan kategori produk menggunakan post kaya kemarin.
#### Building for source