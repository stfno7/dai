<?php
$destinos = array(
    array(
        'codigo' => '1234',
        'Destino' => strtoupper('Buzios'), // Función de cadena, para pasar el string a mayusculas
        'es_internacional' => true, // Propiedad para el condicional de color rojo o celeste
        'descripcion' => 'Aéreo, Traslados, 07 noches, Desayuno, ASSIST CARD',
        'precio_usd' => 499,10,
        'paquetes_vendidos_bd' => 100,
        'paquetes_vendidos_bt' => 20,
        'paquetes_disponibles' => 200,
        'imagen' => 'assets/img/1234.jpg'
    ),
    array(
        'codigo' => '2345',
        'Destino' => strtoupper('Rio de Janeiro'),
        'es_internacional' => true,
        'descripcion' => 'Aéreo AA, Traslados, 07 noches, Desayuno, ASSIST CARD',
        'precio_usd' => 649,
        'paquetes_vendidos_bd' => 20,
        'paquetes_vendidos_bt' => 30,
        'paquetes_disponibles' => 90,
        'imagen' => 'assets/img/2345.jpg'
    ),
    array(
        'codigo' => '3456',
        'Destino' => strtoupper('Charter Porto Seguro'),
        'es_internacional' => true,
        'descripcion' => 'Aéreo Andes, Traslados, 07 noches, Sin desayuno, ASSIST CARD',
        'precio_usd' => 829,
        'paquetes_vendidos_bd' => 5,
        'paquetes_vendidos_bt' => 10,
        'paquetes_disponibles' => 90,
        'imagen' => 'assets/img/3456.jpg'
    ),
    array(
        'codigo' => '4567',
        'Destino' => strtoupper('Merlo'),
        'es_internacional' => false,
        'descripcion' => '07 días, 04 noches en bus cama, semi cama, media pensión',
        'precio_usd' => 300,
        'paquetes_vendidos_bd' => 0,
        'paquetes_vendidos_bt' => 0,
        'paquetes_disponibles' => 200,
        'imagen' => 'assets/img/4567.jpg'
    ),
    array(
        'codigo' => '5678',
        'Destino' => strtoupper('Cataratas del iguazu'),
        'es_internacional' => false,
        'descripcion' => '07 días, 04 noches en bus cama, media pensión, Excurs: Minas de Wanda, Cataratas de Arg y Bra. ( no incluyen ingresos )',
        'precio_usd' => 513,
        'paquetes_vendidos_bd' => 110,
        'paquetes_vendidos_bt' => 40,
        'paquetes_disponibles' => 300,
        'imagen' => 'assets/img/5678.jpg'
    ),
);
?>