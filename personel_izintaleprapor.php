<?php include_once("_head.php"); ?>

<body>
    <!-- Preloader -->
    <div class="preloader-it">
        <div class="la-anim-1"></div>
    </div>
    <!-- /Preloader -->

    <div class="wrapper theme-3-active pimary-color-pink">
        <?php include_once("_header.php"); ?>

        <!-- Main Content -->
        <div class="page-wrapper">
            <div class="container-fluid pt-25 panel">

                <!-- Row -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="panel panel-default card-view">
                                    <div class="panel-heading">
                                        <div class="pull-left">
                                            <h6 class="panel-title txt-dark">İzin Talepleri Raporu</h6>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="panel-wrapper collapse in">
                                        <div class="panel-body">
                                            <div class="table-wrap">
                                                <div class="table-responsive">

                                                    <?php
                            // Verileri 'izin formundan'  çekiyoruz
                            $izintalepleri = VERİTABANI_FONKSİYONU("TABLO_ADI", "*", "1=1 order by id desc");

                            // Tablo başlığı oluşturuyoruz, ID sütunu dahil edilmiyor
                            echo '<table class="table table-hover display  pb-30">';
                            echo '<thead>';
                            echo '<tr>';
                            echo '<th>Ad Soyad</th>'; 
                            echo '<th>İzin Tip</th>';
                            echo '<th>İzin Başlangıç</th>';
                            echo '<th>İzin Bitiş</th>';
                            echo '<th>İzindeki Adres</th>';
                            // echo '<th>İşe Başlama</th>'; 
                            echo '<th>Açıklama</th>';
                            echo '<th>Onaycı 1 Durum</th>'; 
                            echo '<th>Onaycı 2 Durum</th>';
                            echo '<th>Onaycı 3 Durum</th>';
                            echo '<th>Durum</th>';  // Onayla/Reddet sütunu başlığı
                            echo '</tr>';
                            echo '</thead>'; 
 
                            // Verileri tabloya yazıyoruz
                            echo '<tbody>'; 
                            foreach ($izintalepleri as $talep) {
                                // Satıra tıklama olayı ekliyoruz
                                echo '<tr onclick="openModal(' . htmlspecialchars(json_encode($talep)) . ')" style="cursor: pointer;">'; 

                                //KULLANICI ADI
                                echo '<td>' . $talep['TABLO_SÜTUN_ADI'] . '</td>';

                                //İZİN TİP İD
                                echo '<td>' . $talep['TABLO_SÜTUN_ADI'] . '</td>';

                                //İZİN BAŞLANGIÇ TARİHİ
                                echo '<td>' . $talep['TABLO_SÜTUN_ADI'] . '</td>';

                                //İZİN BİTİŞ TARİHİ
                                echo '<td>' . $talep['TABLO_SÜTUN_ADI'] . '</td>';

                                //İZİNDEKİ ADRESİ
                                echo '<td>' . $talep['TABLO_SÜTUN_ADI'] . '</td>'; 

                                //AÇIKLAMA
                                echo '<td>' . $talep['TABLO_SÜTUN_ADI'] . '</td>';

                                //BİRİNCİ ONAYCI DURUM
                                echo '<td>' . $talep['TABLO_SÜTUN_ADI'] . '</td>';

                                //İKİNCİ ONAYCI DURUM
                                echo '<td>' . $talep['TABLO_SÜTUN_ADI'] . '</td>';
                                
                                //ÜÇÜNCÜ ONAYCI DURUM
                                echo '<td>' . $talep['TABLO_SÜTUN_ADI'] . '</td>';
                                
                                // Butonlar ekleniyor
                                echo '<td>';
                                
                                echo '</td>';
                                
                                echo '</tr>';
                            }
                            echo '</tbody>';
                            echo '</table>';
                            ?>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Modal -->
                                <div class="modal fade" id="izinModal" tabindex="-1" role="dialog"
                                    aria-labelledby="izinModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="izinModalLabel">İzin Detayları</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <!-- Modal içeriği dinamik olarak buraya eklenecek -->
                                                <p><strong>Ad Soyad:</strong> <span id="modalAdSoyad"></span></p>
                                                <p><strong>İzin Tip:</strong> <span id="modalIzinTip"></span></p>
                                                <p><strong>İzin Başlangıç:</strong> <span
                                                        id="modalIzinBaslangic"></span></p>
                                                <p><strong>İzin Bitiş:</strong> <span id="modalIzinBitis"></span></p>
                                                <p><strong>İzindeki Adres:</strong> <span id="modalIzinAdres"></span>
                                                </p>
                                                <p><strong>İşe Başlama:</strong> <span id="modalIseBaslama"></span></p>
                                                <p><strong>Açıklama:</strong> <span id="modalAciklama"></span></p>
                                                <p><strong>Onaycı 1 Durum:</strong> <span id="modalOnayci1"></span></p>
                                                <p><strong>Onaycı 2 Durum:</strong> <span id="modalOnayci2"></span></p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Kapat</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /Modal -->

                                <?php include_once("_footer.php"); ?>
                            </div>
                            <!-- /Main Content -->
                        </div>
                    </div>
                </div>
                <!-- JavaScript ile Modal Açma ve Dinamik Veri Doldurma -->
                <script>
                function openModal(talep) {
                    // Modal içeriğini doldur
                    document.getElementById('modalAdSoyad').textContent = talep.kid;
                    document.getElementById('modalIzinTip').textContent = talep.izintipid;
                    document.getElementById('modalIzinBaslangic').textContent = talep.izinbastar;
                    document.getElementById('modalIzinBitis').textContent = talep.izinbittar;
                    document.getElementById('modalIzinAdres').textContent = talep.izindekiadres;
                    document.getElementById('modalIseBaslama').textContent = talep.izinsonbastar;
                    document.getElementById('modalAciklama').textContent = talep.aciklama;
                    document.getElementById('modalOnayci1').textContent = talep.birincionaycidurum;
                    document.getElementById('modalOnayci2').textContent = talep.ikincionaycidurum;

                    // Modalı göster
                    $('#izinModal').modal('show');
                }
                </script>
 
                <style>
                .table tbody tr {
                    cursor: pointer;
                    transition: transform 0.3s ease, box-shadow 0.3s ease;
                }

                .table tbody tr:hover {
                    background-color: #f1f1f1;
                    /* Hover rengi */
                    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
                    transform: translateY(-4px);
                    /* Kabartma efekti */
                }

                .table tbody td form {
                    display: flex;
                    justify-content: flex-end;
                }
                </style>
            </div>
</body>

</html>