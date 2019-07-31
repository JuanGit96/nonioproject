<!DOCTYPE html>
<html>
<body>
<table>
    <tr>
        <td>
            <h1 align="center" style="padding-top: 9px; color: #027780;     font-size: 34px;">¡ Hola !</h1>
        </td>
        <td>
            <img src="<?php echo $message->embed('img/Logo.png'); ?>" width="60%"> 
        </td>
    </tr>
    <tr>
        <td colspan="2">
            <h2 align="center">Hemos recibido tu solicitud de recuperación de contraseña, a continuacion encontraras tu nueva contraseña para ingresar a la plataforma.</h2>
        </td>
    </tr>
    <tr>
        <td colspan="2">
            <h3 >Usuario : {{$user}}</h3>
        </td>
    </tr>
    <tr>
        <td colspan="2">
            <h3 >Contraseña : {{$pass}}</h3>
        </td>
    </tr>
    <tr>
        <td colspan="2">
            <h4 align="center">Te recomendamos iniciar sesión en la plataforma y cambiar tu contraseña para siempre recordar tu acceso.</h4>
        </td>
    </tr>
    
</table>
</body>
</html>
