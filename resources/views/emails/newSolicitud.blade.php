
<h2>Nueva solicitud:</h2>
<span>******************</span><br>
<h2>La siguiente solicitud vence en aproximadamente 5 dias:</h2>


<h4>Datos de la solicitud</h4>
<br>
<p>
    <label>Ingresos: {{$simulation->income}}</label><br>
    <label>Correo: {{$simulation->email_contact}}</label><br>
    <label>Valor Comercial: {{$simulation->sale_value}}</label><br>
    <label>Costo de Operacional: {{$simulation->depreciation_costs}}</label><br>
    <label>Costo de Amortización: {{$simulation->amortization_costs}}</label><br>
    <label>Obligaciones Financieras: {{$simulation->financial_obligations}}</label><br>
</p>
<p>
    <label>Fecha: {{date_format(date_create($simulation->created_at),"d/m/Y  H:i:s")}}</label><br>
    <label>Valor requerido: ${{number_format($simulation->value)}}</label><br>
    <label>Entidad solicitada: {{$simulation->banco}}</label><br>
    <label>Tasa: {{$simulation->interest_rate}}</label><br>
    <label>Plazo: {{$simulation->terms}}</label><br>
    <label>Capacidad de endeudamiento respecto a la entidad: ${{number_format($simulation->capacidad)}}</label><br>
</p>


