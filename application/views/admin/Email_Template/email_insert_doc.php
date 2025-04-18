<!-- THIS EMAIL WAS BUILT AND TESTED WITH LITMUS http://litmus.com -->
<!-- IT WAS RELEASED UNDER THE MIT LICENSE https://opensource.org/licenses/MIT -->
<!-- QUESTIONS? TWEET US @LITMUSAPP -->
<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
<head>
    <meta charset="utf-8"> <!-- utf-8 works for most cases -->
    <meta name="viewport" content="width=device-width"> <!-- Forcing initial-scale shouldn't be necessary -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge"> <!-- Use the latest (edge) version of IE rendering engine -->
    <meta name="x-apple-disable-message-reformatting">  <!-- Disable auto-scale in iOS 10 Mail entirely -->
    <title>DocTS Notification</title> <!-- The title tag shows in email notifications, like Android 4.4. -->

    <!-- Web Font / @font-face : BEGIN -->
    <!-- NOTE: If web fonts are not required, lines 10 - 27 can be safely removed. -->

    <!-- Desktop Outlook chokes on web font references and defaults to Times New Roman, so we force a safe fallback font. -->
    <!--[if mso]>
        <style>
            * {
                font-family: Arial, sans-serif !important;
            }
        </style>
    <![endif]-->

    <!-- All other clients get the webfont reference; some will render the font and others will silently fail to the fallbacks. More on that here: http://stylecampaign.com/blog/2015/02/webfont-support-in-email/ -->
    <!--[if !mso]><!-->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet">
    <!--<![endif]-->

    <!-- Web Font / @font-face : END -->

    <!-- CSS Reset -->
    <style>

        /* What it does: Remove spaces around the email design added by some email clients. */
        /* Beware: It can remove the padding / margin and add a background color to the compose a reply window. */
        html,
        body {
            margin: 0 auto !important;
            padding: 0 !important;
            height: 100% !important;
            width: 100% !important;
        }

        /* What it does: Stops email clients resizing small text. */
        * {
            -ms-text-size-adjust: 100%;
            -webkit-text-size-adjust: 100%;
        }

        /* What it does: Centers email on Android 4.4 */
        div[style*="margin: 16px 0"] {
            margin:0 !important;
        }

        /* What it does: Stops Outlook from adding extra spacing to tables. */
        table,
        td {
            mso-table-lspace: 0pt !important;
            mso-table-rspace: 0pt !important;
        }

        /* What it does: Fixes webkit padding issue. Fix for Yahoo mail table alignment bug. Applies table-layout to the first 2 tables then removes for anything nested deeper. */
        table {
            border-spacing: 0 !important;
            border-collapse: collapse !important;
            table-layout: fixed !important;
            margin: 0 auto !important;
        }
        table table table {
            table-layout: auto;
        }

        /* What it does: Uses a better rendering method when resizing images in IE. */
        img {
            -ms-interpolation-mode:bicubic;
        }

        /* What it does: A work-around for email clients meddling in triggered links. */
        *[x-apple-data-detectors],  /* iOS */
        .x-gmail-data-detectors,  /* Gmail */
        .x-gmail-data-detectors *,
        .aBn {
            border-bottom: 0 !important;
            cursor: default !important;
            color: inherit !important;
            text-decoration: none !important;
            font-size: inherit !important;
            font-family: inherit !important;
            font-weight: inherit !important;
            line-height: inherit !important;
        }

        /* What it does: Prevents Gmail from displaying an download button on large, non-linked images. */
        .a6S {
            display: none !important;
            opacity: 0.01 !important;
        }
        /* If the above doesn't work, add a .g-img class to any image in question. */
        img.g-img + div {
            display:none !important;
           }

        /* What it does: Prevents underlining the button text in Windows 10 */
        .button-link {
            text-decoration: none !important;
        }

        /* What it does: Removes right gutter in Gmail iOS app: https://github.com/TedGoas/Cerberus/issues/89  */
        /* Create one of these media queries for each additional viewport size you'd like to fix */
        /* Thanks to Eric Lepetit @ericlepetitsf) for help troubleshooting */
        @media only screen and (min-device-width: 375px) and (max-device-width: 413px) { /* iPhone 6 and 6+ */
            .email-container {
                min-width: 375px !important;
            }
        }

    </style>

    <!-- Progressive Enhancements -->
    <style>

        /* What it does: Hover styles for buttons */
        .button-td,
        .button-a {
            transition: all 100ms ease-in;
        }
        .button-td:hover,
        .button-a:hover {
            background: #555555 !important;
            border-color: #555555 !important;
        }

        /* Media Queries */
        @media screen and (max-width: 480px) {

            /* What it does: Forces elements to resize to the full width of their container. Useful for resizing images beyond their max-width. */
            .fluid {
                width: 100% !important;
                max-width: 100% !important;
                height: auto !important;
                margin-left: auto !important;
                margin-right: auto !important;
            }

            /* What it does: Forces table cells into full-width rows. */
            .stack-column,
            .stack-column-center {
                display: block !important;
                width: 100% !important;
                max-width: 100% !important;
                direction: ltr !important;
            }
            /* And center justify these ones. */
            .stack-column-center {
                text-align: center !important;
            }

            /* What it does: Generic utility class for centering. Useful for images, buttons, and nested tables. */
            .center-on-narrow {
                text-align: center !important;
                display: block !important;
                margin-left: auto !important;
                margin-right: auto !important;
                float: none !important;
            }
            table.center-on-narrow {
                display: inline-block !important;
            }

            /* What it does: Adjust typography on small screens to improve readability */
      .email-container p {
        font-size: 17px !important;
        line-height: 22px !important;
      }
        }

    </style>

    <!-- What it does: Makes background images in 72ppi Outlook render at correct size. -->
    <!--[if gte mso 9]>
  <xml>
    <o:OfficeDocumentSettings>
      <o:AllowPNG/>
      <o:PixelsPerInch>96</o:PixelsPerInch>
    </o:OfficeDocumentSettings>
  </xml>
    <![endif]-->


</head>
<body width="100%" bgcolor="#F1F1F1" style="margin: 0; mso-line-height-rule: exactly;">
    <center style="width: 100%; background: #F1F1F1; text-align: left;">

        <!-- Visually Hidden Preheader Text : BEGIN -->
        <div style="display:none;font-size:1px;line-height:1px;max-height:0px;max-width:0px;opacity:0;overflow:hidden;mso-hide:all;font-family: sans-serif;">
      This is an internal system used by CWC to track documents.
        </div>
        <!-- Visually Hidden Preheader Text : END -->

        <!--
            Set the email width. Defined in two places:
            1. max-width for all clients except Desktop Windows Outlook, allowing the email to squish on narrow but never go wider than 680px.
            2. MSO tags for Desktop Windows Outlook enforce a 680px width.
            Note: The Fluid and Responsive templates have a different width (600px). The hybrid grid is more "fragile", and I've found that 680px is a good width. Change with caution.
        -->
        <div style="max-width: 680px; margin: auto;" class="email-container">
            <!--[if mso]>
            <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="680" align="center">
            <tr>
            <td>
            <![endif]-->

            <!-- Email Body : BEGIN -->
            <table role="presentation" cellspacing="0" cellpadding="0" border="0" align="center" width="100%" style="max-width: 680px;" class="email-container">


                <!-- HEADER : BEGIN -->
                <tr>
                    <td bgcolor="#17A2B8">
                        <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                            <tr>
                                <td style="padding: 30px 40px 30px 40px; text-align: center;">
                                    <img src="https://i.ibb.co/bLpXpXW/cwc-mis-logo-1.png" alt="alt_text" border="0" style="height: auto; font-family: sans-serif; font-size: 15px; line-height: 20px; color: #555555;">
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <!-- HEADER : END -->

                

                
                <!-- AGENDA : BEGIN -->
                <tr>
                    <td bgcolor="#f7fafc">
                        <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                            <tr>
                                <td style="padding: 40px 40px 20px 40px; text-align: left;">
                                    <h1 style="margin: 0; font-family: 'Open Sans', sans-serif; font-size: 20px; line-height: 26px; color: #333333; font-weight: bold;">Inter-Division Document Tracking and Management Systems (DDocTS)</h1>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding: 0px 20px 10px 40px; font-family: sans-serif; font-size: 15px; line-height: 20px; color: #555555; text-align: left; font-weight:normal;">
                                    <p style="margin: 0;">You could check the status of your document using the document number provided by checking it <a href="https://services.cwc.gov.ph/checkStatus/document/<?php echo $data['doc_number']; ?>" target="_blank" style="background-color: #17A2B8; color: white; padding: 2px 3px; text-decoration: none; text-transform: uppercase;">HERE</a>.</p>
                                    <p style="color: #b4112a;"><i>Note: This is a system generated email, please dont reply. Thank you</i></p>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding: 0px 40px 20px 20px;">
                                    
                                    <table width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#ffffff" style="border:1px solid #dddddd; border-left:3px solid #17A2B8;">
                                        <tr>
                                            <td align="" style="padding: 20px 10px 0px 20px; font-family: 'Open Sans', sans-serif; font-size: 13px; line-height: 20px; color: #555555; text-align: left; font-weight:normal;">
                                                <h3 style="margin:0;">
                                                    Document Number: <b style="color: #006fd4;"><?php echo $data['doc_number']; ?></b>
                                                </h3>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="" style="padding: 5px 10px 10px 5px; font-family: sans-serif; font-size: 13px; line-height: 20px; color: #555555; text-align: left; font-weight:normal;">
                                                <p style="margin:0;">
                                                    
                                                </p>
                                            </td>
                                        </tr>
                                    </table>

                                </td>
                            </tr>

                            <tr>
                                <td style="padding: 0px 40px 20px 20px;">
                                    
                                    <table width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#ffffff" style="border:1px solid #dddddd; border-left:3px solid #17A2B8;">
                                        <tr>
                                            <td align="" style="padding: 20px 10px 0px 20px; font-family: 'Open Sans', sans-serif; font-size: 13px; line-height: 20px; color: #555555; text-align: left; font-weight:normal;">
                                                <h3 style="margin:0;">
                                                    Document Title: <b style="color: #006fd4;"><?php echo $data['doc_title']; ?></b>
                                                </h3>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="" style="padding: 5px 10px 10px 5px; font-family: sans-serif; font-size: 14px; line-height: 20px; color: #555555; text-align: left; font-weight:normal;">
                                                <p style="margin:0;">
                                                    
                                                </p>
                                            </td>
                                        </tr>
                                    </table>

                                </td>
                            </tr>

                            <tr>
                                <td style="padding: 0px 40px 20px 20px;">
                                    
                                    <table width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#ffffff" style="border:1px solid #dddddd; border-left:3px solid #17A2B8;">
                                        <tr>
                                            <td align="" style="padding: 20px 10px 0px 20px; font-family: 'Open Sans', sans-serif; font-size: 13px; line-height: 20px; color: #555555; text-align: left; font-weight:normal;">
                                                <h3 style="margin:0;">
                                                    Date Received: <b style="color: #006fd4;"><?php echo $data['date']; ?></b>
                                                </h3>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="" style="padding: 5px 10px 10px 5px; font-family: sans-serif; font-size: 14px; line-height: 20px; color: #555555; text-align: left; font-weight:normal;">
                                                <p style="margin:0;">
                                                    
                                                </p>
                                            </td>
                                        </tr>
                                    </table>

                                </td>
                            </tr>

                            <tr>
                                <td style="padding: 0px 40px 20px 20px;">
                                    
                                    <table width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#ffffff" style="border:1px solid #dddddd; border-left:3px solid #17A2B8;">
                                        <tr>
                                            <td align="" style="padding: 20px 10px 0px 20px; font-family: 'Open Sans', sans-serif; font-size: 14px; line-height: 20px; color: #555555; text-align: left; font-weight:normal;">
                                                <h3 style="margin:0;">
                                                    Status: <b><?php echo $data['doc_status1']; ?></b>
                                                </h3>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="" style="padding: 5px 10px 10px 5px; font-family: sans-serif; font-size: 14px; line-height: 20px; color: #555555; text-align: left; font-weight:normal;">
                                                <p style="margin:0;">
                                                    
                                                </p>
                                            </td>
                                        </tr>
                                    </table>

                                </td>
                            </tr>
                            
                            
                            

                        </table>
                    </td>
                </tr>
                <!-- AGENDA : END -->

                <!-- CTA : BEGIN -->
                <tr>
                    <td bgcolor="#17A2B8">
                        <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                            <tr>
                                <td style="padding: 20px 40px 5px 40px; text-align: center;">
                                    <h1 style="margin: 0; font-family: 'Open Sans', sans-serif; font-size: 20px; line-height: 24px; color: #ffffff; font-weight: bold;">Inter-Division Document Tracking and Management Systems (DDocTS)</h1>
                                </td>
                            </tr>
                           
                            <tr>
                                <td valign="middle" align="center" style="text-align: center; padding: 0px 20px 20px 20px;">

                                    <!-- Button : BEGIN -->
                                    <table role="presentation" align="center" cellspacing="0" cellpadding="0" border="0" class="center-on-narrow">
                                        <tr>
                                            <td style="border-radius: 50px; background: #ffffff; text-align: center;" class="button-td">
                                                <a href="https://services.cwc.gov.ph/request_button/account/<?php echo $data['staff_id']; ?>" target="_blank" style="background: #ffffff; border: 15px solid #ffffff; font-family: 'Open Sans', sans-serif; font-size: 14px; line-height: 1.1; text-align: center; text-decoration: none; display: block; border-radius: 50px; font-weight: bold;" class="button-a">
                                                    <span style="color:#17A2B8;" class="button-link">&nbsp;&nbsp;&nbsp;&nbsp;REQUEST AN ACCOUNT&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                                </a>
                                            </td>
                                        </tr>
                                    </table>
                                    <!-- Button : END -->

                                </td>
                            </tr>

                        </table>
                    </td>
                </tr>
                <!-- CTA : END -->
                <!-- FOOTER : BEGIN -->
                <tr>
                    <td bgcolor="#ffffff">
                        <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                            <tr>
                                <td style="padding: 10px 10px 10px 10px; font-family: sans-serif; font-size: 12px; line-height: 18px; color: #ffffff;background-color: #696b72; text-align: center; font-weight:normal;">
                                    <p style="margin: 0; font-weight: 700; font-size: 12px">2019  © Powered by Management Information System Unit</p>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <!-- FOOTER : END -->

            </table>
            <!-- Email Body : END -->

            <!--[if mso]>
            </td>
            </tr>
            </table>
            <![endif]-->
        </div>

    </center>
</body>
</html>
