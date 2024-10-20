<?php
session_start();

//bağlantı yapılacak sayfalar

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Sabit veriler
        //sms için gerekli olan bilgilerin yazılması
        $username = "(mesaj servisi kullanıcı adı)";
        $password = "(mesaj servisi şifresi)";
        $origin = "(gönderici adı)";

       
        $tarih = date("d.m.Y");
        $saat = date("H:i:s");
    

    // Ortak POST verileri
    $kid = $_POST['TABLO_SÜTUN_ADI'];
    $izin_tipid = $_POST['TABLO_SÜTUN_ADI'];
    $aciklama = $_POST['TABLO_SÜTUN_ADI'];
    $birincibirim = $_POST['TABLO_SÜTUN_ADI'];
    $ikincibirim = $_POST['TABLO_SÜTUN_ADI'];
    $ucuncubirim = $_POST['TABLO_SÜTUN_ADI'];
    $birincivekil = $_POST['TABLO_SÜTUN_ADI'];
    $ikincivekil = $_POST['TABLO_SÜTUN_ADI'];
    $ucuncuvekil = $_POST['TABLO_SÜTUN_ADI'];
    $onayci1 = $_POST['TABLO_SÜTUN_ADI'];
    $onayci2 = $_POST['TABLO_SÜTUN_ADI'];
    $onayci3 = $_POST['TABLO_SÜTUN_ADI'];
    $izindurumid = 3;

    
    $db = "veritabanı bağlantısı";

    try {
        switch ($izin_tipid) {
            case '1': // Yıllık İzin
            case '2': // Ücretsiz İzin
            case '5': // Diğer İzinler
                $izinbastar = $_POST['TABLO_SÜTUN_ADI'];
                $izinbittar = $_POST['TABLO_SÜTUN_ADI'];
                $izinsonbastar = $_POST['TABLO_SÜTUN_ADI'];
                $izindekiadres = $_POST['TABLO_SÜTUN_ADI'];
                $izinsuresi = $_POST['TABLO_SÜTUN_ADI'];

             
          
                $db->Sorgu("VERİTABANINA KAYIT İŞLEMİ İÇİN İLGİLİ SQL KODU");
             
               
                   // Mesaj gönderme
                   $kisibilgisi = VERİTABANI_FONKSİYONU("VERİTABANI_ADI", "*", "id=$onayci1");
                   $telefonno = $kisibilgisi[0]['ceptel'];
                   $basvurankisi=VERİTABANI_FONKSİYONU("VERİTABANI_ADI", "*", "id=$kid");
                   $basvurankisi = $basvurankisi[0]['adi'] . " " . $basvurankisi[0]['soyadi'];
                   $mesajDizi = "Sayın Yetkili, $basvurankisi tarafından izin talep formu doldurulmuştur. Form bilgi detayına ulaşmak için tıklayınız. 'SAYFA LİNKİ'";
   
                     $url = "http://SMS_URL_BİLGİSİ" . urlencode($username) . "&pw=" . urlencode($password) . "&msg=" . urlencode($mesajDizi) . "&orgn=" . urlencode($origin) . "&list=" . urlencode($telefonno);
                   
                   file_get_contents($url);
                break;

            case '3': // Akademik İzin
                $organizasyon_turu = $_POST['TABLO_SÜTUN_ADI'];
                $org_tarihi = $_POST['TABLO_SÜTUN_ADI'];
                $org_sunumu = $_POST['TABLO_SÜTUN_ADI'];
                $org_projeadi = $_POST['TABLO_SÜTUN_ADI'];
                $org_akademik_aciklama = $_POST['TABLO_SÜTUN_ADI'];

                $izinbastar = $_POST['TABLO_SÜTUN_ADI'];
                $izinbittar = $_POST['TABLO_SÜTUN_ADI'];
                $izinsonbastar = $_POST['TABLO_SÜTUN_ADI'];
                $izindekiadres = $_POST['TABLO_SÜTUN_ADI'];
                $izinsuresi = $_POST['TABLO_SÜTUN_ADI'];

                $db->Sorgu("VERİTABANINA KAYIT İŞLEMİ İÇİN İLGİLİ SQL KODU");

              
                // Mesaj gönderme
                $kisibilgisi = VERİTABANI_FONKSİYONU("VERİTABANI_ADI", "*", "id=$onayci1");
                $telefonno = $kisibilgisi[0]['ceptel'];
                $basvurankisi=VERİTABANI_FONKSİYONU("VERİTABANI_ADI", "*", "id=$kid");
                $basvurankisi = $basvurankisi[0]['adi'] . " " . $basvurankisi[0]['soyadi'];
                $mesajDizi = "Sayın Yetkili, $basvurankisi tarafından izin talep formu doldurulmuştur. Form bilgi detayına ulaşmak için tıklayınız.'SAYFA LİNKİ'";

                $url = "http://SMS_URL_BİLGİSİ" . urlencode($username) . "&pw=" . urlencode($password) . "&msg=" . urlencode($mesajDizi) . "&orgn=" . urlencode($origin) . "&list=" . urlencode($telefonno);
                file_get_contents($url);
                break;

            case '4': // Günlük/Saatlik İzin
                $saatlik_izin_neden = $_POST['TABLO_SÜTUN_ADI'];
                $gunluk_bastar = $_POST['TABLO_SÜTUN_ADI'];
                $gunluk_bittar = $_POST['TABLO_SÜTUN_ADI'];
                $gunluk_baslama_saati = $_POST['TABLO_SÜTUN_ADI'];
                $gunluk_izin_suresi = $_POST['TABLO_SÜTUN_ADI'];

              

                $db->Sorgu("VERİTABANINA KAYIT İŞLEMİ İÇİN İLGİLİ SQL KODU");
                
                   // Mesaj gönderme
                   $kisibilgisi = VERİTABANI_FONKSİYONU("VERİTABANI_ADI", "*", "id=$onayci1");
                   $telefonno = $kisibilgisi[0]['ceptel'];
                   $basvurankisi=VERİTABANI_FONKSİYONU("VERİTABANI_ADI", "*", "id=$kid");
                   $basvurankisi = $basvurankisi[0]['adi'] . " " . $basvurankisi[0]['soyadi'];
                   $mesajDizi = "Sayın Yetkili, $basvurankisi tarafından izin talep formu doldurulmuştur. Form bilgi detayına ulaşmak için tıklayınız.'SAYFA LİNKİ'";
   
                   $url = "http://SMS_URL_BİLGİSİ"  . urlencode($username) . "&pw=" . urlencode($password) . "&msg=" . urlencode($mesajDizi) . "&orgn=" . urlencode($origin) . "&list=" . urlencode($telefonno);
                   file_get_contents($url);
                break;
        }

        // Başarılı işlem mesajı
        $_SESSION['mesaj'] = [
            'title' => 'Başarılı!',
            'message' => 'İzin talebiniz başarıyla iletildi.',
            'type' => 'success'
        ];
        header("Location: http://SAYFANIZIN_URL_BİLGİSİ/personel_izintalepformu");
    } catch (PDOException $e) {
        echo "Hata: " . $e->getMessage();
    }
} else {
    echo "Formdan gelen veriler yok.";
}
?>
