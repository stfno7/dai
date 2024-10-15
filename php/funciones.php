<?php
// Funcion para devolver los valores en la columna precio b/t. Precio b/t con un 10% sobre el precio base doble
function calcular_precio_triple($precio_base_doble) {
    return $precio_base_doble * 0.9; 
}

// Funcion columna info pasajes. Multiplica la columna info paquetes (B/D Vendidos) x 2, y devuelve el valor info pasajes B/D Vendidos.
function calcular_pasajes_dobles($paquetes_vendidos_bd) {
    return $paquetes_vendidos_bd * 2;
}

// Funcion columna info pasajes. Multiplica los valores de info paquetes (B/T Vendidos) x 3, y devuelve el valor info pasajes B/T Vendidos.
function calcular_pasajes_triples($paquetes_vendidos_bt) {
    return $paquetes_vendidos_bt * 3;
}

// 3. Funciones del total para el punto 9 y 10
function calcular_total_ventas_dobles($precio_bd, $paquetes_vendidos_bd) {
    return $precio_bd * calcular_pasajes_dobles($paquetes_vendidos_bd);
}

function calcular_total_ventas_triples($precio_bt, $paquetes_vendidos_bt) {
    return $precio_bt * calcular_pasajes_triples($paquetes_vendidos_bt);
}
?>