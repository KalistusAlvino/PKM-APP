<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Email</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

        body {
            font-family: 'Poppins', Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
        }

        .header {
            text-align: center;
            padding: 20px 0;
            border-bottom: 1px solid #eaeaea;
        }

        .logo {
            max-width: 150px;
            max-height: 150px;
            margin-bottom: 15px;
        }

        .content {
            padding: 30px 20px;
            text-align: center;
        }

        h1 {
            color: #4f46e5;
            font-size: 24px;
            margin-bottom: 20px;
            font-weight: 600;
        }

        p {
            font-size: 16px;
            margin-bottom: 25px;
            color: #4b5563;
        }

        .button {
            display: inline-block;
            background-color: #4f46e5;
            color: #ffffff !important;
            text-decoration: none;
            padding: 12px 30px;
            border-radius: 6px;
            font-weight: 500;
            font-size: 16px;
            margin: 20px 0;
            transition: background-color 0.3s;
        }

        .button:hover {
            background-color: #4338ca;
        }

        .icon {
            width: 80px;
            height: 80px;
            margin-bottom: 20px;
        }

        .footer {
            text-align: center;
            padding: 20px;
            color: #6b7280;
            font-size: 14px;
            border-top: 1px solid #eaeaea;
        }

        @media only screen and (max-width: 600px) {
            .container {
                width: 100%;
                border-radius: 0;
            }

            h1 {
                font-size: 22px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <!-- Replace with your actual logo -->
            <img src="https://ukdw.ac.id/wp-content/uploads/2022/10/logo-ukdw.png" alt="Logo" class="logo">
        </div>

        <div class="content">
            <h1>Halo, Mahasiswa UKDW yang Berprestasi!</h1>

            <p>Terima kasih telah mendaftar di platform kami. Untuk melanjutkan proses pendaftaran dan mengaktifkan akun
                Anda, silakan verifikasi alamat email Anda dengan mengklik tombol di bawah ini:</p>

            <a href="{{ url('verifikasi-email/anggota/' . $mahasiswa->email_verification_token) }}"
                class="button">Verifikasi Email Sekarang</a>

            <p style="font-size: 14px; margin-top: 30px;">Jika Anda tidak melakukan pendaftaran ini, silakan abaikan
                email ini.</p>

            <p style="font-size: 14px; color: #6b7280;">Tombol tidak berfungsi? Salin dan tempel URL berikut ke browser
                Anda:<br>
                <a href="{{ url('verifikasi-email/anggota/' . $mahasiswa->email_verification_token) }}"
                    style="color: #4f46e5; word-break: break-all;">
                    {{ url('verifikasi-email/anggota/' . $mahasiswa->email_verification_token) }}
                </a>
            </p>
        </div>

        <div class="footer">
            <p>&copy; PKM UKDW.</p>
            <p>Alamat: Jl. Dr. Wahidin Sudirohusodo No.5-25, Kotabaru, Kec. Gondokusuman, Kota Yogyakarta, Daerah Istimewa Yogyakarta 55224</p>
        </div>
    </div>
</body>

</html>
