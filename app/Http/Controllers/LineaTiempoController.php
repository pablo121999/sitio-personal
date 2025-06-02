<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LineaTiempo;
use Illuminate\Support\Facades\Storage;
use Exception;

class LineaTiempoController extends Controller
{
    public function index()
    {
        return view('LineaTiempo.main');
    }

    public function ListaLineaTiempo()
    {
        return response()->json(LineaTiempo::select('id', 'ano', 'titulo', 'descripcion')->get());
    }

    public function crear()
    {
        return view('LineaTiempo.crear');
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'ano' => 'required|integer|min:1',
                'titulo' => 'required|string|max:255',
                'descripcion' => 'required|string',
                'imagen' => 'required|image|mimes:jpg,jpeg,png,webp,gif|max:2048',
            ]);

            // Guardar la imagen en storage/app/public/linea_tiempo
            $rutaImagen = $request->file('imagen')->store('linea_tiempo', 'public');

            $linea = LineaTiempo::create([
                'ano' => $request->ano,
                'titulo' => $request->titulo,
                'descripcion' => $request->descripcion,
                'imagen' => $rutaImagen,
            ]);

            return redirect()->route('LineaTiempo')->with('success', 'Registro guardado exitosamente.');

        } catch (Exception $e) {
            return redirect()->route('LineaTiempo')->with('error', 'Ocurrió un error: ' . $e->getMessage());
        }
    }

    public function show($id)
    {
        $linea = LineaTiempo::findOrFail($id);
        return response()->json($linea);
    }

    public function update($id)
    {
        return view('LineaTiempo.editar', [
            'LineaTiempo' => LineaTiempo::where('id', $id)->select('id', 'ano', 'titulo', 'descripcion', 'imagen')->first(),
        ]);
    }

    public function actualizar(Request $request, $id)
    {
        $request->validate([
            'ano' => 'required|integer|min:1',
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'imagen' => 'nullable|image|mimes:jpg,jpeg,png,webp,gif|max:2048',
        ]);

        // Buscar el registro por ID
        $linea = LineaTiempo::findOrFail($id);

        // Si se sube nueva imagen, reemplazar
        if ($request->hasFile('imagen')) {
            // Opcional: eliminar imagen anterior
            if ($linea->imagen && Storage::disk('public')->exists($linea->imagen)) {
                Storage::disk('public')->delete($linea->imagen);
            }

            // Guardar nueva imagen
            $rutaImagen = $request->file('imagen')->store('linea_tiempo', 'public');
            $linea->imagen = $rutaImagen;
        }

        $linea->ano = $request->ano;
        $linea->titulo = $request->titulo;
        $linea->descripcion = $request->descripcion;
        $linea->save();

        return redirect()->route('LineaTiempo')->with('success', 'Registro actualizado exitosamente.');
    }


    public function destroy($id)
    {
        $linea = LineaTiempo::findOrFail($id);

        // Eliminar imagen del storage si existe
        if ($linea->imagen && Storage::disk('public')->exists($linea->imagen)) {
            Storage::disk('public')->delete($linea->imagen);
        }

        // Eliminar el registro
        $linea->delete();

        return redirect()->route('LineaTiempo')->with('success', 'Registro eliminado exitosamente.');
    }
}
