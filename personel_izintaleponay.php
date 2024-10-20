<?php  include_once("_head.php");?>
<!-- Data table CSS -->
<link href="<?php echo $base_url; ?>assets/vendors/bower_components/datatables/media/css/jquery.dataTables.min.css"
    rel="stylesheet" type="text/css" />

<body>
    
    <!--Preloader-->
    <div class="preloader-it">
        <div class="la-anim-1"></div>
    </div>
    <!--/Preloader-->
    <div class="wrapper theme-3-active pimary-color-pink">
        <?php include_once("_header.php");?>
        <!-- Main Content -->
        <div class="page-wrapper">
            <div class="container-fluid pt-25 panel">
                <!-- Row -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="row">
                            <?php $izintaleponay = VERİTABANI_FONKSİYONU("İZİN_FORMU_TABLO_ADI", "*", 
                            "( (TABLO_SÜTUN_BİLGİSİ = $idim AND (TABLO_SÜTUN_BİLGİSİ IS NULL OR TABLO_SÜTUN_BİLGİSİ = 0))
                            OR (TABLO_SÜTUN_BİLGİSİ = $idim AND (TABLO_SÜTUN_BİLGİSİ IS NULL OR TABLO_SÜTUN_BİLGİSİ = 0))
                            OR (TABLO_SÜTUN_BİLGİSİ = $idim AND (TABLO_SÜTUN_BİLGİSİ IS NULL OR TABLO_SÜTUN_BİLGİSİ = 0))
                            )");
                            
                            ?>

                            <div class="col-sm-6">
                                <div class="panel panel-default card-view">
                                    <div class="panel-heading">
                                        <div class="pull-left">
                                        <strong><h6 class="panel-title txt-dark">İzin Detay Bilgisi</h6></strong>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                    <?php 
                                    if (count($izintaleponay) > 0) {

                                        foreach ($izintaleponay as $izinonay) {
                                            $izintipi=$izinonay["TABLO_SÜTUN_BİLGİSİ"];
                                            ?>
                                    <div class="panel-wrapper collapse in"> 
                                        <div class="panel-body"> 
                                            <!-- aleyna getirecek -->
                                            <strong><p class="text-muted">Personel Bilgileri</strong></p>
                                            <strong><p class="text-muted">Ad-Soyad:</strong><?php $izinonaybekleyenid=$izinonay["kid"];
                                            $onayisteyen=VERİTABANI_FONKSİYONU("KULLANICI_TABLO_ADI","*","id=$izinonaybekleyenid");
                                            $onayadsoyad=$onayisteyen["0"]["adi"]." ".$onayisteyen["0"]["soyadi"]; echo $onayadsoyad;
                                            ?></p>
                                            <strong><p class="text-muted">İzin Tipi:</strong>
                                                <?php  $izintipibilgisi=VERİTABANI_FONKSİYONU("İZİN_TİPİ_TABLO_ADI","*","id=$izintipi");
                                                echo $izintipibilgisi["0"]["TABLO_SÜTUN_BİLGİSİ"];
                                                ?>
                                            </p> 
                                            <?php   
                                                // Talebi oluşturan kişinin id'sini izintalep tablosundan al
                                                $talepEdenID = $izinonay["kid"];
                                                
                                                // Talebi oluşturan kişinin bilgilerini al (id eşleşmesine göre)
                                                $talepEdenBilgiler = VERİTABANI_FONKSİYONU("KULLANICI_TABLO_ADI", "*", "id=$talepEdenID");

                                                // Kişinin telefon numarasını al
                                                $talepEdenTelefon = isset($talepEdenBilgiler[0]["ceptel"]) ? $talepEdenBilgiler[0]["ceptel"] : "Telefon numarası bulunamadı.";
                                            ?>

                                            <p class="text-muted">
                                                <strong>Telefon Numarası:</strong> <?php echo $talepEdenTelefon; ?>
                                            </p>

                                            <?php
                                                // İzin bilgilerini alıyoruz (son talebe göre)

                                                // Tarih bilgilerini alıyoruz
                                                $izinBaslamaTarihi = $izinonay["TABLO_SÜTUN_BİLGİSİ"];
                                                $izinBitisTarihi = $izinonay["TABLO_SÜTUN_BİLGİSİ"];
                                                $izinSonrasiIsBaslamaTarihi=$izinonay["TABLO_SÜTUN_BİLGİSİ"];
                                                $gunlukizinBaslamaTarihi = $izinonay["TABLO_SÜTUN_BİLGİSİ"];
                                                $gunlukizinBitisTarihi = $izinonay["TABLO_SÜTUN_BİLGİSİS"];

                                            ?>

                                            <strong><p class="text-muted">İzin Tarihleri:</strong>
                                                
                                                <?php 
                                                if( $izinonay["TABLO_SÜTUN_BİLGİSİ"]==4){ echo "</br>" ."Başlangıç:".date('d-m-Y H:i:s', strtotime($gunlukizinBaslamaTarihi))."</br>Bitiş: ".date('d-m-Y H:i:s', strtotime($gunlukizinBitisTarihi));
                                                }
                                                else{
                                                    // VARCHAR tipindeki tarih verilerini kontrol edip işleme
                                                    if (!empty($izinBaslamaTarihi) && !empty($izinBitisTarihi)) {
                                                        // Tarihlerin geçerli bir timestamp olup olmadığını kontrol edelim
                                                        $baslangicZamani = strtotime($izinBaslamaTarihi);
                                                        $bitisZamani = strtotime($izinBitisTarihi);
                                                         
                                                      
                                                        if ($baslangicZamani !== false && $bitisZamani !== false) {
                                                            // Eğer tarihler geçerliyse, formatlayıp ekrana basalım
                                                            echo "</br>". "Başlangıç: " . date('d-m-Y', $baslangicZamani) . "</br>Bitiş: " . date('d-m-Y', $bitisZamani). "</br>";
                                                         }
                                                     }

                                                    

                                                }
                                                
                                                ?>


                                            </p>


                                                
                                            <strong><p class="text-muted">İzin Sonrası İşe Başlama Tarihi:</strong>
                                              
                                                        <?php 
                                                if($izinonay["TABLO_SÜTUN_BİLGİSİ"]==4){ echo date('d-m-Y H:i:s', strtotime($izinonay["TABLO_SÜTUN_BİLGİSİ"]));
                                                }
                                                else{
                                                     

                                                        // VARCHAR tipindeki izin sonrası işe başlama tarihi verisini kontrol edip işleme
                                                        if (!empty($izinSonrasiIsBaslamaTarihi)) {
                                                            // Tarihin geçerli bir timestamp olup olmadığını kontrol edelim
                                                            $isBaslamaZamani = strtotime($izinSonrasiIsBaslamaTarihi);


                                                            if ($isBaslamaZamani !== false) {
                                                                // Eğer tarih geçerliyse, formatlayıp ekrana basalım
                                                                echo "" . date('d-m-Y', $isBaslamaZamani);
                                                            } 
                                                         }


                                                }
                                                
                                                ?>
                                                </p>
                                                <strong><p class="text-muted">İzindeki Adresi:</strong>
                                              
                                              <?php echo $izinonay["TABLO_SÜTUN_BİLGİSİ"]; ?>
                                            
                                      </p>
                                      <p class="text-muted"><strong>Talep Nedeni: </strong>
                                                    <?php 
                                                        // Eğer izin tipi akademik izin (id=3) ise, akademikaciklama sütunundaki değeri göster
                                                        if($izintipid == "3") {
                                                            echo $izinonay["TABLO_SÜTUN_BİLGİSİ"];
                                                        } 
                                                        // Eğer izin tipi günlük/saatlik izin (id=4) ise, talepneden sütunundaki değeri göster
                                                        elseif($izintipid == "4") {
                                                            echo $izinonay["TABLO_SÜTUN_BİLGİSİ"]; 
                                                        }  
                                                        // Diğer izin tiplerinde, aciklama sütunundaki değeri göster
                                                        else {
                                                            echo $izinonay["TABLO_SÜTUN_BİLGİSİ"];
                                                        }
                                                    ?> 
                                                </p>

                                                <strong><p class="text-muted">Birimi:</strong>
                                              
                                              <?php echo $izinonay["TABLO_SÜTUN_BİLGİSİ"]; ?>
                                            
                                      </p>
                                      <strong><p class="text-muted">Vekili/Yerine Bakacak Kişi:</strong>
                                              
                                              <?php echo $izinonay["TABLO_SÜTUN_BİLGİSİ"]; ?>
                                            
                                      </p>
                                      


                                                <?php if ($izintipi == "3"): ?>
                                                    <p class="text-muted"><strong>Organizasyon Türü: </strong>
                                                        <?php echo $izinonay["TABLO_SÜTUN_BİLGİSİ"]; ?>
                                                    </p> 
                                                <?php endif; ?>

                                                <?php if ($izintipi == "3"): ?>
                                                    <p class="text-muted"><strong>Tarih ve Yer: </strong>
                                                        <?php echo $izinonay["TABLO_SÜTUN_BİLGİSİ"]; ?>
                                                    </p> 
                                                <?php endif; ?> 

                                                <?php if ($izintipi == "3"): ?> 
                                                    <p class="text-muted"><strong>Varsa sunum/yayın adı: </strong>
                                                        <?php echo $izinonay["TABLO_SÜTUN_BİLGİSİ"]; ?>
                                                    </p> 
                                                <?php endif; ?> 
                                                  
                                                <?php if ($izintipi == "3"): ?> 
                                                    <p class="text-muted"><strong>Proje kapsamındaysa proje adı: </strong>
                                                        <?php echo $izinonay["TABLO_SÜTUN_BİLGİSİ"]; ?>
                                                    </p> 
                                                <?php endif; ?>   
                                             

                                            <p class="text-muted"><strong>Kaçıncı Onaylayıcısınız:</strong>
                                                <?php  $onayciSeviyesi = '';  // Başlangıçta boş tanımlıyoruz

                                                    if ($izinonay['TABLO_SÜTUN_BİLGİSİ'] == $idim) {
                                                        echo "Birinci onaylayıcısınız.";
                                                        $onayciSeviyesi = 'birinci';
                                                    } elseif ($izinonay['TABLO_SÜTUN_BİLGİSİ'] == $idim) {
                                                        echo "İkinci onaylayıcısınız.";
                                                        $onayciSeviyesi = 'ikinci';
                                                    } elseif ($izinonay['TABLO_SÜTUN_BİLGİSİ'] == $idim) {
                                                        echo "Üçüncü onaylayıcısınız.";
                                                        $onayciSeviyesi = 'ucuncu';
                                                    }
                                                ?>
                                            </p>


                                            <?php
                                            $onayciSeviyesi = '';  // Onaylayıcı seviyesini belirle

                                            // Birinci onaylayıcı iseniz, formu her zaman gösterebilirsiniz
                                            if ($izinonay['TABLO_SÜTUN_BİLGİSİ'] == $idim) {
                                                $onayciSeviyesi = 'birinci';
                                                echo " ";

                                            // İkinci onaylayıcı iseniz ve birinci onaycı durumu 1 ise (yani onay vermişse)
                                            } elseif ($izinonay['TABLO_SÜTUN_BİLGİSİ'] == $idim && $izinonay['TABLO_SÜTUN_BİLGİSİ'] == 1) {
                                                $onayciSeviyesi = 'ikinci';
                                                echo "İkinci onaylayıcısınız ve birinci onaycı onay verdi.";

                                            // Üçüncü onaylayıcı iseniz ve hem birinci hem de ikinci onaycı durumu 1 ise (yani onay vermişlerse)
                                            } elseif ($izinonay['TABLO_SÜTUN_BİLGİSİ'] == $idim && $izinonay['TABLO_SÜTUN_BİLGİSİ'] == 1 && $izinonay['TABLO_SÜTUN_BİLGİSİ'] == 1) {
                                                $onayciSeviyesi = 'ucuncu';
                                                echo "Üçüncü onaylayıcısınız ve hem birinci hem de ikinci onaycı onay verdi.";
                                            } else {
                                                // Eğer herhangi bir onaylayıcı durumu sağlanmamışsa formu göstermiyoruz
                                                echo "Onay işlemi için gerekli şartlar sağlanmadı.";
                                            }
                                            ?>

                                            <?php if ($onayciSeviyesi !== ''): ?>
                                            <form method="post"
                                                action="<?php echo $base_url . "yönlendirilecek_dosya_dizini/izinonaykontrol.php"; ?>">
                                                <div class="button-list mt-25">
                                                    <input type="hidden" name="id"
                                                        value="<?php echo $izinonay['id']; ?>">
                                                    <input type="hidden" name="onayci_seviyesi"
                                                        value="<?php echo $onayciSeviyesi; ?>">

                                                    <button type="submit" name="onay" value="1"
                                                        class="btn btn-success btn-rounded">Onayla</button>
                                                    <button type="submit" name="reddet" value="2"
                                                        class="btn btn-danger btn-rounded">Reddet</button>
                                                </div>
                                            </form>
                                            <?php endif; ?>



                                        </div>
                                    </div>
                             <?php }}else{echo "Onay için bekleyen bulunmamaktadır.";} ?>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- Row -->


                <?php include_once("_footer.php"); ?>
                <!-- Data table JavaScript -->
                <script
                    src="<?php echo $base_url; ?>assets/vendors/bower_components/datatables/media/js/jquery.dataTables.min.js">
                </script>
                <script src="<?php echo $base_url; ?>assets/grandin/dist/js/dataTables-data.js"></script>


            </div>
            <!-- /Main Content -->
        </div>
</body>

</html>