<!DOCTYPE html>
<html>

<head>
    <title>View PDF</title>
    <style>
        body,
        html {
            margin: 0;
            padding: 0;
            height: 100%;
            overflow: hidden;
        }

        embed {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
        }
    </style>
</head>

<body>
    <embed src="{{ asset('data_file/' . $file->file) }}" type="application/pdf" />
</body>

</html>
