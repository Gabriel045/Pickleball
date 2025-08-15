<?php

function format_phone_number($phone)
{
    // Verifica si el número tiene un prefijo internacional (+1)
    if (strpos($phone, '+') === 0) {
        // Extrae el prefijo internacional y el resto del número
        $parts = explode(' ', $phone, 2);
        $prefix = $parts[0]; // Prefijo internacional (e.g., "+58")
        $number = isset($parts[1]) ? $parts[1] : ''; // Resto del número

        // Formatea el número al estilo (XXX) XXX-XXXX
        $number = preg_replace('/[^0-9]/', '', $number); // Elimina caracteres no numéricos
        $formatted_number = preg_replace('/(\d{3})(\d{3})(\d{4})/', '($1) $2-$3', $number);

        return $formatted_number; // Devuelve el número formateado con el prefijo
    }

    // Si no tiene prefijo, solo formatea el número
    $phone = preg_replace('/[^0-9]/', '', $phone); // Elimina caracteres no numéricos
    return preg_replace('/(\d{3})(\d{3})(\d{4})/', '($1) $2-$3', $phone);
}

get_header(); ?>
<div>test</div>
<div><?php echo format_phone_number("+58 424-781-1434") ?></div>

<?php get_footer(); ?>