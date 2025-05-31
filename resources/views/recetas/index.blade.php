<x-app-layout>
    <x-slot name="header">
        <h2>Listado de Recetas</h2>
    </x-slot>

    <div>
        <div>
            <div>
                <a href="{{ route('recetas.create') }}">Añadir Nueva Receta</a>

                @if ($recetas->isEmpty())
                    <p>No hay recetas disponibles.</p>
                @else
                    <table style="width:100%; border: 1px solid black; border-collapse: collapse; margin-top: 15px;">
                        <thead style="background-color: #f0f0f0;">
                            <tr>
                                <th style="border: 1px solid black; padding: 5px; text-align: center;">Nombre</th>
                                <th style="border: 1px solid black; padding: 5px; text-align: center;">Descripción</th>
                                <th style="border: 1px solid black; padding: 5px; text-align: center;">Tiempo preparación.</th>
                                <th style="border: 1px solid black; padding: 5px; text-align: center;">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($recetas as $receta)
                                <tr>
                                    <td style="border: 1px solid black; padding: 5px; text-align: center;">{{ $receta->name }}</td>
                                    <td style="border: 1px solid black; padding: 5px; text-align: center;">{{ Str::limit($receta->description, 30) }}</td>
                                    <td style="border: 1px solid black; padding: 5px; text-align: center;">{{ $receta->preparation_time }} min</td>
                                    <td style="border: 1px solid black; padding: 5px; text-align: center;">
                                        <a href="{{ route('recetas.show', $receta) }}">Ver</a> |
                                        <a href="{{ route('recetas.edit', $receta) }}">Editar</a> |
                                        <form action="{{ route('recetas.destroy', $receta) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="return confirm('¿Eliminar?');" style="background:none; border:none; color:red; cursor:pointer;">Eliminar</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>