<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #eee;
            border-radius: 10px;
        }
        .header {
            background-color: #1a4da1;
            color: white;
            padding: 20px;
            text-align: center;
            border-radius: 10px 10px 0 0;
        }
        .content {
            padding: 30px;
        }
        .original-message {
            background-color: #f9f9f9;
            padding: 20px;
            border-left: 4px solid #1a4da1;
            margin-top: 20px;
            font-style: italic;
        }
        .footer {
            text-align: center;
            padding: 20px;
            font-size: 0.8em;
            color: #777;
        }
        .button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #1a4da1;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>GBIS Mojoagung</h1>
        </div>
        <div class="content">
            <p>Halo <strong>{{ $contact->name }}</strong>,</p>
            <p>Terima kasih telah menghubungi kami. Berikut adalah balasan untuk pesan Anda:</p>
            
            <div style="margin: 20px 0; padding: 20px; border: 1px solid #ddd; border-radius: 8px;">
                {!! nl2br(e($replyMessage)) !!}
            </div>

            <p>Jika ada pertanyaan lebih lanjut, jangan ragu untuk membalas email ini atau hubungi kami melalui website.</p>

            <div class="original-message">
                <strong>Pesan asli Anda:</strong><br>
                "{{ $contact->message }}"
            </div>
            
            <p>Tuhan Yesus memberkati.</p>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} GBIS Mojoagung. Seluruh hak cipta dilindungi.<br>
            Jl. Raya Mojoagung No.283, Ngemplak Utara, Mojotrisno, Kec. Mojoagung, Kabupaten Jombang</p>
        </div>
    </div>
</body>
</html>
