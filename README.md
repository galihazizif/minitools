# Minitools
Tools kecil ini berguna ketika banyak tiket kereta api habis, membantu mengingatkan jika ada tiket kereta yang dibatalkan tersedia untuk relasi dan tanggal tertentu. Barangkali anda beruntung bisa mendapatkan tiket yang dibatalkan orang lain.

## Penggunaan.

```php tiket.php <yyyy> <mm> <dd> <stasiun_asal> <stasiun tujuan>```

**yyyy** : Tahun keberangkatan, misal: 2017   

**mm** : Bulan keberangkatan, misal 09   

**dd** : Tanggal keberangkatan, misal 20   

**stasiun_asal** : Sesuai dengan kode stasiun, misal GMR untuk Gambir   

**stasiun_tujuan** : Sesuai dengan kode stasiun, misal PWT untuk Purwokerto   


Contoh

```php tiket.php 2017 09 08 PSE#PASARSENEN PWT#PURWOKERTO```


Format stasiun tujuan harus sesuai dengan kode stasiun. Kode stasiun bisa anda cari di google.
