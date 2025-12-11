        <!-- BEGIN: JS Assets-->
        <script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js"></script>
        <script src="https://maps.googleapis.com/maps/api/js?key=[' your-google-map-api']&libraries=places"></script>
        <script src="<?php echo base_url('assets/template/dist/js/app.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('assets/admin/assets/libs/jquery/dist/jquery.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/template/sweetalert2/dist/sweetalert2.all.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/template/vendors/loadingjs/loading.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/template/vendors/loadingjs/jquery.loading.min.js'); ?>"></script>
        <script src="https://cdn.jsdelivr.net/npm/tail.select@0.5.2/js/tail.select.min.js"></script>
        <?php $CI = &get_instance(); ?>
        <script>
            var csrf_name = '<?php echo $CI->security->get_csrf_token_name(); ?>';
            var csrf_hash = '<?php echo $CI->security->get_csrf_hash(); ?>';
        </script>
        <script>
            $(document).on('click', '#notification', function() {
                var view = '';
                $.ajax({
                    url: "<?php echo base_url('admin/dashboard/getNotif') ?>",
                    method: "GET",
                    dataType: "json",
                    data: {
                        view: view,
                    },
                    success: function(result) {
                        $('#notif_list').html(result.notification);
                        // Event delegation for notification items
                        $('#notif_list').on('click', '.notification-item', function() {
                            var notificationId = $(this).data('id');
                            console.log('Notification ID clicked: ' + notificationId);
                            // Use the notificationId as needed (e.g., send it to another AJAX call)
                            // Example:
                            $.ajax({
                                url: '<?php echo base_url('admin/Dashboard/readNotif'); ?>',
                                method: 'POST',
                                dataType: 'json',
                                data: {
                                    csrf_name: csrf_hash,
                                    notification_id: notificationId
                                },
                                success: function(data) {
                                    //Handle the response.
                                    if (data === 'success') {
                                        console.log(data);
                                    } else {
                                        console.error('An error occurred.');
                                    }
                                }
                            });

                        });
                    }
                });
            });
        </script>

        </body>

        </html>