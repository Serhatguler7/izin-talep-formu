<?php



$mesaj = null;
if (isset($_SESSION['mesaj'])) {
    $mesaj = $_SESSION['mesaj']; 
    unset($_SESSION['mesaj']); // Mesajı gösterdikten sonra session'dan siliyoruz
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- SweetAlert CDN -->
    <!-- arama işlemi için -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
   
    <?php include_once("_head.php"); ?>
    <style>
    .form-container {
        border: 1px solid #ccc;
        padding: 20px;
        margin: 20px 0;
        border-radius: 5px;
        width: 100%;
        box-sizing: border-box;
    }

    .form-group {
        margin-bottom: 15px;
    }

    .form-group label {
        margin-right: 20px;
        min-width: 150px;
        text-align: left;
    }

    .izin-tipi-group {
        display: flex;
        flex-wrap: wrap;
        /* gap: 10px; */
    }

    .radio-group {
        display: flex;
        align-items: center;
        margin-right: 20px;
        margin-bottom: 10px;
    }

    .radio-group input[type="radio"] {
        margin-right: 5px;
        transform: scale(1.2);
        /* Butonları büyütmek için */
    }

    .form-group textarea {
        width: 100%;
        max-width: 537px;
        height: 37px;
        resize: none;
    }

    @media (max-width: 767px) {
        .form-group label {
            min-width: 100px;
        }

        .form-container {
            padding: 15px;
        }

        .izin-tipi-group {
            flex-direction: column;
            /* Mobil görünümde dikey hizalama */
        }

        .radio-group {
            margin-right: 0;
            margin-bottom: 15px;
        }

        .radio-group label {
            font-size: 14px;
        }

        .radio-group input[type="radio"] {
            transform: scale(1);
            /* Mobilde radyo butonlarının boyutunu küçültmek */
        }
    }

    .akademik-izin-ise {
        display: none;
    }

    .gunluk-izin-ise {
        display: none;
    }

    .kisisel-bilgiler {
        display: block;
    }

    .genel-izin-baslama {
        display: block;
    }

    .izin-tipi {
        display: block;
    }

    .warning-message {
        color: red;
        font-size: 14px;
        margin-top: 20px;
    }

    .note-message {
        font-size: 14px;
        margin-top: 10px;
        font-style: italic;
    }

    #izin-suresi {
        margin-top: 15px;
        padding: 10px;
        border: 1px solid #dcdcdc;
        border-radius: 5px;
        background-color: #f8f9fa;
    }

    /* arama seçim cssleri  */
    .custom-dropdown {
        position: relative;
        width: 100%;
        /* Menünün genişliğini tüm satırı kaplayacak şekilde ayarlar */
        cursor: pointer;
        font-family: Arial, sans-serif;
    }

    .dropdown-selected {
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        background-color: #f9f9f9;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        display: flex;
        justify-content: space-between;
        align-items: center;
        background-color: #fff;
        color: #333;
        font-size: 16px;
        transition: background-color 0.3s, box-shadow 0.3s;
        width: 100%;
        /* Dropdown'un genişliğini tam genişlikte yapar */
    }

    .dropdown-selected:after {
        content: "\25BC";
        font-size: 12px;
        margin-left: 10px;
    }

    .dropdown-menu {
        display: none;
        position: absolute;
        top: 100%;
        left: 0;
        width: 100%;
        background-color: #fff;
        border: 1px solid #ccc;
        border-radius: 4px;
        max-height: 250px;
        overflow-y: auto;
        z-index: 1000;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
        transition: all 0.3s ease;
    }

    .dropdown-menu.active {
        display: block;
        opacity: 1;
        transform: translateY(0);
    }

    .dropdown-menu input {
        width: 100%;
        padding: 10px;
        border: none;
        border-bottom: 1px solid #eee;
        box-sizing: border-box;
        outline: none;
        font-size: 16px;
    }

    .dropdown-menu ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .dropdown-menu ul li {
        padding: 10px;
        cursor: pointer;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        transition: background-color 0.3s;
        font-size: 16px;
        color: #333;
    }

    .dropdown-menu ul li:hover {
        background-color: #f1f1f1;
    }

    .dropdown-menu ul li:active {
        background-color: #e9e9e9;
    }

    .search-container {
        position: relative;
        width: 300px;
    }

    input[type="text"] {
        width: 100%;
        padding: 10px;
        font-size: 16px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    .custom-dropdown {
        position: absolute;
        width: 100%;
        max-height: 200px;
        overflow-y: auto;
        border: 1px solid #ccc;
        border-radius: 5px;
        background-color: #fff;
        z-index: 1000;
        display: none;
    }

    .custom-dropdown div {
        padding: 10px;
        cursor: pointer;
    }

    .custom-dropdown div:hover {
        background-color: #f1f1f1;
    }

    .custom-dropdown.show {
        display: block;
    }

    .input-row {
        display: flex;
        gap: 10px;
        /* Aralarına boşluk bırakmak için */
    }

    .search-container {
        flex: 1;
        /* Hepsinin aynı genişlikte olmasını sağlar */
    }

    input[type="text"] {
        width: 100%;
        padding: 10px;
        box-sizing: border-box;
        /* Padding dahil genişliği kontrol etmek için */
    }

    .custom-dropdown {
        /* İstediğiniz stilleri buraya ekleyebilirsiniz */
    }
    .modal-header {
    background-color: #f44336;
    color: white;
    }

    .modal-footer .btn {
        background-color: #f44336;
    }
    </style>
</head>

<body>
    <!-- Eğer session'dan bir mesaj gelmişse, bu mesajı JavaScript ile göster -->
    <?php if ($mesaj): ?>
    <script>
    Swal.fire({
        title: '<?= $mesaj['title'] ?>',
        text: '<?= $mesaj['message'] ?>',
        icon: '<?= $mesaj['type'] ?>', // success, error, warning gibi türler
        confirmButtonText: 'Tamam'
    });
    </script>
    <?php endif; ?>
    <?php

?>
<!-- Hata Mesajı İçin Modal -->
<div class="modal fade" id="errorModal" tabindex="-1" role="dialog" aria-labelledby="errorModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="errorModalLabel">Form Hatası</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Kapat">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Lütfen tüm zorunlu alanları doldurun.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Tamam</button>
      </div>
    </div>
  </div>
</div>

    <div class="preloader-it">
        <div class="la-anim-1"></div>
    </div>

    <div class="wrapper theme-3-active pimary-color-pink">
        <?php include_once("_header.php");?>
        

        <div class="page-wrapper">
            <div class="container-fluid pt-25 panel">
                <?php 
                // Kullanıcı bilgilerini al
                $kullanicitanimla = "veritabanı bağlantısı için ilgili kodu yazınız";

                // Kullanıcı bilgilerini değişkenlere atayın
                // Bilgiler örnek olarak yazılmıştır.
                $idim = $kullanicitanimla[0]["id"];
                $adi = $kullanicitanimla[0]["adi"];
                $soyadi = $kullanicitanimla[0]["soyadi"];
                $tcKimlikNo = $kullanicitanimla[0]["tc"];
                $telefon = $kullanicitanimla[0]["ceptel"];
                ?>
                <h3 class="mb-4">İZİN TALEP FORMU</h3>
                <!-- YÖNELENDİRİLECEK KENDİ SAYFAYI GİRİNİZ -->
                <form method="post" action="https://yonlendirileceksayfa.com/kontroler/izinkontrol.php">
                    <input type="hidden" name="kid" value="<?php echo $idim; ?>">
                    <div class="form-container izin-tipi">
                        <h5 class="mb-4">İzin Tipi</h5>
                        <div class="form-group">
                            <div class="izin-tipi-group">
                                <?php 
                                    $izinTipleri = "İzin tipinin bulunduğu tablonun tanımlanması"; 
                                        foreach($izinTipleri as $izinTipi){ 
                                            $checked = ($izinTipi['id'] == 1) ? 'checked' : ''; // id 1 olan otomatik seçili
                                        ?>
                                <div class="radio-group">
                                    <input type="radio" id="<?php echo $izinTipi['secmeliid']; ?>" name="izin-tipleri"
                                        value="<?php echo $izinTipi['id']; ?>" <?php echo $checked; ?>>
                                    <label
                                        for="<?php echo $izinTipi['secmeliid']; ?>"><?php echo $izinTipi['izintipi']; ?></label>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="aciklama">Açıklama:</label>
                            <input type="text" id="aciklama" name="aciklama" class="form-control">
                        </div>
                    </div>
                    <div class="form-container gunluk-izin-ise">
                        <h5 class="mb-4">Günlük/Saatlik İzin İse;</h5>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="ad-soyad">Adı Soyadı:</label>
                                    <input type="text" id="ad-soyad" name="ad-soyad" class="form-control"
                                        value="<?php echo $adi . ' ' . $soyadi; ?>" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="neden">Talep Nedeni:</label>
                                    <input type="text" id="neden" name="neden" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="gunluk-izin-baslama-tarihi">İznin Başlama Tarihi ve Saati:</label>
                                    <input type="datetime-local" id="gunluk-izin-baslama-tarihi"
                                        name="gunluk-izin-baslama-tarihi" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="gunluk-izin-bitis-tarihi">İznin Bitiş Tarihi ve Saati:</label>
                                    <input type="datetime-local" id="gunluk-izin-bitis-tarihi"
                                        name="gunluk-izin-bitis-tarihi" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="gunluk-ise-baslama-tarihi">İzin Sonrası İşe Başlama Tarihi ve
                                        Saati:</label>
                                    <input type="datetime-local" id="gunluk-ise-baslama-tarihi"
                                        name="gunluk-ise-baslama-tarihi" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div id="izin-suresi">



                                    <label for="gunluk-ise-baslama-tarihi">Toplam İzin Süresi:</label>
                                    0 Gün 0 Saat 0 Dakika
                                </div>
                            </div>
                        </div>
                        <div class="warning-message">
                            *İdari izin, bir takvim yılı için iki (2) iş gününü geçemez. Saatlik kullanılan izinler iki
                            (2) iş gününden mahsup edilir. İki (2) iş gününü aşması durumunda yıllık izinden mahsup
                            edilir.
                        </div>
                        <div class="note-message">
                            NOT: Form eksiksiz doldurulmalıdır.
                        </div>
                    </div>






                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-container kisisel-bilgiler">
                                <h5 class="mb-4">Kişisel Bilgiler</h5>
                                <div class="form-group">
                                    <label for="adi">Adı:</label>
                                    <input type="text" id="adi" name="adi" class="form-control"
                                        value="<?php echo $adi; ?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="soyadi">Soyadı:</label>
                                    <input type="text" id="soyadi" name="soyadi" class="form-control"
                                        value="<?php echo $soyadi; ?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="tc-kimlik">TC Kimlik No:</label>
                                    <input type="text" id="tc" name="tc-kimlik" class="form-control"
                                        oninput="validateNumber(this)" maxlength="11" value="<?php echo $tcKimlikNo; ?>"
                                        readonly>
                                </div>
                                <div class="form-group">
                                    <label for="telefon">Telefon Numarası:</label>
                                    <input type="text" id="telefon" name="telefon" class="form-control"
                                        oninput="validateNumber(this)" maxlength="11" value="<?php echo $telefon; ?>"
                                        readonly>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-container genel-izin-baslama">
                                <div class="form-group">
                                    <label for="izin-baslama-tarihi">İznin Başlama Tarihi<br>(İzne çıkılan ilk
                                        gün):</label>
                                    <input type="date" id="izin-baslama-tarihi" name="izin-baslama-tarihi"
                                        class="form-control">
                                </div>
                                <div class="form-group">
                                    <input type="hidden" name="gunlukIzinSuresi" id="gunlukIzinSuresi">

                                    <label for="izin-bitis-tarihi">İznin Bitiş Tarihi:</label>
                                    <input type="date" id="izin-bitis-tarihi" name="izin-bitis-tarihi"
                                        class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="ise-baslama-tarihi">İzin Sonrası İşe Başlama Tarihi:</label>
                                    <input type="date" id="ise-baslama-tarihi" name="ise-baslama-tarihi"
                                        class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="izindeki-adres">İzindeki Adres:</label>
                                    <input type="text" id="izindeki-adres" name="izindeki-adres" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-container birimler">
                                <div class="form-group">
                                    <label for="birim-gorev1">Birimi/Görevi 1:</label>
                                    <input type="text" id="birim-gorev1" name="birim-gorev1" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="birim-gorev2">Birimi/Görevi 2:</label>
                                    <input type="text" id="birim-gorev2" name="birim-gorev2" class="form-control"
                                        disabled>
                                </div>
                                <div class="form-group">
                                    <label for="birim-gorev3">Birimi/Görevi 3:</label>
                                    <input type="text" id="birim-gorev3" name="birim-gorev3" class="form-control"
                                        disabled>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-container vekiller">
                                <div class="form-group">
                                    <label for="vekil1">Vekil/Yerine Bakacak Kişi 1:</label>
                                    <input type="text" id="vekil1" name="vekil1" class="form-control"
                                        placeholder="Vekil/Yerine Bakacak Kişi 1'i giriniz">
                                </div>
                                <div class="form-group">
                                    <label for="vekil2">Vekil/Yerine Bakacak Kişi 2:</label>
                                    <input type="text" id="vekil2" name="vekil2" class="form-control"
                                        placeholder="Vekil/Yerine Bakacak Kişi 2'yi giriniz">
                                </div>
                                <div class="form-group">
                                    <label for="vekil3">Vekil/Yerine Bakacak Kişi 3:</label>
                                    <input type="text" id="vekil3" name="vekil3" class="form-control"
                                        placeholder="Vekil/Yerine Bakacak Kişi 3'ü giriniz">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-container akademik-izin-ise">
                        <h5 class="mb-4">Akademik İzin İse;</h5>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="organizasyon-turu">Organizasyon türü ve adı (Konferans, seminer,
                                        sempozyum vb.):</label>
                                    <input type="text" id="organizasyon-turu" name="organizasyon-turu"
                                        class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="sunum-yayin">Varsa sunum/yayın adı:</label>
                                    <input type="text" id="sunum-yayin" name="sunum-yayin" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tarihleri-yeri">Tarihleri ve yeri:</label>
                                    <input type="text" id="tarihleri-yeri" name="tarihleri-yeri" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="proje-adi">Proje kapsamındaysa proje adı:</label>
                                    <input type="text" id="proje-adi" name="proje-adi" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="akademik-aciklama">Açıklama:</label>
                                    <input id="akademik-aciklama" name="akademik-aciklama" class="form-control">
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="form-group">
                        <label>Onaycılar: </label>

                        <div class="input-row">
                            <div class="search-container">
                                <input type="text" id="searchInput1" name="searchInput1"
                                    placeholder="Aramak için yazın...">
                                <div id="customDropdown1" class="custom-dropdown"></div>
                                <input type="hidden" id="hiddenInput1" name="selectedUserId1">
                            </div>

                            <div class="search-container">
                                <input type="text" id="searchInput2" placeholder="Aramak için yazın...">
                                <div id="customDropdown2" class="custom-dropdown"></div>
                                <input type="hidden" id="hiddenInput2" name="selectedUserId2">
                            </div>

                            <div class="search-container">
                                <input type="text" id="searchInput3" placeholder="Aramak için yazın...">
                                <div id="customDropdown3" class="custom-dropdown"></div>
                                <input type="hidden" id="hiddenInput3" name="selectedUserId3">
                            </div>
                        </div>
                    </div>




                    <input type="hidden" name="genelIzinSuresi" id="genelIzinSuresi">
                    <div id="genel-izin-suresi">Toplam İzin Süresi: 0 Gün</div>
                    <input type="submit" value="Gönder" class="btn btn-primary">
                </form>
            </div>


        </div>
    </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $izinTipi = $_POST['izin-tipleri'];
    $hatalar = [];

    // Zorunlu alanları kontrol et
    $zorunluAlanlar = ['birim-gorev1', 'vekil1', 'selectedUserId1','hiddenInput1']; // Birim1, Vekil1 ve Onaycı1 her zaman zorunlu
    
    // Seçilen izin tipine göre ek zorunlu alanlar
    if ($izinTipi == '1') { // Yıllık izin
        $zorunluAlanlar = array_merge($zorunluAlanlar, ['aciklama', 'izin-baslama-tarihi', 'izin-bitis-tarihi', 'ise-baslama-tarihi', 'izindeki-adres']);
    } else if ($izinTipi == '2') { // Ücretsiz izin
        $zorunluAlanlar = array_merge($zorunluAlanlar, ['aciklama', 'izin-baslama-tarihi', 'izin-bitis-tarihi', 'ise-baslama-tarihi', 'izindeki-adres']);
    } else if ($izinTipi == '3') { // Akademik izin
        $zorunluAlanlar = array_merge($zorunluAlanlar, ['aciklama', 'izin-baslama-tarihi', 'izin-bitis-tarihi', 'ise-baslama-tarihi', 'izindeki-adres', 'organizasyon-turu', 'tarihleri-yeri', 'sunum-yayin', 'proje-adi', 'akademik-aciklama']);
    } else if ($izinTipi == '4') { // Günlük izin
        $zorunluAlanlar = array_merge($zorunluAlanlar, ['aciklama', 'gunluk-izin-baslama-tarihi', 'gunluk-izin-bitis-tarihi', 'gunluk-ise-baslama-tarihi', 'neden']);
    } else if ($izinTipi == '5') { // Diğer izinler
        $zorunluAlanlar = array_merge($zorunluAlanlar, ['aciklama', 'izin-baslama-tarihi', 'izin-bitis-tarihi', 'ise-baslama-tarihi', 'izindeki-adres']);
    }

    // Zorunlu alanları kontrol et
    foreach ($zorunluAlanlar as $alan) {
        if (empty($_POST[$alan])) {
            $hatalar[] = "$alan alanı boş olamaz.";
        }
    }

    if (empty($hatalar)) {
        // Form başarılıysa
        echo "<p style='color: green;'>Form başarıyla gönderildi.</p>";
    } else {
        // Hataları göster
        foreach ($hatalar as $hata) {
            echo "<p style='color: red;'>$hata</p>";
        }
    }
}
?>
<script>
document.querySelector("form").addEventListener("submit", function(event) {
    let izinTipi = document.querySelector('input[name="izin-tipleri"]:checked').value;
    let zorunluAlanlar = ['#birim-gorev1', '#vekil1', '#hiddenInput1','#searchInput1']; // Birim1, Vekil1 ve Onaycı1 her zaman zorunlu

    // Seçilen izin tipine göre ek zorunlu alanlar
    if (izinTipi == '1') { // Yıllık izin
        zorunluAlanlar = zorunluAlanlar.concat(['#aciklama', '#izin-baslama-tarihi', '#izin-bitis-tarihi', '#ise-baslama-tarihi', '#izindeki-adres']);
    } else if (izinTipi == '2') { // Ücretsiz izin
        zorunluAlanlar = zorunluAlanlar.concat(['#aciklama', '#izin-baslama-tarihi', '#izin-bitis-tarihi', '#ise-baslama-tarihi', '#izindeki-adres']);
    } else if (izinTipi == '3') { // Akademik izin
        zorunluAlanlar = zorunluAlanlar.concat(['#aciklama', '#izin-baslama-tarihi', '#izin-bitis-tarihi', '#ise-baslama-tarihi', '#izindeki-adres', '#organizasyon-turu', '#tarihleri-yeri', '#sunum-yayin', '#proje-adi', '#akademik-aciklama']);
    } else if (izinTipi == '4') { // Günlük izin
        zorunluAlanlar = zorunluAlanlar.concat(['#aciklama', '#gunluk-izin-baslama-tarihi', '#gunluk-izin-bitis-tarihi', '#gunluk-ise-baslama-tarihi', '#neden']);
    } else if (izinTipi == '5') { // Diğer izinler
        zorunluAlanlar = zorunluAlanlar.concat(['#aciklama', '#izin-baslama-tarihi', '#izin-bitis-tarihi', '#ise-baslama-tarihi', '#izindeki-adres']);
    }

    // Zorunlu alanları kontrol et
    let eksikAlanVar = false;
    zorunluAlanlar.forEach(function(selector) {
        let alan = document.querySelector(selector);
        if (alan && !alan.value) {
            eksikAlanVar = true;
            alan.style.border = "2px solid red"; // Eksik alanları işaretle
        } else if (alan) {
            alan.style.border = ""; // Eksik değilse normal hali
        }
    });

    if (eksikAlanVar) {
        event.preventDefault(); // Formu gönderme
        $('#errorModal').modal('show'); // Bootstrap Modal'ı göster
    }
});

</script>

<script>
// Tüm metin input'ları için büyük harfe dönüştürme ve TR dil desteği
document.querySelectorAll('input[type="text"]').forEach(function(input) {
    input.addEventListener('input', function() {
        this.value = this.value.toLocaleUpperCase('tr-TR');
    });
});
</script>








    
<!-- BİRİM VE VEKİL KISIMLARININ AKTİF PASİFLİK DURUMU -->
    <script>
document.addEventListener('DOMContentLoaded', function() {
    // Birim ve vekil alanlarını tanımlıyoruz
    const vekilFields = [
        { birim: document.getElementById("birim-gorev1"), vekil: document.getElementById("vekil1") },
        { birim: document.getElementById("birim-gorev2"), vekil: document.getElementById("vekil2") },
        { birim: document.getElementById("birim-gorev3"), vekil: document.getElementById("vekil3") }
    ];

    // Başlangıçta tüm alanları pasif yapıyoruz, sadece ilk birim aktif kalacak
    vekilFields.forEach((field, index) => {
        if (index > 0) { 
            // İlk birim hariç diğer birimleri pasif yapıyoruz
            field.birim.disabled = true;
        }
        // Tüm vekil alanlarını pasif yapıyoruz
        field.vekil.disabled = true;
    });

    // Alanların aktif/pasif durumunu kontrol eden fonksiyon
    function updateFields() {
        vekilFields.forEach((field, index) => {
            if (field.birim.value.trim() !== "") { // Eğer birim alanı doluysa
                field.vekil.disabled = false; // Vekil alanını aktif hale getiriyoruz
                
                // Eğer vekil alanı doluysa ve bir sonraki birim varsa
                if (index < vekilFields.length - 1 && field.vekil.value.trim() !== "") {
                    vekilFields[index + 1].birim.disabled = false; // Sonraki birim alanını aktif yapıyoruz
                } else {
                    // Eğer vekil alanı boşsa ya da bir sonraki birim boşsa, sonraki alanları pasif yapıyoruz
                    vekilFields[index + 1].birim.disabled = true;
                    vekilFields[index + 1].birim.value = ""; // Birim alanını temizliyoruz
                    vekilFields[index + 1].vekil.value = ""; // Vekil alanını temizliyoruz
                }
            } else {
                // Eğer birim alanı boşsa vekil alanını pasif yapıyoruz
                field.vekil.disabled = true;
                field.vekil.value = ""; // Vekil alanını temizliyoruz
                
                // Sonraki birim alanı da pasif olmalı
                if (index < vekilFields.length - 1) {
                    vekilFields[index + 1].birim.disabled = true;
                    vekilFields[index + 1].birim.value = ""; // Sonraki birim alanını temizliyoruz
                }
            }
        });
    }

    // Her bir birim ve vekil alanına input değişikliği olduğunda tetiklenecek event listener ekliyoruz
    vekilFields.forEach(field => {
        field.birim.addEventListener('input', updateFields); // Birim alanı değiştiğinde tetiklenir
        field.vekil.addEventListener('input', updateFields); // Vekil alanı değiştiğinde tetiklenir
    });
});
</script>



<!-- HANGİ İZİN TİPİNDE HANGİ ALANLAR GÖZÜKECEĞİ KISIM -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    const izinTipleri = {
        akademik: document.getElementById('akademik-izin'),
        gunluk: document.getElementById('gunluk-izin'),
        yillik: document.getElementById('yillik-izin'),
        ucretsiz: document.getElementById('ucretsiz-izin'),
        diger: document.getElementById('diger-izinler')
    };

    const sekmeler = {
        akademikSekme: document.querySelector('.akademik-izin-ise'),
        gunlukSekme: document.querySelector('.gunluk-izin-ise'),
        genelSekme: document.querySelector('.genel-izin-baslama'),
        genelIzinSuresiDiv: document.getElementById('genel-izin-suresi'),
        kisiselSekme: document.querySelector('.kisisel-bilgiler')
    };

    // Genel izin bölümünü göster/gizle
    function showGeneralLeaveSection() {
        sekmeler.genelIzinSuresiDiv.style.display = 'block';
    }

    function hideGeneralLeaveSection() {
        sekmeler.genelIzinSuresiDiv.style.display = 'none';
    }

    // Tüm sekmeleri gizleyen bir fonksiyon
    function hideAllSections() {
        sekmeler.akademikSekme.style.display = 'none';
        sekmeler.gunlukSekme.style.display = 'none';
        sekmeler.genelSekme.style.display = 'none';
        sekmeler.kisiselSekme.style.display = 'none';
        hideGeneralLeaveSection(); // Genel izin süresini gizler
    }

    // İzin tipi değiştiğinde ilgili alanları gösteren fonksiyon
    function showSectionForIzinTipi(tip) {
        hideAllSections(); // Önce tüm sekmeleri gizleyelim

        if (tip === 'akademik') {
            sekmeler.akademikSekme.style.display = 'block';
            sekmeler.kisiselSekme.style.display = 'block';
            sekmeler.genelSekme.style.display = 'block';
            showGeneralLeaveSection();
        } else if (tip === 'yillik' || tip === 'ucretsiz' || tip === 'diger') {
            sekmeler.kisiselSekme.style.display = 'block';
            sekmeler.genelSekme.style.display = 'block';
            showGeneralLeaveSection();
        } else if (tip === 'gunluk') {
            sekmeler.gunlukSekme.style.display = 'block';
        }
    }

    // Her izin tipine tıklanıldığında yapılacak işlemler
    for (const [tip, radio] of Object.entries(izinTipleri)) {
        radio.addEventListener('change', function () {
            if (radio.checked) {
                showSectionForIzinTipi(tip);
            }
        });
    }

    // Sayfa yüklendiğinde seçili izin tipine göre başlat
    for (const [tip, radio] of Object.entries(izinTipleri)) {
        if (radio.checked) {
            showSectionForIzinTipi(tip);
        }
    }
});
</script>

    <script>
    function validateNumber(input) {
        input.value = input.value.replace(/[^0-9]/g, '');
    }
    </script>





<!-- ONAYCILAR KISMI -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Mevcut kullanıcının ID'si (PHP'den gelen)
    const mevcutKullaniciId = <?php echo json_encode($idim); ?>;

    // Veritabanından çekilen kullanıcılar
    const users = <?php
        $kullanicilar = vtGetTable("kullanici", "id, adi, soyadi", "aktifpasif=1");
        $userList = [];
        foreach ($kullanicilar as $kullanici) {
            $userList[] = [
                'id' => $kullanici['id'],
                'name' => $kullanici['adi'] . " " . $kullanici['soyadi']
            ];
        }
        echo json_encode($userList);
    ?>;

    // Mevcut kullanıcıyı onaycı listesinden çıkarıyoruz
    const filteredUsers = users.filter(user => user.id != mevcutKullaniciId);

    // Onaycıların seçili olup olmadığını takip eden bir dizi
    const selectedOnaycilar = [null, null, null];

    // Onaycı seçimlerini güncelleyen fonksiyon
    function updateOnayciDropdowns() {
        [1, 2, 3].forEach(function(i) {
            const customDropdown = document.getElementById('customDropdown' + i);
            const hiddenInput = document.getElementById('hiddenInput' + i);
            const selectedUserId = hiddenInput.value;

            customDropdown.innerHTML = '';  // Mevcut dropdown'ı temizle
            filteredUsers.forEach(user => {
                if (!selectedOnaycilar.includes(user.id.toString()) || user.id.toString() === selectedUserId) {
                    const div = document.createElement('div');
                    div.textContent = user.name;
                    div.dataset.value = user.id;
                    div.addEventListener('click', function() {
                        document.getElementById('searchInput' + i).value = user.name;
                        hiddenInput.value = user.id;
                        selectedOnaycilar[i - 1] = user.id.toString();
                        customDropdown.classList.remove('show');
                        updateOnayciDropdowns();  // Diğer dropdown'ları güncelle
                    });
                    customDropdown.appendChild(div);
                }
            });
        });
    }

    // Arama kutularını kurmak için fonksiyon
    function setUpSearch(inputId, dropdownId, hiddenInputId, index) {
        const searchInput = document.getElementById(inputId);
        const customDropdown = document.getElementById(dropdownId);
        const hiddenInput = document.getElementById(hiddenInputId);

        searchInput.addEventListener('input', function() {
            const filter = searchInput.value.toLowerCase();
            customDropdown.innerHTML = '';  // Mevcut içeriği temizle

            if (filter) {
                const filteredUsersList = filteredUsers.filter(user => user.name.toLowerCase().includes(filter));
                filteredUsersList.forEach(user => {
                    if (!selectedOnaycilar.includes(user.id.toString()) || user.id.toString() === hiddenInput.value) {
                        const div = document.createElement('div');
                        div.textContent = user.name;
                        div.dataset.value = user.id;
                        div.addEventListener('click', function() {
                            searchInput.value = user.name;
                            hiddenInput.value = user.id;
                            selectedOnaycilar[index] = user.id.toString();
                            customDropdown.classList.remove('show');
                            updateOnayciDropdowns();
                        });
                        customDropdown.appendChild(div);
                    }
                });
                customDropdown.classList.add('show');
            } else {
                customDropdown.classList.remove('show');
            }
        });
    }

    // Arama fonksiyonlarını başlatıyoruz
    setUpSearch('searchInput1', 'customDropdown1', 'hiddenInput1', 0);
    setUpSearch('searchInput2', 'customDropdown2', 'hiddenInput2', 1);
    setUpSearch('searchInput3', 'customDropdown3', 'hiddenInput3', 2);

    // Sayfa yüklendiğinde dropdown'ları güncelle
    updateOnayciDropdowns();
});
</script>

<script>
$(document).ready(function() {
    $('form').on('submit', function(e) {
        const onayci1 = $('#hiddenInput1').val();
        const onayci2 = $('#hiddenInput2').val();
        const onayci3 = $('#hiddenInput3').val();

        // Onaycıların farklı olup olmadığını kontrol ediyoruz
        if ((onayci1 && onayci2 && onayci1 === onayci2) || 
            (onayci1 && onayci3 && onayci1 === onayci3) || 
            (onayci2 && onayci3 && onayci2 === onayci3)) {
            alert("Hata: Onaycılar birbirinden farklı olmalıdır.");
            e.preventDefault();  // Form gönderimini durdur
        }
    });
});
</script>

<script>
$(document).ready(function() {
    function setupDropdown(dropdownSelected, dropdownMenu, searchBox, dropdownList, hiddenInput) {
        // Dropdown menüyü açma/kapama işlemi
        dropdownSelected.on('click', function() {
            dropdownMenu.toggleClass('active');
        });

        // Arama kutusuna yazılanları filtreleme
        searchBox.on('keyup', function() {
            const searchText = $(this).val().toLowerCase();
            dropdownList.children('li').each(function() {
                const text = $(this).text().toLowerCase();
                $(this).toggle(text.indexOf(searchText) > -1);
            });
        });

        // Bir öğe seçildiğinde dropdown'u kapatma ve değeri gizli input'a yazma
        dropdownList.on('click', 'li', function() {
            const selectedText = $(this).text();
            const selectedValue = $(this).data('value');
            dropdownSelected.text(selectedText).data('value', selectedValue);
            hiddenInput.val(selectedValue);
            dropdownMenu.removeClass('active');
        });

        // Dropdown dışına tıklanıldığında menüyü kapatma
        $(document).on('click', function(event) {
            if (!$(event.target).closest('.custom-dropdown').length) {
                dropdownMenu.removeClass('active');
            }
        });
    }

    // Onaycı 1 için dropdown setup
    setupDropdown(
        $('#dropdownSelected1'),
        $('#dropdownSelected1').next('.dropdown-menu'),
        $('#searchBox1'),
        $('#dropdownList1'),
        $('#searchInput1')
    );

    // Onaycı 2 için dropdown setup
    setupDropdown(
        $('#dropdownSelected2'),
        $('#dropdownSelected2').next('.dropdown-menu'),
        $('#searchBox2'),
        $('#dropdownList2'),
        $('#searchInput12')
    );

    // Onaycı 3 için dropdown setup
    setupDropdown(
        $('#dropdownSelected3'),
        $('#dropdownSelected3').next('.dropdown-menu'),
        $('#searchBox3'),
        $('#dropdownList3'),
        $('#searchInput13')
    );
});
</script>



<!--  İZİN SÜRESİ HESAPLAMA -->
 <script>
document.addEventListener('DOMContentLoaded', function() {

    // Günlük izin süresi hesaplama fonksiyonu (Öğle arası hariç)
    function calculateLeaveDuration() {
        const startDateTime = new Date(document.getElementById('gunluk-izin-baslama-tarihi').value);
        const endDateTime = new Date(document.getElementById('gunluk-izin-bitis-tarihi').value);

        // Tarihlerin geçerli olup olmadığını kontrol edelim
        if (isNaN(startDateTime) || isNaN(endDateTime)) {
            document.getElementById('izin-suresi').textContent = "Toplam İzin Süresi: 0 Gün 0 Saat 0 Dakika";
            document.getElementById('gunlukIzinSuresi').value = 0; // Gizli inputu sıfırla
            return;
        }document.addEventListener('DOMContentLoaded', function() {

    // Tarihleri kontrol eden genel fonksiyon
    function validateLeaveDates(startDateId, endDateId, workStartDateId) {
        const startDate = new Date(document.getElementById(startDateId).value);
        const endDate = new Date(document.getElementById(endDateId).value);
        const workStartDate = new Date(document.getElementById(workStartDateId).value);

        if (isNaN(startDate.getTime()) || isNaN(endDate.getTime()) || isNaN(workStartDate.getTime())) {
            showErrorMessage(`#${startDateId}`, 'Geçerli tarih giriniz.');
            showErrorMessage(`#${endDateId}`, 'Geçerli tarih giriniz.');
            showErrorMessage(`#${workStartDateId}`, 'Geçerli tarih giriniz.');
            return false;
        }

        if (endDate < startDate) {
            showErrorMessage(`#${endDateId}`, 'İzin bitiş tarihi, izin başlangıç tarihinden önce olamaz.');
            return false;
        }

        if (workStartDate < endDate) {
            showErrorMessage(`#${workStartDateId}`, 'İşe başlama tarihi, izin bitiş tarihinden önce olamaz.');
            return false;
        }

        return true;
    }

    // Form gönderim kontrolü
    document.querySelector('form').addEventListener('submit', function(e) {
        const selectedLeaveType = getSelectedLeaveType();
        let valid = true;

        // Zorunlu alanları kontrol et
        if (!validateRequiredFields(selectedLeaveType)) {
            valid = false;
        }

        // İzin tipine göre tarih kontrolü
        if (selectedLeaveType == '4') { // Günlük izin
            if (!validateLeaveDates('gunluk-izin-baslama-tarihi', 'gunluk-izin-bitis-tarihi', 'gunluk-ise-baslama-tarihi')) {
                valid = false;
            }
        } else if (['1', '2', '3', '5'].includes(selectedLeaveType)) { // Genel izinler
            if (!validateLeaveDates('izin-baslama-tarihi', 'izin-bitis-tarihi', 'ise-baslama-tarihi')) {
                valid = false;
            }
        }

        if (!valid) {
            e.preventDefault(); // Formu göndermeyi engelle
        }
    });

});


        // Öğle arası saatleri: 12:00 - 13:00
        const lunchBreakStart = new Date(startDateTime);
        lunchBreakStart.setHours(12, 0, 0, 0); // 12:00
        const lunchBreakEnd = new Date(startDateTime);
        lunchBreakEnd.setHours(13, 0, 0, 0); // 13:00

        // Başlangıç ve bitiş tarihleri arasındaki farkı milisaniye cinsinden hesaplayalım
        let durationInMs = endDateTime - startDateTime;

        // Eğer başlangıç ve bitiş tarihi öğle arasını kapsıyorsa, 1 saat çıkartalım
        if (startDateTime < lunchBreakEnd && endDateTime > lunchBreakStart) {
            durationInMs -= 3600000; // 1 saat = 3600000 milisaniye
        }

        // Milisaniyeyi gün, saat ve dakika cinsine çevirelim
        const totalMinutes = Math.floor(durationInMs / (1000 * 60)); // Toplam dakika
        const totalHours = Math.floor(totalMinutes / 60); // Toplam saat
        const remainingMinutes = totalMinutes % 60; // Kalan dakika
        const totalDays = Math.floor(totalHours / 24); // Toplam gün
        const remainingHours = totalHours % 24; // Kalan saat

        // Saat ve dakikayı iki nokta ile formatlayalım
        const formattedTime = `${String(remainingHours).padStart(2, '0')}:${String(remainingMinutes).padStart(2, '0')}`;

        // Sonucu ekranda gösterelim (örneğin: "Toplam İzin Süresi: 1 Gün 05:30")
        const formattedDuration = `Toplam İzin Süresi: ${totalDays} Gün ${formattedTime}`;
        document.getElementById('izin-suresi').textContent = formattedDuration;

        // Toplam gün ve saat bilgilerini dakika bazında saklamak için toplam dakikayı gizli inputa yazalım
        document.getElementById('gunlukIzinSuresi').value = totalMinutes;
    }

    // Genel izin süresi hesaplama fonksiyonu
    function calculateGeneralLeaveDays() {
        const startDate = new Date(document.getElementById('izin-baslama-tarihi').value);
        const endDate = new Date(document.getElementById('izin-bitis-tarihi').value);

        // Tarihlerin geçerli olup olmadığını kontrol edelim
        if (isNaN(startDate) || isNaN(endDate)) {
            document.getElementById('genel-izin-suresi').textContent = "Toplam İzin Süresi: 0 Gün";
            document.getElementById('genelIzinSuresi').value = 0;  // Gizli inputu sıfırla
            return;
        }

        let totalDays = 0;

        // Tarih aralığında hafta sonları hariç günleri sayıyoruz
        for (let current = new Date(startDate); current <= endDate; current.setDate(current.getDate() + 1)) {
            const day = current.getDay();
            if (day !== 0) {  // Pazar gününü dışarıda bırakıyoruz
                totalDays++;
            }
        }

        document.getElementById('genel-izin-suresi').textContent = `Toplam İzin Süresi: ${totalDays} Gün`;
        document.getElementById('genelIzinSuresi').value = totalDays;  // Gizli inputu güncelle
    }

    // Başlangıç ve bitiş tarihleri için dinleyiciler
    document.getElementById('gunluk-izin-baslama-tarihi').addEventListener('change', calculateLeaveDuration);
    document.getElementById('gunluk-izin-bitis-tarihi').addEventListener('change', calculateLeaveDuration);

    document.getElementById('izin-baslama-tarihi').addEventListener('change', calculateGeneralLeaveDays);
    document.getElementById('izin-bitis-tarihi').addEventListener('change', calculateGeneralLeaveDays);

});
</script> 


     <!-- select arama işlemi için -->


    <script>
    $(document).ready(function() {
        $('select').select2({
            placeholder: "Seçiniz",
            allowClear: true
        });
    });
    </script>


    <?php include_once("_sfooter.php"); ?>

</body>

</html>