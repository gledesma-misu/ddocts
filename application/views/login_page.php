<!DOCTYPE html>
<html lang="en" class="light">
    <!-- BEGIN: Head -->
    <head> 
        <meta charset="utf-8">
        <link href="<?php echo base_url('favicon.gif'); ?>" rel="shortcut icon">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Rubick admin is super flexible, powerful, clean & modern responsive tailwind admin template with unlimited possibilities.">
        <meta name="keywords" content="admin template, Rubick Admin Template, dashboard template, flat admin template, responsive admin template, web app">
        <meta name="author" content="LEFT4CODE">
        <title>Login - DocTS</title>
        <!-- BEGIN: CSS Assets-->
        <link rel="stylesheet" href="<?php echo base_url('assets/template/dist/css/app.css'); ?>" />
        <!-- END: CSS Assets-->
    </head>
    <!-- END: Head -->
    <body class="login">
        <div class="container sm:px-10">
            <div class="block xl:grid grid-cols-2 gap-4">
                <!-- BEGIN: Login Info -->
                <div class="hidden xl:flex flex-col min-h-screen">
                    <a href="" class="-intro-x flex items-center pt-5">
                        <img alt="Rubick Tailwind HTML Admin Template" class="w-6" src="<?php echo base_url('assets/template/dist/images/logo.svg'); ?>">
                        <span class="text-white text-lg ml-3"> CWC - <span class="font-medium">DOCTS</span> </span>
                    </a>
                    <div class="my-auto">
                        <img alt="Rubick Tailwind HTML Admin Template" class="-intro-x w-1/2 -mt-16" src="<?php echo base_url('assets/template/dist/images/illustration.svg'); ?>">
                        <div class="-intro-x text-white font-medium text-4xl leading-tight mt-10 mr-5">
                           Document Tracking and Management Systems (DocTS)
                        </div>
                    </div>
                </div>
                <!-- END: Login Info -->
                <!-- BEGIN: Login Form -->
                <div class="h-screen xl:h-auto flex py-5 xl:py-0 my-10 xl:my-0">
                    <div class="my-auto mx-auto xl:ml-20 bg-white dark:bg-dark-1 xl:bg-transparent px-5 sm:px-8 py-8 xl:p-0 rounded-md shadow-md xl:shadow-none w-full sm:w-3/4 lg:w-2/4 xl:w-auto">
                        <h2 class="intro-x font-bold text-2xl xl:text-3xl text-center xl:text-left">
                            Sign In
                        </h2>
                        <div class="intro-x mt-2 text-gray-500 xl:hidden text-center">A few more clicks to sign in to your account. Manage all your e-commerce accounts in one place</div>
                        <?php echo form_open('login/checklogin'); ?>
                        <div class="intro-x mt-8">
                            <input type="text" id="username" name="username" class="intro-x login__input form-control py-3 px-4 border-gray-300 block" placeholder="Username" required>
                            <input type="password" id="password" name="password" class="intro-x login__input form-control py-3 px-4 border-gray-300 block mt-4" placeholder="Password" required>
                        </div>
                        <div class="intro-x flex text-gray-700 dark:text-gray-600 text-xs sm:text-sm mt-4">
                            <div class="flex items-center mr-auto">
                            </div>
                            <a href="">Forgot Password?</a> 
                        </div>
                        <div class="intro-x mt-5 xl:mt-8 text-center xl:text-left">
                            <button type="submit" class="btn btn-primary py-3 px-4 w-full xl:w-32 xl:mr-3 align-top">Login</button>
                        </div>
                        <?php echo form_close(); ?>
                        <div class="intro-x mt-10 xl:mt-24 text-gray-700 dark:text-gray-600 text-center xl:text-left">
                            Management Information System Unit (MISU)
                            <br>
                            <a class="text-theme-1 dark:text-theme-10" href="">Version 1.0.1</a>
                        </div>
                    </div>
                </div>
                <!-- END: Login Form -->
            </div>
        </div>

        <!-- BEGIN: JS Assets-->
        <script src="<?php echo base_url('assets/template/dist/js/app.js'); ?>"></script>
        <!-- END: JS Assets-->
 

        <script src="<?php echo base_url('assets/template/sweetalert2/dist/sweetalert2.all.min.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('assets/admin/assets/libs/jquery/dist/jquery.min.js'); ?>"></script>

<?php if($this->session->flashdata('email_notif')): ?>
    <script type="text/javascript">
     Swal.fire({
       title: '<strong>AW SNAP!</strong>',
       icon: 'error',
       html:
         '<?php echo $this->session->flashdata('email_notif');?>',
       showCloseButton: true,
       focusConfirm: true,
       allowEscapeKey: true,
       confirmButtonText:
         '<i class="fa fa-thumbs-down"></i> OH NO!',
       confirmButtonAriaLabel: 'OH NO!'
     })
   </script>
<?php endif; ?>

<script type="text/javascript">
$('.align-top').on('click',function(e){
  let timerInterval
    Swal.fire({
      title: 'Please Wait ....',
      html: 'I will close in <b></b> milliseconds.',
      timer: 2000,
      timerProgressBar: true,
      didOpen: () => {
        Swal.showLoading()
        const b = Swal.getHtmlContainer().querySelector('b')
        timerInterval = setInterval(() => {
          b.textContent = Swal.getTimerLeft()
        }, 100)
      },
      willClose: () => {
        clearInterval(timerInterval)
      }
    }).then((result) => {
      /* Read more about handling dismissals below */
      if (result.dismiss === Swal.DismissReason.timer) {
        console.log('I was closed by the timer')
      }
    })
});
</script>


    </body>
</html>
