        <!-- BEGIN: JS Assets-->
        <script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js"></script>
        <script src="https://maps.googleapis.com/maps/api/js?key=["your-google-map-api"]&libraries=places"></script>
        <script src="<?php echo base_url('assets/template/dist/js/app.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('assets/admin/assets/libs/jquery/dist/jquery.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/template/sweetalert2/dist/sweetalert2.all.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/template/vendors/loadingjs/loading.min.js'); ?>"></script>
    	<script src="<?php echo base_url('assets/template/vendors/loadingjs/jquery.loading.min.js'); ?>"></script>


<script>
    $(document).on('click', '#notification', function(){
        var view = '';
        $.ajax({
            url:"<?php echo base_url('admin/dashboard/getNotif') ?>",
            method:"POST",
            dataType:"json",
            data:{view:view},
            success:function(result){
                console.log(result);
                $('#notif_list').html(result.notification);
            }
        });
    });

</script>

    </body>
</html>