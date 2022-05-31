{{-- resources/views/vue.blade.php --}}
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Laravel 9 Vue 3 - DevDuniya.com</title>
	<link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
</head>
<body>
    <script>
        const data = <?php echo json_encode('hello from php') ?>
    </script>
	<div id="app"></div>

	<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>