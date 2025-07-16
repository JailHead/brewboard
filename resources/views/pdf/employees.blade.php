<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Reporte de Empleados</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            color: #333;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #677c5b;
            padding-bottom: 10px;
        }
        .header h1 {
            color: #677c5b;
            margin: 0;
        }
        .meta-info {
            text-align: right;
            margin-bottom: 20px;
            font-size: 12px;
            color: #666;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
            font-size: 12px;
        }
        th {
            background-color: #677c5b;
            color: white;
            font-weight: bold;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .summary {
            margin-top: 20px;
            padding: 15px;
            background-color: #efe9db;
            border-radius: 5px;
        }
        .summary h3 {
            color: #677c5b;
            margin-top: 0;
        }
        .role-count {
            display: inline-block;
            margin-right: 20px;
        }
        .footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            text-align: center;
            font-size: 10px;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>BrewBoard - Reporte de Empleados</h1>
    </div>

    <div class="meta-info">
        <strong>Fecha de generación:</strong> {{ now()->format('d/m/Y H:i') }}<br>
        <strong>Total de empleados:</strong> {{ $employees->count() }}
    </div>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre Completo</th>
                <th>Rol</th>
                <th>Email</th>
                <th>Teléfono</th>
                <th>Turno</th>
                <th>Fecha de Ingreso</th>
            </tr>
        </thead>
        <tbody>
            @foreach($employees as $employee)
            <tr>
                <td>{{ $employee->id }}</td>
                <td>{{ $employee->full_name }}</td>
                <td>{{ $employee->role->name }}</td>
                <td>{{ $employee->user?->email ?? 'Sin usuario' }}</td>
                <td>{{ $employee->phone }}</td>
                <td>{{ $employee->shift }}</td>
                <td>{{ $employee->entry_date->format('d/m/Y') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="summary">
        <h3>Resumen por Roles</h3>
        @php
            $roleStats = $employees->groupBy('role.name')->map(function($group) {
                return $group->count();
            });
        @endphp
        
        @foreach($roleStats as $role => $count)
            <span class="role-count">
                <strong>{{ $role }}:</strong> {{ $count }}
            </span>
        @endforeach

        @if($roleStats->get('Administrador', 0) > 2)
            <div style="color: #ef4444; margin-top: 10px;">
                ⚠️ <strong>Alerta:</strong> Hay más de 2 administradores ({{ $roleStats->get('Administrador') }})
            </div>
        @endif
    </div>

    <div class="footer">
        BrewBoard ERP - Generado automáticamente
    </div>
</body>
</html>