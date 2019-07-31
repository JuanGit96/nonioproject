<!DOCTYPE html>
<html>
<body>
<table>
    <tr>
        <td>
            <h1 align="center" style="padding-top: 9px; color: #027780;     font-size: 34px;">¡ Nuevo registro !</h1>
        </td>
        <td>
            <img src="<?php echo $message->embed('img/Logo.png'); ?>" width="60%" align="center"> 
        </td>
    </tr>
    <tr>
        <td style="margin-left: 45px;" colspan="2">
            <h2>Datos de la empresa</h2>
        </td>
    </tr>
    <tr>
        <td style="margin-left: 45px;" colspan="2">
            <h3 >Nombre : {{$pyme->name_company}}</h3>
        </td>
    </tr>
    <tr>
        <td style="margin-left: 45px;" colspan="2">
            <h3 >Nombre de contacto : {{$pyme->name_contact}}</h3>
        </td>
    </tr>
    <tr>
        <td style="margin-left: 45px;" colspan="2">
            <h3 >Telefono : {{$pyme->phone}}</h3>
        </td>
    </tr>
    <tr>
        <td style="margin-left: 45px;" colspan="2">
            <h3 >Ubicacion : {{$pyme->ubication}}</h3>
        </td>
    </tr>
    <tr>
        <td align="center">
            <h2 >Datos de la Simulación</h2>
        </td>
    </tr>
    <tr>
        <td style="margin-left: 45px;" colspan="2"">
            <h3 >Sector : {{$simulacion->sector}}</h3>
        </td>
    </tr>
    <tr>
        <td style="margin-left: 45px;" colspan="2">
            <h3 >Fecha : {{$simulacion->date}}</h3>
        </td>
    </tr>
    <tr>
        <td style="margin-left: 45px;" colspan="2">
            <h3 >Ingresos : {{$simulacion->income}}</h3>
        </td>
    </tr>
    <tr>
        <td style="margin-left: 45px;" colspan="2">
            <h3 >Costos de ventas : {{$simulacion->sale_value}}</h3>
        </td>
    </tr>
    <tr>
        <td style="margin-left: 45px;" colspan="2">
            <h3 >Gastos de operación  : {{$simulacion->operating_costs}}</h3>
        </td>
    </tr>
    <tr>
        <td style="margin-left: 45px;" colspan="2">
            <h3 >Gastos de depreciación  : {{$simulacion->depreciation_costs}}</h3>
        </td>
    </tr>
    <tr>
        <td style="margin-left: 45px;" colspan="2">
            <h3 >Saldo de obligaciones financieras  : {{$simulacion->financial_obligations}}</h3>
        </td>
    </tr>
    <tr>
        <td style="margin-left: 45px;" colspan="2">
            <h3 >Valor del Patrimonio : {{$simulacion->heritage_value}}</h3>
        </td>
    </tr>
    <tr>
        <td style="margin-left: 45px;" colspan="2">
            <h3 >Email : {{$simulacion->email_contact}}</h3>
        </td>
    </tr>
    <tr>
        <td style="margin-left: 45px;">
            <h2 >Otros datos</h2>
        </td>
    </tr>
    <tr>
        <td style="margin-left: 45px;" colspan="2">
            <h3 >Valor solicitado : {{$simulation_demand->value}}</h3>
        </td>
    </tr>
    <tr>
        <td style="margin-left: 45px;" colspan="2">
            <h3 >Rodi : {{$simulation_demand->rodi}}</h3>
        </td>
    </tr>
    <tr>
        <td style="margin-left: 45px;" colspan="2">
            <h3 >D inversion : {{$simulation_demand->dinversion}}%</h3>
        </td>
    </tr>
    <tr>
        <td style="margin-left: 45px;" colspan="2">
            <h3 >Costo patrimonio : {{$simulation_demand->costopatrimonio}}%</h3>
        </td>
    </tr>
    <tr>
        <td style="margin-left: 45px;" colspan="2">
            <h3 >Endeudamiento adicional : {{$simulation_demand->eadicional}}</h3>
        </td>
    </tr>
    <tr>
        <td style="margin-left: 45px;" colspan="2">
            <h3 >Roic : {{$simulation_demand->roic}}%</h3>
        </td>
    </tr>
    <tr>
        <td style="margin-left: 45px;" colspan="2">
            <h3 >Fecha de creacion : {{$simulation_demand->created_at}}</h3>
        </td>
    </tr>
</table>
</body>
</html>


