<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    @livewireStyles
    <title>Document</title>
</head>
<body>
@livewire('choices-component')

@livewireScripts
<script>
    $(document).ready(function() {
        $('.select2').select2();
        $('.select3').select2({
            tags: true,
            placeholder: "Type impact indicators"
        });
    });

    $("#district").on('change', function (e) {
        let id = $(this).val()
        console.log(id);
{{--        @this.set('selectedDistrict', id);--}}
        // livewire.emit('getSectorsByDistrictId');
        // livewire.emit('getParishesByDistrictId');
    })

    window.addEventListener('render-select2', event => {
        console.log('option changed');
        // $('.select3').select2({
        //     tags: true,
        //     placeholder: "Type impact indicators"
        // });
        $('.select2').select2();
    })
</script>
</body>
</html>
