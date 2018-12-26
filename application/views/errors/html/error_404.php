<!DOCTYPE html>
<html lang="en">
<head>
  <title>HALAMAN TIDAK DITEMUKAN</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="/assets/css/bootstrap.min.css">		
<style type="text/css">
.error-page {padding: 40px 15px;text-align: center;}
.error-actions {margin-top:15px;margin-bottom:15px;}
.error-actions .btn { margin-right:10px; }
h1.404error {    font-size :100px !important; }
</style>
</head>
<body>
<div class="error-page">
    <h2>Oops!</h2>
    <h1 class="404error"><?php echo $heading; ?></h1>
    <div class="error-details">
        <?php echo $message; ?>
    </div>
  
    <div class="error-actions">
        <a href="index.php" class="btn btn-primary btn-lg"><span class="glyphicon glyphicon-home"></span>
            KE HALAMAN DEPAN </a>
    </div>
</div>
</body>
</html>
