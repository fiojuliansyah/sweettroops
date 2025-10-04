<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Magic Login Link</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol';
            margin: 0;
            padding: 0;
            width: 100%;
            background-color: #f4f7f6;
        }
    </style>
</head>
<body style="margin: 0; padding: 0; width: 100%; background-color: #f4f7f6;">
    <table width="100%" border="0" cellpadding="0" cellspacing="0" style="background-color: #f4f7f6; padding: 20px;">
        <tr>
            <td align="center">
                <table width="600" border="0" cellpadding="0" cellspacing="0" style="width: 100%; max-width: 600px; margin: 0 auto; background-color: #ffffff; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                    <tr>
                        <td style="padding: 40px;">
                            
                            <p style="font-size: 16px; color: #555555; line-height: 1.5; margin-top: 0;">
                                Hi {{ $userName ?? 'Fio' }},
                            </p>
                            
                            <p style="font-size: 16px; color: #555555; line-height: 1.5;">
                                You requested to log in to your SweetTroops account – here’s your one-time magic link:
                            </p>
                            
                            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="padding: 20px 0;">
                                <tr>
                                    <td align="center">
                                        <a href="{{ $loginUrl }}" target="_blank" style="display: inline-block; padding: 12px 25px; font-size: 16px; font-weight: bold; color: #ffffff; background-color: #4D7660; text-decoration: none; border-radius: 5px;">
                                            Login Now
                                        </a>
                                    </td>
                                </tr>
                            </table>

                            <p style="font-size: 14px; color: #555555; line-height: 1.5;">
                                ⚠ This link will expire in 60 minutes, so be sure to use it soon. If the link expires, don’t worry – you can always request a new one from our website.
                            </p>
                            
                            <p style="font-size: 14px; color: #888888; line-height: 1.5;">
                                If you didn’t request this, please ignore this email. Your account is safe.
                            </p>
                            <p style="font-size: 16px; color: #555555; line-height: 1.5; margin-top: 30px;">
                                Sweet Wishes,<br>
                                The SweetTroops Team
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

</body>
</html>