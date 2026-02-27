<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>You're Invited!</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f5f5f5; margin:0; padding:0;">
    <table width="100%" cellpadding="0" cellspacing="0" style="background-color: #f5f5f5; padding: 40px 0;">
        <tr>
            <td align="center">
                <table width="600" cellpadding="0" cellspacing="0" style="background-color: #ffffff; border-radius: 8px; overflow: hidden; box-shadow: 0 4px 10px rgba(0,0,0,0.1);">

                    <!-- Header -->
                    <tr>
                        <td align="center" style="background-color: #6b46c1; padding: 30px;">
                            <h1 style="color: #ffffff; font-size: 28px; margin: 0;">You're Invited!</h1>
                        </td>
                    </tr>

                    <!-- Body -->
                    <tr>
                        <td style="padding: 30px; color: #333333; font-size: 16px; line-height: 1.5;">
                            <p>Hi there,</p>
                            <p>You've been invited to join our platform. Click the button below to accept your invitation and get started:</p>

                            <p style="text-align: center; margin: 30px 0;">
                                <a href="{{ $link }}"
                                    style="background-color: #6b46c1; color: #ffffff; text-decoration: none; padding: 12px 24px; border-radius: 6px; display: inline-block; font-weight: bold;">
                                    Accept Invitation
                                </a>
                            </p>

                            <p>If the button doesn't work, copy and paste this link into your browser:</p>
                            <p style="word-break: break-all;">
                                <a href="{{ $link }}" style="color: #6b46c1;">{{ $link}}</a>
                            </p>

                            <p>Welcome aboard!<br>— The EasyColoc Team</p>
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td align="center" style="background-color: #f0f0f0; padding: 20px; color: #777777; font-size: 12px;">
                            <p>EasyColoc • 123 Your Street • Your City • Your Country</p>
                            <p>If you did not expect this invitation, you can safely ignore this email.</p>
                        </td>
                    </tr>

                </table>
            </td>
        </tr>
    </table>
</body>
</html>
