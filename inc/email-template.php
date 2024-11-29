<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title><?php echo esc_html($title); ?></title>
    <style>
    @media only screen and (max-width: 620px) {
        table[class="body"] h1 {
            font-size: 20px !important;
            margin-bottom: 10px !important;
        }

        table[class="body"] p,
        table[class="body"] ul,
        table[class="body"] td,
        table[class="body"] span,
        table[class="body"] a {
            font-size: 16px !important;
        }

        table[class="body"] .wrapper {
            padding: 10px !important;
        }

        table[class="body"] .content {
            padding: 0 !important;
        }

        table[class="body"] .container {
            padding: 0 !important;
            width: 100% !important;
        }

        table[class="body"] .main {
            border-left-width: 0 !important;
            border-radius: 0 !important;
            border-right-width: 0 !important;
        }

        table[class="body"] .btn table {
            width: 100% !important;
        }

        table[class="body"] .btn a {
            width: 100% !important;
        }
    }
    </style>
</head>

<body
    style="background-color: #eaebed; font-family: sans-serif; -webkit-font-smoothing: antialiased; font-size: 14px; line-height: 1.4; margin: 0; padding: 0; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;">
    <table role="presentation" border="0" cellpadding="0" cellspacing="0" class="body"
        style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; background-color: #eaebed; width: 100%;"
        width="100%" bgcolor="#eaebed">
        <tr>
            <td style="font-family: sans-serif; font-size: 14px; vertical-align: top;" valign="top">
                &nbsp;
            </td>
            <td class="container"
                style="font-family: sans-serif; font-size: 14px; vertical-align: top; display: block; max-width: 580px; padding: 10px; width: 580px; Margin: 0 auto;"
                width="580" valign="top">
                <div class="header" style="padding: 5px 0;">
                    <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%"
                        style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; width: 100%;">
                        <tr>
                            <td class="align-center" width="100%"
                                style="font-family: sans-serif; font-size: 14px; vertical-align: top; text-align: center;"
                                valign="top" align="center">
                                <a href="https://www.coastmachinery.com/"
                                    style="color: #00548c; text-decoration: underline;"><img
                                        src="https://www.coastmachinery.com/wp-content/uploads/2020/11/used-machinery-dealer.png"
                                        width="180" height="36" alt="CMG"
                                        style="border: none; -ms-interpolation-mode: bicubic; max-width: 100%;" /></a>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="content"
                    style="box-sizing: border-box; display: block; Margin: 0 auto; max-width: 580px; padding: 10px;">
                    <table role="presentation" class="main"
                        style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; background: #ffffff; border-radius: 3px; width: 100%;"
                        width="100%">
                        <tr>
                            <td class="wrapper"
                                style="font-family: sans-serif; font-size: 14px; vertical-align: top; box-sizing: border-box; padding: 20px;"
                                valign="top">
                                <table role="presentation" border="0" cellpadding="0" cellspacing="0"
                                    style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; width: 100%;"
                                    width="100%">
                                    <tr>
                                        <td style="font-family: sans-serif; font-size: 14px; text-align: center; vertical-align: top;"
                                            valign="top">
                                            <h1
                                                style="font-family: sans-serif; font-size: 18px; font-weight: normal; margin: 0; margin-bottom: 15px;">
                                                <strong><?php echo $headingtext; ?></strong>
                                            </h1>
                                            <p
                                                style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;">
                                                <?php echo $bodytext1; ?>
                                            </p>
                                            <?php echo $bodytext2; ?>
                                            <table role="presentation" border="0" cellpadding="0" cellspacing="0"
                                                class="btn btn-primary"
                                                style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; box-sizing: border-box; width: 100%;"
                                                width="100%">
                                                <tbody>
                                                    <tr>
                                                        <td align="center"
                                                            style="font-family: sans-serif; font-size: 14px; vertical-align: top; padding-bottom: 15px;"
                                                            valign="top">
                                                            <table role="presentation" border="0" cellpadding="0"
                                                                cellspacing="5"
                                                                style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: auto; width: auto;">
                                                                <tbody>
                                                                    <tr>
                                                                        <td style="font-family: sans-serif; font-size: 14px; vertical-align: top; border-radius: 5px; text-align: center; background-color: #00548c;"
                                                                            valign="top" align="center"
                                                                            bgcolor="#00548c">
                                                                            <a href="<?php echo $btnlink; ?>"
                                                                                target="_blank"
                                                                                style="border: solid 1px #00548c; border-radius: 5px; box-sizing: border-box; cursor: pointer; display: inline-block; font-size: 14px; font-weight: bold; margin: 0; padding: 12px 25px; text-decoration: none; text-transform: capitalize; background-color: #00548c; border-color: #00548c; color: #ffffff;"><?php echo $btntext; ?></a>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <p
                                                style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px; text-align: center;">
                                                <?php echo $bodytext3; ?>
                                            </p>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                    <div class="footer" style="clear: both; Margin-top: 10px; text-align: center; width: 100%;">
                        <table role="presentation" border="0" cellpadding="0" cellspacing="0"
                            style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; width: 100%;"
                            width="100%">
                            <tr>
                                <td class="content-block"
                                    style="font-family: sans-serif; vertical-align: top; padding-bottom: 10px; padding-top: 10px; color: #9a9ea6; font-size: 12px; text-align: center;"
                                    valign="top" align="center">
                                    <span class="location" style="color: #9a9ea6; font-size: 12px; text-align: center;">
                                        Coast Machinery Group<br />
                                        Unit 170 - 31789 King Rd, <br>
                                        Abbotsford, BC - V2T 5Z2, <br>
                                        Canada
                                    </span>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </td>
            <td style="font-family: sans-serif; font-size: 14px; vertical-align: top;" valign="top">
                &nbsp;
            </td>
        </tr>
    </table>
</body>

</html>