

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ambulance Services</title>
    <link rel="stylesheet" href="ambulanceSer.css">
</head>
<body>
    <header class="header">
        <a href="#" class="logo"> <img src="Logo2a.png" alt="Logo"></a>
        <h1>AMBULANCE SERVICES</h1>
    </header>
    <div class="row">
        <img src="ambulance_services.png" alt="ambulance_services" class="ambulance_services">
        <h2 class="callno">1990</h2>
        <a href="tel:1990" class="rectangle">CONNECT</a>
    </div>
    <div>
        <div class="rectangle1">
            <h2 class="heading">OTHER AMBULANCE SERVICES</h2>
            <?php include 'display_other_services.php'; ?>
        </div><br>
        <button class="btn"> <i class="fa-solid fa-angle-left"></i> Back</button>
    </div>
</body>
</html>
