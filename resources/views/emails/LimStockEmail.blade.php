<table style="max-width: 600px; padding: 10px; margin:0 auto; border-collapse: collapse;">
    <tr>
        <td style="background-color: #ecf0f1">
            <div style="color: #34495e; margin: 4% 10% 2%; text-align: justify;font-family: sans-serif">
                <h2 style="color: #e67e22; margin: 0 0 7px">
                    Se ha reportado un nuevo caso de Limit de Stock de productos a las {{ $count->created_at }}.
                </h2>
                <p style="margin: 2px; font-size: 15px">
                    Estos son los datos del producto:
                </p>
                <ul style="font-size: 15px;  margin: 10px 0">
                    <li>ID: {{ $count['id'] }}</li>
                    <li>Nombre: {{ $count['name'] }}</li>
                    <li>Stock actual: {{ $count['stock']}}</li>
                </ul>
                <p style="color: #8A8B8B; font-size: 14px; text-align: center;margin: 30px 0 0">
                    CafeteriaK
                </p>
            </div>
        </td>
    </tr>
</table>
