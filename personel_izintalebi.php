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
                <div class="row">
                    <div class="col-sm-12">
                        <div class="panel panel-default card-view">
                            <div class="panel-heading">
                                <div class="pull-left">
                                    <h6 class="panel-title txt-dark">İzin Taleplerim</h6>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="panel-wrapper collapse in">
                                <div class="panel-body">
                                    <div class="table-wrap">
                                        <div class="table-responsive">
                                            <table id="datable_1" class="table table-hover display  pb-30">
                                                <thead>
                                                    <tr>
                                                        <th>İzin Türü</th>
                                                        <th>Talep Nedeni</th>
                                                        <th>İzin Başlangıç</th>
                                                        <th>İzin Bitiş</th>
                                                        <th>Onay Durumu-1</th>
                                                        <th>Onay Durumu-2</th>
														<th>Onay Durumu-3</th>

                                                    </tr>
                                                </thead>
                                                <?php $izintaleplerim=VERİTABANI_FONKSİYONU("TABLO_ADI", "*","kid=$idim");
												?>
                                                <tbody>
                                                    <?php foreach ($izintaleplerim as $izintalebi) {
														
													?>
                                                    <tr>
                                                        <td><?php $izintipi=$izintalebi["TABLO_SÜTUN_ADI"];
														$izintur=VERİTABANI_FONKSİYONU("TABLO_ADI", "*", "id=$izintipi");
														echo $izintur["0"]["TABLO_SÜTUN_ADI"];
														
														?></td>
                                                        <td><?php if($izintipi=="4"){
															echo $izintalebi["TABLO_SÜTUN_ADI"];
														}elseif($izintipi=="3"){
															echo $izintalebi["TABLO_SÜTUN_ADI"];
														}
														else{echo $izintalebi["TABLO_SÜTUN_ADI"];}
														
														?></td>
                                                        <td><?php if($izintipi=="4"){
															echo $izintalebi["TABLO_SÜTUN_ADI"];
															}else{echo $izintalebi["TABLO_SÜTUN_ADI"];}
																?>
                                                        </td>
                                                        <td><?php if($izintipi=="4"){
															echo $izintalebi["TABLO_SÜTUN_ADI"];
															}else{echo $izintalebi["TABLO_SÜTUN_ADI"];}?></td>
                                                        <td><?php $onaylayiciid=$izintalebi["TABLO_SÜTUN_ADI"];
														if($onaylayiciid!==NULL && $onaylayiciid!=0 ){
														$onaykisibilgi=VERİTABANI_FONKSİYONU("TABLO_ADI","*","id=$onaylayiciid");
														echo "Onay Verecek Kişi: ".$onayadsoyad=$onaykisibilgi["0"]["adi"]." ".$onaykisibilgi["0"]["soyadi"];
														if($izintalebi["TABLO_SÜTUN_ADI"]=="0")
														{
															echo "</br><p style='background-color: #FFA500;color:black;'>Bekleme</p>";
														}
														elseif($izintalebi["TABLO_SÜTUN_ADI"]=="1")
														{echo "</br><p style='background-color: #28A745;color:black;'>Onaylandı</p>";}
														elseif($izintalebi["TABLO_SÜTUN_ADI"]=="2")
														{echo "</br><p style='background-color: #FF0000;color:black;'>Reddedildi</p>";}else{
															echo "</br><p style='background-color: #FFA500;color:black;'>Bekleme</p>";
														}
													}
														else{ echo "";}
														?>

                                                        </td>
                                                        <td><?php $onaylayiciid=$izintalebi["TABLO_SÜTUN_ADI"];
														if($onaylayiciid!==NULL && $onaylayiciid!=0 ){
															$onaykisibilgi=VERİTABANI_FONKSİYONU("TABLO_ADI","*","id=$onaylayiciid");
															echo "Onay Verecek Kişi: ".$onayadsoyad=$onaykisibilgi["0"]["adi"]." ".$onaykisibilgi["0"]["soyadi"];
															if($izintalebi["TABLO_SÜTUN_ADI"]=="0")
															{
																echo "</br><p style='background-color: #FFA500;color:black;'>Bekleme</p>";
															}
															elseif($izintalebi["TABLO_SÜTUN_ADI"]=="1")
															{echo "</br><p style='background-color: #28A745;color:black;'>Onaylandı</p>";}
															elseif($izintalebi["TABLO_SÜTUN_ADI"]=="2")
															{echo "</br><p style='background-color: #FF0000;color:black;'>Reddedildi</p>";}else{
																echo "</br><p style='background-color: #FFA500;color:black;'>Bekleme</p>";
															}
														}
														else{ echo "";}
														?>

                                                        </td>
														<td><?php $onaylayiciid=$izintalebi["TABLO_SÜTUN_ADI"];
														if($onaylayiciid!==NULL && $onaylayiciid!=0 ){
															$onaykisibilgi=VERİTABANI_FONKSİYONU("TABLO_ADI","*","id=$onaylayiciid");
															echo "Onay Verecek Kişi: ".$onayadsoyad=$onaykisibilgi["0"]["adi"]." ".$onaykisibilgi["0"]["soyadi"];
															if($izintalebi["TABLO_SÜTUN_ADI"]=="0")
															{
																echo "</br><p style='background-color: #FFA500;color:black;'>Bekleme</p>";
															}
															elseif($izintalebi["TABLO_SÜTUN_ADI"]=="1")
															{echo "</br><p style='background-color: #28A745;color:black;'>Onaylandı</p>";}
															elseif($izintalebi["TABLO_SÜTUN_ADI"]=="2")
															{echo "</br><p style='background-color: #FF0000;color:black;'>Reddedildi</p>";}else{
																echo "</br><p style='background-color: #FFA500;color:black;'>Bekleme</p>";
															}
														}
														else{ echo "";}
														?>

                                                        </td>

                                                    </tr>
                                                    <?php } ?>
                                                </tbody>

                                                <tfoot>
                                                    <tr>
                                                        <th>İzin Türü</th>
                                                        <th>Talep Nedeni</th>
                                                        <th>İzin Başlangıç</th>
                                                        <th>İzin Bitiş</th>
                                                        <th>Onay Durumu-1</th>
                                                        <th>Onay Durumu-2</th>
														<th>Onay Durumu-3</th>

                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Row -->

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