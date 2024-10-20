<?php 
session_start();
//bağlantı yapılacak sayfalar


        //sms için gerekli olan bilgilerin yazılması
        $username = "(mesaj servisi kullanıcı adı)";
        $password = "(mesaj servisi şifresi)";
        $origin = "(gönderici adı)";



$tarih=date("d.m.Y");

$sontarih=date("d.m.Y",strtotime('1 day',strtotime($tarih)));

$saat=date("H:i:s");


if (isset($_POST['id']) && isset($_POST['onayci_seviyesi'])) {
    $izinId = $_POST['id'];
    $onayciSeviyesi = $_POST['onayci_seviyesi'];
    $tarih = date('Y-m-d H:i:s');
    $db = "VERİTABANI BAĞLANTISI";

    if (isset($_POST['onay'])) {
        $izinbilgisi = VERİTABANI_FONKSİYONU("TABLO_ADI", "*", "id=$izinId");
        $basvurukisisi = $izinbilgisi["0"]["kid"];
        $basvurankisibilgisi = VERİTABANI_FONKSİYONU("TABLO_ADI", "*", "id=$basvurukisisi");

        if ($onayciSeviyesi == 'birinci') {
            // 1. Onaylayıcı onayı
            $db->Sorgu("UPDATE TABLO_ADI SET TABLO_SÜTUN_ADI = 1, TABLO_SÜTUN_ADI = '$tarih' WHERE id = '$izinId'");

            $ikincionaylayicikisi = $izinbilgisi["0"]["TABLO_SÜTUN_ADI"];
            if ($ikincionaylayicikisi !== NULL && $ikincionaylayicikisi != 0) {
                $kisibilgisi = VERİTABANI_FONKSİYONU("TABLO_ADI", "*", "id=$ikincionaylayicikisi");
                $telefonno = $kisibilgisi["0"]["ceptel"];
                $basvurankisi = $basvurankisibilgisi["0"]["adi"]." ".$basvurankisibilgisi["0"]["soyadi"];
                
                $mesajDizi = "Sayın Yetkili, ".$basvurankisi." tarafından izin talep formu onaylanmıştır. Lütfen belgeleri onaylayınız. 'SAYFA LİNKİ'";

                // SMS Gönderme
                $url = "SMS URL BİLGİSİ" . urlencode($username) . "&pw=" . urlencode($password) . "&msg=" . urlencode($mesajDizi) . "&orgn=" . urlencode($origin) . "&list=" . urlencode($telefonno) . "&sd=";
                $cekilen_veri = file_get_contents($url);
            }

        } elseif ($onayciSeviyesi == 'ikinci') {
            // 2. Onaylayıcı onayı
            $db->Sorgu("UPDATE TABLO_ADI SET TABLO_SÜTUN_ADI = 1, TABLO_SÜTUN_ADI = '$tarih' WHERE id = '$izinId'");

            $ucuncuonaylayicikisi = $izinbilgisi["0"]["TABLO_SÜTUN_ADI"];

            if ($ucuncuonaylayicikisi === NULL || $ucuncuonaylayicikisi == 0) {
                // Eğer üçüncü onaylayıcı yoksa, başvuran kişiye SMS gönder
                $telefonno = $basvurankisibilgisi["0"]["ceptel"];
                $izindetay = $izinbilgisi["0"]["aciklama"];

                $mesajDizi = "Sayın Yetkili, '".$izindetay."' açıklamasıyla doldurmuş olduğunuz izin formu tamamen onaylanmıştır. Bilginize.";

                // SMS Gönderme
                $url = "SMS URL BİLGİSİ" . urlencode($username) . "&pw=" . urlencode($password) . "&msg=" . urlencode($mesajDizi) . "&orgn=" . urlencode($origin) . "&list=" . urlencode($telefonno) . "&sd=";
                $cekilen_veri = file_get_contents($url);
            } else {
                // Üçüncü onaylayıcı varsa, onay SMS'i gönder
                $kisibilgisi = VERİTABANI_FONKSİYONU("TABLO_ADI", "*", "id=$ucuncuonaylayicikisi");
                $telefonno = $kisibilgisi["0"]["ceptel"];
                $basvurankisi = $basvurankisibilgisi["0"]["adi"]." ".$basvurankisibilgisi["0"]["soyadi"];

                $mesajDizi = "Sayın Yetkili, ".$basvurankisi." tarafından izin talep formu onaylanmıştır. Lütfen belgeleri onaylayınız. 'SAYFA LİNKİ'";

                // SMS Gönderme
                $url = "SMS URL BİLGİSİ" . urlencode($username) . "&pw=" . urlencode($password) . "&msg=" . urlencode($mesajDizi) . "&orgn=" . urlencode($origin) . "&list=" . urlencode($telefonno) . "&sd=";
                $cekilen_veri = file_get_contents($url);
            }

        } elseif ($onayciSeviyesi == 'ucuncu') {
            // 3. Onaylayıcı onayı (Son aşama)
            $db->Sorgu("UPDATE TABLO_ADI SET TABLO_SÜTUN_ADI = 1, TABLO_SÜTUN_ADI = '$tarih' WHERE id = '$izinId'");
            
            // İzin formunu dolduran kişiye bilgi SMS'i
            $telefonno = $basvurankisibilgisi["0"]["ceptel"];
            $izindetay = $izinbilgisi["0"]["aciklama"];

            $mesajDizi = "Sayın Yetkili, '".$izindetay."' açıklamasıyla doldurmuş olduğunuz izin formu tamamen onaylanmıştır. Bilginize.";

            // SMS Gönderme
            $url = "SMS URL BİLGİSİ" . urlencode($username) . "&pw=" . urlencode($password) . "&msg=" . urlencode($mesajDizi) . "&orgn=" . urlencode($origin) . "&list=" . urlencode($telefonno) . "&sd=";
            $cekilen_veri = file_get_contents($url);
        }

    } 
    elseif (isset($_POST['reddet'])) {
        // Reddetme işlemi için
        $izinbilgisi = VERİTABANI_FONKSİYONU("TABLO_ADI", "*", "id=$izinId");
        $basvurukisisi = $izinbilgisi["0"]["TABLO_SÜTUN_ADI"];
        $basvurankisibilgisi = VERİTABANI_FONKSİYONU("TABLO_ADI", "*", "id=$basvurukisisi");
        $telefonno = $basvurankisibilgisi["0"]["ceptel"];
    
        if ($onayciSeviyesi == 'birinci') {
            $db->Sorgu("UPDATE TABLO_ADI SET TABLO_SÜTUN_ADI = 2, TABLO_SÜTUN_ADI = '$tarih' WHERE id = '$izinId'");
            $reddedenOnayci = 'Birinci onaylayıcı';
        } elseif ($onayciSeviyesi == 'ikinci') {
            $db->Sorgu("UPDATE TABLO_ADI SET TABLO_SÜTUN_ADI = 2, TABLO_SÜTUN_ADI = '$tarih' WHERE id = '$izinId'");
            $reddedenOnayci = 'İkinci onaylayıcı';
        } elseif ($onayciSeviyesi == 'ucuncu') {
            $db->Sorgu("UPDATE TABLO_ADI SET TABLO_SÜTUN_ADI = 2, TABLO_SÜTUN_ADI = '$tarih' WHERE id = '$izinId'");
            $reddedenOnayci = 'Üçüncü onaylayıcı';
        }
    
        // Başvuran kişiye SMS gönder
        $mesajDizi = "Sayın Yetkili, izin formunuz ".$reddedenOnayci." tarafından reddedilmiştir. Bilginize.";
    
        // SMS Gönderme
        $url = "SMS URL BİLGİSİ" . urlencode($username) . "&pw=" . urlencode($password) . "&msg=" . urlencode($mesajDizi) . "&orgn=" . urlencode($origin) . "&list=" . urlencode($telefonno) . "&sd=";
        $cekilen_veri = file_get_contents($url);
    }

    header("Location: "."YÖNLENDİRME YAPILACAK SAYFA /personel_izintaleponay");
}

?>