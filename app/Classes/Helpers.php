<?php

namespace App\Classes;

use DateTime;
use ReflectionClass;

class Helpers{

    static function saludo():string{
        $mensaje = null;
        $hora = date('G');
        
        if($hora >= 0 && $hora < 12)
            $mensaje = "Buenos dias";
        elseif($hora >=12 && $hora < 18)
            $mensaje = "Buenas tardes";
        elseif($hora >= 18 && $hora <= 23)
            $mensaje = "Buenas noches";

        return $mensaje;
    }

    static function setSwalAlert($icon, $title, $text, $timer = null) {
        if(!isset($_SESSION)) {
            session_start();
        }

        $_SESSION['swal'] = [
            'icon' => $icon,
            'title' => $title,
            'text' => $text,
            'timer' => $timer
        ];
    }
    
    static function showSwalAlert() {
        if(!isset($_SESSION))
            session_start();

        if (isset($_SESSION['swal'])) {
            echo '
                <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            ';
            echo "<script>
                Swal.fire({
                    icon: '{$_SESSION['swal']['icon']}',
                    title: '{$_SESSION['swal']['title']}',
                    text: '{$_SESSION['swal']['text']}',
                    ".($_SESSION['swal']['timer'] ? "timer: {$_SESSION['swal']['timer']}, showConfirmButton: false" : "")."
                });
            </script>";
            unset($_SESSION['swal']);
        }
    }

    static function obtenerIniciales($cadena):string {
        // Eliminar espacios en blanco adicionales
        $cadena = trim($cadena);
        
        // Separar la cadena en palabras
        $palabras = explode(' ', $cadena);
        
        // Verificar que haya al menos dos palabras
        if (count($palabras) < 2) {
            $iniciales = strtoupper($palabras[0][0] . '');
            return $iniciales;
        }
        
        // Obtener las iniciales de las dos primeras palabras
        $iniciales = strtoupper($palabras[0][0]) . strtoupper($palabras[1][0]);
        
        return $iniciales;
    }

    static function getFirstName($cadena):string{
        // Eliminar espacios en blanco adicionales
        $cadena = trim($cadena);
        
        // Separar la cadena en palabras
        $palabras = explode(' ', $cadena);
        
        return ', '.$palabras[0]??'';
    }

    static function traducirYGuardarJson($entidad, $id, $objNuevo, $objOriginal = null, array $atributosTraducibles = [], $format = "text") {
        $clavesTraducidas = [];
        $clavesOriginales = [];

        foreach ($atributosTraducibles as $nombre) {
            if (!property_exists($objNuevo, $nombre)) continue;

            $valorNuevo = $objNuevo->$nombre ?? '';
            $valorOriginal = $objOriginal?->$nombre ?? '';

            if (empty($valorNuevo)) continue;

            // Guardamos el texto original en español
            $clavesOriginales[$nombre] = $valorNuevo;

            // Solo traduce si no existe el original o ha cambiado
            if ($objOriginal === null || $valorNuevo !== $valorOriginal) {
                $traduccion = self::traducirGoogle($valorNuevo, 'es', 'en', $format);
                $clavesTraducidas[$nombre] = $traduccion;
            }
        }

        $claveEntidad = "{$entidad}-{$id}";

        if (!empty($clavesTraducidas)) {
            $rutaJsonEN = __DIR__ . "/../../public/assets/lang/en.dynamic.json";
            $jsonEN = file_exists($rutaJsonEN) ? json_decode(file_get_contents($rutaJsonEN), true) : [];

            if (!isset($jsonEN[$claveEntidad])) {
                $jsonEN[$claveEntidad] = [];
            }

            foreach ($clavesTraducidas as $k => $v) {
                $jsonEN[$claveEntidad][$k] = $v;
            }

            file_put_contents($rutaJsonEN, json_encode($jsonEN, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        }

        if (!empty($clavesOriginales)) {
            $rutaJsonES = __DIR__ . "/../../public/assets/lang/es.dynamic.json";
            $jsonES = file_exists($rutaJsonES) ? json_decode(file_get_contents($rutaJsonES), true) : [];

            if (!isset($jsonES[$claveEntidad])) {
                $jsonES[$claveEntidad] = [];
            }

            foreach ($clavesOriginales as $k => $v) {
                $jsonES[$claveEntidad][$k] = $v;
            }

            file_put_contents($rutaJsonES, json_encode($jsonES, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        }
    }

    private static function traducirGoogle($texto, $from = 'es', $to = 'en', $format = "text") {
        $apiKey = $_ENV['GOOGLE_TRANSLATE'];
        $url = 'https://translation.googleapis.com/language/translate/v2';

        $params = [
            'q' => $texto,
            'source' => $from,
            'target' => $to,
            'format' => $format,
            'key' => $apiKey
        ];

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/x-www-form-urlencoded'
        ]);

        $response = curl_exec($ch);
        curl_close($ch);

        $data = json_decode($response, true);

        return $data['data']['translations'][0]['translatedText'] ?? $texto;
    }

    public static function formatearFechasHoras(string $jsonFechas): array {
        $fechas = json_decode($jsonFechas);
        $diasMeses = [];
        $horas = [];

        foreach ($fechas as $fechaRaw) {
            $fecha = new DateTime($fechaRaw);
            $diasMeses[] = $fecha->format('j M');
            $horas[] = $fecha->format('H:i');
        }

        // Eliminar duplicados en caso de que todas las horas sean iguales
        $horasUnicas = array_unique($horas);
        // Ordenar las fechas (por si acaso)
        sort($diasMeses);
        sort($horasUnicas);

        return [
            'fechas' => implode(', ', $diasMeses),
            'horas' => implode(', ', $horasUnicas)
        ];
    }

    public static function limitarTexto($texto, $longitud = 100) {
        if (strlen($texto) > $longitud)
            $texto = substr($texto, 0, $longitud) . '...';
        return $texto;
    }

    public static function generate_password($longitud = 12): string {
        $caracteres = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789+-=[]{}|;:,.<>?';
        $caracteres = str_shuffle($caracteres);
        $contrasena = '';
        
        for ($i = 0; $i < $longitud; $i++) {
            $contrasena .= $caracteres[rand(0, strlen($caracteres) - 1)];
        }

        return $contrasena;
    }

    public static function newUserPaymentHTML():string{
        return $html = '
            <!DOCTYPE html>
            <html>
                <head>
                    <meta charset="UTF-8">
                    <title>Cuenta creada con éxito</title>
                </head>
                <body style="margin:0;padding:0;background-color:#f4f4f4;font-family:Arial, sans-serif;">
                    <table width="100%" cellpadding="0" cellspacing="0" style="background-color:#f4f4f4;padding:30px 0;">
                        <tr>
                        <td align="center">
                            <table width="600" cellpadding="0" cellspacing="0" style="background:#ffffff;border-radius:8px;overflow:hidden;box-shadow:0 0 10px rgba(0,0,0,0.05);">
                            <tr>
                                <td style="background:#CDA02D;padding:20px;text-align:center;color:#ffffff;font-size:24px;">
                                <strong>¡Tu cuenta ha sido creada!</strong>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding:30px;color:#000000;">
                                <h1 style="margin-top:0;font-size:22px;">Hola{NOMBRE_USUARIO}</h1>
                                <p style="font-size:16px;line-height:1.5;">
                                    Gracias por tu compra. Hemos creado automáticamente una cuenta para que puedas acceder a tu producto y administrar tu perfil dentro de nuestra plataforma.
                                </p>
                                <p style="font-size:16px;line-height:1.5;">
                                    Aquí tienes tu contraseña temporal:
                                </p>
                                <div style="background:#f7f7f7;padding:12px 18px;margin:20px 0;border-radius:6px;font-size:18px;text-align:center;font-weight:bold;color:#000000;">
                                    {CONTRASENA_GENERADA}
                                </div>
                                <p style="font-size:16px;line-height:1.5;">
                                    Puedes cambiarla después de iniciar sesión desde tu panel de usuario.
                                </p>
                                <div style="text-align:center;margin:30px 0;">
                                    <a href="{URL_TUTORIAL}" style="background:#CDA02D;color:#ffffff;text-decoration:none;padding:12px 24px;border-radius:6px;font-size:16px;display:inline-block;">
                                    Ver tutorial de uso
                                    </a>
                                </div>
                                <p style="font-size:14px;color:#777777;">
                                    Si tienes dudas o necesitas ayuda, puedes enviar un correo a {EMAIL_SOPORTE}.
                                </p>
                                </td>
                            </tr>
                            <tr>
                                <td style="background:#eeeeee;padding:15px;text-align:center;font-size:12px;color:#999999;">
                                © '.date("Y").' KTA Institue. Todos los derechos reservados.
                                </td>
                            </tr>
                            </table>
                        </td>
                        </tr>
                    </table>
                </body>
            </html>';

    }

    public static function facturaHTML():string{
        return $html = '
            <!DOCTYPE html>
            <html>
            <head>
            <meta charset="UTF-8">
            <title>Resumen de tu compra</title>
            </head>
            <body style="margin:0;padding:0;background-color:#f4f4f4;font-family:Arial, sans-serif;">
            <table width="100%" cellpadding="0" cellspacing="0" style="background-color:#f4f4f4;padding:30px 0;">
                <tr>
                <td align="center">
                    <table width="600" cellpadding="0" cellspacing="0" style="background:#ffffff;border-radius:8px;overflow:hidden;box-shadow:0 0 10px rgba(0,0,0,0.05);">
                    <tr>
                        <td style="background:#CDA02D;padding:20px;text-align:center;color:#ffffff;font-size:24px;">
                        <strong>Resumen de tu compra</strong>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:30px;color:#000000;">
                        <h1 style="margin-top:0;font-size:22px;">Hola{NOMBRE_USUARIO}</h1>
                        <p style="font-size:16px;line-height:1.5;">
                            ¡Gracias por tu compra! Adjuntamos el comprobante de pago en formato PDF con todos los detalles registrados.
                        </p>
                        <p style="font-size:16px;line-height:1.5;">
                            Si necesitas soporte o tienes dudas sobre tu compra, no dudes en contactarnos.
                        </p>
                        <div style="text-align:center;margin:30px 0;">
                            <a href="{URL_SOPORTE}" style="background:#CDA02D;color:#ffffff;text-decoration:none;padding:12px 24px;border-radius:6px;font-size:16px;display:inline-block;">
                            Contactar soporte
                            </a>
                        </div>
                        <p style="font-size:16px;color:#777777;">
                            Este correo incluye tu comprobante como archivo adjunto.
                        </p>
                        </td>
                    </tr>
                    <tr>
                        <td style="background:#eeeeee;padding:15px;text-align:center;font-size:12px;color:#999999;">
                        © '.date("Y").' KTA Institute. Todos los derechos reservados.
                        </td>
                    </tr>
                    </table>
                </td>
                </tr>
            </table>
            </body>
            </html>';

    }
}