<!DOCTYPE html>
<html>
    <body>
        <table width="100%" cellpadding="0" cellspacing="0" style="border: solid">
            <tr >
                <td>
                    <h1 align="center" style="padding-top: 9px; color: #027780;     font-size: 34px;">¡Bienvenido!</h1>
                </td>
                <td>
                    <img src="<?php echo $message->embed('img/Logo.png'); ?>" width="80%" align="center"> 
                </td>
            </tr>
            <tr >
                <td colspan="2">
                    <h2 align="center">A continuación encontrarás tu contraseña para ingresar a la plataforma en el momento que desees.</h2>
                </td>
            </tr>
            <tr >
                <td colspan="2">
                    <h3 align="center">Usuario : {{$user}}</h3>
                </td>
            </tr>
            <tr >
                <td colspan="2">
                    <h3 align="center">Contraseña : {{$pass}}</h3>
                </td>
            </tr>
            <tr >
                <td colspan="2">
                    <h4 align="center">Te recomendamos iniciar sesión en la plataforma y cambiar tu contraseña para siempre recordar tu acceso.</h4>
                </td>
            </tr>
        </table>
    </body>
</html>


