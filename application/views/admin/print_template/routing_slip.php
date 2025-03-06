<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<!DOCTYPE html>
<html lang="en">

<head>
    <base href="<?php echo base_url(); ?>" />
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Routing & Tracking Slip </title>
    <!-- <link rel="stylesheet" href="styles.css"> -->
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .container {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #000;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .header-text {
            text-align: center;
        }

        .header p {
            margin: 5px 0;
        }

        .header-image {
            height: 80px;
            /* Adjust height as needed */
        }

        .header-image.left {
            margin-right: 10px;
        }

        /* .header-image.right {
            margin-left: 10px;
        } */


        .title {
            text-align: center;
            margin-bottom: 20px;
        }

        .title h2 {
            margin: 0;
            text-decoration: underline;
        }

        hr {
            margin: 20px 0;
        }

        .details table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }

        .details td {
            border: 1px solid #000;
            padding: 10px;
        }


        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        thead th {
            border: 1px solid #000;
            padding: 10px;
            text-align: center;
        }

        tbody td {
            border: 1px solid #000;
            padding: 10px;
        }

        tbody td p {
            margin: 5px 0;
        }
    </style>
</head>

<body>
    <div class="container">

        <div class="header">

            <!-- <img src="data:image/png;base64, '.$dataBase64.'" alt="CWC" class="header-image left">
            <img src="<?php echo "ddocts/assets/admin/assets/images/logo.png"; ?>" alt="Logo" class="header-image left"> -->
            <img src="<?php echo $imgpath; ?>">
            <div class="header-text">
                <p>Republic of the Philippines</p>
                <p>COUNCIL FOR THE WELFARE OF CHILDREN</p>
                <p>

                </p>
            </div>
            <div class="title">
                <h2>ROUTING AND TRACKING SLIP </h2>
            </div>
            <hr>
            <div class="details">
                <table>
                    <tr>
                        <td><strong>SUBJECT:</strong></td>
                        <td><strong>DOCUMENT TRACKING NO:</strong></td>
                    </tr>
                    <tr>
                        <td><strong>DATE CREATED:</strong></td>
                        <td><strong>DEADLINE:</strong></td>
                    </tr>
                </table>
            </div>
            <table>
                <thead>
                    <tr>
                        <th colspan="3">FROM</th>
                        <th rowspan="2">NOTES / REMARKS</th>
                        <th colspan="3">TO</th>
                    </tr>
                    <tr>
                        <th>NAME/OFFICE</th>
                        <th>DATE</th>
                        <th>TIME</th>
                        <th>NAME/OFFICE</th>
                        <th>DATE</th>
                        <th>TIME</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <!-- Add more rows as needed -->
                </tbody>
            </table>
        </div>
</body>

</html>