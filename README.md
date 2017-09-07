# Minitools
Tools kecil ini berguna ketika banyak tiket kereta api habis, membantu mengingatkan jika ada tiket kereta yang dibatalkan tersedia untuk relasi dan tanggal tertentu. Barangkali anda beruntung bisa mendapatkan tiket yang dibatalkan orang lain.

## Penggunaan.

```php tiket.php <yyyy> <mm> <dd> <stasiun_asal> <stasiun tujuan> <pilihan_kereta>```

**yyyy** : Tahun keberangkatan, misal: 2017   

**mm** : Bulan keberangkatan, misal 09   

**dd** : Tanggal keberangkatan, misal 20   

**stasiun_asal** : Sesuai dengan kode stasiun, misal GMR untuk Gambir   

**stasiun_tujuan** : Sesuai dengan kode stasiun, misal PWT untuk Purwokerto    

**pilihan_kereta** : ditulis subclass kereta dan nomor kereta *&lt;subclass&gt;_&lt;nomor_kereta&gt;*


Format stasiun tujuan harus sesuai dengan kode stasiun. Kode stasiun bisa anda cari di google.

Format pilihan_kereta bisa diambil dari halaman pemesanan tiket pada situs https://tiket.kereta-api.co.id  

![Pesan tiket](http://telegra.ph/file/6eb6676e09bd9670abcfc.png)


Contoh:

Saya ingin mengetahui jika ada tiket KA Serayu dan KA Sawunggalih seperti pada gambar pada screenshot diatas yang dibatalkan.

Kode KA Sawunggalih tujuan PSE adalah 121 dan Serayu tujuan Jakarta adalah 215.

```php tiket.php 2017 09 08 PWT PSE m_121,c_215```   

** Selamat Mencoba ** 
