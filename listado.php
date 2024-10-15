<?php  // Punto 10). El código solo se inicia si se cumple con las condiciones de existencia de los archivos funciones.php y array.php
    $required_files = ['php/array.php', 'php/funciones.php'];
    
    foreach ($required_files as $file) {
        if (!file_exists($file)) {
            die("Error: El archivo $file no existe.");
        }
    }
        include('php/array.php'); 
        include('php/funciones.php'); 
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <title>1er Desempeño</title>
        <meta content="" name="description">
        <meta content="" name="keywords">
        <link href="assets/img/favicon.png" rel="icon">
        <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">
        <link href="https://fonts.gstatic.com" rel="preconnect">
        <link
            href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
            rel="stylesheet">
        <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
        <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
        <link href="assets/css/style.css" rel="stylesheet">
    </head>
    <body>
        <!-- Header -->
        <header id="header" class="header fixed-top d-flex align-items-center">
            <div class="d-flex align-items-center justify-content-between">
                <a href="index.html" class="logo d-flex align-items-center">
                <img src="assets/img/logo.png" alt="">
                <span class="d-none d-lg-block">NiceAdmin</span>
                </a>
                <i class="bi bi-list toggle-sidebar-btn"></i>
            </div>
        </header>
        <!-- Header -->
         <!-- Aside -->
        <aside id="sidebar" class="sidebar">
            <ul class="sidebar-nav" id="sidebar-nav">
                <li class="nav-item">
                    <a class="nav-link " href="index.html">
                    <i class="bi bi-grid"></i>
                    <span>Home</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-menu-button-wide"></i><span>Paquetes</span><i class="bi bi-chevron-down ms-auto"></i>
                    </a>
                    <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                        <li>
                            <a href="listado.php">
                            <i class="bi bi-circle"></i><span>Disponibles</span>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </aside>
        <!-- Aside -->
         <!-- Main -->
        <main id="main" class="main">
        <div class="pagetitle">
            <h1>
                Listado de Paquetes de Viajes 
            </h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Inicio</a></li>
                    <li class="breadcrumb-item"><a href="#">Paquetes</a></li>
                    <li class="breadcrumb-item active">Disponibles</li>
                </ol>
            </nav>
        </div>
        <section class="section dashboard">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-12">
                            <div class="card top-selling overflow-auto">
                                <div class="card-body pb-0">
                                    <h5 class="card-title">Los más vendidos</h5>
                                    <table class="table table-borderless">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Destino</th>
                                                <th scope="col">Descripción</th>
                                                <th scope="col">Precio B/D</th>
                                                <th scope="col">Precio B/T</th>
                                                <th scope="col">Info Paquetes</th>
                                                <th scope="col">Info Pasajes</th>
                                                <th scope="col">Total de ventas</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                // Variables para punto 9 y 10
                                                $contador_internacionales = 0; 
                                                $contador_nacionales = 0; 
                                                $total_paquetes_internacionales = 0; // Cuadro internacionales
                                                $total_paquetes_nacionales = 0; // Cuadro internacionales
                                                $total_ventas_dobles = 0; //  Ventas dobles
                                                $total_ventas_triples = 0; //  Ventas triples
                                                
                                                // Bucle para punto 9 y 10
                                                foreach ($destinos as $destino) {
                                                    if ($destino['es_internacional']) {
                                                        $contador_internacionales++;
                                                        $total_paquetes_internacionales += $destino['paquetes_vendidos_bd'] + $destino['paquetes_vendidos_bt']; // Total de paquetes vendidos internacionales
                                                    } else {
                                                        $contador_nacionales++;
                                                        $total_paquetes_nacionales += $destino['paquetes_vendidos_bd'] + $destino['paquetes_vendidos_bt']; // Total de paquetes vendidos nacionales
                                                    }
                                                
                                                    // Calcular los precios
                                                    $precio_bd_final = ($destino['es_internacional']) ? $destino['precio_usd'] + 169 : $destino['precio_usd'];
                                                    $precio_bt_final = ($destino['es_internacional']) ? calcular_precio_triple($destino['precio_usd']) + 169 : calcular_precio_triple($destino['precio_usd']);
                                                
                                                    // Sumar el final en ventas 
                                                    $total_ventas_dobles += calcular_total_ventas_dobles($precio_bd_final, $destino['paquetes_vendidos_bd']);
                                                    $total_ventas_triples += calcular_total_ventas_triples($precio_bt_final, $destino['paquetes_vendidos_bt']);
                                                }
                                                
                                                
                                                $count = 1; // Contador número de fila izquierdo #, NRO Renglón, Punto 1
                                                foreach ($destinos as $destino):  // Array multidimensional destinos
                                                // Calcular precios
                                                $precio_bd_final = ($destino['Destino'] === 'Merlo' || $destino['Destino'] === 'Cataratas del iguazu') ? $destino['precio_usd'] : $destino['precio_usd'] + 169; // Sumatoría Precio B/D + imp, excluyente a destino nacional
                                                $precio_bt_final = ($destino['Destino'] === 'Merlo' || $destino['Destino'] === 'Cataratas del iguazu') ? : calcular_precio_triple($destino['precio_usd']) + 169; // Sumatoría Precio B/T + imp, excluyente a destino nacional
                                                ?>
                                            <tr>
                                                <th scope="row"><?php echo $count++; ?></th> <!-- Se inicia el contador, Punto 1 -->
                                                <td>
                                                    <a href="#">
                                                        <img src="<?php echo $destino['imagen']; ?>" data-bs-placement="left" data-bs-toggle="tooltip" data-bs-original-title="<?php echo $destino['codigo']; ?>" style="width: 50px;"/> <!-- Estilo para la imagen, código como tooltip, Punto 2 A) -->
                                                    </a>
                                                    <br />
                                                    <?php if ($destino['es_internacional']): ?> <!-- Punto 2B, Condicional verificación si el codigo es internacional o no -->
                                                    <i class="bi bi-bookmark-star-fill text-danger"></i> <!-- rojo / internacional -->
                                                    <?php else: ?> 
                                                    <i class="bi bi-bookmark-star-fill text-info"></i> <!-- celeste / nacional -->
                                                    <?php endif; ?>
                                                    <?php echo ($destino['Destino']); ?> 
                                                </td>
                                                <td>
                                                    <a href="#" class="text-primary fw-bold">
                                                        <?php echo substr($destino['descripcion'], 0, 50) . '...'; ?> <!-- Función cadena substr, limitada a 50 primeros digitos + concatenación de puntos suspensivos, Punto 3A) -->
                                                    </a>
                                                </td>
                                                <td>
                                                    <h6>
                                                        <span title="Precio Final: <?php echo ($destino['Destino'] === 'MERLO' || $destino['Destino'] === 'CATARATAS DEL IGUAZU') ? number_format($destino['precio_usd']) : number_format($precio_bd_final); ?>" data-bs-toggle="tooltip" data-bs-placement="top"> <!-- Tooltip precio final, 4C -->
                                                            U$S <?php echo number_format($destino['precio_usd'], 2); ?> <!-- Formateo a dos decimales. Toma propiedad de array.php, 'precio_usd' y se formatea a 2 decimales. 4 a) -->
                                                            <?php if ($destino['Destino'] !== 'MERLO' && $destino['Destino'] !== 'CATARATAS DEL IGUAZU'): ?>
                                                            + Imp. U$S 169
                                                            <?php endif; ?>
                                                        </span>
                                                    </h6>
                                                </td>
                                                <td>
                                                    <h6>
                                                        <span title="Precio Final: <?php echo ($destino['Destino'] === 'MERLO' || $destino['Destino'] === 'CATARATAS DEL IGUAZU') ? number_format(calcular_precio_triple($destino['precio_usd'])) : number_format($precio_bt_final); ?>" data-bs-toggle="tooltip" data-bs-placement="top"> <!-- Tooltip Punto 4D -->
                                                            U$S <?php echo number_format(calcular_precio_triple($destino['precio_usd']), 2); ?> <!-- Formato a 2 decimal, para el valor del array 'precio_usd', columna Precio B/T. No entendí si el formateo debía aplicarse solo a precio base doble  -->
                                                            <?php if ($destino['Destino'] !== 'MERLO' && $destino['Destino'] !== 'CATARATAS DEL IGUAZU'): ?>
                                                            + Imp. U$S 169
                                                            <?php endif; ?>
                                                        </span>
                                                    </h6>
                                                </td>
                                                <td>
                                                    <h5>
                                                        <?php
                                                            $total_vendidos = $destino['paquetes_vendidos_bd'] + $destino['paquetes_vendidos_bt']; // Se toman las propiedades del array y se realiza un calculo de suma. Tooltip, Punto 6 D
                                                            $color_clase = 'badge border-info border-1 text-info'; // Color por defecto
                                                            
                                                            if ($total_vendidos == 0) { // Condicional color para el total de paquetes, Punto 6 E 
                                                            $color_clase = 'badge border-danger border-1 text-danger'; // Rojo
                                                            } elseif ($total_vendidos >= ($destino['paquetes_disponibles'] / 2)) {
                                                                $color_clase = 'badge border-success border-1 text-success'; // Verde
                                                            } else {
                                                                $color_clase = 'badge border-warning border-1 text-warning'; // Amarillo
                                                            }
                                                            ?>
                                                        <span class="<?php echo $color_clase; ?>">
                                                        B/D Vendidos: <?php echo $destino['paquetes_vendidos_bd']; ?> <!-- Punto 6 A. Propiedad del array B/D. paquetes_vendidos_bd -->
                                                        </span>
                                                        <span class="<?php echo $color_clase; ?>">
                                                        B/T Vendidos: <?php echo $destino['paquetes_vendidos_bt']; ?> <!-- Punto 6 B. Propiedad del array B/T. paquetes_vendidos_bt -->
                                                        </span>
                                                        <span class="badge border-info border-1 text-info" title="Total vendidos: <?php echo $total_vendidos; ?>">
                                                        Paquetes disponibles: <?php echo $destino['paquetes_disponibles']; ?> <!-- Punto 6 C. Propiedad array. paquetes_disponibles -->
                                                        </span>
                                                    </h5>
                                                </td>
                                                <td>
                                                    <h5>
                                                        <span class="badge border-info border-1 text-info">
                                                        B/D Vendidos: <?php echo calcular_pasajes_dobles($destino['paquetes_vendidos_bd']); ?> <!-- Función propia para pasajes dobles (calcular_pasajes_dobles) * 2. funciones.php. Punto 7 A -->
                                                        </span>
                                                        <span class="badge border-info border-1 text-info">
                                                        B/T Vendidos: <?php echo calcular_pasajes_triples($destino['paquetes_vendidos_bt']); ?> <!-- Función propia para pasajes triples (calcular_pasajes_triples) * 3. funciones.php. Punto 7 B -->
                                                        </span>
                                                        <span class="badge border-info border-1 text-info">
                                                        Total pasajes vendidos: <?php echo calcular_pasajes_dobles($destino['paquetes_vendidos_bd']) + calcular_pasajes_triples($destino['paquetes_vendidos_bt']); ?> <!-- Resultado según sección -->
                                                        </span>
                                                    </h5>
                                                </td>
                                                <td>
                                                    <h4>
                                                        <span class="badge border-info border-1 text-info" title="Precio Final (<?php echo $destino['precio_usd']; ?> + 169) * Cant. Pasajes vendidos (<?php echo $destino['paquetes_vendidos_bd'] * 2; ?>)">
                                                            B/D: U$S <?php echo number_format($precio_bd_final * $destino['paquetes_vendidos_bd'] * 2); ?> <!-- Formateo a dos decimales -->
                                                        </span>
                                                        <span class="badge border-info border-1 text-info" title="Precio Final (<?php echo calcular_precio_triple($destino['precio_usd']); ?> + 169) * Cant. Pasajes vendidos (<?php echo $destino['paquetes_vendidos_bt'] * 3; ?>)">
                                                        B/T: U$S <?php echo number_format($precio_bt_final * $destino['paquetes_vendidos_bt'] * 3); ?>
                                                        </span>
                                                        <span class="badge border-info border-1 text-info" title="(Total B/D + Total B/T)">
                                                        TOTAL U$S <?php echo number_format(($precio_bd_final * $destino['paquetes_vendidos_bd'] * 2) + ($precio_bt_final * $destino['paquetes_vendidos_bt'] * 3)); ?>
                                                        </span>
                                                    </h4>
                                                </td>
                                            </tr>
                                            <?php endforeach; ?> <!-- Fin búcle -->
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Punto 9 y 10 secciones -->
            <div class="row">
                <div class="col-xxl-4 col-md-6">
                    <div class="card info-card revenue-card">
                        <div class="card-body">
                            <h5 class="card-title">
                                DESTINOS <span>| Cantidad Internacionales</span> 
                            </h5>
                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-patch-check-fill"></i>
                                </div>
                                <div class="ps-3">
                                    <h6><?php echo $contador_internacionales; ?></h6> <!-- Llamado a variable creada antes de comenzar el bucle -->
                                    <h5>Paquetes vendidos: <?php echo $total_paquetes_internacionales; ?></h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-4 col-md-6">
                    <div class="card info-card revenue-card">
                        <div class="card-body">
                            <h5 class="card-title">
                                DESTINOS <span>| Cantidad Nacionales</span> 
                            </h5>
                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-patch-check-fill"></i>
                                </div>
                                <div class="ps-3">
                                    <h6><?php echo $contador_nacionales; ?></h6>
                                    <h5>Paquetes vendidos: <?php echo $total_paquetes_nacionales; ?></h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-4 col-md-6">
                    <div class="card info-card revenue-card">
                        <div class="card-body">
                            <h5 class="card-title">
                                Total <span>| Final de Ventas</span> 
                            </h5>
                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-currency-dollar"></i>
                                </div>
                                <div class="ps-3">
                                    <h6>U$S <?php echo number_format($total_ventas_dobles + $total_ventas_triples, 2); ?></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Section -->
        </main>
        <!-- Main -->
         <!-- Fin código PHP -->


         <!-- Comienzo código HTML -->
        <!--
        <header id="header" class="header fixed-top d-flex align-items-center">
            <div class="d-flex align-items-center justify-content-between">
                <a href="index.html" class="logo d-flex align-items-center">
                <img src="assets/img/logo.png" alt="">
                <span class="d-none d-lg-block">NiceAdmin</span>
                </a>
                <i class="bi bi-list toggle-sidebar-btn"></i>
            </div>
        </header>
        <aside id="sidebar" class="sidebar">
            <ul class="sidebar-nav" id="sidebar-nav">
                <li class="nav-item">
                    <a class="nav-link " href="index.html">
                    <i class="bi bi-grid"></i>
                    <span>Home</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-menu-button-wide"></i><span>Paquetes</span><i class="bi bi-chevron-down ms-auto"></i>
                    </a>
                    <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                        <li>
                            <a href="listado.html">
                            <i class="bi bi-circle"></i><span>Disponibles</span>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </aside>
        <main id="main" class="main">
            <div class="pagetitle">
                <h1>
                    Listado de Paquetes de Viajes 
                </h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Inicio</a></li>
                        <li class="breadcrumb-item"><a href="#">Paquetes</a></li>
                        <li class="breadcrumb-item active">Disponibles</li>
                    </ol>
                </nav>
            </div>
            <section class="section dashboard">
                <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-12">
                            <div class="card top-selling overflow-auto">
                                <div class="card-body pb-0">
                                    <h5 class="card-title">Los mas vendidos </h5>
                                    <table class="table table-borderless">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Destino</th>
                                                <th scope="col">Descripción</th>
                                                <th scope="col">Precio B/D</th>
                                                <th scope="col">Precio B/T</th>
                                                <th scope="col">Info Paquetes</th>
                                                <th scope="col">Info Pasajes</th>
                                                <th scope="col">Total de ventas</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th scope="row"> 1</th>
                                                <th scope="row">
                                                    <a href="#"><img src="assets/img/1234.jpg" data-bs-placement="left" data-bs-toggle="tooltip"
                                                        data-bs-original-title="1234" /></a>
                                                    <br />
                                                    <i class="bi bi-bookmark-star-fill text-danger"></i>
                                                    BUZIOS
                                                </th>
                                                <td>
                                                    <a href="#" class="text-primary fw-bold">
                                                    Aéreo, Traslados, 07 noches, Desayuno, ASSIST CAR...
                                                    </a>
                                                </td>
                                                <td>
                                                    <h6>
                                                        <span title="Precio Final: 668">
                                                        U$S 499 + Imp. U$S 169 </span>
                                                    </h6>
                                                </td>
                                                <td>
                                                    <h6>
                                                        <span title="Precio Final: 618.1">
                                                        U$S 449.1 + Imp. U$S 169
                                                        </span>
                                                    </h6>
                                                </td>
                                                <td>
                                                    <h5>
                                                        <span class="badge border-success border-1 text-success">
                                                        B/D vendidos : 100 </span>
                                                        <span class="badge border-success border-1 text-success">
                                                        B/T vendidos: 20 </span>
                                                        <span class="badge border-info border-1 text-info" title="Total paquetes vendidos: 120">
                                                        Paquetes disponibles: 200 </span>
                                                    </h5>
                                                </td>
                                                <td>
                                                    <h5>
                                                        <span class="badge border-info border-1 text-info">
                                                        B/D Vendidos 200 </span>
                                                        <span class="badge border-info border-1 text-info">
                                                        B/T Vendidos 60 </span>
                                                        <span class="badge border-info border-1 text-info">
                                                        Total pasajes vendidos: 260 </span>
                                                    </h5>
                                                </td>
                                                <td>
                                                    <h4>
                                                        <span class="badge border-info border-1 text-info"
                                                            title="Precio Final (499 + 169 ) * Cant. Pasajes vendidos (200 )">
                                                        B/D: U$S 133600 </span>
                                                        <span class="badge border-info border-1 text-info"
                                                            title="Precio Final (449.1 + 169 ) * Cant. Pasajes vendidos (60 )">
                                                        B/T: U$S 37086 </span>
                                                        <span class="badge border-info border-1 text-info" title="(133600 + 37086 ) ">
                                                        TOTAL U$S 170686 </span>
                                                    </h4>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row"> 2</th>
                                                <th scope="row">
                                                    <a href="#"><img src="assets/img/2345.jpg" data-bs-placement="left" data-bs-toggle="tooltip"
                                                        data-bs-original-title="2345" /></a>
                                                    <br />
                                                    <i class="bi bi-bookmark-star-fill text-danger"></i>
                                                    RIO DE JANEIRO
                                                </th>
                                                <td>
                                                    <a href="#" class="text-primary fw-bold">
                                                    Aéreo AA, Traslados, 07 noches, Desayuno, ASSIST ...
                                                    </a>
                                                </td>
                                                <td>
                                                    <h6>
                                                        <span title="Precio Final: 818">
                                                        U$S 649 + Imp. U$S 169 </span>
                                                    </h6>
                                                </td>
                                                <td>
                                                    <h6>
                                                        <span title="Precio Final: 753.1">
                                                        U$S 584.1 + Imp. U$S 169
                                                        </span>
                                                    </h6>
                                                </td>
                                                <td>
                                                    <h5>
                                                        <span class="badge border-success border-1 text-success">
                                                        B/D vendidos : 20 </span>
                                                        <span class="badge border-success border-1 text-success">
                                                        B/T vendidos: 30 </span>
                                                        <span class="badge border-info border-1 text-info" title="Total paquetes vendidos: 50">
                                                        Paquetes disponibles: 90 </span>
                                                    </h5>
                                                </td>
                                                <td>
                                                    <h5>
                                                        <span class="badge border-info border-1 text-info">
                                                        B/D Vendidos 40 </span>
                                                        <span class="badge border-info border-1 text-info">
                                                        B/T Vendidos 90 </span>
                                                        <span class="badge border-info border-1 text-info">
                                                        Total pasajes vendidos: 130 </span>
                                                    </h5>
                                                </td>
                                                <td>
                                                    <h4>
                                                        <span class="badge border-info border-1 text-info"
                                                            title="Precio Final (649 + 169 ) * Cant. Pasajes vendidos (40 )">
                                                        B/D: U$S 32720 </span>
                                                        <span class="badge border-info border-1 text-info"
                                                            title="Precio Final (584.1 + 169 ) * Cant. Pasajes vendidos (90 )">
                                                        B/T: U$S 67779 </span>
                                                        <span class="badge border-info border-1 text-info" title="(32720 + 67779 ) ">
                                                        TOTAL U$S 100499 </span>
                                                    </h4>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row"> 3</th>
                                                <th scope="row">
                                                    <a href="#"><img src="assets/img/3456.jpg" data-bs-placement="left" data-bs-toggle="tooltip"
                                                        data-bs-original-title="3456" /></a>
                                                    <br />
                                                    <i class="bi bi-bookmark-star-fill text-danger"></i>
                                                    CHARTER PORTO SEGURO
                                                </th>
                                                <td>
                                                    <a href="#" class="text-primary fw-bold">
                                                    Aéreo Andes, Traslados, 07 noches, Sin desayuno, ...
                                                    </a>
                                                </td>
                                                <td>
                                                    <h6>
                                                        <span title="Precio Final: 998">
                                                        U$S 829 + Imp. U$S 169 </span>
                                                    </h6>
                                                </td>
                                                <td>
                                                    <h6>
                                                        <span title="Precio Final: 915.1">
                                                        U$S 746.1 + Imp. U$S 169
                                                        </span>
                                                    </h6>
                                                </td>
                                                <td>
                                                    <h5>
                                                        <span class="badge border-warning border-1 text-warning">
                                                        B/D vendidos : 5 </span>
                                                        <span class="badge border-warning border-1 text-warning">
                                                        B/T vendidos: 10 </span>
                                                        <span class="badge border-info border-1 text-info" title="Total paquetes vendidos: 15">
                                                        Paquetes disponibles: 90 </span>
                                                    </h5>
                                                </td>
                                                <td>
                                                    <h5>
                                                        <span class="badge border-info border-1 text-info">
                                                        B/D Vendidos 10 </span>
                                                        <span class="badge border-info border-1 text-info">
                                                        B/T Vendidos 30 </span>
                                                        <span class="badge border-info border-1 text-info">
                                                        Total pasajes vendidos: 40 </span>
                                                    </h5>
                                                </td>
                                                <td>
                                                    <h4>
                                                        <span class="badge border-info border-1 text-info"
                                                            title="Precio Final (829 + 169 ) * Cant. Pasajes vendidos (10 )">
                                                        B/D: U$S 9980 </span>
                                                        <span class="badge border-info border-1 text-info"
                                                            title="Precio Final (746.1 + 169 ) * Cant. Pasajes vendidos (30 )">
                                                        B/T: U$S 27453 </span>
                                                        <span class="badge border-info border-1 text-info" title="(9980 + 27453 ) ">
                                                        TOTAL U$S 37433 </span>
                                                    </h4>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row"> 4</th>
                                                <th scope="row">
                                                    <a href="#"><img src="assets/img/4567.jpg" data-bs-placement="left" data-bs-toggle="tooltip"
                                                        data-bs-original-title="4567" /></a>
                                                    <br />
                                                    <i class="bi bi-bookmark-star-fill text-info"></i>
                                                    MERLO
                                                </th>
                                                <td>
                                                    <a href="#" class="text-primary fw-bold">
                                                    07 días · 04 noches en bus cama, semi cama, medi...
                                                    </a>
                                                </td>
                                                <td>
                                                    <h6>
                                                        <span title="Precio Final: 300">
                                                        U$S 300 </span>
                                                    </h6>
                                                </td>
                                                <td>
                                                    <h6>
                                                        <span title="Precio Final: 270">
                                                        U$S 270
                                                        </span>
                                                    </h6>
                                                </td>
                                                <td>
                                                    <h5>
                                                        <span class="badge border-danger border-1 text-danger">
                                                        B/D vendidos : 0 </span>
                                                        <span class="badge border-danger border-1 text-danger">
                                                        B/T vendidos: 0 </span>
                                                        <span class="badge border-info border-1 text-info" title="Total paquetes vendidos: 0">
                                                        Paquetes disponibles: 200 </span>
                                                    </h5>
                                                </td>
                                                <td>
                                                    <h5>
                                                        <span class="badge border-info border-1 text-info">
                                                        B/D Vendidos 0 </span>
                                                        <span class="badge border-info border-1 text-info">
                                                        B/T Vendidos 0 </span>
                                                        <span class="badge border-info border-1 text-info">
                                                        Total pasajes vendidos: 0 </span>
                                                    </h5>
                                                </td>
                                                <td>
                                                    <h4>
                                                        <span class="badge border-info border-1 text-info"
                                                            title="Precio Final (300  ) * Cant. Pasajes vendidos (0 )">
                                                        B/D: U$S 0 </span>
                                                        <span class="badge border-info border-1 text-info"
                                                            title="Precio Final (270  ) * Cant. Pasajes vendidos (0 )">
                                                        B/T: U$S 0 </span>
                                                        <span class="badge border-info border-1 text-info" title="(0 + 0 ) ">
                                                        TOTAL U$S 0 </span>
                                                    </h4>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row"> 5</th>
                                                <th scope="row">
                                                    <a href="#"><img src="assets/img/5678.jpg" data-bs-placement="left" data-bs-toggle="tooltip"
                                                        data-bs-original-title="5678" /></a>
                                                    <br />
                                                    <i class="bi bi-bookmark-star-fill text-info"></i>
                                                    CATARATAS DEL IGUAZU
                                                </th>
                                                <td>
                                                    <a href="#" class="text-primary fw-bold">
                                                    07 días · 04 noches en bus cama, media pensión...
                                                    </a>
                                                </td>
                                                <td>
                                                    <h6>
                                                        <span title="Precio Final: 513">
                                                        U$S 513 </span>
                                                    </h6>
                                                </td>
                                                <td>
                                                    <h6>
                                                        <span title="Precio Final: 461.7">
                                                        U$S 461.7
                                                        </span>
                                                    </h6>
                                                </td>
                                                <td>
                                                    <h5>
                                                        <span class="badge border-success border-1 text-success">
                                                        B/D vendidos : 110 </span>
                                                        <span class="badge border-success border-1 text-success">
                                                        B/T vendidos: 40 </span>
                                                        <span class="badge border-info border-1 text-info" title="Total paquetes vendidos: 150">
                                                        Paquetes disponibles: 300 </span>
                                                    </h5>
                                                </td>
                                                <td>
                                                    <h5>
                                                        <span class="badge border-info border-1 text-info">
                                                        B/D Vendidos 220 </span>
                                                        <span class="badge border-info border-1 text-info">
                                                        B/T Vendidos 120 </span>
                                                        <span class="badge border-info border-1 text-info">
                                                        Total pasajes vendidos: 340 </span>
                                                    </h5>
                                                </td>
                                                <td>
                                                    <h4>
                                                        <span class="badge border-info border-1 text-info"
                                                            title="Precio Final (513  ) * Cant. Pasajes vendidos (220 )">
                                                        B/D: U$S 112860 </span>
                                                        <span class="badge border-info border-1 text-info"
                                                            title="Precio Final (461.7  ) * Cant. Pasajes vendidos (120 )">
                                                        B/T: U$S 55404 </span>
                                                        <span class="badge border-info border-1 text-info" title="(112860 + 55404 ) ">
                                                        TOTAL U$S 168264 </span>
                                                    </h4>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-4 col-md-6">
                            <div class="card info-card revenue-card">
                                <div class="card-body">
                                    <h5 class="card-title">
                                        DESTINOS <span>| Cantidad Internacionales</span> 
                                    </h5>
                                    <div class="d-flex align-items-center">
                                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-patch-check-fill"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6>3</h6>
                                            <h5>Paquetes vendidos: 185</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-4 col-md-6">
                            <div class="card info-card revenue-card">
                                <div class="card-body">
                                    <h5 class="card-title">
                                        DESTINOS <span>| Cantidad Nacionales</span> 
                                    </h5>
                                    <div class="d-flex align-items-center">
                                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-patch-check-fill"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6>2</h6>
                                            <h5>Paquetes vendidos: 150</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-4 col-md-6">
                            <div class="card info-card revenue-card">
                                <div class="card-body">
                                    <h5 class="card-title">
                                        Total <span>| Final de Ventas</span> 
                                    </h5>
                                    <div class="d-flex align-items-center">
                                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-currency-dollar"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6>U$S 476882</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>
        -->
        <footer id="footer" class="footer">
            <div class="copyright">
                &copy; Copyright <strong><span>NiceAdmin</span></strong>. All Rights Reserved
            </div>
            <div class="credits">
                Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
            </div>
        </footer>
        <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>
        <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="assets/js/main.js"></script>
    </body>
</html>