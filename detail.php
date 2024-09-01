<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Read Text File</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div id="content"></div>

    <script>
        $(document).ready(function() {
           $.ajax({
    url: 'https://cors-anywhere.herokuapp.com/https://www.sciencedirect.com/sdfe/arp/cite?withabstract=true&format=text/plain&pii=S0009254119304851',
    method: 'GET',
    dataType: 'text',
    success: function(data) {
        $('#content').text(data);
    },
    error: function(xhr, status, error) {
        console.error('Dosya yüklenemedi:', error);
    }
});

        });
    </script>
</body>
</html>
