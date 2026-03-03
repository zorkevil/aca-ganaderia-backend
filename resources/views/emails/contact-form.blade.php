<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nueva Consulta de Contacto</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background-color: #4CAF50;
            color: white;
            padding: 20px;
            text-align: center;
            border-radius: 5px 5px 0 0;
        }
        .content {
            background-color: #f9f9f9;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 0 0 5px 5px;
        }
        .field {
            margin-bottom: 15px;
        }
        .field-label {
            font-weight: bold;
            color: #555;
        }
        .field-value {
            margin-top: 5px;
            padding: 10px;
            background-color: white;
            border-left: 3px solid #4CAF50;
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>Nueva Consulta de Contacto</h2>
        <p>Sección: {{ ucfirst($form->section) }}</p>
    </div>
    
    <div class="content">
        <div class="field">
            <div class="field-label">Nombre y Apellido:</div>
            <div class="field-value">{{ $form->nombre }} {{ $form->apellido }}</div>
        </div>

        <div class="field">
            <div class="field-label">Email:</div>
            <div class="field-value">{{ $form->email }}</div>
        </div>

        <div class="field">
            <div class="field-label">Teléfono:</div>
            <div class="field-value">{{ $form->telefono }}</div>
        </div>

        <div class="field">
            <div class="field-label">Rol:</div>
            <div class="field-value">{{ $form->rol }}{{ $form->otro_rol ? ' - ' . $form->otro_rol : '' }}</div>
        </div>

        <div class="field">
            <div class="field-label">Localidad:</div>
            <div class="field-value">{{ $form->localidad }}</div>
        </div>

        @if($form->area)
        <div class="field">
            <div class="field-label">Área:</div>
            <div class="field-value">{{ $form->area }}</div>
        </div>
        @endif

        <div class="field">
            <div class="field-label">Mensaje:</div>
            <div class="field-value">{{ $form->mensaje }}</div>
        </div>

        <div class="field">
            <div class="field-label">Fecha de envío:</div>
            <div class="field-value">{{ $form->created_at->format('d/m/Y H:i') }}</div>
        </div>
    </div>
</body>
</html>