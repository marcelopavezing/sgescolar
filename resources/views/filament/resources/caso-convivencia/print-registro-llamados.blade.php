<div>
    <h1>Registro de Llamados - Caso #{{ $caso->id }}</h1>
    <p><strong>Descripción del caso:</strong> {{ $caso->descripcion }}</p>
    <button onclick="printDiv('registro_llamados')" class="print:hidden inline-block px-4 py-2 text-sm font-semibold bg-blue-600 rounded hover:bg-blue-700 transition">
        🖨️ Imprimir
    </button>

    <div class="">
        <table id="registro_llamados" class="min-w-full border border-gray-200 text-sm text-left text-gray-800 rounded-lg overflow-hidden">
            <thead class="bg-blue-100 text-blue-800 uppercase text-xs font-semibold tracking-wide">
                <tr>
                    <th class="px-4 py-3">#</th>
                    <th class="px-4 py-3">Nombre Contacto</th>
                    <th class="px-4 py-3">Número Teléfono</th>
                    <th class="px-4 py-3">Fecha</th>
                    <th class="px-4 py-3">Hora</th>
                    <th class="px-4 py-3">Observación</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
            @forelse($registro_de_llamados as $i => $llamado)
            <tr class="hover:bg-gray-50">
                <td class="px-4 py-2">{{ $i + 1 }}</td>
                <td class="px-4 py-2">{{ $llamado['nombre_contacto'] ?? '' }}</td>
                <td class="px-4 py-2">{{ $llamado['numero_telefono'] ?? '' }}</td>
                <td class="px-4 py-2">{{ $llamado['fecha'] ?? '' }}</td>
                <td class="px-4 py-2">{{ $llamado['hora'] ?? '' }}</td>
                <td class="px-4 py-2">{{ $llamado['observacion_llamados'] ?? '' }}</td>
            </tr>
            @empty
            <tr><td colspan="6" style="text-align:center">No hay registros de llamados.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
@section('scripts')
<script javascript>
function printDiv(divId) {
    const content = document.getElementById(divId).innerHTML;
    const printWindow = window.open('', '', 'height=600,width=800');
    printWindow.document.write(`
        <html>
            <head>
                <title>Impresión</title>
                <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
                <style>
                    @media print {
                        body { margin: 0; padding: 1rem; }
                    }
                </style>
            </head>
            <body>${content}</body>
        </html>
    `);
    printWindow.document.close();
    printWindow.focus();
    printWindow.print();
    printWindow.close();
}
</script>
@endsection
